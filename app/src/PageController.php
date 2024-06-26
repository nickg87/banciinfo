<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\Core\Manifest\ModuleResourceLoader;
    use SilverStripe\View\Requirements;

    class PageController extends ContentController
    {
        /**
         * An array of actions that can be accessed via a request. Each array element should be an action name, and the
         * permissions or conditions required to allow the user to access it.
         *
         * <code>
         * [
         *     'action', // anyone can access this action
         *     'action' => true, // same as above
         *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
         *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
         * ];
         * </code>
         *
         * @var array
         */
        private static $allowed_actions = [];

        protected function init()
        {
            parent::init();
            // You can include any CSS or JS required by your project here.
            // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
//            $runtimeFile = 'app/js/consent_v2_texts.js';
//            $absolutePath = BASE_PATH . '/' . $runtimeFile;
//            if (file_exists(ModuleResourceLoader::singleton()->resolvePath($absolutePath))) {
//                Requirements::javascript($runtimeFile, [ 'async' => true]);
//            }

//            $runtimeFile = 'app/js/consent_v2.js';
//            $absolutePath = BASE_PATH . '/' . $runtimeFile;
//            if (file_exists(ModuleResourceLoader::singleton()->resolvePath($absolutePath))) {
//                Requirements::javascript($runtimeFile, [ 'async' => true]);
//            }

            $runtimeFile = 'app/js/dist/bundle.js';
            $absolutePath = BASE_PATH . '/' . $runtimeFile;
            if (file_exists(ModuleResourceLoader::singleton()->resolvePath($absolutePath))) {
                Requirements::javascript($runtimeFile, [ 'async' => true]);
            }


//            $runtimeFile = 'app/css/consent_v2.css';
//            $absolutePath = BASE_PATH . '/' . $runtimeFile;
//            if (file_exists(ModuleResourceLoader::singleton()->resolvePath($absolutePath))) {
//                Requirements::css($runtimeFile);
//            }
        }
    }
}
