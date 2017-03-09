<?php

namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\Helper;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

/**
 * Обеспечивает отображение страницы со списком деталей для выбранной категории
 *
 * Class ModelVariant
 * @package NS\TecDocSite\Pages
 */
class ModelVariant implements PageInterface
{
    /**
     * Возвращает html список деталей для выбранной категории
     *
     * @return string
     */
    public function getHtml()
    {
        $tecDocRestClient = new TecDoc();
        $tecDocRestClient->setTecdocHost(TecDocApiConfig::HOST)
            ->setUserKey(TecDocApiConfig::USER_KEY)
            ->setUserLogin(TecDocApiConfig::USER_LOGIN)
            ->setUserPsw(TecDocApiConfig::USER_PSW);
        $modificationId = $_GET['modelVariant'];
        $tree = $tecDocRestClient->getModelVariant($modificationId, Helper::getCarId());
        $carTypeUrlText = Helper::getCarIdUrl();
        $contentTemplateData = array(
            'tree' => $tree,
            'carType' => Helper::getCarId(),
            'breadcrumbs' => self::getBreadcrumbs(),
            'url' => "/?man={$_REQUEST['man']}&model={$_REQUEST['model']}&modelVariant={$_REQUEST['modelVariant']}{$carTypeUrlText}&group="
        );
        $content = View::deploy('tree.tpl', $contentTemplateData);
        $templateData = array('content' => $content);

        return View::deploy('index.tpl', $templateData);
    }

    /**
     * Возвращает html код с хлебными крошками
     *
     * @return string
     */
    private static function getBreadcrumbs()
    {
        $tecDocRestClient = new TecDoc();
        $tecDocRestClient->setTecdocHost(TecDocApiConfig::HOST)
            ->setUserKey(TecDocApiConfig::USER_KEY)
            ->setUserLogin(TecDocApiConfig::USER_LOGIN)
            ->setUserPsw(TecDocApiConfig::USER_PSW);
        $modificationId = (int)$_GET['modelVariant'];
        $modification = $tecDocRestClient->getModificationById($modificationId);
        $carTypeUrlText = Helper::getCarIdUrl();
        $breadcrumbs = array(
            array(
                'name' => $modification->manufacturerName,
                'url' => "?man={$modification->manufacturerId}{$carTypeUrlText}"
            ),
            array(
                'name' => $modification->modelName,
                'url' => "?man={$modification->manufacturerId}&model={$modification->modelId}{$carTypeUrlText}"
            ),
            array(
                'name' => $modification->name
            )
        );
        $templateData = array(
            'breadcrumbs' => $breadcrumbs
        );

        return View::deploy('common/breadcumbs.tpl', $templateData);
    }
}