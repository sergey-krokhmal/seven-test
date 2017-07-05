<?php
namespace Krokhmal\Soft\Web\MVC;

abstract class BaseController
{
	public function view($data = array()) {
		$full_class_name = get_class($this);
        $view_dir = str_replace("Application\\Controllers\\", "Application\\Views\\", $full_class_name);
        $view_dir = str_replace("Controller", "", $view_dir);
        $view_file = debug_backtrace()[1]['function'];
        return new View($view_dir, $view_file, $data);
	}
    
    public function customView($view_name, $data = array()) {
    }
	
    abstract public function index();
}