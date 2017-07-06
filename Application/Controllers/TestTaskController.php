<?php
namespace Application\Controllers;

use Krokhmal\Soft\Web\MVC\BaseController;
use Application\Models\Task1 as Task1;
use Application\Models\Task2 as Task2;

class TestTaskController extends BaseController
{	
    public function index()
    {
        $data['title'] = 'Список выполненных тестовых заданий';
        return $this->view($data);
    }
    
    public function solvedTask($args)
    {
        $data['title'] = 'Список выполненных тестовых заданий';
        switch($args['task_number']) {
            case 1:
                $task = new Task1($_SERVER['DOCUMENT_ROOT'].'/files/test.txt');
                $data['input_data'] = $task->getInputData();
                $data['input_data_name'] = 'Текст файла';
                $result = $task->getResult();
                $data['result'][0]['name'] = 'Массив с контентом';
                $data['result'][0]['array'] = $result['content'];
                $data['result'][1]['name'] = 'Массив с описанием';
                $data['result'][1]['array'] = $result['description'];
            break;
            case 2:
                $task = new Task2($_SERVER['DOCUMENT_ROOT'].'/files/test2.txt');
                $data['input_data'] = $task->getInputData();
                $data['input_data_name'] = 'Текст файла';
                $result = $task->getResult();
                $data['result'][0]['name'] = 'Массив с ключами и их значениями';
                $data['result'][0]['array'] = $result;
            break;
        }
        
        
        return $this->view($data);
    }
}