<?php
namespace NS\ABCPApi\RestClient;

/**
 * Содержит все необходимые параметры для запроса.
 */
class Request {
	/**
	 * Ссылка на Web-сервис.
	 *
	 * @var string
	 */
	protected $serviceUrl = '';

	/**
	 * Заголовок HTTP Accept.
	 *
	 * @var string
	 */
	protected $httpAccept = 'application/xml';

	/**
	 * Метод запрос (GET, POST и т.д.).
	 *
	 * @var string
	 */
	protected $method = 'get';

	/**
	 * Массив параметров.
	 *
	 * @var array
	 */
	protected $parameters = array();

	/**
	 * Имя операци.
	 *
	 * @var string
	 */
	protected $operation = '';

	public function __construct($serviceUrl = '') {
		$this->serviceUrl = $serviceUrl;
	}

	/**
	 * Возвращает ссылку на Web-сервис.
	 *
	 * @return string
	 */
	public function getServiceUrl() {
		return $this->serviceUrl;
	}

	/**
	 * Устанавливает ссылку на Web-сервис. Возвращает текущий экземпляр класса.
	 *
	 * @param string $serviceUrl
	 * @return Request
	 */
	public function setServiceUrl($serviceUrl) {
		$this->serviceUrl = $serviceUrl;
		return $this;
	}

	/**
	 * Вовзращает http заголовок  httpAccept.
	 *
	 * @return string
	 */
	public function getHttpAccept() {
		return $this->httpAccept;
	}

	/**
	 * Устанавливает http заголовок  httpAccept. Возвращает текущий экземпляр класса.
	 *
	 * @param string $httpAccept
	 * @return Request Current object ($this).
	 */
	public function setHttpAccept($httpAccept) {
		$this->httpAccept = $httpAccept;
		return $this;
	}

	/**
	 * Возвращает метод отправки запроса (GET, POST и т.д.).
	 *
	 * @return string Method.
	 */
	public function getMethod() {
		return $this->method;
	}

	/**
	 * Устанавливает метод отправки запроса (GET, POST и т.д.). Возвращает текущий экземпляр класса.
	 *
	 * @param string $method
	 * @return Request
	 */
	public function setMethod($method) {
		$this->method = $method;
		return $this;
	}

	/**
	 * Возвращает параметры запроса.
	 *
	 * @return array
	 */
	public function getParameters() {
		return $this->parameters;
	}

	/**
	 * Устанавливает параметры запроса. Возвращает текущий экземпляр класса.
	 *
	 * @param array $parameters
	 * @return Request
	 */
	public function setParameters(array $parameters) {
		$this->parameters = $parameters;
		return $this;
	}

	/**
	 * Добавляет параметры запроса. Возвращает текущий экземпляр класса.
	 *
	 * @param string $name
	 * @param string $value
	 * @return Request
	 */
	public function addParameter($name, $value) {
		$this->parameters[$name] = $value;
		return $this;
	}

	/**
	 * Удаляет параметр из запроса по ключу. Возвращает текущий экземпляр класса.
	 *
	 * @param string $name
	 * @return Request
	 */
	public function removeParameter($name) {
		unset($this->parameters[$name]);
		return $this;
	}

	/**
	 * Устанавливает операцию, которая будет выполнена в ходе запроса. Возвращает текущий экземпляр класса.
	 *
	 * @param string $operation
	 * @return Request
	 */
	public function setOperation($operation) {
		$this->operation = $operation;
		return $this;
	}

	/**
	 * Возвращает название операции, которая будет выполнена в ходе запроса.
	 *
	 * @return string.
	 */
	public function getOperation() {
		return $this->operation;
	}
}