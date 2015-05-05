<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

class Models implements PageInterface {
	/**
	 * Возвращает html страницы с моделями.
	 *
	 * @return string
	 */
	public function getHtml() {
		$tecDocRestClient = new TecDoc();
		$tecDocRestClient->setUserKey(TecDocApiConfig::USER_KEY)
			->setUserLogin(TecDocApiConfig::USER_LOGIN)
			->setUserPsw(TecDocApiConfig::USER_PSW);
		$manufacturerId = $_GET['man'];
		$dataModels = $tecDocRestClient->getModels($manufacturerId);

		$begin = 1990;
		$end = (int)date('Y');
		$step = 10;
		$selectedYear = isset($_GET['yearFilter']) && isset($_GET['yearFilter']) ? (int)$_GET['yearFilter'] : 'all';
		$yearsFilter = array();
		$outModels = array();
		for ($i = $begin - $step; $i < $end; $i += $step) {
			$yearsFilter[] = array(
				'begin' => $i < $begin ? 0 : $i,
				'end' => $i >= $end - $step ? $end : $i + $step,
				'endView' => $i >= $end - $step ? '' : $i + $step,
				'isVisible' => FALSE
			);
		}
		$isModelVisible = $selectedYear === 'all';
		foreach ($dataModels as $oneModel) {
			$yearTo = $oneModel->yearTo ? $oneModel->yearTo : new \DateTime();
			$yearFrom = $oneModel->yearFrom ? $oneModel->yearFrom : new \DateTime('1970-01-01');
			foreach ($yearsFilter as &$oneRangeValue) {
				if ($yearFrom->format('Y') <= $oneRangeValue['end'] && $yearTo->format('Y') >= $oneRangeValue['begin']) {
					$oneRangeValue['isVisible'] = TRUE;
					if ($selectedYear === $oneRangeValue['end']) {
						$isModelVisible = TRUE;
					}
				}
			}
			if ($isModelVisible) {
				$outModels[] = $oneModel;
			}
		}

		$contentTemplateData = array(
			'models' => $outModels,
			'breadcrumbs' => self::getBreadcrumbs(),
			'selectedYear' => $selectedYear,
			'yearsFilter' => $yearsFilter,
			'man' => $manufacturerId
		);
		$templateData = array(
			'content' => View::deploy('models.tpl', $contentTemplateData)
		);

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
		$manufacturerId = (int)$_GET['man'];
		$manufacturers = $tecDocRestClient->getManufacturers();
		if (is_array($manufacturers)) {
			foreach ($manufacturers as $oneManufacturer) {
				if ($oneManufacturer->id === $manufacturerId) {
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