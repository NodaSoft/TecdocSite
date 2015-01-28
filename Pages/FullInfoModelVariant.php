<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Interfaces\PageInterface;
use NS\TecDocSite\Common\View;



class FullInfoModelVariant implements PageInterface {
	/**
	 * Возвращает html страницы с модификациями.
	 *
	 * @return string
	 */
	public function getHtml() {
		$tecDocRestClient = new TecDoc();
		$tecDocRestClient->setUserKey(TecDocApiConfig::USER_KEY)
			->setUserLogin(TecDocApiConfig::USER_LOGIN)
			->setUserPsw(TecDocApiConfig::USER_PSW);
		$modelId = $_GET['modelVariant'];
		$modification = $tecDocRestClient->getModificationById($modelId);
		$contentTemplateData = array(
			'modification' => $modification
		);
		$content = View::deploy('full.info.model.variant.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}

	/**
	 * Возвращает html код с хлебными крошками.
	 *
	 * @return string
	 */
	private static function getBreadcrumbs() {
		$tecDocRestClient = new TecDoc();
		$tecDocRestClient->setUserKey(TecDocApiConfig::USER_KEY)
			->setUserLogin(TecDocApiConfig::USER_LOGIN)
			->setUserPsw(TecDocApiConfig::USER_PSW);
		$breadcrumbs = array();
		$manufacturerId = $_GET['man'];
		$manufacturers = $tecDocRestClient->getManufacturers();
		if (is_array($manufacturers)) {
			foreach ($manufacturers as $oneManufacturer) {
				if ($oneManufacturer->id == $manufacturerId) {
					$breadcrumbs[] = array(
						'name' => $oneManufacturer->name
					);
				}
			}
		}
		$templateData = array(
			'breadcrumbs' => $breadcrumbs
		);
		return View::deploy('common/breadcumbs.tpl', $templateData);
	}
}