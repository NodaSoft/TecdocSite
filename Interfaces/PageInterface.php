<?php
namespace NS\TecDocSite\Interfaces;

/**
 * Интерфейс описывающий поведение страницы
 *
 * Interface PageInterface
 * @package NS\TecDocSite\Interfaces
 */
interface PageInterface
{
    /**
     * Возвращает сгенерированный html код страницы
     *
     * @return mixed
     */
    public function getHtml();
}