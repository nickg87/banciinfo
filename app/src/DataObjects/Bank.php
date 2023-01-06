<?php
/**
 * @author   : nick
 * @date     : 05 Ian 2023
 * @copyright: banci-info
 */

namespace Custom\BanciInfo;
use SilverStripe\AssetAdmin\Forms\UploadField;

use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

class Bank extends DataObject{

    private static $table_name = "Banci_Info_Bank";

    private static $singular_name = 'Bank';

    private static $db = [
        'Title'                           => 'Varchar(255)',
        'Description'                     => 'HTMLText',
        'Address'                         => 'Varchar(255)',
        'Phone'                           => 'Varchar(255)',
        'Fax'                             => 'Varchar(255)',
        'Email'                           => 'Varchar(255)',
        'Website'                         => 'Varchar(255)',
        'SwiftCode'                       => 'Varchar(255)',
        'CUI'                             => 'Varchar(255)',
        'Reg_Com'                         => 'Varchar(255)',
        'Active'                          => 'Boolean(1)',
        'Footer'                          => 'Boolean(0)',
        'OldLink'                         => 'Varchar(255)',
        'URLSegment'                      => 'Varchar(255)',
        'CustomMetaTitle'                 => 'Varchar(255)',
        'CustomMetaDescription'           => 'Text',
        'CustomOutdatedText'              => 'Text',
        'Sort'                            => 'Int',
        'ShowInSitemap'                   => 'Boolean(1)',
    ];

    private static $indexes = [
        "URLSegment"     => true,
    ];

    private static $casting = [
        'Description'             => 'HTMLText',
    ];

    private static $has_many = [
        'Images'        => Image::class,
        'Files'         => File::class,
    ];

    private static $many_many = [
        'Articles'         => Article::class,
    ];

    private static $has_one = [];

//    private static $belongs_many_many = [
//        'Tags' => Tag::class.'.RelatedTags',
//        'RelatedArts' => Article::class . '.RelatedArticles',
//    ];

    private static $defaults = [
        'Title'                 => 'New Bank',
    ];

}
