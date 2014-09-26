<?
/**
 * PSR-4
 */
define('NS_PREFIX', 'NS\ABCPApi');
define('SRC', __DIR__ . '/src/');
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
		$fileName = SRC . str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}
	$fileName .= $className . '.php';
	if (file_exists($fileName)) {
		require_once $fileName;
	}
});
