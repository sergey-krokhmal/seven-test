<?php
namespace Krokhmal\Soft\Application\Config;

public class Routes
{
	const ROOT = $_SERVER['DOCUMENT_ROOT'].'/';
	const APP_DIR = 'Application/';
	const APP_PATH = ROOT.APP_DIR;
	const VIEW404 = 'Application/Views/Shared/404.php';
	
    const ROUTE_LIST = array
    (
		// Главная 
        array(
			'pattern' => '~^/*$~',
			'controller' => 'Home',
			'method' => 'index',
		),
		
		// Страница списка выполненных заданий
		array(
			'pattern' => '~^/tasks/?$~',
			'controller' => 'TestTasks',
			'method' => 'index',
		),
		
		// Страница выполненного тестового задания
		array(
			'pattern' => '~^/tasks/solved/(?<task_number>[a-z0-9_-]+){1}$~',
			'controller' => 'TestTasks',
			'method' => 'solvedTask',
			'arguments' => array('task_number');
		),
		
		// Страница тестовых заданий
		array(
			'pattern' => '~^/tasks/list$~',
			'controller' => 'TestTasks',
			'method' => 'taskList',
		),
    );
}
 