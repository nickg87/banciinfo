<?php
/**
 * @author   : nick
 * @date     : 04 Ian 2023
 * @copyright: local
 */

namespace Local\Blocks;

use SilverStripe\Admin\AdminRootController;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;

class CustomAdminController extends AdminRootController {

	public function handleRequest(HTTPRequest $request)
	{
        var_dump('enters here');

		if ($request->match('graphql')) {
			$request->setUrl(str_replace('admin/graphql', '', $request->getURL()));
			/** @var Controller $controllerObj */
			$controllerObj = Injector::inst()->create('%$SilverStripe\GraphQL\Controller.admin');
			return $controllerObj->handleRequest($request);
		}

		$this->redirect(Director::baseURL());
		return $this->getResponse();
	}
}
