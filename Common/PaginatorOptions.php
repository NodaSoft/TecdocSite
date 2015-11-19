<?php
namespace NS\TecDocSite\Common;

/**
 * Скрипт, описывающий интерфейс paginator-a, преднозначенного для перемещения по страницам
 *
 * Class PaginatorOptions
 * @package NS\TecDocSite\Common
 */
class PaginatorOptions
{
    /**
     * Порядковый номер начального элемента
     *
     * @var int
     */
    public $startRecord = 0;
    /**
     * Количество элементов на страницу
     *
     * @var int
     */
    public $recordsPageCount = 0;
    /**
     * Общее количество элементов на страницу
     *
     * @var int
     */
    public $totalRecords = 0;
    /**
     * Количество отображаемых страниц для перехода
     *
     * @var int
     */
    public $displayedPagesCount = 9;
    /**
     * Имя параметра содержащего номер начального элемента
     *
     * @var string
     */
    public $argName = 'start';
    /**
     * Текущая ссылка
     *
     * @var string|null
     */
    public $url = null;
    /**
     * Имя шаблона для пагинатора
     *
     * @var string
     */
    public $template = 'common/paginator.tpl';
}
