<?php
namespace Application\Models;

use \PDO;

// Задача 5
class Task5
{
    private $db;    // Подключение к БД
	private $rows;  // Массив записей из таблицы БД
    
    public function __construct($db)
    {
		$this->db = $db;
		$task3 = new Task3($db);                // Создать объект 3-го задания
		$this->row = $task3->getInputData();    // Получить исходный массив из задания 3
    }
    
    // Получение входных данных задания
    public function getInputData()
    {
        return $this->row;
    }
    
    // Получить результат
    public function getResult()
    {
        // Записи без потомков, но с 2-мя старшими родителями
        $stm = $this->db->query("
			SELECT res.* FROM `departs` res
			LEFT JOIN `departs` parent_l1 ON parent_l1.id = res.parent
			LEFT JOIN `departs` parent_l2 ON parent_l2.id = parent_l1.parent
			LEFT JOIN `departs` parent_l3 ON parent_l3.id = parent_l2.parent
            LEFT JOIN `departs` no_child ON no_child.parent = res.id
			WHERE
            	parent_l1.id IS NOT NULL AND 
                parent_l2.id IS NOT NULL AND
                parent_l3.id IS NULL AND
                no_child.id IS NULL
		");
		return $stm->fetchAll(PDO::FETCH_ASSOC);
	}
}
