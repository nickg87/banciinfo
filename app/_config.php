<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);
//romve item from CMS left menu
\SilverStripe\Admin\CMSMenu::remove_menu_class(SilverStripe\CampaignAdmin\CampaignAdmin::class);

$menuItems = array(
    'CMSPagesController',
    'AssetAdmin',
    'CMSSettingsController',
    'MyAdmin',
    'SecurityAdmin',
);

//foreach(array_combine($menuItems, range(count($menuItems), 1)) as $class => $menuPriority)
//    $config->update($class, 'menu_priority', $menuPriority);