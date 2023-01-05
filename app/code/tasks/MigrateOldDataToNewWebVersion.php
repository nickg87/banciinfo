<?php
/**
 * @author   : nick
 * @date     : 05 Ian 2023
 * @copyright: banci-info
 */


namespace Custom\BanciInfo;

use SilverStripe\Dev\BuildTask;
use SilverStripe\Dev\Debug;
use SilverStripe\ORM\DB;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\CMS\Model\SiteTree;
use Page;

/**
 * Class MigrateOldDataToNewWebVersion
 *
 * @package Eun\Giga
 */
class MigrateOldDataToNewWebVersion extends BuildTask
{
	protected $title = 'Migrat OLD data to New SS Version!';

	protected $description = 'This will take old data(targeted by ID - with children) and move them to new web2 pages and content of old page in a new Content Basic block in new web2 page';

	protected $enabled = true;

	public static $addedPages = 0;
	public static $addedBlocks = 0;


	private static $segment = 'migrate-old-data';

	function run($request)
	{
        var_dump('should enter here');
		// 220 Basic of Light Measurement
		// 31 Support
		// 32 About us
		// 35 News
		//$pageIDsEN = '220, 31, 32, 35';
//		$pageIDsEN = '31, 32, 35, 220';
//
//		// 151 Grundlagen der Lichtmesstechnik
//		// 8 Über uns
//		// 562 Informationsportal [except 151!]
//		//$pageIDsDE = '151, 8, 562';
//		$pageIDsDE = '7, 8, 34';
//		$pageNotIDsDE = '151';
//
//		$sqlQuery_EN = new SQLSelect();
//		$sqlQuery_EN->setFrom('SiteTree_old_to_migrate');
//		$sqlQuery_EN->setSelect("*");
//		$sqlQuery_EN->addWhere("ID IN (".$pageIDsEN.") ");
//		$resultsEN = $sqlQuery_EN->execute();
//		$rawSQL_EN = $sqlQuery_EN->sql();
//		//Debug::dump($rawSQL_EN);
//
//
//		$sqlQuery_DE = new SQLSelect();
//		$sqlQuery_DE->setFrom('SiteTree_old_to_migrate');
//		$sqlQuery_DE->setSelect("*");
//		$sqlQuery_DE->addWhere("ID IN (".$pageIDsDE.") ");
//		$resultsDE = $sqlQuery_DE->execute();
//		$rawSQL_DE = $sqlQuery_DE->sql();
//		//Debug::dump($rawSQL_DE);
//
//
//		$BasePageID_EN = 40;
//		$BasePageID_DE = 8;
//
//		$fakeContentBlock = BaseBlock::get()->filter(array('Content:not' => null))->first();
//
//		//Debug::dump($resultsEN);
//		//die('here');
//
//		//do it for EN
//		if (!is_null($resultsEN)) {
//			foreach ($resultsEN as $result) {
//				$currentID = $result['ID'];
//				$pageContent = trim($result['Content']);
//				$result = self::unsetUnnecessary($result);
//				$result['ParentID'] = $BasePageID_EN;
//				//Debug::dump($result);
//				$checkExistsTitle = $result['Title'];
//				$checkExistsURLSegment = $result['URLSegment'];
//				$pageExists = Page::get()->filter(array('Title'=> $checkExistsTitle, 'URLSegment'=> $checkExistsURLSegment, 'ParentID'=> $BasePageID_EN))->first();
//				//Debug::dump($pageExists);
//				if (is_null($pageExists)) {
//					// save new page
//					$newPageId = self:: saveNewPage($result,$BasePageID_EN, $pageContent, $fakeContentBlock);
//
//					if ($newPageId && strlen($pageContent)) {
//						// save content as Content Base Block for new page
//						$blockAdded = self::saveBlockContentToNewPage($fakeContentBlock, $pageContent, $newPageId);
//						self::$addedPages ++;
//						if ($blockAdded) {
//							self::$addedBlocks ++;
//						}
//					}
//
//					if($newPageId) {
//						self::checkExistingOldChildrenPage($currentID, $fakeContentBlock, $newPageId);
//					}
//				}
//
//				//Debug::dump($pageExists);
//			}
//		}
//
//		//do it for DE
//		if (!is_null($resultsDE)) {
//			foreach ($resultsDE as $result) {
//				$currentID = $result['ID'];
//				$pageContent = trim($result['Content']);
//				$result = self::unsetUnnecessary($result);
//				$result['ParentID'] = $BasePageID_DE;
//				//Debug::dump($result);
//				$checkExistsTitle = $result['Title'];
//				$checkExistsURLSegment = $result['URLSegment'];
//				$pageExists = Page::get()->filter(array('Title'=> $checkExistsTitle, 'URLSegment'=> $checkExistsURLSegment, 'ParentID'=> $BasePageID_DE))->first();
//				//Debug::dump($pageExists);
//				if (is_null($pageExists)) {
//					// save new page
//					$newPageId = self:: saveNewPage($result,$BasePageID_DE, $pageContent, $fakeContentBlock);
//					if($newPageId) {
//						self::checkExistingOldChildrenPage($currentID, $fakeContentBlock, $newPageId);
//					}
//				}
//			}
//		}

		DB::alteration_message("Task finished. ".self::$addedPages." new Pages added and ".self::$addedBlocks." new Basic Content Added ", "changed");
	}

	public function checkExistingOldChildrenPage($id, $fakeContentBlock, $PageId) {
		$sqlQuery = new SQLSelect();
		$sqlQuery->setFrom('SiteTree_old_to_migrate');
		$sqlQuery->setSelect("*");
		$sqlQuery->addWhere("ParentID = ".$id." ");
		$results = $sqlQuery->execute();
		if (!is_null($results)) {
			foreach ($results as $result) {
				$currentID = $result['ID'];
				$pageContent = trim($result['Content']);
				$result = self::unsetUnnecessary($result);
				$result['ParentID'] = $id;
				$checkExistsTitle = $result['Title'];
				$checkExistsURLSegment = $result['URLSegment'];
				$pageExists = Page::get()->filter(array('Title'=> $checkExistsTitle, 'URLSegment'=> $checkExistsURLSegment, 'ParentID'=> $PageId))->first();
				if (is_null($pageExists)) {
					// save new page
					//$newPageId = self:: saveNewPage($result,$id, $pageContent, $fakeContentBlock);
					$fields = array_keys($result);
					$page = new Page();

					foreach ($fields as $field) {
						$page->{$field} = $result[$field];
					}

					$page->ParentID = $PageId;
					$newPageId = $page->write();

					$page->publish('Stage', 'Live');

					if ($newPageId && strlen($pageContent)) {
						// save content as Content Base Block for new page
						$blockAdded = self::saveBlockContentToNewPage($fakeContentBlock, $pageContent, $newPageId);
						self::$addedPages ++;
						if ($blockAdded) {
							self::$addedBlocks ++;
						}
					}

					if($newPageId) {
						self::checkExistingOldChildrenPage($currentID, $fakeContentBlock, $newPageId);
					}
				}


			}
		}

	}

	public function unsetUnnecessary($result) {
		unset($result['MenuTitle'],$result['ClassName'],$result['MetaTitle'],$result['ID'],$result['Content']);
		return $result;
	}

	public function saveBlockContentToNewPage($record, $content, $parentPageID)
	{
		$clone = $record->duplicate();
		$clone->Content = $content;
		$clone->ParentPageID = $parentPageID;
		return $clone->write();
	}

	public function saveNewPage($result,$parentPageID, $pageContent, $fakeContentBlock)
	{
		$fields = array_keys($result);
		$page = new Page();
		//Debug::dump($page);
		//Debug::dump($page->$allowed_children);

		foreach ($fields as $field) {
			$page->{$field} = $result[$field];
		}

		$page->ParentID = $parentPageID;
		$newPageId = $page->write();

		$page->publish('Stage', 'Live');

		if ($newPageId && strlen($pageContent)) {
			// save content as Content Base Block for new page
			$blockAdded = self::saveBlockContentToNewPage($fakeContentBlock, $pageContent, $newPageId);
			self::$addedPages ++;
			if ($blockAdded) {
				self::$addedBlocks ++;
			}
		}

		return $newPageId;
	}
}
