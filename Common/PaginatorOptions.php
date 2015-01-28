<?php
namespace NS\TecDocSite\Common;
/**
 * Скрипт, описывающий интерфейс paginator-a, преднозначенного для перемещения по страницам.
 */
class PaginatorOptions {

	public $startRecord = 0;
	public $recordsPageCount = 0;
	public $totalRecords = 0;
	public $displayedPagesCount = 9;
	public $showPagesTotalTitle = FALSE;
	public $showGoFirstAndLast = TRUE;
	public $showGoPrevAndNext = TRUE;
	public $showRefreshLink = FALSE;
	public $shortLinks = FALSE;
	public $align = 'left';
	public $argName = 'start';
	public $url = NULL;
	public $urlArgs = NULL;
	public $template = 'common/paginator.tpl';
}
