<?php
/**
 * @author   : stas
 * @date     : 29 Apr 2020
 * @copyright: einsundnull
 */

namespace Eun\Blocks;


use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Control\Controller;

class SiteConfigReader
{
	/**
	 * @var array
	 */
	private static $config;

	private static function init()
	{
		$requestedDevBuild = (stripos(Controller::curr()->getRequest()->getURL(), 'dev/build') === 0);
		if (!$requestedDevBuild) {
			$reflectionProperty = new \ReflectionProperty(SiteConfig::class, 'record');
			$reflectionProperty->setAccessible(true);
			self::$config = $reflectionProperty->getValue(SiteConfig::current_site_config());
		}
	}

	public static function get(string $field) {
		if (self::$config === null) {
			self::init();
		}
		return self::$config[$field] ?? null;
	}
}
