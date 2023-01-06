<?php

namespace Custom\BanciInfo;

use SilverStripe\Admin\ModelAdmin;
use SS_JoinedGraphQL\DataObjects\Item;

class TagAdmin extends ModelAdmin{
    private static $managed_models = [
        Tag::class
    ];

    private static $url_segment = 'tag';
    private static $menu_title = 'Tags';
    private static $menu_icon_class = 'font-icon-tag';
}
