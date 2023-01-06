<?php
/**
 * @author   : nick
 * @date     : 05 Ian 2023
 * @copyright: banci-info
 */


namespace Custom\BanciInfo;

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\ManyManyList;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\ToggleCompositeField;

/**
 * Class Tag
 *
 * @property string Title
 * @property string Description
 *
 * @method ManyManyList Articles()
 *
 * @package Eun\Giga
 */
class Tag extends DataObject
{
	private static $table_name = "Banci_Info_Tag";

	private static $singular_name = 'Tag';

	private static $default_sort = "Sort ASC";

	private static $db = [
		'Title'       => 'Varchar(255)',
		'Description' => 'Varchar(255)',
		'Sort'        => 'Int',
	];

	private static $many_many = [
//		'Articles' => Article::class,
//		'Banks' => Bank::class,
	];

	public static function getDropdown()
	{
		$res = [];
		$cats = Tag::get();
		foreach ($cats as $cat) {
			$res[ $cat->ID ] = $cat->Title__en_US;
		}
		return $res;
	}



	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		//$fields->removeByName(array_keys(self::$db));
//		$fields->removeByName('Articles');
		//$fields->removeByName('Banks');

		return $fields;
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

	protected function onBeforeWrite()
	{
		if (!$this->Sort) {
			$this->Sort = Tag::get()->max('Sort') + 1;
		}
		parent::onBeforeWrite();
	}

}
