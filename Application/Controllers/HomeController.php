<?php
namespace Application\Controllers;

use Krokhmal\Soft\Web\MVC\BaseController;

// Контроллер главной страницы
class HomeController extends BaseController
{	
    // Вывод главной страницы
    public function index()
    {
        $data['title'] = 'Главная - тестовое задание';
        return $this->view($data);
    }
}
