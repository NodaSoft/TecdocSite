<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method Manufacturer[] convertToTecDocEntitiesArray() static
 * @method Manufacturer createByData() static
 */
class Manufacturer extends Base {
	/**
	 * Идентификатор производителя
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Наименование производителя (бренда)
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id');
	}
} 