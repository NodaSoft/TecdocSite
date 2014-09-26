<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

class Group implements PageInterface
{
	/**
	 * Возвращает html дерева категорий для модификации.
	 *
	 * @return string
	 */
	public function getHtml() {
		$tecDocRestClient = new TecDoc();
		$tecDocRestClient->setUserKey(TecDocApiConfig::USER_KEY)
			->setUserLogin(TecDocApiConfig::USER_LOGIN)
			->setUserPsw(TecDocApiConfig::USER_PSW);
		$modificationId = $_GET['modelVariant'];
		$categoryId = $_GET['group'];
		$articles = $tecDocRestClient->getArticles($modificationId, $categoryId);
		$contentTemplateData = array(
			'articles' => $articles
		);
		$content = View::deploy('group.details.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
}