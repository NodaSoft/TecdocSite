<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method ArticleDocument[] convertToTecDocEntitiesArray() static
 * @method ArticleDocument createByData() static
 */
class ArticleDocument extends Base {
	/**
	 * Идентификатор
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Тип файла (например, image/jpeg)
	 *
	 * @var string
	 */
	public $fileType;
	/**
	 * Данные
	 *
	 * @var string
	 */
	public $data;

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id');
	}
} 