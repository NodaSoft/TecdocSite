<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

/**
 * Обеспечивает отображение страницы с модификациями
 *
 * Class FullInfoModelVariant
 * @package NS\TecDocSite\Pages
 */
class FullInfoModelVariant implements PageInterface
{
    /**
     * Возвращает html страницы с модификациями
     *
     * @return string
     * @throws \Exception
     */
    public function getHtml()
    {
        $tecDocRestClient = new TecDoc();
        $tecDocRestClient->setTecdocHost(TecDocApiConfig::HOST)
            ->setUserKey(TecDocApiConfig::USER_KEY)
            ->setUserLogin(TecDocApiConfig::USER_LOGIN)
            ->setUserPsw(TecDocApiConfig::USER_PSW);
        $modelId = $_GET['modelVariant'];
        $modification = $tecDocRestClient->getModificationById($modelId);
        $contentTemplateData = array(
            'modification' => $modification
        );
        $content = View::deploy('full.info.model.variant.tpl', $contentTemplateData);
        $templateData = array('content' => $content);
        return View::deploy('index.tpl', $templateData);
    }
}