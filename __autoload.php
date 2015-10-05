<?php
/**
 * PSR-4
 */
spl_autoload_register(function ($className) {
    $className = ltrim($className, '\\');
    if (strpos($className, NS_PREFIX) === 0) {
        $className = substr($className, strlen(NS_PREFIX));
        $className = ltrim($className, '\\');
    }
    $fileName = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= $className . '.php';
    if ($fileName && file_exists($fileName)) {
        require_once $fileName;
    }
});

/**
 * vendors
 */
$loader = require_once 'vendor/autoload.php';
