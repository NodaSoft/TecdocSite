<?php

namespace NS\TecDocSite\Common;

/**
 * Класс, реализующий интерфейс paginator-a, преднозначенного для перемещения по страницам
 *
 * Class Paginator
 * @package NS\TecDocSite\Common
 */
class Paginator
{
    /**
     * Одна страница
     */
    const ONE_PAGE = 1;
    /**
     * Настройки пагинатора
     *
     * @var PaginatorOptions|null
     */
    private $options = null;
    /**
     * Отображаемые страницы
     *
     * @var array
     */
    private $displayedPages = [];
    /**
     * Текущая страница
     *
     * @var int
     */
    private $currentPage = 0;
    /**
     * Количество страниц
     *
     * @var int
     */
    private $pagesCount = 0;

    /**
     * Конструктор класса
     *
     * @param PaginatorOptions|null $options
     */
    public function __construct(PaginatorOptions $options = null)
    {
        $this->options = isset($options) ? $options : new PaginatorOptions();
    }

    /**
     * Деструктор класса
     */
    public function __destruct()
    {
        unset($this->options);
        unset($this->displayedPages);
    }

    /**
     * Возвращает интерфейс пагинатора в виде html
     *
     * @return string
     * @throws \Exception
     * @throws \SmartyException
     */
    public function deploy()
    {
        $this->make();
        $page = '';
        if (self::ONE_PAGE < $this->getPagesCount()) {
            $options = $this->getOptions();
            $url = is_null($options->url) ? $_SERVER['REQUEST_URI'] : $options->url;
            $parsedUrl = parse_url($url);
            parse_str($parsedUrl['query'], $urlQueryArray);
            unset($urlQueryArray[$options->argName]);
            $newUrlData = [];
            foreach ($urlQueryArray as $k => $oneUrlQueryItem) {
                $newUrlData[] = "$k=$oneUrlQueryItem";
            }
            $url = $newUrlData ? '?' . implode('&', $newUrlData) : '';
            $dataTemplate = [
                'displayedPages' => $this->getDisplayedPages(),
                'options' => $options,
                'argName' => $options->argName,
                'url' => $url,
                'currentPage' => $this->getCurrentPage(),
                'pagesCount' => $this->getPagesCount()
            ];
            $page = View::deploy($options->template, $dataTemplate);
        }

        return $page;
    }

    /**
     * Инициализация опций
     */
    final protected function make()
    {
        $options = $this->getOptions();
        $startRecord = abs((int)$options->startRecord);
        $maxRecords = ceil(($options->totalRecords - $options->recordsPageCount) / $options->recordsPageCount) * $options->recordsPageCount;
        if ($startRecord > $maxRecords) {
            $startRecord = $maxRecords;
        }
        $this->currentPage = floor($startRecord / $options->recordsPageCount) + 1;
        $this->pagesCount = floor($maxRecords / $options->recordsPageCount) + 1;
        $leftEdgePage = $this->currentPage - floor($options->displayedPagesCount / 2);
        if ($leftEdgePage <= 1) {
            $leftEdgePage = 1;
        }
        $rightEdgePage = $leftEdgePage + $options->displayedPagesCount - 1;
        if ($rightEdgePage >= $this->pagesCount) {
            $rightEdgePage = $this->pagesCount;
        }
        if (($rightEdgePage - $leftEdgePage) < $options->displayedPagesCount) {
            $leftEdgePage = $rightEdgePage - $options->displayedPagesCount + 1;
            if ($leftEdgePage <= 1) {
                $leftEdgePage = 1;
            }
        }
        for ($number = $leftEdgePage; $number <= $rightEdgePage; $number++) {
            $this->displayedPages[$number] = ($number - 1) * $options->recordsPageCount;
        }
    }

    /**
     * Вовращает опции для инициализации пагинатора
     *
     * @return PaginatorOptions|null
     */
    final protected function getOptions()
    {
        return $this->options;
    }

    /**
     * Возвращает количество страниц
     *
     * @return int
     */
    final protected function getPagesCount()
    {
        return $this->pagesCount;
    }

    /**
     * Возвращает отображаемые страницы
     *
     * @return array
     */
    final protected function getDisplayedPages()
    {
        return $this->displayedPages;
    }

    /**
     * Возвращает текущую страницу
     *
     * @return int
     */
    final protected function getCurrentPage()
    {
        return $this->currentPage;
    }
}