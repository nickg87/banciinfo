<?php
/**
 * @author   : nick
 * @date     : 06 Ian 2023
 * @copyright: banci-info
 */

namespace Custom\BanciInfo;

use PageController;
use SilverStripe\Control\Director;
use Page;
use SilverStripe\Dev\Debug;

class MainPageController extends PageController
{
	/**
	 * @var array
	 */
	private static $allowed_actions = [];

    protected function init()
    {
        parent::init();
        //Debug::dump('enters here main');
        // You can include any CSS or JS required by your project here.
        // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
    }

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
