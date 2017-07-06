<?php
namespace Application\Models;

class Task6
{
	private $arr;
    
    public function __construct($length, $min_val, $max_val)
    {
		$array = array();
		for ($i = 0; $i <=$length; $i++) {
			$rand = mt_rand ($min_val, $max_val);
			$array[$i] = $rand;
		}
		$this->arr = $array;
    }
    
    public function getInputData()
    {
        return $this->arr;
    }
    
    public function getResult()
    {
        $repeat_counts = array_count_values($array);    // Получить количество повторений каждого значения массива
		$max_repeat_count = max($repeat_counts);        // Максимальное количество повторений
		$repeats = array();
		for ($i = 2; $i <= $max_repeat_count; $i++) {       // Для всех возможных количеств повторений
			$repeats = array_merge($repeats, array_keys($repeat_counts, $i));
		}

		return $repeats;
	}
}