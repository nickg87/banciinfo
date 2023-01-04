<?php

namespace SS_JoinedGraphQL\DataObjects;
use SilverStripe\AssetAdmin\Forms\UploadField;

use SilverStripe\ORM\DataObject;

class Item extends DataObject{

    private static $db = [
        "Name" => "Varchar",
        "Description" => "Varchar",
        "Price" => "Currency",
    ];
    private static $table_name = "Item";

}
