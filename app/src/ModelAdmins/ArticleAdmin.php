<?php

namespace Custom\BanciInfo;

use SilverStripe\Admin\ModelAdmin;
use SS_JoinedGraphQL\DataObjects\Item;

class ArticleAdmin extends ModelAdmin{
    private static $managed_models = [
        Article::class
    ];

    private static $url_segment = 'article';
    private static $menu_title = 'Article';
    private static $menu_icon_class = 'font-icon-list';
}
