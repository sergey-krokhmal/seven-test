<?php
namespace Krokhmal\Soft\Web\MVC;

// MVC маршрут
class Route
{
	private $url_pattern;
	private $controller_name;
	private $method;
	private $url_query_params;
	
	public function __construct(string $url_pattern, string $controller_name, string $method, $url_query_params = array()){
		$this->url_pattern = $url_pattern;
		$this->controller_name = $controller_name;
		$this->method = $method;
		$this->url_query_params = $url_query_params;
	}
}
