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
        $url_path = parse_url($request_uri, PHP_URL_PATH);
        
		foreach(Routes::ROUTE_LIST as $route) {
			if(preg_match($route['pattern'], $url_path, $matches)) {
				$controller_name = $route['controller'].'Controller';
				$method_name = $route['method'];
				$arguments = array();
				if (isset($route['arguments'])) {
					foreach($route['arguments'] as $arg_name) {
						$arguments[$arg_name] = $matches[$arg_name];
					}
				}
				break;
			}
		}
		
		if (isset($controller_name)) {
			print_r($controller_name);
			$controller = $$controller_name();
			$controller->$method_name($arguments);
		}
    }
}
