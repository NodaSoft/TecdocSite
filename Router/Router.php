<?php
namespace NS\TecDocSite\Router;

use NS\TecDocSite\Interfaces\PageInterface;
use NS\TecDocSite\Pages\Adaptability;
use NS\TecDocSite\Pages\Analogs;
use NS\TecDocSite\Pages\ArticleInfo;
use NS\TecDocSite\Pages\Group;
use NS\TecDocSite\Pages\Index;
use NS\TecDocSite\Pages\Models;
use NS\TecDocSite\Pages\ModelVariant;
use NS\TecDocSite\Pages\Modifications;

class Router
{

	/**
	 * Выводит содержание страницы.
	 */
	public static function run() {
		$pageClass = self::getPageClass($_GET);
		echo $pageClass->getHtml();
	}

	/**
	 * Возвращает имя класса контроллера страницы.
	 *
	 * @param array $data
	 * @return PageInterface
	 */
	private static function getPageClass(array $data) {
		switch (TRUE) {
			case isset($data['analogs']) && isset($data['number']):
				$pageClass = new Analogs();
				break;
			case isset($data['adaptability']) && isset($data['articleId']):
				$pageClass = new Adaptability();
				break;
			case isset($data['articleInfo']) && isset($data['articleId']):
				$pageClass = new ArticleInfo();
				break;
			case isset($data['group']) && isset($data['modelVariant']):
				$pageClass = new Group();
				break;
			case isset($data['model']) && isset($data['man']) && isset($data['modelVariant']):
				$pageClass = new ModelVariant();
				break;
			case isset($data['model']) && isset($data['man']):
				$pageClass = new Modifications();
				break;
			case isset($data['man']):
				$pageClass = new Models();
				break;
			default:
				$pageClass = new Index();
		}
		return $pageClass;
	}
} 