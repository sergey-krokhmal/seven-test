<?php
namespace Application\Models;

use \PDO;

class Task3
{
    private $db;
    private $top_level;
	private $rows;
    
    public function __construct($db, $top_level = 5)
    {
        $this->db = $db;
        $this->top_level = $top_level;
		$stm = $db->query("SELECT * FROM `departs`");
		$count = $stm->rowCount();
		// Если таблица пустая, то инициировать ее случайным деревом
		if ($count == 0) {
			$top_level_count = 0;   // Колисество ветвей последнего уровня
			$i = 0;                 // Индекс-Id ветви
			$tree = array();        // Массив дерева
			while($top_level_count <= 8) {  // Пока ветвей максимального уровня меньше 8
				$parent = rand(0, $i);      // Выбрать случайного родителя
				if ($parent == 0) {         // Если родитель 0
					$level = 0;             // Новый уровень 0
				} else {
					$level = $tree[$parent]['level']+1; // Иначе взять уроовень родителя + 1
				}
				if ($level == $top_level+1) {   // Если новый уровень ниже $top_level на единицу
					$level = $top_level; // Поставить ему максимальный уровень
					$parent = $tree[$parent]['parent']; // И родителя взять с максимального уровня
				}
				if ($level == $top_level) {
					$top_level_count++;
				}
				$i++;
				$name = $this->randStr(5);
				$this->insertNode($tree, $i, $level, $name, $parent);
			}
			foreach($tree as $id => $node) {
				$this->db->exec("INSERT INTO `departs` SET id = $id, name = '".$node['name']."', parent = ".$node['parent']);
			}
			$stm = $db->query("SELECT * FROM `departs`");
		}
		$this->rows = $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
	private function insertNode(&$tree, $i, $level, $name, $parent) // функция фставки ветви в массив дерева
	{
		$tree[$i]['name'] = $name;
		$tree[$i]['parent'] = $parent;
		$tree[$i]['level'] = $level;
	}
	
	public function randStr($max_len) // Функция генерирования случайной строки длинной до $max_len символов
	{
		$r_len = rand(1,$max_len);
		$rs = '';
		for($i = 0; $i < $r_len; $i++) {
			$rc = chr(rand(65,90));
			$rs .= $rc;
		}
		return $rs;
	}
	
    public function getInputData()
    {
        return $this->rows;
    }
    
	private function createTree($arr, $parent = 0, $level = 0)
	{
		$tree = '';
		if ($parent == 0) {
			$pre = '';
		} else {
			$pre = '->';
		}
		for ($i = 0; $i < count($arr); $i++) {
			if ($arr[$i]['parent'] == $parent) {
				$tree .= str_repeat('  ', $level);
				$tree .= $pre.$arr[$i]['name'].'<br/>';
				$tree .= $this->createTree($arr, $arr[$i]['id'], $level+1);
			}
		}
		return $tree;
	}
	
    public function getResult()
    {
        return $this->createTree($this->rows);
    }
}
