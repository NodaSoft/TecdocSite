<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
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
		$tecDocRestClient = new TecDoc();
		$tecDocRestClient->setUserKey(TecDocApiConfig::USER_KEY)
			->setUserLogin(TecDocApiConfig::USER_LOGIN)
			->setUserPsw(TecDocApiConfig::USER_PSW);
		$modificationId = $_GET['modelVariant'];
		$tree = $tecDocRestClient->getModelVariant($modificationId);
		$contentTemplateData = array(
			'tree' => $tree,
			'url'  => "/?man={$_REQUEST['man']}&model={$_REQUEST['model']}&modelVariant={$_REQUEST['modelVariant']}&group="
		);
		$content = View::deploy('tree.tpl', $contentTemplateData);
		$templateData = array('content' => $content);
		return View::deploy('index.tpl', $templateData);
	}
}