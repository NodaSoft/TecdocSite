<?php
namespace NS\TecDocSite\Pages;

use NS\TecDocSite\Common\TecDocApiClient;
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
		$restClient = new TecDocApiClient(array(TecDocApiConfig::HOST));
		$modificationId = $_GET['modelVariant'];
		$categoryId = $_GET['group'];
		$articles = $restClient->getArticles($modificationId, $categoryId);
		$contentTemplateData = array(
			'articles' => $articles
		);
		$content = View::deploy('group.details.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
}