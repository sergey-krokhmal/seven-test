<?php
namespace Application\Controllers;

public class HomeController extends BaseController
{
	private function renderView($data = array()) {
		
	}
	
    public function index()
    {
        echo "home, work";
    }
}