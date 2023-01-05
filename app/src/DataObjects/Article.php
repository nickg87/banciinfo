<?php
/**
 * @author   : nick
 * @date     : 05 Ian 2023
 * @copyright: banci-info
 */

namespace Custom\BanciInfo;
use SilverStripe\AssetAdmin\Forms\UploadField;

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

class Article extends DataObject{

    private static $table_name = "Banci_Info_Article";

    private static $singular_name = 'Article';

    private static $db = [
        'Active'                          => 'Boolean',
        'Visibility'                      => 'Boolean(1)',
        'Title'                           => 'Varchar(255)',
        'OldLink'                         => 'Varchar(255)',
        'Description'                     => 'HTMLText',
        'ShortDescription'                => 'Text',
        'BulletPoints'                    => 'HTMLText',
        'URLSegment'                      => 'Varchar(255)',
        'CustomMetaTitle'                 => 'Varchar(255)',
        'CustomMetaDescription'           => 'Text',
        'CustomOutdatedText'              => 'Text',
        'OrderRank'                       => 'Int',
    ];

    private static $indexes = [
        "URLSegment"     => true,
    ];

    private static $casting = [
        'Description'             => 'HTMLText',
        'ShortDescription'             => 'HTMLText',
    ];

    private static $has_many = [
//        'Images'        => ArticleImage::class,
//        'ContentImages' => ArticleContentImage::class,
//        'Features'      => ProductFeature::class,
//        'Files'         => ArticleFile::class,
    ];

    private static $many_many = [
        'SimilarArticles'          => Article::class,
        ];

    private static $has_one = [];

    private static $belongs_many_many = [
        'Categories' => Category::class . '.Articles',
        'Tags' => Tag::class,
        'SimilarArts' => Article::class . '.SimilarArticles',
    ];

    private static $defaults = [
        'Title'                 => 'New Article',
    ];

    public static function canEditArticle($member) {
        return Permission::check('CMS_ACCESS\Custom\ArticleAdmin', 'any', $member);
    }
}
