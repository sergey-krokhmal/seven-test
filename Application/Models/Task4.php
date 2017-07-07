<?php
namespace Application\Models;

use \PDO;

class Task4
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
			LEFT JOIN `departs` child_l1 ON child_l1.parent = res.id
			LEFT JOIN `departs` child_l2 ON child_l2.parent = child_l1.id
			LEFT JOIN `departs` child_l3 ON child_l3.parent = child_l2.id  
			LEFT JOIN `departs` no_parent ON no_parent.id = res.parent
			WHERE child_l3.id IS NOT NULL AND no_parent.id IS NULL
            GROUP BY res.id
		");

		return $stm->fetchAll(PDO::FETCH_ASSOC);
	}
}