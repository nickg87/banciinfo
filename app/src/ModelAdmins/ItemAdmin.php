<?php

namespace SS_JoinedGraphQL\ModelAdmins;

use SilverStripe\Admin\ModelAdmin;
use SS_JoinedGraphQL\DataObjects\Item;

class ItemAdmin extends ModelAdmin{
    private static $managed_models = [
        Item::class
    ];

    private static $url_segment = 'item';
    private static $menu_title = 'Item';
    private static $menu_icon_class = 'font-icon-list';
}
