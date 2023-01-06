<?php
/**
 * @author   : nick
 * @date     : 05 Ian 2023
 * @copyright: banci-info
 */

namespace Custom\BanciInfo;

use Eun\Blocks\SiteConfigReader;
use PageController;
use SilverStripe\Control\Director;
use SilverStripe\Control\Controller;
use Eun\Giga\Category;
use Eun\Giga\Product;
use SilverStripe\i18n\i18n;
use Page;
use SilverStripe\Dev\Debug;

class BanksPageController extends PageController
{
	/**
	 * @var array
	 */
	private static $allowed_actions = [
	];

	public static function getTopLevelPage($id = false){
		if ($id) {
			$curPage = Page::get_by_id($id);
		} else {
			$curPage = Director::get_current_page();

		}
		if ($curPage->ParentID > 0) {
			return self::getTopLevelPage($curPage->ParentID);
		} else {
			return $curPage;
		}
	}

}
