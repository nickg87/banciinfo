<?php

namespace Custom\BanciInfo;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldExportButton;
use SilverStripe\Forms\GridField\GridFieldImportButton;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SS_JoinedGraphQL\DataObjects\Item;

class CategoryAdmin extends ModelAdmin{

    private static $menu_icon_class = 'font-icon-tree';

    private static $awesome_icon = "fa-cubes";

    private static $managed_models = [
        Category::class,
    ];

    private static $url_segment = 'category';

    private static $menu_title = 'Categories';


    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        $gridFieldName = $this->sanitiseClassName($this->modelClass);
        $gridField = $form->Fields()->fieldByName($gridFieldName);
        $gridField->setList($gridField->getList()->filter(['ParentID' => '0']));


        $gridField->getConfig()->getComponentByType(GridFieldPaginator::class)->setItemsPerPage(999999);
        $gridFieldConfig = $gridField->getConfig();
        $gridFieldConfig->removeComponentsByType(GridFieldImportButton::class);
        $gridFieldConfig->removeComponentsByType(GridFieldExportButton::class);
        $gridFieldConfig->addComponent(new GridFieldOrderableRows('Sort'),);

        $dataColumns = $gridField->getConfig()->getComponentByType(GridFieldDataColumns::class);

        $dataColumns->setDisplayFields([
            'ID' => 'ID',
            'Title' => 'Title',
            'Description' => 'Description',
        ]);

        return $form;
    }
}
