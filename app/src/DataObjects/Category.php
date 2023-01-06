<?php
/**
 * @author   : nick
 * @date     : 05 Ian 2023
 * @copyright: banci-info
 */


namespace Custom\BanciInfo;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Dev\Debug;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldExportButton;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\GridField\GridFieldImportButton;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\ManyManyList;
use SilverStripe\Control\Director;
use SilverStripe\ORM\ArrayList;
use Page;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\View\ArrayData;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\DataList;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Terraformers\RichFilterHeader\Form\GridField\RichFilterHeader;

/**
 * Class Category
 *
 * @property string Name
 * @property string Status
 * @property string Description
 *
 * @method ManyManyList Products
 * @method ManyManyList ProductLoops
 * @method Image Image
 *
 * @package Custom\BanciInfo
 */
class Category extends DataObject
{
	private static $table_name = "Banci_Info_Category";

	private static $singular_name = 'Category';

	private static $default_sort = 'Sort ASC';

	private static $db = [
		'Title'                 => 'Varchar(255)',
		'Description'           => 'Text',
		'URLSegment'            => 'Varchar(255)',
		'DescriptionMore'       => 'HTMLText',
		'Sort'                  => 'Int',
		'ShowInSitemap'         => 'Boolean(1)',
		'CustomMetaDescription' => 'Text',
		'CustomMetaTitle' 		=> 'Text'
	];

	private static $has_one = [
		'Icon'        => Image::class,
		'HeaderImage' => Image::class,
		'Parent'      => Category::class,
	];

	private static $many_many = [
		'Articles'         => Article::class,
	];

	private static $has_many = [
		'SubCategories' => Category::class . '.Parent',
	];

	private static $cascade_deletes = [
		'Icon',
		'HeaderImage',
	];

	private static $casting = [
		'DescriptionMore' => 'HTMLText',
	];


	//Set our defaults
	private static $defaults = [
		'URLSegment'     => 'new-cat',
	];


	//Add an SQL index for the URLSegment
	private static $indexes = [
		"URLSegment"     => true,
	];

	public static function allActive()
	{
		return self::get()->filter('status', 1)->map('ID', 'Name');
	}


	//Set URLSegment to be unique on write

	public static function getDropdown()
	{
		$res = [];
		$cats = Category::get()->filter(['ParentID' => '0']);
		foreach ($cats as $cat) {
			$res[ $cat->ID ] = $cat->Title__en_US;
		}
		return $res;
	}

	public static function getDropdownShortcodeList()
	{
		$res = [];
		$cats = Category::get()->sort('Title__en_US');
		foreach ($cats as $key=>$cat) {
			$res[ $key ]['id'] = $cat->ID;
			$res[ $key ]['name'] = $cat->Title__en_US;
		}
		return $res;
	}

	//Test whether the URLSegment exists already on another Product



	public static function getDropdownall()
	{
		$res = [];
		$cats = Category::get();
		foreach ($cats as $cat) {
			$res[ $cat->ID ] = $cat->Title__en_US;
		}
		return $res;
	}

	public static function getDropdownallSubcat()
	{
		$res = [];
		$cats = Category::get()->filter(['ParentID:GreaterThan' => '0']);
		foreach ($cats as $cat) {
			$res[ $cat->ID ] = $cat->Title__en_US;
		}
		return $res;
	}

	function onBeforeWrite()
	{
		if (!$this->Sort) {
			$this->Sort = Category::get()->max('Sort') + 1;
		}

		parent::onBeforeWrite();
	}

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fields->removeByName('Sort');
		$fields->removeByName('URLSegment');
//		$fields->removeByName('Title');
//		$fields->removeByName('Description');
//		$fields->removeByName('DescriptionMore');
//		$fields->removeByName('CustomMetaDescription');
//		$fields->removeByName('CustomMetaTitle');
		$fields->removeByName('Articles');
		$fields->removeByName('SubCategories');
		$fields->removeByName('Parent');
		$fields->removeByName('ParentID');


		if ($this->exists()) {
			$config = GridFieldConfig_RelationEditor::create();
			$config->removeComponentsByType(GridFieldFilterHeader::class);
			$config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
			$dataColumns = $config->getComponentByType(GridFieldDataColumns::class);
            $config->addComponent(new GridFieldOrderableRows('Sort'));
            $config->addComponent(self::_filtersConfig());

			$config->removeComponentsByType(GridFieldExportButton::class);

//			$exportButton = new GigaExportButton('buttons-before-left');
//			$exportButton->setExportColumns($this->getExportFields());
//			$exportButton->setCsvFilename('subcategories-for-'.$this->ID);
//			$config->addComponent($exportButton);

			$presetDisplayFields = [];
			$presetDisplayFields['ID'] = 'ID';
			$presetDisplayFields['Title'] = 'Title';
			$presetDisplayFields['Description'] = 'Description';

			$dataColumns->setDisplayFields($presetDisplayFields);

//			$config->addComponents(
//				self::_filtersConfig()
//			);

			$subCategoriesField = new GridField(
				'SubCategories',
				'Sub Categories',
				$this->SubCategories(),
				$config
			);
			//$subCategoriesField->getConfig()->removeComponent(new GridFieldFilterHeader());
			$fields->addFieldToTab('Root.SubCategory', $subCategoriesField);
		}


		// Add our file uploader to a new tab called "Map" (Root.Map).
		$fields->addFieldToTab('Root.Main', $imgField = (new UploadField('Icon', 'Icon image'))->setAllowedExtensions(['jpg', 'png']));
		$fields->addFieldToTab('Root.Main', $imgField2 = (new UploadField('HeaderImage', 'Header Image'))->setAllowedExtensions(['jpg', 'png']));

		$fields->addFieldToTab('Root.Main', new OptionsetField('ShowInSitemap', 'Sitemap', [
			true  => 'Show',
			false => 'Hide'],
			$this->ShowInSitemap));
		return $fields;
	}

    public static function _filtersConfig()
    {
        $filter = new RichFilterHeader();

        $presetFilterMethods = [];
        $presetFilterMethods['ID'] = function(DataList $list, $name, $value) {
            return $list->filterAny([
                $name . ':PartialMatch' => $value,
            ]);
        };
        $presetFilterMethods['Title'] = function(DataList $list, $name, $value) {
            return $list->filterAny([
                $name . ':PartialMatch' => $value,
            ]);
        };
        $presetFilterMethods['Description'] = function(DataList $list, $name, $value) {
            return $list->filterAny([
                $name . ':PartialMatch' => $value,
            ]);
        };


        $presetFilterFields = [];
        $presetFilterFields['ID'] = $labelTitle = TextField::create('', '');
        $presetFilterFields['Title'] = $labelTitle = TextField::create('', '');
        $presetFilterFields['Description'] = $labelTitle = TextField::create('', '');


        $presetFilterConfig = [];
        $presetFilterConfig['ID'] = 'ID';
        $presetFilterConfig['Title'] = 'Title';
        $presetFilterConfig['Description'] = 'Description';

        $filter
            ->setFilterConfig($presetFilterConfig)
            ->setFilterMethods($presetFilterMethods);

        return $filter;
    }

	public function getExportFields()
	{
		$exportFieldsArray = [
			'ID'                 => 'ID',
		];

        $exportFieldsArray ['Title'] =  'Title';
        $exportFieldsArray ['Description'] =  'Description';
        $exportFieldsArray ['DescriptionMore'] =  'DescriptionMore';
        $exportFieldsArray ['URLSegment'] =  'URLSegment';

		$exportFieldsArray ['Sort'] = 'Sort';

		return $exportFieldsArray;
	}


//	public static function _filtersConfig()
//	{
//		$filter = new RichFilterHeader();
//
//		$presetFilterMethods = [];
//		$presetFilterMethods['ID'] = function(DataList $list, $name, $value) {
//			return $list->filterAny([
//				$name . ':PartialMatch' => $value,
//			]);
//		};
//		foreach (TranslatableDataObject::$langs as $lang) {
//			$presetFilterMethods['Title__'.$lang] = function(DataList $list, $name, $value) {
//				return $list->filterAny([
//					$name . ':PartialMatch' => $value,
//				]);
//			};
//		}
//
//		$presetFilterConfig = [];
//		$presetFilterConfig['ID'] = 'ID';
//		foreach (TranslatableDataObject::$langs as $lang) {
//			$presetFilterConfig['Title__'.$lang] = 'Title__'.$lang;
//		}
//
//		$filter
//			->setFilterConfig($presetFilterConfig)
//			->setFilterMethods($presetFilterMethods);
//
//		return $filter;
//	}

	public function getCMSValidator()
	{
		return new RequiredFields([
			'Name',
		]);
	}

	//Generate the link for this category
	function Link($lang = false)
	{
		$urlPrefix = '/';
		return $urlPrefix  . "" . trim(strtolower($this->URLSegment)) . '/';
	}


	//Generate the link for this category
	function AbsoluteLink($link = false)
	{
		return Director::absoluteURL($this->Link($link));
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 *
	 * @return \SilverStripe\ORM\DataList
	 */
	public static function _getAllCategories($limit = 0, $offset = 0)
	{
		$categories = self::get()->filter(['ParentID' => 0]);
		if (!empty($categories)) {
			$result = $categories;
		} else {
			$result = new ArrayList();
		}
		return $result;
	}

	public function getTopLevelPage($id = false){

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

	public function getCategoryBreadcrumbs() {
		return self::_getCategoryBreadcrumbs($this->ID);
	}

	public static function _getCategoryBreadcrumbs($id, $result = null) {
		$return = is_null($result) ? [] : $result;
		$current = self::get_by_id($id);
		$return[] = [
			'ID' => $current->ID,
			'ParentID' => $current->ParentID,
			'Title' => $current->T('Title'),
			'Link' => $current->Link(),
		];
		if ($current->ParentID > 0) {
			return self::_getCategoryBreadcrumbs($current->ParentID, $return);
		} else {
			return array_reverse($return);
		}
	}

	public static function CategoryLinkShortcode($arguments, $content = null, $parser = null, $tagName = null) {

		if (!$content) {
			return '';
		}
		if (isset($arguments['text'])) {
			$customText = $arguments['text'];
		}
		if (isset($arguments['title'])) {
			$customTitle = $arguments['title'];
		}
		$category = self::get_by_id(Category::class, $content);

		if (!$category) {
			return '';
		}
		$anchorText = $category->T('Title');
		$anchorTitle = $category->T('Title');

		if (strlen($customText)) $anchorText = $customText;
		if (strlen($customTitle)) $anchorTitle = $customTitle;

		if ($tagName == 'category_link') {
			return '<a target="_blank" title="'.$anchorTitle.'" href="' . $category->AbsoluteLink() . '">' . $anchorText . '</a>';
		}
		return $category->AbsoluteLink();
	}

	public function dbField($fieldName = null)
	{
		if ($fieldName) {
			if (isset(self::$db[ $fieldName ])) {
				return self::$db[ $fieldName ];
			}
		}
		return null;
	}

	public function canView($member = null) {
		return true;
	}

	public function canEdit($member = null)
	{
		return Article::canEditArticle($member);
	}

	public function canDelete($member = null)
	{
		return Article::canEditArticle($member);
	}

	public function canCreate($member = null, $context = [])
	{
		return Article::canEditArticle($member);
	}

}
