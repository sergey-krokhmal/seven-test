<?php
namespace Krokhmal\Soft\Web\MVC;

public abstract class BaseController
{
	private function renderView($data = array()) {
		
	}
	
    public function index()
    {
        echo "home, work";
    }
}