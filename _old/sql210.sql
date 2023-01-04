CREATE TABLE `erad_brands` (
`id_brand` int( 11 ) NOT NULL AUTO_INCREMENT ,
`denumire_brand` varchar( 250 ) NOT NULL default '',
`logo_brand` varchar( 150 ) NOT NULL default '',
`descriere_brand` text NOT NULL ,
`ord` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id_brand` )
) ENGINE = MYISAM DEFAULT CHARSET = latin1;

 




CREATE TABLE `erad_tematici` (
`id_tematica` int( 11 ) NOT NULL AUTO_INCREMENT ,
`denumire_tematica` varchar( 250 ) NOT NULL default '',
`description` varchar( 250 ) NOT NULL default '',
`keywords` varchar( 250 ) NOT NULL default '',
`id_parinte` int( 11 ) NOT NULL default '0',
`lvl` int( 2 ) NOT NULL default '0',
`ord` int( 11 ) NOT NULL default '0',
KEY `id_tematica` ( `id_tematica` )
) ENGINE = MYISAM DEFAULT CHARSET = latin1;

 



DROP TABLE IF EXISTS `erad_bannere`;
 CREATE  TABLE  `erad_bannere` (  `id_campanie` int( 11  )  NOT  NULL  auto_increment ,
 `denumire_firma` varchar( 250  )  NOT  NULL default  '0',
 `tip_campanie` tinyint( 1  )  NOT  NULL default  '0',
 `denumire_campanie` varchar( 200  )  NOT  NULL default  '',
 `buget` decimal( 10, 2  )  NOT  NULL default  '0.00',
 `cpm_negociat` decimal( 10, 2  )  NOT  NULL default  '0.00',
 `tip_banner` tinyint( 4  )  NOT  NULL default  '0',
 `tip_fisier` tinyint( 1  )  NOT  NULL default  '0',
 `banner` varchar( 150  )  NOT  NULL default  '',
 `custom_height` int( 5  )  NOT  NULL default  '0',
 `custom_width` int( 5  )  NOT  NULL default  '0',
 `link` varchar( 250  )  NOT  NULL default  '',
 `data_start` date NOT  NULL default  '0000-00-00',
 `data_stop` date NOT  NULL default  '0000-00-00',
 `buget_maxim` decimal( 10, 2  )  NOT  NULL default  '0.00',
 `activ` tinyint( 1  )  NOT  NULL default  '0',
 `mentiuni` text NOT  NULL ,
 PRIMARY  KEY (  `id_campanie`  ) ,
 KEY  `id_firma` (  `denumire_firma`  )  ) ENGINE  =  MyISAM DEFAULT CHARSET  = latin1;

 



 CREATE  TABLE  `erad_campuri_categorii` (  `id` int( 11  )  NOT  NULL  auto_increment ,
 `id_categorie` int( 11  )  NOT  NULL default  '0',
 `id_camp` int( 11  )  NOT  NULL default  '0',
 PRIMARY  KEY (  `id`  ) ,
 KEY  `id_categorie` (  `id_categorie` ,  `id_camp`  )  ) ENGINE  =  MyISAM DEFAULT CHARSET  = latin1;

 


 CREATE  TABLE  `erad_curier` (  `id_curier` int( 11  )  NOT  NULL  auto_increment ,
 `curier_nume` varchar( 250  )  NOT  NULL default  '',
 `durata_expeditie` varchar( 250  )  NOT  NULL default  '',
 `descriere_curier` text NOT  NULL ,
 PRIMARY  KEY (  `id_curier`  )  ) ENGINE  =  MyISAM DEFAULT CHARSET  = latin1;

 




 CREATE  TABLE  `erad_date_firma` (  `id_firma` int( 1  )  NOT  NULL  auto_increment ,
 `firma_denumire` varchar( 250  )  NOT  NULL default  '',
 `firma_cui` varchar( 250  )  NOT  NULL default  '',
 `firma_ro` varchar( 250  )  NOT  NULL default  '',
 `firma_sediu` varchar( 250  )  NOT  NULL default  '',
 `firma_cont` varchar( 250  )  NOT  NULL default  '',
 `firma_banca` varchar( 250  )  NOT  NULL default  '',
 PRIMARY  KEY (  `id_firma`  )  ) ENGINE  =  MyISAM DEFAULT CHARSET  = latin1;

 


 CREATE  TABLE  `erad_judete_curier` (  `id` int( 11  )  NOT  NULL  auto_increment ,
 `id_judet` int( 11  )  NOT  NULL default  '0',
 `id_curier` int( 11  )  NOT  NULL default  '0',
 `taxa_standard` decimal( 10, 2  )  NOT  NULL default  '0.00',
 `taxa_per_kg` decimal( 10, 2  )  NOT  NULL default  '0.00',
 `taxa_express` decimal( 10, 2  )  NOT  NULL default  '0.00',
 `taxa_express_per_kg` decimal( 10, 2  )  NOT  NULL default  '0.00',
 PRIMARY  KEY (  `id`  ) ,
 KEY  `id_curier` (  `id_curier`  ) ,
 KEY  `id_judet` (  `id_judet`  )  ) ENGINE  =  MyISAM DEFAULT CHARSET  = latin1;

 

ALTER TABLE `erad_produse` ADD `id_brand` INT( 11 ) NOT NULL AFTER `id_categorie` ;

ALTER TABLE `erad_produse` ADD INDEX ( `id_brand` ) ;

ALTER TABLE `erad_produse` ADD `ord_oferta` INT( 11 ) NOT NULL AFTER `ord` ;

ALTER TABLE `erad_produse` ADD `greutate` DECIMAL( 10, 2 ) NOT NULL ;




 CREATE  TABLE  `erad_produse_tematici` (  `id_pt` int( 11  )  NOT  NULL  auto_increment ,
 `id_produs` int( 11  )  NOT  NULL default  '0',
 `id_tematica` int( 11  )  NOT  NULL default  '0',
 PRIMARY  KEY (  `id_pt`  ) ,
 KEY  `id_produs` (  `id_produs`  ) ,
 KEY  `id_tematica` (  `id_tematica`  )  ) ENGINE  =  MyISAM DEFAULT CHARSET  = latin1;

 


ALTER TABLE `erad_promotii` ADD `id_categorie` INT( 11 ) NOT NULL AFTER `id_promotie` ;

ALTER TABLE `erad_promotii` ADD INDEX ( `id_categorie` ) ;





ALTER TABLE `erad_users` ADD `nume_user` VARCHAR( 150 ) NOT NULL AFTER `denumire` ;
ALTER TABLE `erad_users` ADD `client` TINYINT( 1 ) NOT NULL AFTER `denumire` ;
ALTER TABLE `erad_users` CHANGE `reg_comert_cnp` `reg_comert` VARCHAR( 250 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `erad_users` ADD `cnp` VARCHAR( 30 ) NOT NULL AFTER `reg_comert` ;
ALTER TABLE `erad_users` CHANGE `cif_ci` `cui` VARCHAR( 250 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL; 
ALTER TABLE `erad_users` ADD `ci` VARCHAR( 10 ) NOT NULL AFTER `cui` ;
ALTER TABLE `erad_users` CHANGE `adresa_sediu` `adresa_facturare` VARCHAR( 250 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL; 
ALTER TABLE `erad_users` ADD `adr_fact` TINYINT( 1 ) NOT NULL AFTER `adresa_facturare` ;

ALTER TABLE `erad_users` CHANGE `judet` `id_judet` INT( 11 ) NOT NULL ;
ALTER TABLE `erad_users` ADD INDEX ( `id_judet` ) ;
ALTER TABLE `erad_users` ADD `cod_postal` VARCHAR( 10 ) NOT NULL AFTER `localitate` ;
ALTER TABLE `erad_users` CHANGE `adresa_postala` `adresa_livrare` VARCHAR( 250 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;











