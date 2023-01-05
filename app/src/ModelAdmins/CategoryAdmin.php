<?php

namespace Custom\BanciInfo;

use SilverStripe\Admin\ModelAdmin;
use SS_JoinedGraphQL\DataObjects\Item;

class CategoryAdmin extends ModelAdmin{
    private static $managed_models = [
        Category::class
    ];

    private static $url_segment = 'category';
    private static $menu_title = 'Category';
    private static $menu_icon_class = 'font-icon-list';
}
