<?php
namespace Application\Controllers;

use Krokhmal\Soft\Web\MVC\BaseController;

class HomeController extends BaseController
{	
    public function index()
    {
        $data['title'] = 'Главная - тестовое задание';
        return $this->view($data);
    }
}