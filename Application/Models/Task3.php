<?php
namespace Application\Models;

use \PDO;

class Task3
{
    private $db;        // Соединение с БД
    private $top_level; // Последний уровень дерева
	private $rows;      // Массив записей БД
    
    public function __construct($db, $top_level = 5)
    {
        $this->db = $db;
        $this->top_level = $top_level;
        
        // Получить количество записей таблицы дерева
		$stm = $db->query("SELECT * FROM `departs`");
		$count = $stm->rowCount();
		// Если таблица пустая, то инициировать ее случайным деревом
		if ($count == 0) {
			$top_level_count = 0;   // Колисество элементов последнего уровня
			$i = 0;                 // Индекс-Id элемента и максимальный id родителя
			$tree = array();        // Массив дерева
			while($top_level_count <= 8) {  // Пока элементов последнего уровня меньше 8
				$parent = rand(0, $i);      // Выбрать случайного родителя
				if ($parent == 0) {         // Если родитель 0
					$level = 0;             // Новый уровень 0
				} else {
					$level = $tree[$parent]['level']+1; // Иначе взять уроовень родителя + 1
				}
				if ($level == $top_level+1) {           // Если новый уровень ниже последнего уровня на единицу
					$level = $top_level;                // Поставить ему последний уровень
					$parent = $tree[$parent]['parent']; // И родителя взять с последнего уровня
				}
				if ($level == $top_level) { // Если уровень нового элемента равен последнему
					$top_level_count++;     // Увеличить счетчик элементов последнего уровня
				}
				$i++;   // Инкремент id элемента
				$name = $this->randStr(7);  // Генерировать случайное имя элемента
				$this->insertNode($tree, $i, $level, $name, $parent);   // Добавить элемент к дереву
			}
            // Для всех элементов дерева
			foreach($tree as $id => $node) {
                // Вставить элемент в таблицу БД
				$this->db->exec("INSERT INTO `departs` SET id = $id, name = '".$node['name']."', parent = ".$node['parent']);
			}
            // Получить записи новых элементов дерева из таблицы
			$stm = $db->query("SELECT * FROM `departs`");
		}
        // Получить записи элементов в виде массива
		$this->rows = $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Добавление элемента к массиву дерева
	private function insertNode(&$tree, $i, $level, $name, $parent) // функция фставки ветви в массив дерева
	{
		$tree[$i]['name'] = $name;
		$tree[$i]['parent'] = $parent;
		$tree[$i]['level'] = $level;
	}
	
    // Функция генерирования случайной строки длинной до $max_len символов
	public function randStr($max_len)
	{
		$r_len = rand(1,$max_len);  // Получить случайную длинну строки
		$rs = '';                   // Изначально строка пуста
        // Склеить строку из случайных символов алфавита
		for($i = 0; $i < $r_len; $i++) {
			$rc = chr(rand(65,90));
			$rs .= $rc;
		}
		return $rs;
	}
	
    // Получение входных данных задания
    public function getInputData()
    {
        return $this->rows;
    }
    
    // Формировать ветку дерева
	private function createTree($arr, $parent = 0, $level = 0)
	{
		$tree = '';
        // Если элемент высшего уровня
		if ($parent == 0) {
            // Приставки нет
			$pre = '';
		} else {
            // Иначе есть приставка
			$pre = '->';
		}
        // Для всех элементов дерева
		for ($i = 0; $i < count($arr); $i++) {
            // Если элемент является потомком вершины текущей ветки
			if ($arr[$i]['parent'] == $parent) {
                // Добавить к имени этого элемента отступ
				$tree .= str_repeat('  ', $level);
				$tree .= $pre.$arr[$i]['name'].'<br/>';
                // Сформировать отступы для потомков этого элемента
				$tree .= $this->createTree($arr, $arr[$i]['id'], $level+1);
			}
		}
		return $tree;
	}
	
    // Получить результат
    public function getResult()
    {
        return $this->createTree($this->rows);
    }
}
