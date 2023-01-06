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
 * Class City
 *
 * @property string Title
 * @property string Description
 *
 *
 * @package Custom\BanciInfo
 */
class City extends DataObject
{
	private static $table_name = "Banci_Info_City";

	private static $singular_name = 'City';

	private static $default_sort = "Sort ASC";

	private static $db = [
		'Title'       => 'Varchar(255)',
		'Description' => 'Varchar(255)',
		'Main'        => 'Boolean(0)',
		'Sort'        => 'Int',
	];

	private static $has_one = [
		'County' => County::class,
	];

	public static function getDropdown()
	{
		$res = [];
		$cats = City::get();
		foreach ($cats as $cat) {
			$res[ $cat->ID ] = $cat->Title;
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
