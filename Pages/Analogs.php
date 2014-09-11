<?php
namespace NS\TecDocSite\Pages;

use NS\TecDocSite\Common\AnalogTypes;
use NS\TecDocSite\Common\TecDocApiClient;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

class Analogs implements PageInterface
{
	/**
	 * Возвращает html страницы с аналогами.
	 *
	 * @return string
	 */
	public function getHtml() {
		$restClient = new TecDocApiClient(array(TecDocApiConfig::HOST));
		$number = $_GET['number'];
		$analogs = $restClient->getAnalogs($number, AnalogTypes::ANY);
		$contentTemplateData = array(
			'analogs' => $analogs
		);
		$content = View::deploy('analogs.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
} 