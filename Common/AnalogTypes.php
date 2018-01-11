<?php

namespace NS\TecDocSite\Common;

/**
 * Класс содержит описание типов аналогов
 *
 * Class AnalogTypes
 * @package NS\TecDocSite\Common
 */
class AnalogTypes
{
    /**
     * Совпадение
     */
    const MATCH = 0;
    /**
     * OE-номер
     */
    const OE_NUMBER = 1;
    /**
     * Торговый номер
     */
    const NUMBER = 2;
    /**
     * Сопоставимый
     */
    const COMPARABLE = 3;
    /**
     * Замена
     */
    const REPLACEMENT = 4;
    /**
     * Заменяемое
     */
    const REMOVABLE = 5;
    /**
     * EAN
     */
    const EAN = 6;
    /**
     * Любая
     */
    const ANY = 10;

}