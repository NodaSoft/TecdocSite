<?php
namespace NS\TecDocSite\Pages;

use NS\TecDocSite\Common\TecDocApiClient;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

class Models implements PageInterface
{
	/**
	 * Возвращает html страницы с моделями.
	 *
	 * @return string
	 */
	public function getHtml() {
		$restClient = new TecDocApiClient(array(TecDocApiConfig::HOST));
		$manufacturerId = $_GET['man'];
		$dataModels = $restClient->getModels($manufacturerId);
		$contentTemplateData = array(
			'models' => $dataModels,
			'man'    => $manufacturerId
		);
		$content = View::deploy('models.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
} 