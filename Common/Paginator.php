<?php
namespace NS\TecDocSite\Common;

/**
 * Класс, реализующий интерфейс paginator-a, преднозначенного для перемещения по страницам.
 */
class Paginator {

	const ONE_PAGE = 1;

	private $options = NULL;
	private $displayedPages = array();
	private $currentPage = 0;
	private $pagesCount = 0;

	public function __construct(PaginatorOptions $options = NULL) {
		$this->options = isset($options) ? $options : new PaginatorOptions();
	}

	public function __destruct() {
		unset($this->options);
		unset($this->displayedPages);
	}

	public function deploy() {
		$this->make();
		
		$page = '';
		if (self::ONE_PAGE < $this->getPagesCount()) {
			$options = $this->getOptions();
			$url = is_null($options->url) ? $_SERVER['REQUEST_URI'] : $options->url;
			$parsedUrl = parse_url($url);
			parse_str($parsedUrl['query'], $urlQueryArray);
			unset($urlQueryArray[$options->argName]);
			$newUrlData = array();
			foreach ($urlQueryArray as $k => $oneUrlQueryItem) {
				$newUrlData[] = "$k=$oneUrlQueryItem";
			}
			$url = $newUrlData ? '?' . implode('&', $newUrlData) : '';
			$dataTemplate = array(
				'displayedPages' => $this->getDisplayedPages(),
				'options' => $options,
				'argName' => $options->argName,
				'url' => $url,
				'currentPage' => $this->getCurrentPage(),
				'pagesCount' => $this->getPagesCount()
			);
			$page = View::deploy($options->template, $dataTemplate);
		}
		return $page;
	}

	final protected function make() {
		$options = $this->getOptions();

		$startRecord = abs((int) $options->startRecord);
		$maxRecords = ceil(($options->totalRecords - $options->recordsPageCount) / $options->recordsPageCount) * $options->recordsPageCount;
		if ($startRecord > $maxRecords) {
			$startRecord = $maxRecords;
		}
		$this->currentPage = floor($startRecord / $options->recordsPageCount) + 1;
		$this->pagesCount = floor($maxRecords / $options->recordsPageCount) + 1;

		$leftEdgePage = $this->currentPage - floor($options->displayedPagesCount / 2);
		if ($leftEdgePage <= 1) {
			$leftEdgePage = 1;
		}

		$rightEdgePage = $leftEdgePage + $options->displayedPagesCount - 1;
		if ($rightEdgePage >= $this->pagesCount) {
			$rightEdgePage = $this->pagesCount;
		}

		if (($rightEdgePage - $leftEdgePage) < $options->displayedPagesCount) {
			$leftEdgePage = $rightEdgePage - $options->displayedPagesCount + 1;
			if ($leftEdgePage <= 1) {
				$leftEdgePage = 1;
			}
		}

		for ($number = $leftEdgePage; $number <= $rightEdgePage; $number++) {
			$this->displayedPages[$number] = ($number - 1) * $options->recordsPageCount;
		}
	}

	final protected function getOptions() {
		return $this->options;
	}

	final protected function getDisplayedPages() {
		return $this->displayedPages;
	}

	final protected function getCurrentPage() {
		return $this->currentPage;
	}

	final protected function getPagesCount() {
		return $this->pagesCount;
	}
}