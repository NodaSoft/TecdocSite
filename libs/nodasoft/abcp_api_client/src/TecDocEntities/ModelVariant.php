<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method ModelVariant[] convertToTecDocEntitiesArray() static
 * @method ModelVariant createByData() static
 */
class ModelVariant extends Base {
	/**
	 * Идентификатор.
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Название раздела.
	 *
	 * @var string
	 */
	public $name;
	/**
	 * Является ли папкой.
	 *
	 * @var bool
	 */
	public $hasChilds;
	/**
	 * Родительский идентификатор.
	 *
	 * @var int
	 */
	public $parentId;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id', 'parentId');
	}
} 