<?php
namespace Application\Models;

class Task7
{
	private $arr;
    
    public function __construct($array)
    {
		$this->arr = $array;
    }
    
	private function incrementIndexes($input_array, &$column_indexes, $row = false) {
		$count = count($column_indexes);
		if ($row === false) {
			$row = $count-1;
		}
		if (isset($column_indexes[$row])) {
			if ($column_indexes[$row] == count($input_array[$row])-1) {
				$column_indexes[$row] = 0;
				incrementIndexes($input_array, $column_indexes, $row-1);
			} else {
				$column_indexes[$row]++;
			}
		} else {
			return;
		}
	}
	
    public function getInputData()
    {
        return $this->arr;
    }
    
    public function getResult()
    {
        $result = array();

		$comb_count = 1;
		foreach($input_array as $row_array) {
			$comb_count *= count($row_array);
		}
		$comb_row_length = count($input_array);
		$column_indexes = array_fill(0, $comb_row_length, 0);

		// Для всех комбинаций 
		for ($i = 0; $i < $comb_count; $i++) {
			// Для каждого индекса значения для комбинации из каждого исходного массива значений
			foreach ($column_indexes as $row_index => $col_index) {
				// Выбираем соответствующие индексам значения в новую комбинацию
				$result[$i][$row_index] = $input_array[$row_index][$col_index];
			}
			// Инкремент индекса
			$this->incrementIndexes($input_array, $column_indexes);
		}
		return $result;
	}
}