<?php
namespace NS\TecDocSite\Pages;

use NS\TecDocSite\Common\TecDocApiClient;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

class Adaptability implements PageInterface
{
	/**
	 * Возвращает html страницы с приминимостями.
	 *
	 * @return string
	 */
	public function getHtml() {
		$restClient = new TecDocApiClient(array(TecDocApiConfig::HOST));
		$articleId = $_GET['articleId'];
		$adaptabilities = $restClient->getAdaptability($articleId);
		$contentTemplateData = array(
			'adaptabilities' => $adaptabilities
		);
		$content = View::deploy('adaptability.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
} 