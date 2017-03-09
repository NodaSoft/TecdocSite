<?php

namespace NS\TecDocSite\Common;

use NS\ABCPApi\Common\CarType;

/**
 * Класс содержит вспомогательные функции.
 *
 * Class Helper
 * @package NS\TecDocSite\Common
 */
class Helper
{
    /**
     * Содержит допустимые типы автомобилей.
     *
     * @var int[]
     */
    public static $availableCarTypes = [
        CarType::ALL,
        CarType::CARS,
        CarType::TRUCKS,
        CarType::LIGHT_TRUCKS,
    ];

    /**
     * Возвращает тип автомобиля в зависимости от переданных GET параметров.
     *
     * @return int
     */
    public static function getCarId()
    {
        return isset($_GET['carType']) && in_array($_GET['carType'],
            self::$availableCarTypes) ? (int)$_GET['carType'] : 0;
    }

    /**
     * Возвращает текст для использования в ссылка для типа автомобиля в зависимости от переданных GET параметров.
     *
     * @return string
     */
    public static function getCarIdUrl()
    {
        return isset($_GET['carType']) && in_array($_GET['carType'],
            self::$availableCarTypes) ? "&carType={$_GET['carType']}" : '';
    }

}