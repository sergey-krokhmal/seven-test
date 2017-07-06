<?php
namespace Application\Models;

class Task2
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
        $result_arr = array();
        $pattern = '/(?<key>raz|dva|tri):(?<data>.*?)(?=(?:raz|dva|tri|$))/u';
        if (preg_match_all($pattern, $this->file_text, $matches)) {
            for($i = 0; $i < count($matches[0]); $i++) {
                $result_arr[$matches['key'][$i]] = $matches['data'][$i];
            }
        }
        return $result_arr;
    }
}