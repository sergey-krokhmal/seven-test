<?php
namespace Krokhmal\Soft\Web;

// Абстрактный класс Web движка
abstract class WebEngine
{
    // Выполнение запроса
    abstract public function executeRequest($url_path);
}
