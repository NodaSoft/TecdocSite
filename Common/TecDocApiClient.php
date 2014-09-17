<?php
namespace NS\TecDocSite\Common;

use RestClient\CurlRestClient;

class TecDocApiClient
{
	/**
	 *  Возвращает список производителей автомобилей в виде массива.
	 *
	 * @param int $carType
	 * @return array
	 */
	public function getManufacturers($carType = 0) {
		$requestVars = array(
			'userlogin' => TecDocApiConfig::USER_LOGIN,
			'userpsw'   => TecDocApiConfig::USER_PSW,
			'userkey' => TecDocApiConfig::USER_KEY
		);
		if ($carType) {
			$requestVars['carType'] = $carType;
		}
		return $this->getResultsByGet($requestVars, 'manufacturers');
	}

	/**
	 * Возвращает список модификаций автомобилей в виде массива.
	 *
	 * @param $manufacturerId
	 * @param $modelId
	 * @return array
	 */
	public function getModifications($manufacturerId, $modelId) {
		$requestVars = array(
			'userlogin'      => TecDocApiConfig::USER_LOGIN,
			'userpsw'        => TecDocApiConfig::USER_PSW,
			'userkey' => TecDocApiConfig::USER_KEY,
			'manufacturerId' => $manufacturerId,
			'modelId'        => $modelId
		);
		return $this->getResultsByGet($requestVars, 'modifications');
	}

	/**
	 * Возвращает список категорий для дерева категорий в виде массива.
	 *
	 * @param $modificationId
	 * @return array
	 */
	public function getModelVariant($modificationId) {
		$requestVars = array(
			'userlogin'      => TecDocApiConfig::USER_LOGIN,
			'userpsw'        => TecDocApiConfig::USER_PSW,
			'userkey' => TecDocApiConfig::USER_KEY,
			'modificationId' => $modificationId
		);
		return $this->getResultsByGet($requestVars, 'tree');
	}

	/**
	 * Возвращает список деталей по категории и модификации в виде массива.
	 *
	 * @param $modificationId
	 * @param $categoryId
	 * @return array
	 */
	public function getArticles($modificationId, $categoryId) {
		$requestVars = array(
			'userlogin' => TecDocApiConfig::USER_LOGIN,
			'userpsw' => TecDocApiConfig::USER_PSW,
			'userkey' => TecDocApiConfig::USER_KEY,
			'modificationId' => $modificationId,
			'categoryId'     => $categoryId
		);
		return $this->getResultsByGet($requestVars, 'articles');
	}

	/**
	 * Возвращает список моделей автомобилей в виде массива.
	 *
	 * @param $manufacturerId
	 * @return array
	 */
	public function getModels($manufacturerId) {
		$requestVars = array(
			'userlogin'      => TecDocApiConfig::USER_LOGIN,
			'userpsw'        => TecDocApiConfig::USER_PSW,
			'userkey' => TecDocApiConfig::USER_KEY,
			'manufacturerId' => $manufacturerId
		);
		return $this->getResultsByGet($requestVars, 'models');
	}

	/**
	 * Возвращает детализированную информацию о детали в виде массива.
	 *
	 * @param $articleId
	 * @return array
	 */
	public function getArticleInfo($articleId) {
		$requestVars = array(
			'userlogin' => TecDocApiConfig::USER_LOGIN,
			'userpsw'   => TecDocApiConfig::USER_PSW,
			'userkey' => TecDocApiConfig::USER_KEY,
			'articleId' => $articleId
		);
		return $this->getResultsByGet($requestVars, 'articleInfo');
	}

	/**
	 * Возвращает список применимости в виде массива.
	 *
	 * @param $articleId
	 * @return array
	 */
	public function getAdaptability($articleId) {
		$requestVars = array(
			'userlogin' => TecDocApiConfig::USER_LOGIN,
			'userpsw'   => TecDocApiConfig::USER_PSW,
			'userkey' => TecDocApiConfig::USER_KEY,
			'articleId' => $articleId
		);
		return $this->getResultsByGet($requestVars, 'adaptability');
	}

	/**
	 * Вовзращает список аналогов в виде массива.
	 *
	 * @param $number
	 * @param $type
	 * @return array
	 */
	public function getAnalogs($number, $type) {
		$requestVars = array(
			'userlogin' => TecDocApiConfig::USER_LOGIN,
			'userpsw'   => TecDocApiConfig::USER_PSW,
			'userkey' => TecDocApiConfig::USER_KEY,
			'number'    => $number,
			'type'      => $type
		);
		return $this->getResultsByGet($requestVars, 'analogs');
	}

	/**
	 * Возвращает результат RESTfull запроса в виде массива.
	 *
	 * @param array $requestVars
	 * @param string $operation
	 * @return array
	 */
	public function getResultsByGet($requestVars, $operation) {
		$restClient = new CurlRestClient(TecDocApiConfig::HOST);
		$response = json_decode($restClient->get($operation, $requestVars));
		return $response ? $response : array();
	}
} 