<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

/**
 * Главная страница. Выводится по умолчанию.
 */
class Index implements PageInterface {

	/**
	 * Возвращает html страницы.
	 *
	 * @return string
	 */
	public function getHtml() {
		$tecDocRestClient = new TecDoc();
		$tecDocRestClient->setUserKey(TecDocApiConfig::USER_KEY)
			->setUserLogin(TecDocApiConfig::USER_LOGIN)
			->setUserPsw(TecDocApiConfig::USER_PSW);
		$carType = isset($_GET['carType']) ? $_GET['carType'] : 0;
		$selectedLetter = !empty($_GET['letter']) ? $_GET['letter'] : '';
		$manufacturers = $tecDocRestClient->getManufacturers($carType);
		$manufacturersTemplateData = array();
		foreach ($manufacturers as $oneManufacturer) {
			$firstLetter = substr($oneManufacturer->name, 0, 1);
			$manufacturersTemplateData[$firstLetter][] = $oneManufacturer;
		}
		$contentTemplateData = array(
			'manufacturers' => $manufacturersTemplateData,
			'carType' => $carType,
			'breadcrumbs' => self::getBreadcrumbs(),
			'selectedLetter' => $selectedLetter
		);
		$content = View::deploy('manufacturers.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}

	/**
	 * Возвращает html код с хлебными крошками.
	 *
	 * @return string
	 */
	private static function getBreadcrumbs() {
		$templateData = array(
			'breadcrumbs' => array()
		);
		return View::deploy('common/breadcumbs.tpl', $templateData);
	}
}