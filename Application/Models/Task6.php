<?php
namespace Application\Models;

// Задание 6
class Task6
{
	private $arr;   // Массив случайных чисел
    
    // length - длинна исходного массива,
    // min_val и max_val - минимальное и максимальное значения массива
    public function __construct($length, $min_val, $max_val)
    {
		$array = array();
		for ($i = 0; $i <=$length; $i++) {
			$rand = mt_rand ($min_val, $max_val);
			$array[$i] = $rand;
		}
		$this->arr = $array;
    }
    
    // Получение входных данных задания
    public function getInputData()
    {
        return $this->arr;
    }
    
    // Получить результат
    public function getResult()
    {
        $repeat_counts = array_count_values($this->arr);    // Получить количество повторений каждого значения массива
		$max_repeat_count = max($repeat_counts);            // Максимальное количество повторений
		$repeats = array();
		for ($i = 2; $i <= $max_repeat_count; $i++) {       // Для всех возможных количеств повторений
            // Склеить массив повторяемых чисел с найденными числами
			$repeats = array_merge(
                $repeats,                       // Найденные числа
                array_keys($repeat_counts, $i)  // Выбрать из массива посторений числа, повторяемые $i раз
            );
		}

		return $repeats;
	}
}
