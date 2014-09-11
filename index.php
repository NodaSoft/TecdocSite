<?php
namespace NS\TecDocSite;
use NS\TecDocSite\Router\Router;
define('NS_PREFIX', 'NS\TecDocSite');
require_once '__autoload.php';
Router::run();