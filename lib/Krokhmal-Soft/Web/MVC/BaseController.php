<?php
namespace Krokhmal\Soft\Web\MVC;

abstract class BaseController
{
	
	private function getViewDir() {
		$full_class_name = get_class($this);
        $view_dir = str_replace("Application\\Controllers\\", "Application\\Views\\", $full_class_name);
        $view_dir = str_replace("Controller", "", $view_dir);
		return $view_dir;
	}
	
	public function view($data = array()) {
        $view_dir = $this->getViewDir();
        $view_file = debug_backtrace()[1]['function'];
        return new View($view_dir, $view_file, $data);
	}
    
    public function customView(string $view_file = '', $data = array(), string $view_dir = '') {
		if (!isset($view_file)||$view_file == '') {
			return $this->view($data);
		} else {
			if ($view_dir == '') {
				$view_dir = $this->getViewDir();
			} else {
				return new View($view_dir, $view_file, $data);
			}
		}
    }
	
    abstract public function index();
}