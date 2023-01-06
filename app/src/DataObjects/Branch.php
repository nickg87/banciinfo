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
class Branch extends DataObject
{
	private static $table_name = "Banci_Info_Branch";

	private static $singular_name = 'Branch';

	private static $default_sort = "Sort ASC";

	private static $db = [
		'Title'       => 'Varchar(255)',
		'Description' => 'Varchar(255)',
		'Address'     => 'Varchar(255)',
		'Phone'       => 'Varchar(255)',
		'Fax'         => 'Varchar(255)',
		'Email'       => 'Varchar(255)',
		'Active'      => 'Boolean(0)',
		'OldLink'     => 'Varchar(255)',
		'Sort'        => 'Int',
	];

	private static $has_one = [
		'County' => County::class,
		'City' => City::class,
		'Bank' => Bank::class,
	];

	public static function getDropdown()
	{
		$res = [];
		$cats = Branch::get();
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
