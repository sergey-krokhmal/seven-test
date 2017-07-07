<?php
namespace Application\Models;

// Задание 1
class Task1
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
        $description_arr = array(); // Массив описаний тегов
        $content_arr = array();     // Массив контента тегов
        
        // Если файл прочитан
        if ($this->file_text !== false){
            // Определить шаблон для тегов, их описания и контента
            $pattern = '/\[(?<name>\w+)(?::(?<description>[\w ]*))?\](?<content>.*)\[\/(?:\w+)\]/u';
            // Найти все теги
            if (preg_match_all($pattern, $this->file_text, $matches)) {
                $count = count($matches[0]);
                // Для каждого тега
                for($i = 0; $i < $count; $i++) {
                    $content_arr[$matches['name'][$i]] = $matches['content'][$i];   // Получить контент тега
                    $description_arr[$matches['name'][$i]] = $matches['description'][$i];   // Получить описание тега
                }
            }
        }
        
        // Возвратить оба массива
        return array(
            'content' => $content_arr,
            'description' => $description_arr
        );
    }
}