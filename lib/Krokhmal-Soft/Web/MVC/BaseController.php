<?php
namespace Krokhmal\Soft\Web\MVC;

// Базовый MVC-контроллер
abstract class BaseController
{
	// Получение каталога шаблона представления на основе имени конкретного контроллера
	private function getViewDir() {
		$full_class_name = get_class($this);
        // Сформировать каталог для шаблона представления
        $view_dir = str_replace("Application\\Controllers\\", "Application\\Views\\", $full_class_name);
        $view_dir = str_replace("Controller", "", $view_dir);   // Убрать окончание класса контроллера
		return $view_dir;
	}
	
    // получение объекта проедставления по коталогу и имени шаблона представления (соответствует имени метода контроллера)
	public function view($data = array()) {
        $view_dir = $this->getViewDir();                // Каталог представления
        $view_file = debug_backtrace()[1]['function'];  // Имя метода контроллера, из которого вызвали этот метод
        return new View($view_dir, $view_file, $data);  // Возвратить представление
	}
    
    // получение объекта проедставления по коталогу и имени шаблона представления 
    // Каталог и имя указываются вручную
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
	
    // Абстрактный метод для стандартного маршрута контроллера
    abstract public function index();
}