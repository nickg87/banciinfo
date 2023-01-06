<?php
/**
 * @author   : nick
 * @date     : 05 Ian 2023
 * @copyright: banci-info
 */


namespace Custom\BanciInfo;

use SilverStripe\Dev\BuildTask;
use SilverStripe\Dev\Debug;
use SilverStripe\ORM\DB;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\CMS\Model\SiteTree;
use Page;

/**
 * Class MigrateOldDataToNewWebVersion
 *
 * @package Custom\BanciInfo
 */
class MigrateOldDataToNewWebVersion extends BuildTask
{
	protected $title = 'Migrat OLD data to New SS Version!';

	protected $description = 'This will take old data(targeted by ID - with children) and move them to new web2 pages and content of old page in a new Content Basic block in new web2 page';

	protected $enabled = true;

	public static $addedArticles = 0;
	public static $addedCategories = 0;
	public static $addedBancks = 0;
	public static $addedCounties = 0;
	public static $addedCities = 0;
	public static $addedBranches = 0;


	private static $segment = 'migrate-old-data';

	function run($request)
	{
//        //categorii
//        $sqlQuery_categorii = new SQLSelect();
//        $sqlQuery_categorii->setFrom('erad_categorii');
//        $sqlQuery_categorii->setSelect("*");
//        $sqlQuery_categorii->addWhere("id_parinte = 0 ");
//        $resultsCategorii = $sqlQuery_categorii->execute();
//        if (!is_null($resultsCategorii)) {
//            foreach ($resultsCategorii as $result) {
//                $newCat = new Category();
//                $newCat->Title = $result['link'];
//                $newCat->CustomMetaTitle = $result['link'];
//                $newCat->Description = $result['categorie'];
//                $newCat->DescriptionMore = $result['link']. ' - '.$result['categorie'];
//                $newCat->CustomMetaDescription = $result['categorie'];
//                $newCat->URLSegment = strtolower(str_replace(' ', '-', $result['link']));
//                $newCat->ShowInSitemap = 1;
//                $newCat->ID = $result['id_categorie'];
//                $newCatId = $newCat->write();
//                if ($newCatId) {
//                    self::$addedCategories++;
//                    $sqlQuery_subCategorii = new SQLSelect();
//                    $sqlQuery_subCategorii->setFrom('erad_categorii');
//                    $sqlQuery_subCategorii->setSelect("*");
//                    $sqlQuery_subCategorii->addWhere("id_parinte = '".$result['id_categorie']."' ");
//                    $resultsSubCategorii = $sqlQuery_subCategorii->execute();
//                    $rawSQL_Categorii = $sqlQuery_subCategorii->sql();
//                    if (!is_null($resultsSubCategorii)) {
//                        foreach ($resultsSubCategorii as $result_sc) {
//                            $newSCat = new Category();
//                            $newSCat->Title = $result_sc['link'];
//                            $newSCat->CustomMetaTitle = $result_sc['link'];
//                            $newSCat->Description = $result_sc['categorie'];
//                            $newSCat->DescriptionMore = $result_sc['link']. ' - '.$result_sc['categorie'];
//                            $newSCat->CustomMetaDescription = $result_sc['categorie'];
//                            $newCat->ID = $result_sc['id_categorie'];
//                            $newSCat->URLSegment = strtolower(str_replace(' ', '-', $result_sc['link']));
//                            $newSCat->ShowInSitemap = 1;
//                            $newSCat->ParentID = $newCatId;
//                            $newSCatId = $newSCat->write();
//                            if ($newSCatId) {
//                                self::$addedCategories++;
//                            }
//                        }
//                    }
//                }
//
//            }
//        }
//
//        //articole
//        $sqlQuery_articole = new SQLSelect();
//        $sqlQuery_articole->setFrom('erad_produse');
//        $sqlQuery_articole->setSelect("*");
//        $resultsArticole = $sqlQuery_articole->execute();
//        if (!is_null($resultsArticole)) {
//            foreach ($resultsArticole as $result) {
//                $newArt = new Article();
//                $newArt->Title = $result['produs'];
//                $newArt->Created = $result['added_on'];
//                $newArt->ShortTitle = $result['produs_cod'];
//                $newArt->OldLink = strtolower(str_replace(' ', '-', $result['produs_cod'])).'-p'.$result['id_produs'].'.html';
//                $newArt->CustomMetaTitle = $result['produs'];
//                $newArt->Description = $result['descriere'];
//                $newArt->ShortDescription = $result['descriere_scurta'];
//                $newArt->CustomMetaDescription = $result['descriere_scurta'];
//                $newArt->NumberOfViews = $result['accesari'];
//                $newArt->URLSegment = strtolower(str_replace(' ', '-', $result['produs_cod']));
//                $newArt->ShowInSitemap = 1;
//                $newArt->Active = 1;
//                $newArt->Visibility = 1;
//                $newArt->ID = $result['id_produs'];
//                $newArtID = $newArt->write();
//                if ($newArtID) {
//                    self::$addedArticles++;
//                    $category = Category::get()->byId($result['id_categorie']);
//                    if ($category) {
//                        $category->Articles()->add($newArt);
//                    }
//                }
//            }
//        }

        //articole in banci
        $sqlQuery_ab = new SQLSelect();
        $sqlQuery_ab->setFrom('erad_produse_tematici');
        $sqlQuery_ab->setSelect("*");
        $resultsAB = $sqlQuery_ab->execute();
        if (!is_null($resultsAB)) {
            foreach ($resultsAB as $result) {
                $bank = Bank::get()->byId($result['id_tematica']);
                $articol = Article::get()->byId($result['id_produs']);
                if ($bank && $articol) {
                    $bank->Articles()->add($articol);
                }
            }
        }

//
//        //institutii bancare
//        $sqlQuery_banci = new SQLSelect();
//        $sqlQuery_banci->setFrom('erad_tematici');
//        $sqlQuery_banci->setSelect("*");
//        $resultsBanci = $sqlQuery_banci->execute();
//        if (!is_null($resultsBanci)) {
//            foreach ($resultsBanci as $result) {
//                $new = new Bank();
//                $new->Title = $result['denumire_institutie'];
//                $new->Description = $result['descriere_inst'];
//                $new->Address = $result['adresa'];
//                $new->Phone = $result['telefon'];
//                $new->Fax = $result['fax'];
//                $new->Email = $result['email'];
//                $new->Website = $result['www'];
//                $new->SwiftCode = $result['swift'];
//                $new->CUI = $result['cui'];
//                $new->Reg_Com = $result['reg_com'];
//                $new->Active = 1;
//                $new->Footer = $result['footer'];
//                $new->OldLink = strtolower(str_replace(' ', '-', $result['denumire_institutie'])).'-i'.$result['id_tematica'].'.html';
//                $new->CustomMetaTitle = $result['denumire_institutie'];
//                $new->CustomMetaDescription = $result['descriere_inst'];
//                $new->URLSegment = strtolower(str_replace(' ', '-', $result['denumire_institutie']));
//                $new->ShowInSitemap = 1;
//                $new->Active = 1;
//                $new->ID = $result['id_tematica'];
//                $newID = $new->write();
//                if ($newID) {
//                    self::$addedBancks++;
//                }
//            }
//        }
//
//        //judete
//        $sqlQuery_judete = new SQLSelect();
//        $sqlQuery_judete->setFrom('erad_judete');
//        $sqlQuery_judete->setSelect("*");
//        $resultsJudete = $sqlQuery_judete->execute();
//        if (!is_null($resultsJudete)) {
//            foreach ($resultsJudete as $result) {
//                $new = new County();
//                $new->Title = $result['judet'];
//                $new->Description = 'NA';
//                $new->ID = $result['id_judet'];
//                $newID = $new->write();
//                if ($newID) {
//                    self::$addedCounties++;
//                }
//
//            }
//        }

//        //orase 1
//        $sqlQuery_orase = new SQLSelect();
//        $sqlQuery_orase->setFrom('erad_orase');
//        $sqlQuery_orase->setSelect("*");
//        $sqlQuery_orase->addWhere("id_oras < 4000 ");
//        $sqlQuery_orase->addOrderBy("id_oras", "ASC");
//        $resultsOrase = $sqlQuery_orase->execute();
//        if (!is_null($resultsOrase)) {
//            foreach ($resultsOrase as $result) {
//                $new = new City();
//                $new->Title = $result['oras'];
//                $new->Description = 'NA';
//                $new->Main = $result['principal'];
//                $new->ID = $result['id_oras'];
//                $new->CountyID = $result['id_parinte'];
//                $newID = $new->write();
//                if ($newID) {
//                    self::$addedCities++;
//                }
//
//            }
//        }
//
//        //orase 2
//        $sqlQuery_orase = new SQLSelect();
//        $sqlQuery_orase->setFrom('erad_orase');
//        $sqlQuery_orase->setSelect("*");
//        $sqlQuery_orase->addWhere("id_oras > 3999 and  id_oras < 8000");
//        $sqlQuery_orase->addOrderBy("id_oras", "ASC");
//        $resultsOrase = $sqlQuery_orase->execute();
//        if (!is_null($resultsOrase)) {
//            foreach ($resultsOrase as $result) {
//                $new = new City();
//                $new->Title = $result['oras'];
//                $new->Description = 'NA';
//                $new->Main = $result['principal'];
//                $new->ID = $result['id_oras'];
//                $new->CountyID = $result['id_parinte'];
//                $newID = $new->write();
//                if ($newID) {
//                    self::$addedCities++;
//                }
//
//            }
//        }
//
//        //orase 3
//        $sqlQuery_orase = new SQLSelect();
//        $sqlQuery_orase->setFrom('erad_orase');
//        $sqlQuery_orase->setSelect("*");
//        $sqlQuery_orase->addWhere("id_oras > 7999 and  id_oras < 12000 ");
//        $sqlQuery_orase->addOrderBy("id_oras", "ASC");
//        $resultsOrase = $sqlQuery_orase->execute();
//        if (!is_null($resultsOrase)) {
//            foreach ($resultsOrase as $result) {
//                $new = new City();
//                $new->Title = $result['oras'];
//                $new->Description = 'NA';
//                $new->Main = $result['principal'];
//                $new->ID = $result['id_oras'];
//                $new->CountyID = $result['id_parinte'];
//                $newID = $new->write();
//                if ($newID) {
//                    self::$addedCities++;
//                }
//
//            }
//        }
//
//        //orase 4
//        $sqlQuery_orase = new SQLSelect();
//        $sqlQuery_orase->setFrom('erad_orase');
//        $sqlQuery_orase->setSelect("*");
//        $sqlQuery_orase->addWhere("id_oras > 11999 ");
//        $sqlQuery_orase->addOrderBy("id_oras", "ASC");
//        $resultsOrase = $sqlQuery_orase->execute();
//        if (!is_null($resultsOrase)) {
//            foreach ($resultsOrase as $result) {
//                $new = new City();
//                $new->Title = $result['oras'];
//                $new->Description = 'NA';
//                $new->Main = $result['principal'];
//                $new->ID = $result['id_oras'];
//                $new->CountyID = $result['id_parinte'];
//                $newID = $new->write();
//                if ($newID) {
//                    self::$addedCities++;
//                }
//
//            }
//        }

//        //filiale
//        $sqlQuery_judete = new SQLSelect();
//        $sqlQuery_judete->setFrom('erad_filiale');
//        $sqlQuery_judete->setSelect("*");
//        $resultsJudete = $sqlQuery_judete->execute();
//        if (!is_null($resultsJudete)) {
//            foreach ($resultsJudete as $result) {
//                $new = new Branch();
//                $new->Title = $result['denumire_filiala'];
//                $new->Description = $result['descriere_filiala'];
//                $new->Address = $result['adresa'];
//                $new->Phone = $result['telefon'];
//                $new->Fax = $result['fax'];
//                $new->Email = $result['email'];
//                $oldLink = preg_replace('/[^\da-z]/i', ' ', $result['denumire_filiala']).'-f'.$result['id_filiala'].'.html';
//                $oldLink = preg_replace('/ +/', '-', $oldLink);
//                $oldLink = strtolower(preg_replace('/-+/', '-', $oldLink));
//                $new->OldLink = $oldLink;
//                $new->CountyID = $result['id_judet'];
//                $new->CityID = $result['id_judet'];
//                $new->BankID = $result['id_judet'];
//                $new->ID = $result['id_filiala'];
//                $newID = $new->write();
//                if ($newID) {
//                    self::$addedBranches++;
//                }
//            }
//        }

		DB::alteration_message("Task finished. 
                <br> ".self::$addedCategories." new Categories added 
                <br>  ".self::$addedArticles." new Articles added 
                <br>  ".self::$addedBancks." new Banks Added 
                <br>  ".self::$addedCounties." new Counties Added 
                <br>  ".self::$addedCities." new Cities Added 
                <br>  ".self::$addedBranches." new Branches for Banks Added 
                ", "changed");
	}

}
