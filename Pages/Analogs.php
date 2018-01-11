<?php

namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\AnalogTypes;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

/**
 * Обеспечивает отображение страницы с аналогами
 *
 * Class Analogs
 * @package NS\TecDocSite\Pages
 */
class Analogs implements PageInterface
{
    /**
     * Возвращает html страницы с аналогами
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
        $number = $_GET['number'];
        $analogs = $tecDocRestClient->getAnalogs($number, AnalogTypes::ANY);
        $contentTemplateData = [
            'analogs' => $analogs
        ];
        $content = View::deploy('analogs.tpl', $contentTemplateData);
        $templateData = ['content' => $content];

        return View::deploy('index.tpl', $templateData);
    }
}