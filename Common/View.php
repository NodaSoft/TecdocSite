<?php
namespace NS\TecDocSite\Common;

class View {

	/**
	 * @var \Smarty
	 */
	private static $smarty = NULL;

	/**
	 * Возращает экземпляр \Smarty использует синглтон.
	 *
	 * @return \Smarty
	 */
	public static function getSmarty() {
		if (self::$smarty === NULL) {
			self::$smarty = new \Smarty();
			list($compiledPath, $cachedPath) = self::getSmartyDirectories();
			self::$smarty->setTemplateDir(__DIR__ . '/../View/');
			self::$smarty->setCompileDir($compiledPath);
			self::$smarty->setCacheDir($cachedPath);
		}
		return self::$smarty;
	}

	/**
	 * Возвращает результат компиляции шаблона.
	 *
	 * @param string $templateName
	 * @param array $templateData
	 * @return string
	 */
	public static function deploy($templateName, $templateData = array()) {
		$smarty = self::getSmarty();
		$smarty->assign("data", $templateData);
		return self::$smarty->fetch($templateName);
	}

	/**
	 * Возвращает массив с директориями для smarty
	 *
	 * @return string[]
	 */
	private static function getSmartyDirectories() {
		$tempPath = __DIR__ . '/../tmp/smarty';
		if (!file_exists($tempPath)) {
			mkdir($tempPath, 0777, TRUE);
		}

		$compiledPath = $tempPath . '/compiled';
		if (!file_exists($compiledPath)) {
			mkdir($compiledPath, 0777, TRUE);
		}

		$cachedPath = $tempPath . '/cached';
		if (!file_exists($cachedPath)) {
			mkdir($cachedPath, 0777, TRUE);
		}
		return array($compiledPath, $cachedPath);
	}
} 