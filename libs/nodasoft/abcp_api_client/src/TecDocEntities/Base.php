<?php
namespace NS\ABCPApi\TecDocEntities;
/**
 * Базовый класс для всех сущностей TecDoc
 */
class Base {
	/**
	 * Преобразовывает массив из сущностей представленных в виде массива, в массив сущностей в виде объектов.
	 *
	 * @param array|NULL $array
	 * @return array
	 */
	public static function convertToTecDocEntitiesArray($array) {
		if (is_null($array)) {
			return NULL;
		}
		$className = get_called_class();
		$entity = new $className;
		if ($entity instanceof Base) {
			$collection = array();
			foreach ($array as $oneItem) {
				if (is_array($oneItem)) {
					$collection[] = $entity::createByData($oneItem);
				}
			}
			return $collection;
		}
		return NULL;
	}

	/**
	 * Возвращает экземпляр класса со свойствами заполнеными согласно ключам массива.
	 *
	 * @param array $data
	 * @return Base|mixed
	 */
	public static function createByData(array $data) {
		$className = get_called_class();
		$instance = new $className;
		$intProperties = method_exists($instance, 'getIntProperties') ? $instance::getIntProperties() : self::getIntProperties();
		$dateTimeProperties = method_exists($instance, 'getDateTimeProperties') ? $instance::getDateTimeProperties() : self::getDateTimeProperties();
		foreach ($instance as $k => $oneProperty) {
			if (isset($data[$k])) {
				switch (TRUE) {
					case in_array($k, $intProperties):
						$instance->$k = (int)$data[$k];
						break;
					case in_array($k, $dateTimeProperties):
						$instance->$k = self::getDateTimeByYearMonth($data[$k]);
						break;
					default:
						$instance->$k = $data[$k];
				}
			}
		}
		return $instance;
	}

	/**
	 * Возвращает массив имен свойств типа int
	 *
	 * @return string[]
	 */
	protected static function getIntProperties() {
		return array();
	}
	/**
	 * Возвращает массив имен свойств типа \DateTime
	 *
	 * @return string[]
	 */
	protected static function getDateTimeProperties() {
		return array();
	}

	/**
	 * Конвертирует дату в формате "Ym" в объект типа DateTime. Либо возвращает NULL если не получилось преобразовать.
	 *
	 * @param $yearMonth
	 * @return \DateTime|null
	 */
	public static function getDateTimeByYearMonth($yearMonth) {
		if (strlen($yearMonth) == 6) {
			$date = new \DateTime();
			$date->setDate(substr($yearMonth, 0, 4), substr($yearMonth, -2), 1);
			$date->setTime(0, 0, 0);
			return $date;
		}
		return NULL;
	}
} 