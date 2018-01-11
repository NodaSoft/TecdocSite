<?php

namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\Helper;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

/**
 * Обеспечивает отображение страницы с моделями
 *
 * Class Models
 * @package NS\TecDocSite\Pages
 */
class Models implements PageInterface
{
    /**
     * Возвращает html страницы с моделями
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
        $manufacturerId = $_GET['man'];
        $dataModels = $tecDocRestClient->getModels($manufacturerId, Helper::getCarId());
        $begin = 1990;
        $end = (int)date('Y');
        $step = 10;
        $selectedYear = isset($_GET['yearFilter']) && $_GET['yearFilter'] !== 'all' ? (int)$_GET['yearFilter'] : -1;
        $yearsFilter = [];
        $outModels = [];
        for ($i = $begin - $step; $i < $end; $i += $step) {
            $yearsFilter[] = [
                'begin' => $i < $begin ? 0 : $i,
                'end' => $i >= $end - $step ? $end : $i + $step,
                'endView' => $i >= $end - $step ? '' : $i + $step,
                'isVisible' => false
            ];
        }
        foreach ($dataModels as $oneModel) {
            $isModelVisible = $selectedYear === -1;
            $yearTo = $oneModel->yearTo ? $oneModel->yearTo : new \DateTime();
            $yearFrom = $oneModel->yearFrom ? $oneModel->yearFrom : new \DateTime('1970-01-01');
            foreach ($yearsFilter as &$oneRangeValue) {
                if ($yearFrom->format('Y') <= $oneRangeValue['end'] && $yearTo->format('Y') >= $oneRangeValue['begin']) {
                    $oneRangeValue['isVisible'] = true;
                    if ($selectedYear === $oneRangeValue['end']) {
                        $isModelVisible = true;
                    }
                }
            }
            if ($isModelVisible) {
                $outModels[] = $oneModel;
            }
        }

        $contentTemplateData = [
            'models' => $outModels,
            'breadcrumbs' => self::getBreadcrumbs(),
            'selectedYear' => $selectedYear,
            'yearsFilter' => $yearsFilter,
            'carType' => Helper::getCarId(),
            'man' => $manufacturerId
        ];
        $templateData = [
            'content' => View::deploy('models.tpl', $contentTemplateData)
        ];

        return View::deploy('index.tpl', $templateData);
    }

    /**
     * Возвращает html код с хлебными крошками
     *
     * @return string
     * @throws \Exception
     * @throws \SmartyException
     */
    private static function getBreadcrumbs()
    {
        $tecDocRestClient = new TecDoc();
        $tecDocRestClient->setTecdocHost(TecDocApiConfig::HOST)
            ->setUserKey(TecDocApiConfig::USER_KEY)
            ->setUserLogin(TecDocApiConfig::USER_LOGIN)
            ->setUserPsw(TecDocApiConfig::USER_PSW);
        $breadcrumbs = [];
        $manufacturerId = (int)$_GET['man'];
        $manufacturers = $tecDocRestClient->getManufacturers(Helper::getCarId());
        if (is_array($manufacturers)) {
            foreach ($manufacturers as $oneManufacturer) {
                if ($oneManufacturer->id === $manufacturerId) {
                    $breadcrumbs[] = [
                        'name' => $oneManufacturer->name
                    ];
                }
            }
        }
        $templateData = [
            'breadcrumbs' => $breadcrumbs
        ];

        return View::deploy('common/breadcumbs.tpl', $templateData);
    }
}