<?php
namespace Krokhmal\Soft\Web\MVC;

use Krokhmal\Soft\Web\WebEngine;
use Application\Config\Routes;

// MVC движок
class MVCEngine extends WebEngine
{
    // Выполнить запрос с параметрами
    public function executeRequest($request_uri, $assoc_params = array())
    {
        $url_path = parse_url($request_uri, PHP_URL_PATH);  // Получить URL путь
		$url_path = preg_replace('~/$~', '', $url_path);    // Удалить окончание / для проверки маршрута
        
        // По умолчанию маршрут считается не найденым
		$controller_name = "Application\\Controllers\\NotFoundController";
		$method_name = 'index';
		$arguments = array();
		
        // Для всех маршрутов в списке допустимых
		foreach(Routes::ROUTE_LIST as $route) {
            // Найти соответствующий шаблону маршрута
			if(preg_match($route['pattern'], $url_path, $matches)) {
                // Сформировать имя контроллера
				$controller_name = "Application\\Controllers\\".$route['controller'].'Controller';
                // Получить имя метода
				$method_name = $route['method'];
                // Если в маршруте присутствуют аргументы, получить их
				if (isset($route['arguments'])) {
					foreach($route['arguments'] as $arg_name) {
						$arguments[$arg_name] = $matches[$arg_name];
					}
				}
				break;
			}
		}
		
        // Создать экземпляр контроллера
        $controller = new $controller_name();
        // Выполнить его метод
        $view = $controller->$method_name($arguments);
        // Отобразить полученное представление
        $view->render();
    }
}
