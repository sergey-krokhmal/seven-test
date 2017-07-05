<?php
namespace Krokhmal\Soft\Web;

// абстрактный класс движка API
abstract class ApiEngine
{
    // Экончание имени контроллера
    protected $controller_postfix;
    
    public function __construct($controller_postfix)
    {
        $this->controller_postfix = $controller_postfix;
    }
    
    // Сункци§ выполнени§ запроса
    abstract public function executeRequest($http_method, $url_path, $assoc_params);
}
