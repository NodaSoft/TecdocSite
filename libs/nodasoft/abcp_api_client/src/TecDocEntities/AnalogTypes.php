<?php
namespace NS\ABCPApi\TecDocEntities;
/**
 * Класс описывает возможные типы аналогов при поиске.
 */
class AnalogTypes
{
	/**
	 * Совпадение.
	 */
	const MATCH = 0;
	/**
	 * OE-номер.
	 */
	const OE_NUMBER = 1;
	/**
	 * Торговый номер.
	 */
	const NUMBER = 2;
	/**
	 * Сопоставимый.
	 */
	const COMPARABLE = 3;
	/**
	 * Замена.
	 */
	const REPLACEMENT = 4;
	/**
	 * Заменяемое.
	 */
	const REMOVABLE = 5;
	/**
	 * EAN
	 */
	const EAN = 6;
	/**
	 * Любая.
	 */
	const ANY = 10;

} 