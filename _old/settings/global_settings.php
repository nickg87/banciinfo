<?

#echo getcwd();

define('SITE_URL', 'http://banci-old.loc/');
define('SITE_DIR', '/Users/nicuguliman/local/banciinfo/_old/');


define('MYSQL_A', 'localhost');
define('MYSQL_U', 'root');
define('MYSQL_P', 'Prometeu1234#');
define('MYSQL_DB', 'banci_info');





define('DISPLAY_DB_ERRORS', 1);
define('LOG_DB_ERRORS', 1);



error_reporting(1);
ini_set('display_errors', 1);


define('CLASSES_DIR', SITE_DIR . 'lib/classes/');
define('PROFORME_DIR', SITE_DIR . 'proforme/');
define('TPL_PROFORMA', PROFORME_DIR . '_tpl_proforma.php');
define('TPL_COMANDA', PROFORME_DIR . '_tpl_comanda.php');
define('TPL_COMANDA_CONT', PROFORME_DIR . '_tpl_comanda_cont.php');


define('PROFORMA_INC', 1356);



//PICS
define('PICS_SIZE1', 300);
define('PICS_SIZE2', 800);
define('PICS_SIZE3', 130);
define('PICS_SIZE4', 80);

define('PICS_SIZE_ART1', 180);
define('PICS_SIZE_ART2', 650);
define('PICS_SIZE_ART3', 133);




define('BANNER_PROMO', 510);
define('BANNER_PROMO_H', 300);


define('PICS_PROMO', 450);
define('PICS_DIR', SITE_DIR . 'pics/');

define('BANNERS_DIR', SITE_DIR.'banner/' );
define('BANNERS_URL', SITE_URL.'banner/' );



define('PICS_DIR_PROMO', SITE_DIR . 'pics/promo/');
define('PICS_URL_PROMO', SITE_URL . 'pics/promo/');

define('PICS_DIR_SMALL', SITE_DIR . 'pics/small/');
define('PICS_URL_SMALL', SITE_URL . 'pics/small/');

define('PICS_DIR_THUMB', SITE_DIR . 'pics/thumb/');
define('PICS_URL_THUMB', SITE_URL . 'pics/thumb/');

define('PICS_DIR_MEDIU', SITE_DIR . 'pics/mediu/');
define('PICS_URL_MEDIU', SITE_URL . 'pics/mediu/');


define('PICS_DIR_LARGE', SITE_DIR . 'pics/large/');
define('PICS_URL_LARGE', SITE_URL . 'pics/large/');


define('FILE_DIR', SITE_DIR . 'fisiere/');
define('FILE_URL', SITE_URL . 'fisiere/');


$meniu_set=array();

$meniu_set[1]="Meniu principal";
$meniu_set[2]="Link in footer";
//$meniu_set[3]="Link in header";



$pozitii_banner=array();

$pozitii_banner[1]="Left";
$pozitii_banner[2]="Top";
$pozitii_banner[3]="Right";

$open_link=array();

$open_link[1]="Self";
$open_link[2]="Blank";



# --- arrays
$DBF = array(
	'erad_users' => array(
		'tbl' => 'erad_users',
		'pri' => 'id_user',
	),
	'erad_cart' => array(
		'tbl' => 'erad_cart',
		'pri' => 'id_cart',
	),

'erad_produse' => array(
		'tbl' => 'erad_produse',
		'pri' => 'id_produs',
	),

	'erad_comenzi' => array(
		'tbl' => 'erad_comenzi',
		'pri' => 'id_comanda',
	),
	'erad_promotii' => array(
		'tbl' => 'erad_promotii',
		'pri' => 'id_promotie',
	),
	'erad_categorii' => array(
		'tbl' => 'erad_categorii',
		'pri' => 'id_categorie',
	),
	'erad_tematici' => array(
		'tbl' => 'erad_tematici',
		'pri' => 'id_tematica',
	),
	'erad_autori' => array(
		'tbl' => 'erad_autori',
		'pri' => 'id_autor',
	),

	'erad_meniu_set' => array(
		'tbl' => 'erad_meniu_set',
		'pri' => 'id_meniu',
	),

	'erad_pagini' => array(
		'tbl' => 'erad_pagini',
		'pri' => 'id_page',
	),
	'erad_brands' => array(
		'tbl' => 'erad_brands',
		'pri' => 'id_brand',
	),

	'erad_bannere' => array(
		'tbl' => 'erad_bannere',
		'pri' => 'id_campanie',
	),

	'erad_certificari' => array(
		'tbl' => 'erad_certificari',
		'pri' => 'id_certificare',
	),

	'erad_campuri' => array(
		'tbl' => 'erad_campuri',
		'pri' => 'id_camp',
	),
	'erad_campuri_valori' => array(
		'tbl' => 'erad_campuri_valori',
		'pri' => 'id_valoare',
	),
	'erad_um' => array(
		'tbl' => 'erad_um',
		'pri' => 'id_um',
	),
	'erad_date_firma' => array(
		'tbl' => 'erad_date_firma',
		'pri' => 'id_firma',
	),

	'erad_curier' => array(
		'tbl' => 'erad_curier',
		'pri' => 'id_curier',
	),
	'erad_filiale' => array(
		'tbl' => 'erad_filiale',
		'pri' => 'id_filiala',
	),
	'erad_keywords' => array(
		'tbl' => 'erad_keywords',
		'pri' => 'id_keyword',
	),
	'erad_links' => array(
		'tbl' => 'erad_links',
		'pri' => 'id_link',
	),
	'erad_judete' => array(
		'tbl' => 'erad_judete',
		'pri' => 'id_judet',
	),

	'erad_orase' => array(
		'tbl' => 'erad_orase',
		'pri' => 'id_oras',
	),

);



 require('generalitati.php');


require(CLASSES_DIR . 'class.dbt.php');
require(CLASSES_DIR . 'class.dbt_l2.php');

require(CLASSES_DIR . 'class.cart.php');
require(CLASSES_DIR . 'class.users.php');
require(CLASSES_DIR . 'class.login.php');
require(CLASSES_DIR . 'class.comenzi.php');

require(CLASSES_DIR . 'LiveUpdate.class.php');





?>
