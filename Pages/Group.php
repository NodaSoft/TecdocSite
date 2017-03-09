<?php

namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\ABCPApi\TecDocEntities\ModelVariant;
use NS\TecDocSite\Common\Helper;
use NS\TecDocSite\Common\Paginator;
use NS\TecDocSite\Common\PaginatorOptions;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

/**
 * Обеспечивает отображение страницы с отображением дерева категорий для модификаций
 *
 * Class Group
 * @package NS\TecDocSite\Pages
 */
class Group implements PageInterface
{
    /**
     * Варианты отображения единиц на страницу
     *
     * @var int[]
     */
    private $itemsPerPage = array(20, 40, 100);

    /**
     * Дефолтный вид отображения плитка
     */
    const DEFAULT_VIEW_MODE = 'tile';

    /**
     * Возвращает html дерева категорий для модификации
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
        $categoryId = $_GET['group'];
        $articles = $tecDocRestClient->getArticleSimplified($modificationId, $categoryId, [], 0);
        $viewMode = isset($_GET['viewMode']) ? $_GET['viewMode'] : self::DEFAULT_VIEW_MODE;
        $itemsPerPage = isset($_GET['itemsPerPage']) && in_array((int)$_GET['itemsPerPage'], $this->itemsPerPage,
            true) ? (int)$_GET['itemsPerPage'] : current($this->itemsPerPage);
        $totalArticles = count($articles);
        $start = isset($_GET['start']) && is_numeric($_GET['start']) && $_GET['start'] < $totalArticles && $_GET['start'] > 0 && $_GET['itemsPerPage'] < $totalArticles ? $_GET['start'] : 0;
        $articles = array_slice($articles, $start, $itemsPerPage);
        $baseUrlArray = array(
            'man' => $_GET['man'],
            'model' => $_GET['model'],
            'modelVariant' => $_GET['modelVariant'],
            'group' => $_GET['group']
        );
        $baseUrl = http_build_query($baseUrlArray);
        $paginatorOption = new PaginatorOptions();
        $paginatorOption->startRecord = $start;
        $paginatorOption->recordsPageCount = $itemsPerPage;
        $paginatorOption->totalRecords = $totalArticles;
        $paginator = new Paginator($paginatorOption);
        $contentTemplateData = array(
            'breadcrumbs' => self::getBreadcrumbs(),
            'itemsPerPageValues' => $this->itemsPerPage,
            'selectedItemsPerPage' => $itemsPerPage,
            'baseUrl' => $baseUrl,
            'viewMode' => $viewMode,
            'start' => $start,
            'paginator' => isset($paginator) ? $paginator->deploy() : '',
            'articles' => $articles
        );
        $content = View::deploy('group.details.tpl', $contentTemplateData);
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
        $selectedGroupId = (int)$_GET['group'];
        $modification = $tecDocRestClient->getModificationById($modificationId);
        $modelVariants = $tecDocRestClient->getModelVariant($modificationId, Helper::getCarId());
        $modelVariant = new ModelVariant();
        if (is_array($modelVariants)) {
            foreach ($modelVariants as $oneModelVariant) {
                if ($oneModelVariant->id === $selectedGroupId) {
                    $modelVariant = $oneModelVariant;
                    break;
                }
            }
        }
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
                'name' => $modification->name,
                'url' => "?man={$modification->manufacturerId}&model={$modification->modelId}&modelVariant={$modification->id}{$carTypeUrlText}"
            ),
            array(
                'name' => $modelVariant->name
            )
        );
        $templateData = array(
            'breadcrumbs' => $breadcrumbs
        );

        return View::deploy('common/breadcumbs.tpl', $templateData);
    }
}