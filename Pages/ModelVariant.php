<?php
namespace NS\TecDocSite\Pages;

use NS\TecDocSite\Common\TecDocApiClient;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

class ModelVariant implements PageInterface
{
	/**
	 * Возвращает html список деталей для выбранной категории.
	 *
	 * @return string
	 */
	public function getHtml() {
		$restClient = new TecDocApiClient(array(TecDocApiConfig::HOST));
		$modificationId = $_GET['modelVariant'];
		$tree = $restClient->getModelVariant($modificationId);
		$contentTemplateData = array(
			'tree' => $tree,
			'url'  => "/?man={$_REQUEST['man']}&model={$_REQUEST['model']}&modelVariant={$_REQUEST['modelVariant']}&group="
		);
		$content = View::deploy('tree.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
}