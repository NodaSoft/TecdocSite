<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method AnalogArticle[] convertToTecDocEntitiesArray() static
 * @method AnalogArticle createByData() static
 */
class AnalogArticle extends Base {
	/**
	 * Идентификатор детали
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Номер детали
	 *
	 * @var string
	 */
	public $number;
	/**
	 * Искомый номер детали
	 *
	 * @var string
	 */
	public $searchNumber;
	/**
	 * Описание детали
	 *
	 * @var string
	 */
	public $description;
	/**
	 * Идентификатор бренда
	 *
	 * @var int
	 */
	public $brandId;
	/**
	 * Название бренда
	 *
	 * @var string
	 */
	public $brandName;
	/**
	 * Идентификатор группы товара
	 *
	 * @var int
	 */
	public $genericArticleId;
	/**
	 * Тип связи. Все возможные связи указаны в NS\ABCPApi\TecDocEntitiesAnalogTypes
	 *
	 * @var int
	 */
	public $type;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id', 'brandId', 'genericArticleId', 'type');
	}
} 