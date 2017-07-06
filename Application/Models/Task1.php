<?php
namespace Application\Models;

class Task1
{
    private $file_text;
    
    public function __construct($file_name)
    {
        $this->file_text = file_get_contents($file_name, 'r');
    }
    
    public function getInputData()
    {
        return $this->file_text;
    }
    
    public function getResult()
    {
        $description_arr = array();
        $content_arr = array();
        if ($this->file_text !== false){
            $pattern = '/\[(?<name>\w+)(?::(?<description>[\w ]*))?\](?<content>.*)\[\/(?:\w+)\]/u';
            if (preg_match_all($pattern, $this->file_text, $matches)) {
                $count = count($matches[0]);
                for($i = 0; $i < $count; $i++) {
                    $content_arr[$matches['name'][$i]] = $matches['content'][$i];
                    $description_arr[$matches['name'][$i]] = $matches['description'][$i];
                }
            }
        }
        return array(
            'content' => $content_arr,
            'description' => $description_arr
        );
    }
}