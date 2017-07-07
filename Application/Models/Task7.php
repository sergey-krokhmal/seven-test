<?php
namespace Application\Models;

// Задача 7
class Task7
{
	private $arr;   // Массив исходных элементов
    
    public function __construct($array)
    {
		$this->arr = $array;
    }
    
    // Инткемент индексов строки row исходного массива для выбора элементов в комбинацию
    // input_array - исходный массив
    // column_indexes - массив индексов
    // row - строка для которой делается инкремент
	private function incrementIndexes($input_array, &$column_indexes, $row = false) {
		$count = count($column_indexes);    // Получить количество строк исходного массива
		if ($row === false) {               // Если инкрементируемая строка не указана
			$row = $count-1;                // То взять последнюю из строк
		}
        // Если индекс выбранной строки row существует
		if (isset($column_indexes[$row])) {
            // Если индекс элемента выбранной строки последний
			if ($column_indexes[$row] == count($input_array[$row])-1) {
                // Сбросить индекс строки row
				$column_indexes[$row] = 0;
                // Но сделать инкремент предыдущей строки
				$this->incrementIndexes($input_array, $column_indexes, $row-1);
			} else {
                // Если индекс строки row не последний, то инкрементировать его
				$column_indexes[$row]++;
			}
        // Закончить инкремент, если предыдущая строка row была последней
		} else {
			return;
		}
	}
	
    // Получение входных данных задания
    public function getInputData()
    {
        return $this->arr;
    }
    
    // Получить результат
    public function getResult()
    {
        $result = array();          // Результирующий массив
        $input_array = $this->arr;  // Исходный массив
		$comb_count = 1;            // Количество комбинаций
        // Посчитать количество комбинаций
		foreach($input_array as $row_array) {
			$comb_count *= count($row_array);
		}
		$comb_row_length = count($input_array); // Длинна комбинации
        // Сформировать массив индексов каждой строки исходного массива
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
