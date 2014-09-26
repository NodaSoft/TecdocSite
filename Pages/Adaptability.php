<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
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
		$tecDocRestClient = new TecDoc();
		$tecDocRestClient->setUserKey(TecDocApiConfig::USER_KEY)
			->setUserLogin(TecDocApiConfig::USER_LOGIN)
			->setUserPsw(TecDocApiConfig::USER_PSW);
		$articleId = $_GET['articleId'];
		$adaptability = $tecDocRestClient->getAdaptability($articleId);
		$contentTemplateData = array(
			'adaptability' => $adaptability
		);
		$content = View::deploy('adaptability.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
} 