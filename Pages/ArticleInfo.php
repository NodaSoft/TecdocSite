<?php
namespace NS\TecDocSite\Pages;

use NS\ABCPApi\RestApiClients\TecDoc;
use NS\TecDocSite\Common\TecDocApiConfig;
use NS\TecDocSite\Common\View;
use NS\TecDocSite\Interfaces\PageInterface;

/**
 * Обеспечивает отображение страницы с информацией о детали
 *
 * Class ArticleInfo
 * @package NS\TecDocSite\Pages
 */
class ArticleInfo implements PageInterface
{
    /**
     * Возвращает html страницы с информацией о детали
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
        $articleId = $_GET['articleId'];
        $article = $tecDocRestClient->getArticle($articleId);
        $contentTemplateData = array(
            'articleInfo' => $article
        );
        $content = View::deploy('article.info.tpl', $contentTemplateData);
        $templateData = array('content' => $content);
        return View::deploy('index.tpl', $templateData);
    }
}