<?php
/**
 * @author   : nick
 * @date     : 03 Mar 2021
 * @copyright: einsundnull
 */

namespace Eun\Giga;


use SilverStripe\Dev\Debug;
use SilverStripe\View\SSViewer;
use SilverStripe\View\ArrayData;
use Eun\Giga\GigaPageController;
use SilverStripe\i18n\i18n;
use SilverStripe\Control\Controller;


/**
 * Controller for CategoryPages.
 */
class CategoryPageController extends GigaPageController
{
	private static $allowed_actions = ['index'];

	private static $url_handlers = [
		'//$URLSegment' => 'index',
	];

	private static $url_segment = 'cat';

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
		$Category = $this->getCurrentCategory();
		if($Category)
		{
			$metaTitle = $Category->T('Title');
			if ($Category->T('CustomMetaTitle') != '') {
				$metaTitle = ' ';
				$this->data()->MetaTitle = $Category->T('CustomMetaTitle');
			}
			if ($Category->T('CustomMetaDescription') != '') {
				$this->data()->MetaDescription = $Category->T('CustomMetaDescription');
			} else {
				if ($Category->T('Description') != '') {
					$this->data()->MetaDescription = $Category->T('Description');
				}
			}
			return $this->renderWith('Page',['Title' => $metaTitle, 'MetaTitle' => $metaTitle  ]);
		} else {
			//Category not found
			$redirectLink = URL_CATEGORIES_US;
			$langFromUrl = self::getLangFromUrl();
			if ($langFromUrl == I18N_DE) {
				$redirectLink = URL_CATEGORIES_DE;
			} else if ($langFromUrl == I18N_FR) {
				$redirectLink = URL_CATEGORIES_FR;
			} else if ($langFromUrl == I18N_ES) {
				$redirectLink = URL_CATEGORIES_ES;
			} else if ($langFromUrl == I18N_CN) {
				$redirectLink = URL_CATEGORIES_CN;
			}
			$this->redirect('/'.$redirectLink, 301);
		}
	}

	public function getCurrentObject($withActive = false)
	{
		return self::getCurrentCategory($withActive);
	}

	//Get's the current product from the URL, if any
	public function getCurrentCategory($withActive = false)
	{
		$data = $this->request->allParams();
		$URLSegment = urldecode($data['URLSegment']);
		$start = '';
		if ($withActive) {
			//$start = "Active = 1 AND ";
			$start = " ";
		}
		$curLang = self::getLangFromUrl();
		$Category = Category::get_one(Category::class, $start . " (URLSegment__".$curLang." = '" . $URLSegment . "' )");
		if ($URLSegment && $Category) {
			return $Category;
		} else {
			$inactiveCategory = Category::get_one(Category::class, $start . " (URLSegment__".$curLang." = '" . $URLSegment . "' )");
			if ($inactiveCategory) {
				$Category = Category::get_one(Category::class, $start . " (URLSegment__en_US = '" . $inactiveCategory->URLSegment__en_US . "' )");
				if ($Category) {
					return $Category;
				}
			}
		}
	}

	public static function getLangFromUrl() {
		$curLang = I18N_US;
		$tlp = parent::getTopLevelPage();
		if ($tlp->URLSegment == URL_SEGMENT_DE) {
			$curLang = I18N_DE;
		} else if ($tlp->URLSegment == URL_SEGMENT_FR) {
			$curLang = I18N_FR;
		} else if ($tlp->URLSegment == URL_SEGMENT_ES) {
			$curLang = I18N_ES;
		} else if ($tlp->URLSegment == URL_SEGMENT_CN) {
			$curLang = I18N_CN;
		}
		return $curLang;
	}


	public function BootstrapBreadcrumbs($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false)
	{
		$pages = $this->owner->getBreadcrumbItems($maxDepth, $stopAtPageType, $showHidden);

		$productsPageLink = '';
		$productsPageText = '';

		$key = 1;
		foreach ($pages as $page) {
			if ($key == $pages->count()) {
				$page->Title = self::getCurrentCategory()->T('Title');
			}
			$key++;
		}
		$currentCat =  self::getCurrentCategory();
		//Debug::dump($currentCat);
		if ($currentCat->ParentID > 0) {
			$parentCategory = Category::get_by_id($currentCat->ParentID);
			//Debug::dump($parentCategory);
			$productsPageLink = $parentCategory->AbsoluteLinkByLang(self::getLangFromUrl());
			$productsPageText = $parentCategory->T('Title');
		}

		$template = new SSViewer(['BreadcrumbsTemplate', 'Eun\Includes\BreadcrumbsTemplate']);
		return $template->process($this->owner->customise(new ArrayData([
			"Pages"            => $pages,
			"TypeCategory"     => true,
			"ProductsPageText" => $productsPageText,
			"ProductsPageLink" => $productsPageLink,
			"Unlinked"         => $unlinked,
		])));
	}

}
