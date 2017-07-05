<?php
namespace Krokhmal\Soft\Web\MVC;

class View
{
    private $dir_name;
    private $file_name;
    private $data;
    private $default_title = 'Тестовое задание для "7 Ветров" от Сергея Крохмаля';
    
    public function __construct($dir_name, $file_name, $data)
    {
        $this->dir_name = $dir_name;
        $this->file_name = $file_name;
        $this->data = $data;
    }
    
    public function render() {
        foreach($this->data as $name => $var) {
            $$name = $var;
        }
        $title = $this->data['title'] ?? $this->default_title;
        unset($this->data);
        include($_SERVER['DOCUMENT_ROOT'].'\\'."Application\\Views\\Shared\\header.php");
        include($_SERVER['DOCUMENT_ROOT'].'\\'.$this->dir_name.'\\'.$this->file_name.'.php');
        include($_SERVER['DOCUMENT_ROOT'].'\\'."Application\\Views\\Shared\\footer.php");
    }
}