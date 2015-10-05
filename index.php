<?php
namespace NS\TecDocSite;

use NS\TecDocSite\Router\Router;

/* Установка временной зоны, если не задана в php.ini*/
if (ini_get('date.timezone') === '') {
    date_default_timezone_set('Europe/Moscow');
}
define('NS_PREFIX', 'NS\TecDocSite');
/*Конфигурационный файл для разработки.*/
if (file_exists(__DIR__ . '/dev/TecDocApiConfig.php')) {
    require_once __DIR__ . '/dev/TecDocApiConfig.php';
}
require_once '__autoload.php';
Router::run();