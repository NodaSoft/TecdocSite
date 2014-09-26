<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method Model[] convertToTecDocEntitiesArray() static
 * @method Model createByData() static
 */
class Model extends Base {
	/**
	 * Идентификатор модели.
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Название модели.
	 *
	 * @var string
	 */
	public $name;
	/**
	 * Дата начала выпуска модели.
	 *
	 * @var \DateTime|NULL
	 */
	public $yearFrom = NULL;
	/**
	 * Дата окончания выпуска модели. NULL если еще выпускается.
	 *
	 * @var \DateTime|NULL
	 */
	public $yearTo = NULL;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id');
	}

	/**
	 * Возвращает массив имен свойств типа \DateTime
	 *
	 * @return string[]
	 */
	protected static function getDateTimeProperties() {
		return array('yearFrom', 'yearTo');
	}
} 