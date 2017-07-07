<?php
namespace Application\Controllers;

use Krokhmal\Soft\Web\MVC\BaseController;
use Application\Models\Task1 as Task1;
use Application\Models\Task2 as Task2;
use Application\Models\Task3 as Task3;
use Application\Models\Task4 as Task4;
use Application\Models\Task5 as Task5;
use Application\Models\Task6 as Task6;
use Application\Models\Task7 as Task7;
use \PDO;

class TestTaskController extends BaseController
{	
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=tree', 'tree', 'tree');
	}
	
    public function index($args = array())
    {
		$data = $args;
        $data['title'] = 'Список заданий';
		$data['title_h2'] = $data['title'];
        return $this->view($data);
    }
    
    public function solvedTask($args)
    {
		$data = $args;
        $data['title'] = 'Список выполненных тестовых заданий';
		$data['title_h2'] = 'Задание №'.$args['task_number'];
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
			case 3:
			case 4:
			case 5:
				switch($args['task_number']) {
					case 3:
						$task = new Task3($this->db);
						$data['result'][0]['name'] = 'Массив комбинаций';
					break;
					case 4:
						$task = new Task4($this->db);
						$data['result'][0]['name'] = 'Массив комбинаций';
					break;
					case 5:
						$task = new Task5($this->db);
						$data['result'][0]['name'] = 'Массив комбинаций';
					break;
				}
				$data['input_data_name'] = 'Массив дерева (список смежности)';
				$data['input_data'] = $task->getInputData();
				$result = $task->getResult();
				$data['result'][0]['array'] = $result;
			break;
			case 6:
				$task = new Task6(1000000, 100000, 1500000);
                $data['input_data'] = 'Массив слишком большой для отображения';
                $data['large_array'] = true;
                if (isset($_POST['show_anyway'])) {                    
                    $data['input_data'] = $task->getInputData();
                }
                $data['input_data_name'] = 'Массив случайных чисел';
                $result = $task->getResult();
                $data['result'][0]['name'] = 'Массив повторяемых значений';
                $data['result'][0]['array'] = $result;
			break;
			case 7:
				$task = new Task7(
					[
						['a1', 'a2', 'a3'],
						['b1', 'b2'],
						['c1', 'c2', 'c3'],
						['d1']
					]
				);
                $data['input_data'] = $task->getInputData();
                $data['input_data_name'] = 'Массивы значений';
                $result = $task->getResult();
                $data['result'][0]['name'] = 'Массив комбинаций';
                $data['result'][0]['array'] = $result;
			break;
			case '':
				return $this->index($data);
			break;
			default:
				$data['err_msg'] = "Задания под номером ".$args['task_number']." нет! Выберите задание из списка.";
				return $this->index($data);
        }
        
        
        return $this->view($data);
    }
	
	public function tasksText()
	{
		$data['title'] = 'Текст тестового задания';
		return $this->view($data);
	}
}