<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method OENNumber[] convertToTecDocEntitiesArray() static
 * @method OENNumber createByData() static
 */
class OENNumber extends Base {
	/**
	 * Порядковый номер блока.
	 *
	 * @var int
	 */
	public $blockNumber;
	/**
	 * Название производителя (бренда)
	 *
	 * @var string
	 */
	public $brandName;
	/**
	 * Оригинальный OE-номер
	 *
	 * @var string
	 */
	public $oeNumber;
	/**
	 * Индекс сортировки.
	 *
	 * @var int
	 */
	public $sortNumber;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('blockNumber', 'sortNumber');
	}
} 