<?php
namespace Application\Models;

use \PDO;

class Task5
{
    private $db;
	private $rows;
    
    public function __construct($db)
    {
		$this->db = $db;
		$task3 = new Task3($db);
		$this->row = $task3->getInputData();
    }
    
    public function getInputData()
    {
        return $this->row;
    }
    
    public function getResult()
    {
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