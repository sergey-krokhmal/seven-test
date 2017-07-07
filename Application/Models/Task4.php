<?php
namespace Application\Models;

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
			SELECT a.* FROM `departs` a
			LEFT JOIN `departs` b ON a.parent = b.id
			WHERE b.id IS NULL AND a.id IN (
				SELECT b.parent
				FROM `departs` a
				LEFT JOIN `departs` b ON a.id = b.parent
				GROUP BY b.parent
				HAVING COUNT(b.id) >= 3
			)
		");

		return $stm->fetchAll();
	}
}