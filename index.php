<?php
use Krokhmal\Soft\Web\MVC\WebEngine;

// Добавить автозагрузчик
$loader = require (__DIR__ . '/vendor/autoload.php');
// Установка соответсвия префикса пространства имен с его базовым каталогом
$loader->addPsr4( 'Krokhmal\\Soft\\', __DIR__ . '/lib/Krokhmal-Soft/');
$loader->addPsr4( 'Application\\', __DIR__ . '/Application/');

