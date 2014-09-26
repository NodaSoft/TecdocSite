<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
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
		$tecDocRestClient = new TecDoc();
		$tecDocRestClient->setUserKey(TecDocApiConfig::USER_KEY)
			->setUserLogin(TecDocApiConfig::USER_LOGIN)
			->setUserPsw(TecDocApiConfig::USER_PSW);
		$manufacturerId = $_GET['man'];
		$modelId = $_GET['model'];
		$modifications = $tecDocRestClient->getModifications($manufacturerId, $modelId);
		$contentTemplateData = array(
			'modifications' => $modifications,
			'man'           => $manufacturerId
		);
		$content = View::deploy('modifications.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
} 