<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method Modification[] convertToTecDocEntitiesArray() static
 * @method Modification createByData() static
 */
class Modification extends Base {
	/**
	 * Идентификатор модификации.
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Название модификации.
	 *
	 * @var string
	 */
	public $name;
	/**
	 * Идентификатор модели.
	 *
	 * @var int
	 */
	public $modelId;
	/**
	 * Название модели.
	 *
	 * @var string
	 */
	public $modelName;
	/**
	 * Идентификатор производителя (бренда)
	 *
	 * @var int
	 */
	public $manufacturerId;
	/**
	 * Название производителя (бренда).
	 *
	 * @var string
	 */
	public $manufacturerName;
	/**
	 * Дата начала выпуска модификации.
	 *
	 * @var \DateTime
	 */
	public $yearFrom = NULL;
	/**
	 * Дата окончания выпуска модификации. NULL если еще выпускается.
	 *
	 * @var \DateTime|NULL
	 */
	public $yearTo = NULL;
	/**
	 * Тип конструкции
	 *
	 * @var string
	 */
	public $constructionType;
	/**
	 * Система тормозов.
	 *
	 * @var string
	 */
	public $brakeSystem;
	/**
	 * Количество цилиндров.
	 *
	 * @var int
	 */
	public $cylinder;
	/**
	 * Объем двигателя в кубических сантиметрах.
	 *
	 * @var int
	 */
	public $cylinderCapacityCcm;
	/**
	 * Объем двигателя в сантилитрах. (в текдоке не смотря на то что поле называется Liter объем возвращается в сантилитрах)
	 *
	 * @var string
	 */
	public $cylinderCapacityLiter;
	/**
	 * Тип топлива.
	 *
	 * @var string
	 */
	public $fuelType;
	/**
	 * Система подачи топлива.
	 *
	 * @var string
	 */
	public $fuelTypeProcess;
	/**
	 * Схема привода.
	 *
	 * @var string
	 */
	public $impulsionType;
	/**
	 * Тип двигателя.
	 *
	 * @var string
	 */
	public $motorType;
	/**
	 * Мощность в л/c
	 *
	 * @var int
	 */
	public $powerHP;
	/**
	 * Мощность в кВт
	 *
	 * @var int
	 */
	public $powerKW;
	/**
	 * Тоннаж
	 *
	 * @var string
	 */
	public $tonnage;
	/**
	 * Количество клапанов.
	 *
	 * @var int
	 */
	public $valves;
	/**
	 * Код двигателя.
	 *
	 * @var string
	 */
	public $motorCodes;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id', 'modelId', 'manufacturerId', 'cylinder', 'cylinderCapacityCcm', 'powerHP', 'powerKW', 'valves');
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