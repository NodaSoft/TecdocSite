<?php
namespace NS\ABCPApi\RestClient;

/**
 * Класс описывающий ответ Web-сервиса.
 *
 */
class Response {
	/**
	 * http код ответа.
	 *
	 * @var int
	 */
	private $status = 0;

	/**
	 * Заголовоки ответа.
	 *
	 * @var string
	 */
	private $headers = '';

	/**
	 * Тело ответа.
	 *
	 * @var string
	 */
	private $body = '';

	/**
	 * Возвращает http код ответа.
	 *
	 * @return int
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Устанавливает http код ответа. Возвращает текущий экземпляр класса.
	 *
	 * @param int $status
	 * @return Response
	 */
	public function setStatus($status) {
		$this->status = (int)$status;
		return $this;
	}

	/**
	 * Возвращает заголовки ответа.
	 *
	 * @return string Headers.
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * Устанавливает заголовки ответа.  Возвращает текущий экземпляр класса.
	 *
	 * @param string $headers
	 * @return Response
	 */
	public function setHeaders($headers) {
		$this->headers = $headers;
		return $this;
	}

	/**
	 * Возвращает тело ответа в виде массива.
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function getAsArray() {
		$jsonData = json_decode($this->getBody(), TRUE);
		return $jsonData ? $jsonData : array();
	}

	/**
	 * Возвращает тело ответа в виде.
	 *
	 * @return string
	 */
	public function getBody() {
		return $this->body;
	}

	/**
	 * Устанавливает тело ответа. Возвращает текущий экземпляр класса.
	 *
	 * @param string $body
	 * @return Response
	 */
	public function setBody($body) {
		$this->body = $body;
		return $this;
	}
}