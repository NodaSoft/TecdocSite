<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method ArticleInfo[] convertToTecDocEntitiesArray() static
 * @method ArticleInfo createByData() static
 */
class ArticleInfo extends Base {
	/**
	 * Идентификатор информации
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Текстовое описание
	 *
	 * @var string
	 */
	public $text;
	/**
	 * Идентификатор типа
	 *
	 * @var int
	 */
	public $typeId;
	/**
	 * Название типа
	 *
	 * @var string
	 */
	public $typeName;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id', 'typeId');
	}
} 