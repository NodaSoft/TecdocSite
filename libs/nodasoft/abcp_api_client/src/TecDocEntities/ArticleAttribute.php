<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method ArticleAttribute[] convertToTecDocEntitiesArray() static
 * @method ArticleAttribute createByData() static
 */
class ArticleAttribute extends Base {
	/**
	 * Идентификатор
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Признак условия
	 *
	 * @var bool
	 */
	public $isConditional;
	/**
	 * Признак интервала
	 *
	 * @var bool
	 */
	public $isInterval;
	/**
	 * Полное название параметра
	 *
	 * @var string
	 */
	public $name;
	/**
	 * Короткое название параметра
	 *
	 * @var string
	 */
	public $shortName;
	/**
	 * Тип значения параметра (A: Буквенно-цифровой, D: Дата, К: Ключ, N: Числовой, V: Без значения
	 *
	 * @var string
	 */
	public $type;
	/**
	 * Единица измерения
	 *
	 * @var string
	 */
	public $unit;
	/**
	 * Значение
	 *
	 * @var string
	 */
	public $value;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id');
	}
} 