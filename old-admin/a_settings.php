<?
session_start();
#error_reporting(E_ALL & ~E_NOTICE);

$t_start = microtime();


require('../settings/global_settings.php');

//admin define area

//


$scr = $_SERVER['PHP_SELF'];
$default_section='0_0';



 

$MENU_TRANSL = array(
'Info' => 'Info',
'Content' => 'Pagini',
'Categorii' => 'Categorii',
'Comenzi' => 'Comenzi',
'Autori' => 'Autori',
'Articole' => 'Articole',
'Institutii' => 'Institutii',
'Filiale' => 'Filiale',
'Cautari' => 'Cautari',
 
'Links' => 'Links',
'Users' => 'Utilizatori',
 
'Newsletter' => 'Newsletter',
'Banners' => 'Bannere',
'Comentarii' => 'Comentarii Articole',
'Autori' => 'Autori',
 

);

$MENU2=array(

'Info' => array(
		array(
			'titlu' => 'Sumar activitate',
			'file' => 'content/default.php',
			'display' => 1,
			'key' => 'list',
			),
		),
 
'Articole' => array(
//1 -0
		array(
			'titlu' => 'Afiseaza articole',
			'file' => 'content/produse_list.php',
			'display' => 1,
			'key' => 'list',
			),
//1 -1
		array(
			'titlu' => 'Adauga articol',
			'file' => 'content/produse_add.php',
			'display' => 1,
			'key' => 'add',
			),
//1 -2
		array(
			'titlu' => 'Editeaza articol',
			'file' => 'content/produse_mod.php',
			'display' => 0,
			'key' => 'mod',
			),
//1 -3		
		array(
			'titlu' => 'Galerie foto',
			'file' => 'content/galerie_foto.php',
			'display' => 0,
			'key' => 'list',
			), 
//1 -4
		array(
			'titlu' => 'Fisiere',
			'file' => 'content/fisiere.php',
			'display' => 0,
			'key' => 'list',
			),
//1 -5
		array(
			'titlu' => 'Duplica produsul',
			'file' => 'content/produse_duplica.php',
			'display' => 0,
			'key' => 'add',
			),  
//1 -6
		array(
			'titlu' => 'Combinatii & atribute',
			'file' => 'content/produse_combinari.php',
			'display' => 0,
			'key' => 'add',
			), 
//1 -7 
		array(
			'titlu' => 'Cautari in site',
			'file' => 'content/cautari_list.php',
			'display' => 1,
			'key' => 'list',
			),
		array(
			'titlu' => 'Editeaza cautare',
			'file' => 'content/cautari_mod.php',
			'display' => 0,
			'key' => 'mod',
			), 
		),
		
'Banner Homepage' => array(
	//2 -0	 	
		array(
			'titlu' => 'Afiseaza banere',
			'file' => 'content/promo_list.php',
			'display' => 1,
			'key' => 'list',
			), 
		array(
			'titlu' => 'Creeaza banner',
			'file' => 'content/promo_add.php',
			'display' => 1,
			'key' => 'add',
			), 
		array(
			'titlu' => 'Editeaza banner',
			'file' => 'content/promo_mod.php',
			'display' => 0,
			'key' => 'list',
			), 
	),	
		
'Categorii' => array(
//3 -0
		array(
			'titlu' => 'Afiseaza categorii',
			'file' => 'content/cat_list.php',
			'display' => 1,
			'key' => 'list',
			),
//3 -1		 
		array(
			'titlu' => 'Adauga categorie',
			'file' => 'content/cat_add.php',
			'display' => 1,
			'key' => 'add',
			),
//3 -2
		array(
			'titlu' => 'Editeaza categorie',
			'file' => 'content/cat_mod.php',
			'display' => 0,
			'key' => 'mod',
			),
 
		),		
 
 				
'Content' => array(
//6 -0
		array(
			'titlu' => 'Definire meniu',
			'file' => 'content/meniu_set.php',
			'display' => 1,
			'key' => 'list',
			),
		array(
			'titlu' => 'Adauga item meniu',
			'file' => 'content/meniu_add.php',
			'display' => 1,
			'key' => 'add',
			), 
		array(
			'titlu' => 'Editeaza item meniu',
			'file' => 'content/meniu_mod.php',
			'display' => 0,
			'key' => 'mod',
			), 
		array(
			'titlu' => 'Listeaza pagini',
			'file' => 'content/pagini_list.php',
			'display' => 1,
			'key' => 'list',
			),
		
			array(
			'titlu' => 'Adauga pagina',
			'file' => 'content/pagini_add.php',
			'display' => 1,
			'key' => 'add',
			),
		array(
			'titlu' => 'Editeaza pagina',
			'file' => 'content/pagini_mod.php',
			'display' => 0,
			'key' => 'mod',
			),
		array(
			'titlu' => 'Galerie foto',
			'file' => 'content/galerie_foto_pagini.php',
			'display' => 0,
			'key' => 'list',
			), 
		array(
			'titlu' => 'Fisiere',
			'file' => 'content/fisiere_pagini.php',
			'display' => 0,
			'key' => 'list',
			),   
		),	

'Newsletter' => array(
//7 -0
		array(
			'titlu' => 'Lista Useri',
			'file' => 'content/newsletter_users.php',
			'display' => 1,
			'key' => 'list',
			),
		 
		array(
			'titlu' => 'Trimite newsletter',
			'file' => 'content/newsletter_send.php',
			'display' => 0,
			'key' => 'mod',
			),
		array(
			'titlu' => 'Exporta lista',
			'file' => 'content/newsletter_users_out.php',
			'display' => 1,
			'key' => 'list',
			),
		 
		),	
'Institutii' => array(
//8 -0
		array(
			'titlu' => 'Afiseaza institutii',
			'file' => 'content/tematici_list.php',
			'display' => 1,
			'key' => 'list',
			),
		 
		array(
			'titlu' => 'Adauga institutie',
			'file' => 'content/tematici_add.php',
			'display' => 1,
			'key' => 'add',
			),
		array(
			'titlu' => 'Editeaza institutie',
			'file' => 'content/tematici_mod.php',
			'display' => 0,
			'key' => 'mod',
			),
		),	


'Filiale' => array(
//8 -0
		array(
			'titlu' => 'Afiseaza filiale',
			'file' => 'content/filiale_list.php',
			'display' => 1,
			'key' => 'list',
			),
		 
		array(
			'titlu' => 'Adauga filiala',
			'file' => 'content/filiale_add.php',
			'display' => 1,
			'key' => 'add',
			),
		array(
			'titlu' => 'Editeaza filiala',
			'file' => 'content/filiale_mod.php',
			'display' => 0,
			'key' => 'mod',
			),
		),	


/*'Autori' => array(
//9 -0
		array(
			'titlu' => 'Afiseaza autori',
			'file' => 'content/brands_list.php',
			'display' => 1,
			'key' => 'list',
			),
//9 -1 
		array(
			'titlu' => 'Adauga autor',
			'file' => 'content/brands_add.php',
			'display' => 1,
			'key' => 'add',
			),
		
		),	
		*/
'Banners' => array(
//10 -0
		array(
			'titlu' => 'Afiseaza bannere',
			'file' => 'content/banners_list.php',
			'display' => 1,
			'key' => 'list',
			),
//10 -1		 
		array(
			'titlu' => 'Adauga banner',
			'file' => 'content/banners_add.php',
			'display' => 1,
			'key' => 'add',
			),
//10 -2
		array(
			'titlu' => 'Editeaza banner',
			'file' => 'content/banners_mod.php',
			'display' => 0,
			'key' => 'mod',
			),
		),	
		
	
'Link-uri' => array(
//10 -0
		array(
			'titlu' => 'Afiseaza link-uri',
			'file' => 'content/links_list.php',
			'display' => 1,
			'key' => 'list',
			),
//10 -1		 
		array(
			'titlu' => 'Adauga link',
			'file' => 'content/links_add.php',
			'display' => 1,
			'key' => 'add',
			),
//10 -2
		array(
			'titlu' => 'Editeaza link',
			'file' => 'content/links_mod.php',
			'display' => 0,
			'key' => 'mod',
			),
		),	
		
	
'Orase' => array(
//10 -0
		array(
			'titlu' => 'Afiseaza orase',
			'file' => 'content/orase_list.php',
			'display' => 1,
			'key' => 'list',
			),
//10 -1		 
		array(
			'titlu' => 'Editeaza oras',
			'file' => 'content/orase_mod.php',
			'display' => 0,
			'key' => 'mod',
			),
		),	
		
	


'Setari site' => array(
 		
 	
//13 -0	
		array(
			'titlu' => 'Headers & footers',
			'file' => 'content/headers_footers.php',
			'display' => 1,
			'key' => 'mod',
			),					

//13 -1
		array(
			'titlu' => 'Home page',
			'file' => 'content/home_page.php',
			'display' =>0,
			'key' => 'mod',
			),			 
						),			
);

 
/*

$submenus = array(
 
		
 

'Newsletter' => array(
		'Lista Useri'    => 'content/newsletter_users.php',
		'Trimite newsletter'    => 'content/newsletter_send.php',
		 'Trimite newsletter '    => 'content/newsletter_send.php',
		),


);






 
if(trim($_GET['cm']) && in_array(trim($_GET['cm']), $menu)) {
	$_SESSION['cm'] = trim($_GET['cm']);
	$a = array_flip($menu);
	$_SESSION['cm_title'] = $a[$_SESSION['cm']];
	if(is_array($submenus[$_SESSION['cm_title']])) {
		$a = array_keys($submenus[$_SESSION['cm_title']]);
		$_SESSION['csm'] = $submenus[$_SESSION['cm_title']][$a[0]];
		$a = array_flip($submenus[$_SESSION['cm_title']]);
		$_SESSION['csm_title'] = $a[$_SESSION['csm']];
	} else {
		$_SESSION['csm'] = '';
		$_SESSION['csm_title'] = '';
	}
	header('location: '.$scr);
	exit;
}

if(trim($_GET['csm'])) {
	$_SESSION['csm'] = trim($_GET['csm']);
	$a = array_flip($submenus[$_SESSION['cm_title']]);
	$_SESSION['csm_title'] = $a[$_SESSION['csm']];
	
	//extra $_GET vars
	$g = array();
	$g = explode('&', $_SERVER['REQUEST_URI']);
	$gets = '';
	if(count($g) > 1) {
		unset($g[0]);
		$gets = implode('&', $g);
		$gets = '?' . $gets;
	}
	
	header('location: '.$scr.$gets);
	exit;
}

//default page
if(strlen($_SESSION['cm']) == 0) {
	$_SESSION['cm'] = 'content/default.php';
	$a = array_flip($menu);
	$_SESSION['cm_title'] = $a[$_SESSION['cm']];
}
 */

include('functii.php');
include('class.email.php');
 
connectdb(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
?>