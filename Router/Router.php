<?php

namespace NS\TecDocSite\Router;

use NS\TecDocSite\Interfaces\PageInterface;
use NS\TecDocSite\Pages\Analogs;
use NS\TecDocSite\Pages\ArticleInfo;
use NS\TecDocSite\Pages\FullInfoModelVariant;
use NS\TecDocSite\Pages\Group;
use NS\TecDocSite\Pages\Index;
use NS\TecDocSite\Pages\Models;
use NS\TecDocSite\Pages\ModelVariant;
use NS\TecDocSite\Pages\Modifications;

class Router
{

    /**
     * Выводит содержание страницы
     */
    public static function run()
    {
        $pageClass = self::getPageClass($_GET);
        echo $pageClass->getHtml();
    }

    /**
     * Возвращает имя класса контроллера страницы
     *
     * @param array $data
     * @return PageInterface
     */
    private static function getPageClass(array $data)
    {
        switch (true) {
            /*Детализированная информация по модели*/
            case isset($data['fullInfoModelVariant']):
                $pageClass = new FullInfoModelVariant();
                break;
            /*Аналоги*/
            case isset($data['analogs']) && isset($data['number']):
                $pageClass = new Analogs();
                break;
            /*Детализированная информация по запчасти*/
            case isset($data['articleInfo']) && isset($data['articleId']):
                $pageClass = new ArticleInfo();
                break;
            /*Детали. Пятая страница.*/
            case isset($data['group']) && isset($data['modelVariant']):
                $pageClass = new Group();
                break;
            /*Группы деталей. Четвертая страница.*/
            case isset($data['model']) && isset($data['man']) && isset($data['modelVariant']):
                $pageClass = new ModelVariant();
                break;
            /*Список модификаций. Третья страница*/
            case isset($data['model']) && isset($data['man']):
                $pageClass = new Modifications();
                break;
            /*Список моделей. Вторая страница*/
            case isset($data['man']):
                $pageClass = new Models();
                break;
            /*Главная страница*/
            default:
                $pageClass = new Index();
        }

        return $pageClass;
    }
}