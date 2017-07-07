<?php
namespace Application\Config;

// Маршруты сайта
class Routes
{	
    // Массив маршрутов сайта
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
			'pattern' => '~^/tasks$~',
			'controller' => 'TestTask',
			'method' => 'index',
		),
		
		// Страница выполненного тестового задания
		array(
			'pattern' => '~^/tasks/solved(?:/(?<task_number>[a-z0-9_-]+))?$~',
			'controller' => 'TestTask',
			'method' => 'solvedTask',
			'arguments' => array('task_number')
		),
		
		// Страница тестовых заданий
		array(
			'pattern' => '~^/tasks/text$~',
			'controller' => 'TestTask',
			'method' => 'tasksText',
		),
    );
}
