<?php
namespace NS\ABCPApi\TecDocEntities;

/**
 * @method Article[] convertToTecDocEntitiesArray() static
 */
class Article extends Base {
	/**
	 * Идентификатор детали.
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Номер детали.
	 *
	 * @var string
	 */
	public $number;
	/**
	 * Описание детали.
	 *
	 * @var
	 */
	public $description;
	/**
	 * Идентификатор производителя (бренда)
	 *
	 * @var int
	 */
	public $brandId;
	/**
	 * Наименование производителя (бренда)
	 *
	 * @var string
	 */
	public $brandName;
	/**
	 * Идентификатор типа детали.
	 *
	 * @var int
	 */
	public $state;
	/**
	 * Название типа детали.
	 *
	 * @var string
	 */
	public $stateName;
	/**
	 * Идентификатор группы товара.
	 *
	 * @var int
	 */
	public $genericArticleId;
	/**
	 * Информация о товаре.
	 *
	 * @var ArticleInfo
	 */
	public $info;
	/**
	 * Непосредственные аттрибуты детали.
	 *
	 * @var ArticleAttribute[]
	 */
	public $attributes;
	/**
	 * Документы привязанные к детали. Как правило изображения.
	 *
	 * @var ArticleDocument
	 */
	public $documents;
	/**
	 * Оригинальные номера.
	 *
	 * @var OENNumber[]
	 */
	public $oenNumbers;
	/**
	 * Штрих-код
	 *
	 * @var string[]
	 */
	public $eanNumber;

	/**
	 * Возвращает экземпляр класса со свойствами заполнеными согласно ключам массива.
	 *
	 * @param array $data
	 * @return Article
	 */
	public static function createByData($data) {
		$instance = parent::createByData($data);
		$instance->info = is_array($instance->info) ? ArticleInfo::createByData($instance->info) : $instance->info;
		$instance->documents = is_array($instance->documents) ? ArticleDocument::createByData($instance->documents) : $instance->documents;
		$instance->oenNumbers = is_array($instance->oenNumbers) ? OENNumber::convertToTecDocEntitiesArray($instance->oenNumbers) : $instance->oenNumbers;
		$instance->attributes = is_array($instance->attributes) ? ArticleAttribute::convertToTecDocEntitiesArray($instance->attributes) : $instance->attributes;
		return $instance;
	}

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array('id', 'brandId', 'state', 'genericArticleId');
	}
}