<?php
namespace NS\ABCPApi\RestApiClients;

use NS\ABCPApi\Common\CarType;
use NS\ABCPApi\Common\ServiceErrors;
use NS\ABCPApi\RestClient\Request;
use NS\ABCPApi\RestClient\RestClient;
use NS\ABCPApi\TecDocEntities\AnalogArticle;
use NS\ABCPApi\TecDocEntities\Article;
use NS\ABCPApi\TecDocEntities\Manufacturer;
use NS\ABCPApi\TecDocEntities\Model;
use NS\ABCPApi\TecDocEntities\ModelVariant;
use NS\ABCPApi\TecDocEntities\Modification;

/**
 * Клиент для доступа к сервису каталог TecDoc
 *
 */
class TecDoc extends RestClient {
	const WEB_SERVICE_URL = 'tecdoc.api.abcp.ru';
	/**
	 * Значение ключа (USER_KEY) для доступа к TecDoc API
	 *
	 * @var string
	 */
	private $userKey = '';
	/**
	 * Логин (USER_LOGIN) для доступа к TecDoc API
	 *
	 * @var string
	 */
	private $userLogin = '';
	/**
	 * Пароль (USER_PSW) для доступа к TecDoc API
	 *
	 * @var string
	 */
	private $userPsw = '';

	/**
	 * Возвращает значение ключа (USER_KEY) для доступа к TecDoc API
	 *
	 * @return string
	 */
	public function getUserKey() {
		return $this->userKey;
	}

	/**
	 * Устанавливает значение ключа (USER_KEY) для доступа к TecDoc API
	 *
	 * @param $userKey
	 * @return TecDoc
	 */
	public function setUserKey($userKey) {
		$this->userKey = $userKey;
		return $this;
	}

	/**
	 * Возвращает логин (USER_LOGIN) для доступа к TecDoc API
	 *
	 * @return string
	 */
	public function getUserLogin() {
		return $this->userLogin;
	}

	/**
	 * Устанавливает логин (USER_LOGIN) для доступа к TecDoc API
	 *
	 * @param $userLogin
	 * @return TecDoc
	 */
	public function setUserLogin($userLogin) {
		$this->userLogin = $userLogin;
		return $this;
	}

	/**
	 * Возвращает пароль (USER_PSW) для доступа к TecDoc API
	 *
	 * @return string
	 */
	public function getUserPsw() {
		return $this->userPsw;
	}

	/**
	 * Устанавливает пароль (USER_PSW) для доступа к TecDoc API
	 *
	 * @param $userPsw
	 * @return TecDoc
	 */
	public function setUserPsw($userPsw) {
		$this->userPsw = $userPsw;
		return $this;
	}

	public function __construct($userKey = '', $userLogin = '', $userPsw = '') {
		$this->userKey = $userKey;
		$this->userLogin = $userLogin;
		$this->userPsw = $userPsw;
	}

	/**
	 * Возвращает массив сущностей производителей (брендов). Можно указать тип автомобиля.
	 *
	 * @param int $carType
	 * @return Manufacturer[]
	 * @throws \Exception
	 */
	public function getManufacturers($carType = CarType::ALL) {
		return Manufacturer::convertToTecDocEntitiesArray(self::getManufacturersAsArray($carType));
	}

	/**
	 * Возвращает массив производителей (брендов) в виде массива. Можно указать тип автомобиля.
	 *
	 * @param int $carType
	 * @return array
	 * @throws \Exception
	 */
	public function getManufacturersAsArray($carType = CarType::ALL) {
		$requestVars = $this->getAuthenticationData();
		if ($carType) {
			$requestVars['carType'] = $carType;
		}
		$request = new Request(TecDoc::WEB_SERVICE_URL);
		$request->setParameters($requestVars)
			->setOperation('manufacturers');
		$response = $this->send($request)->getAsArray();
		if (isset($response['errorCode'])) {
			throw new \Exception(ServiceErrors::getErrorMessageByCode($response['errorCode']), $response['errorCode']);
		}
		return $response;
	}

	/**
	 * Возвращает массив с данными для авторизации.
	 *
	 * @return array
	 */
	private function getAuthenticationData() {
		return array('userlogin' => $this->getUserLogin(),
		             'userpsw'   => $this->getUserPsw(),
		             'userkey'   => $this->getUserKey()
		);
	}

	/**
	 * Возвращает массив сущностей Model по идентификатору производителя (бренда).
	 *
	 * @param $manufacturerId
	 * @return Model[]
	 * @throws \Exception
	 */
	public function getModels($manufacturerId) {
		return Model::convertToTecDocEntitiesArray(self::getModelsAsArray($manufacturerId));
	}

	/**
	 * Возвращает список моделей по идентификатору производителя (бренда) в виде массива.
	 *
	 * @param $manufacturerId
	 * @return array
	 * @throws \Exception
	 */
	public function getModelsAsArray($manufacturerId) {
		$requestVars = $this->getAuthenticationData();
		$requestVars['manufacturerId'] = $manufacturerId;

		$request = new Request(TecDoc::WEB_SERVICE_URL);
		$request->setParameters($requestVars)
			->setOperation('models');
		$response = $this->send($request)->getAsArray();
		if (isset($response['errorCode'])) {
			throw new \Exception(ServiceErrors::getErrorMessageByCode($response['errorCode']), $response['errorCode']);
		}
		return $response;
	}

	/**
	 * Вовзращает массив сущностей модификаций по идентфикатору производителя (бренда) и идентификатору модели.
	 *
	 * @param $manufacturerId
	 * @param $modelId
	 * @return Modification[]
	 * @throws \Exception
	 */
	public function getModifications($manufacturerId, $modelId) {
		return Modification::convertToTecDocEntitiesArray(self::getModificationsAsArray($manufacturerId, $modelId));
	}

	/**
	 * Вовзращает список модификаций по идентфикатору производителя (бренда) и идентификатору модели в виде массива.
	 *
	 * @param $manufacturerId
	 * @param $modelId
	 * @return array
	 * @throws \Exception
	 */
	public function getModificationsAsArray($manufacturerId, $modelId) {
		$requestVars = $this->getAuthenticationData();
		$requestVars['manufacturerId'] = $manufacturerId;
		$requestVars['modelId'] = $modelId;

		$request = new Request(TecDoc::WEB_SERVICE_URL);
		$request->setParameters($requestVars)
			->setOperation('modifications');
		$response = $this->send($request)->getAsArray();
		if (isset($response['errorCode'])) {
			throw new \Exception(ServiceErrors::getErrorMessageByCode($response['errorCode']), $response['errorCode']);
		}
		return $response;
	}

	/**
	 * Возвращает дерево категорий для заданной модификации.
	 *
	 * @param $modificationId
	 * @return ModelVariant[]
	 * @throws \Exception
	 */
	public function getModelVariant($modificationId) {
		return ModelVariant::convertToTecDocEntitiesArray(self::getModelVariantAsArray($modificationId));
	}

	/**
	 * * Возвращает дерево категорий для заданной модификации в виде массива.
	 *
	 * @param $modificationId
	 * @return array
	 * @throws \Exception
	 */
	public function getModelVariantAsArray($modificationId) {
		$requestVars = $this->getAuthenticationData();
		$requestVars['modificationId'] = $modificationId;

		$request = new Request(TecDoc::WEB_SERVICE_URL);
		$request->setParameters($requestVars)
			->setOperation('tree');
		$response = $this->send($request)->getAsArray();
		if (isset($response['errorCode'])) {
			throw new \Exception(ServiceErrors::getErrorMessageByCode($response['errorCode']), $response['errorCode']);
		}
		return $response;
	}

	/**
	 * Возвращает список деталей для указанной категории.
	 *
	 * @param $modificationId
	 * @param $categoryId
	 * @return Article[]
	 * @throws \Exception
	 */
	public function getArticles($modificationId, $categoryId) {
		return Article::convertToTecDocEntitiesArray(self::getArticlesAsArray($modificationId, $categoryId));
	}

	/**
	 * Возвращает список деталей для указанной категории в виде массива.
	 *
	 * @param $modificationId
	 * @param $categoryId
	 * @return array
	 * @throws \Exception
	 */
	public function getArticlesAsArray($modificationId, $categoryId) {
		$requestVars = $this->getAuthenticationData();
		$requestVars['modificationId'] = $modificationId;
		$requestVars['categoryId'] = $categoryId;
		$request = new Request(TecDoc::WEB_SERVICE_URL);
		$request->setParameters($requestVars)
			->setOperation('articles');
		$response = $this->send($request)->getAsArray();
		if (isset($response['errorCode'])) {
			throw new \Exception(ServiceErrors::getErrorMessageByCode($response['errorCode']), $response['errorCode']);
		}
		return $response;
	}

	/**
	 * Возвращает список модификаций применимых к заданной детали.
	 *
	 * @param $articleId
	 * @return Modification[]
	 * @throws \Exception
	 */
	public function getAdaptability($articleId) {
		return Modification::convertToTecDocEntitiesArray(self::getAdaptabilityAsArray($articleId));
	}

	/**
	 * Возвращает список модификаций применимых к заданной детали в виде массива.
	 *
	 * @param $articleId
	 * @return array
	 * @throws \Exception
	 */
	public function getAdaptabilityAsArray($articleId) {
		$requestVars = $this->getAuthenticationData();
		$requestVars['articleId'] = $articleId;
		$request = new Request(TecDoc::WEB_SERVICE_URL);
		$request->setParameters($requestVars)
			->setOperation('adaptability');
		$response = $this->send($request)->getAsArray();
		if (isset($response['errorCode'])) {
			throw new \Exception(ServiceErrors::getErrorMessageByCode($response['errorCode']), $response['errorCode']);
		}
		return $response;
	}

	/**
	 * Возвращает спискок аналогов по номеру без указания бренда.
	 *
	 * @param $number
	 * @param $analogType
	 * @return AnalogArticle[]
	 * @throws \Exception
	 */
	public function getAnalogs($number, $analogType) {
		return AnalogArticle::convertToTecDocEntitiesArray(self::getAnalogsAsArray($number, $analogType));
	}

	/**
	 * Возвращает спискок аналогов по номеру без указания бренда в виде массива.
	 *
	 * @param $number
	 * @param $analogType
	 * @return array
	 * @throws \Exception
	 */
	public function getAnalogsAsArray($number, $analogType) {
		$requestVars = $this->getAuthenticationData();
		$requestVars['number'] = $number;
		$requestVars['type'] = $analogType;
		$request = new Request(TecDoc::WEB_SERVICE_URL);
		$request->setParameters($requestVars)
			->setOperation('analogs');
		$response = $this->send($request)->getAsArray();
		if (isset($response['errorCode'])) {
			throw new \Exception(ServiceErrors::getErrorMessageByCode($response['errorCode']), $response['errorCode']);
		}
		return $response;
	}

	/**
	 * Возвращает детализированную информацию о детали.
	 *
	 * @param $articleId
	 * @return Article
	 * @throws \Exception
	 */
	public function getArticle($articleId) {
		return Article::createByData(self::getArticleAsArray($articleId));
	}

	/**
	 * Возвращает детализированную информацию о детали в виде массива.
	 *
	 * @param $articleId
	 * @return array
	 * @throws \Exception
	 */
	public function getArticleAsArray($articleId) {
		$requestVars = $this->getAuthenticationData();
		$requestVars['articleId'] = $articleId;
		$request = new Request(TecDoc::WEB_SERVICE_URL);
		$request->setParameters($requestVars)
			->setOperation('articleInfo');
		$response = $this->send($request)->getAsArray();
		if (isset($response['errorCode'])) {
			throw new \Exception(ServiceErrors::getErrorMessageByCode($response['errorCode']), $response['errorCode']);
		}
		return $response;
	}
} 