<?php
namespace NS\TecDocSite\Pages;

use NS\TecDocSite\Common\TecDocApiClient;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

class Modifications implements PageInterface
{
	/**
	 * Возвращает html страницы с модификациями.
	 *
	 * @return string
	 */
	public function getHtml() {
		$restClient = new TecDocApiClient(array(TecDocApiConfig::HOST));
		$manufacturerId = $_GET['man'];
		$modelId = $_GET['model'];
		$modifications = $restClient->getModifications($manufacturerId, $modelId);
		$contentTemplateData = array(
			'modifications' => $modifications,
			'man'           => $manufacturerId
		);
		$content = View::deploy('modifications.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
} 