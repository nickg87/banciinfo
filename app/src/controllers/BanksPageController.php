<?php
/**
 * @author   : nick
 * @date     : 06 Ian 2023
 * @copyright: banci-info
 */

namespace Custom\BanciInfo;


use Custom\BanciInfo\SiteConfigReader;
use SilverStripe\Dev\Debug;
use SilverStripe\View\SSViewer;
use SilverStripe\View\ArrayData;
use Custom\BanciInfo\MainPageController;
use SilverStripe\Control\Controller;


/**
 * Controller for banks Page.
 */
class BanksPageController extends MainPageController
{
	private static $allowed_actions = ['index'];

    protected function init()
    {
        parent::init();
        // Debug::dump('enters here banks');
        // You can include any CSS or JS required by your project here.
        // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
    }

	private static $url_handlers = [
		'//$URLSegment' => 'index',
	];

	private static $url_segment = 'articole';

	/**
	 * Return a link to this request handler.
	 * The link returned is supplied in the constructor
	 *
	 * @param string|null $action
	 * @return string
	 */
	public function Link($action = null)
	{
		$action = $this->getActionUrl();
		$link = Controller::join_links('/', $action);
		$this->extend('updateLink', $link, $action);
		return $link;
	}

	protected function getActionUrl() {
		$currController = Controller::curr();
		$request = $currController->getRequest();
		return $request->getUrl();
	}

	public function index(){
		//Get the Category
		$curItem = $this->getCurrentBank();
        $Content = '';
		if($curItem)
		{
			$metaTitle = $curItem->Title;
			if ($curItem->CustomMetaTitle != '') {
				$metaTitle = $curItem->CustomMetaTitle;
				//$this->data()->MetaTitle = $curItem->CustomMetaTitle;
			}
			if ($curItem->CustomMetaDescription != '') {
				$this->data()->MetaDescription =$curItem->CustomMetaDescription;
			} else {
				if ($curItem->Description != '') {
					$this->data()->MetaDescription = $curItem->Description;
				}
			}
            if ($curItem->Description != '') {
                $Content = $curItem->Description;
                if ($curItem->Articles()->count()) {
                    $Content .= '<br> Gasiti '.$curItem->Articles()->count().' articole despre aceasta insititutie';
                }
            }
            $siteTitle = SiteConfigReader::get('Title');
			return $this->renderWith('Page',['Title' => $curItem->Title, 'MetaTitle' => $metaTitle, 'Content' => $Content  ]);
		} else {
			//Bank not found
            $title = $metaTitle = 'Lista banci romania!';
            $Content = 'Mai jos gasiti lista tuturor bancilor active din Romania!';
            return $this->renderWith('Page',['Title' => $title, 'MetaTitle' => $metaTitle, 'Content' => $Content  ]);

		}
	}

	public function getCurrentObject($withActive = false)
	{
		return self::getCurrentBank($withActive);
	}

	//Get's the current product from the URL, if any
	public function getCurrentBank($withActive = false)
	{
		$data = $this->request->allParams();
		$URLSegment = urldecode($data['URLSegment'] ?? '');
		$start = '';
		if ($withActive) {
			//$start = "Active = 1 AND ";
			$start = " ";
		}
		$curItem = Bank::get_one(Bank::class, $start . " (URLSegment = '" . $URLSegment . "' )");
		if ($URLSegment && $curItem) {
			return $curItem;
		} else {
            return null;
		}
	}


//	public function BootstrapBreadcrumbs($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false)
//	{
//		$pages = $this->owner->getBreadcrumbItems($maxDepth, $stopAtPageType, $showHidden);
//
//		$productsPageLink = '';
//		$productsPageText = '';
//
//		$key = 1;
//		foreach ($pages as $page) {
//			if ($key == $pages->count()) {
//				$page->Title = self::getCurrentCategory()->T('Title');
//			}
//			$key++;
//		}
//		$currentCat =  self::getCurrentCategory();
//		//Debug::dump($currentCat);
//		if ($currentCat->ParentID > 0) {
//			$parentCategory = Category::get_by_id($currentCat->ParentID);
//			//Debug::dump($parentCategory);
//			$productsPageLink = $parentCategory->AbsoluteLinkByLang(self::getLangFromUrl());
//			$productsPageText = $parentCategory->T('Title');
//		}
//
//		$template = new SSViewer(['BreadcrumbsTemplate', 'Eun\Includes\BreadcrumbsTemplate']);
//		return $template->process($this->owner->customise(new ArrayData([
//			"Pages"            => $pages,
//			"TypeCategory"     => true,
//			"ProductsPageText" => $productsPageText,
//			"ProductsPageLink" => $productsPageLink,
//			"Unlinked"         => $unlinked,
//		])));
//	}

}
