<?php
namespace Application\Controllers;

use Krokhmal\Soft\Web\MVC\BaseController;

class NotFoundController extends BaseController
{	
    public function index()
    {
        $data['title'] = '404 - страница не найдена';
        return $this->view();
    }
}