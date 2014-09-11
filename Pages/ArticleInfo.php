<?php
namespace NS\TecDocSite\Pages;

use NS\TecDocSite\Common\TecDocApiClient;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

class ArticleInfo implements PageInterface
{
	/**
	 * Возвращает html страницы с информацией о детали.
	 *
	 * @return string
	 */
	public function getHtml() {
		$restClient = new TecDocApiClient(array(TecDocApiConfig::HOST));
		$articleId = $_GET['articleId'];
		$article = $restClient->getArticleInfo($articleId);
		$article = is_array($article) ? current($article) : $article;
		$contentTemplateData = array(
			'articleInfo' => $article
		);
		$content = View::deploy('article.info.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
} 