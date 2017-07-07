<?php
namespace Application\Models;

// Задание 2
class Task2
{
    private $file_text; // Текст исходного файла
    
    public function __construct($file_name)
    {
        // Прочитать исходный файл
        $this->file_text = file_get_contents($file_name, 'r');
    }
    
    // Получение входных данных задания
    public function getInputData()
    {
        return $this->file_text;
    }
    
    // Получить результат
    public function getResult()
    {
        $result_arr = array();  // Массив ключей с их значениями
        // Шаблон для определения ключей и их значений
        $pattern = '/(?<key>raz|dva|tri):(?<data>.*?)(?=(?:raz|dva|tri|$))/u';
        // Если найдены ключи со значениями в тексте
        if (preg_match_all($pattern, $this->file_text, $matches)) {
            // Сформировать массив ключей и значений текста
            for($i = 0; $i < count($matches[0]); $i++) {
                $result_arr[$matches['key'][$i]] = $matches['data'][$i];
            }
        }
        return $result_arr;
    }
}
