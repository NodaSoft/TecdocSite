<?php

namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\Helper;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

/**
 * Обеспечивает отображение страницы с модификациями
 *
 * Class Modifications
 * @package NS\TecDocSite\Pages
 */
class Modifications implements PageInterface
{
    /**
     * Возвращает html страницы с модификациями
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
        $manufacturerId = $_GET['man'];
        $modelId = $_GET['model'];
        $modifications = $tecDocRestClient->getModifications($manufacturerId, $modelId, Helper::getCarId());
        $contentTemplateData = array(
            'modifications' => $modifications,
            'breadcrumbs' => self::getBreadcrumbs(),
            'carType' => Helper::getCarId(),
            'man' => $manufacturerId
        );
        $content = View::deploy('modifications.tpl', $contentTemplateData);
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
        $breadcrumbs = array();
        $manufacturerId = (int)$_GET['man'];
        $manufacturers = $tecDocRestClient->getManufacturers();
        if (is_array($manufacturers)) {
            $carTypeUrlText = Helper::getCarIdUrl();
            foreach ($manufacturers as $oneManufacturer) {
                if ($oneManufacturer->id === $manufacturerId) {
                    $breadcrumbs[] = array(
                        'name' => $oneManufacturer->name,
                        'url' => "?man={$manufacturerId}{$carTypeUrlText}"
                    );
                }
            }
        }
        $models = $tecDocRestClient->getModels($manufacturerId);
        $modelId = (int)$_GET['model'];
        if (is_array($models)) {
            foreach ($models as $oneModel) {
                if ($oneModel->id === $modelId) {
                    $breadcrumbs[] = array(
                        'name' => $oneModel->name
                    );
                }
            }
        }
        $templateData = array(
            'breadcrumbs' => $breadcrumbs
        );

        return View::deploy('common/breadcumbs.tpl', $templateData);
    }
}