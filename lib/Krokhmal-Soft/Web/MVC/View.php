<?php
namespace Krokhmal\Soft\Web\MVC;

class View
{
    private $dir_name;      // Каталог шаблона
    private $file_name;     // Имя шаблона
    private $data;          // Данные модли шаблона
    private $default_title = 'Тестовое задание для "7 Ветров" от Сергея Крохмаля';  // Заголовок страницы по умолчанию
    
    // Создание экземпляра представления с коталогом и именем шаблона, и его данными
    public function __construct($dir_name, $file_name, $data)
    {
        $this->dir_name = $dir_name;
        $this->file_name = $file_name;
        $this->data = $data;
    }
    
    // Отображение шаблона
    public function render() {
        // Превратить массив данных в переменные
        foreach($this->data as $name => $var) {
            $$name = $var;
        }
        // Установить заголовок, если он был указан
        $title = $this->data['title'] ?? $this->default_title;
        // Сбросить массив данных
        unset($this->data);
        // Сформировать на вывод страницу из шапки, текущего шаблона и подвала страницы
        include($_SERVER['DOCUMENT_ROOT'].'\\'."Application\\Views\\Shared\\header.php");
        include($_SERVER['DOCUMENT_ROOT'].'\\'.$this->dir_name.'\\'.$this->file_name.'.php');
        include($_SERVER['DOCUMENT_ROOT'].'\\'."Application\\Views\\Shared\\footer.php");
    }
}
