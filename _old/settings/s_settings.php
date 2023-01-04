<?
session_start();

error_reporting(E_ALL & ~E_NOTICE);
//if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

require('global_settings.php');



define('DEBUG', true);

require(SITE_DIR . 'admin/functii.php');
connectdb(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
//die('here s_settings');

#printr($_SESSION[cart]);


$hf=mysql_query_assoc("select * from erad_extern where id=0 ");

$_title_sufix = SITE_NAME;

#printr($_SESSION[cart]);

/*
#session_unregister('cart');
$_SESSION[cart] = array_empty($_SESSION[cart]) ? array('items' => array(), 'total' => 0) : $_SESSION[cart];
$_SESSION[cart][items] = array_empty($_SESSION[cart][items]) ? array() : $_SESSION[cart][items];
$_SESSION[cart][total] = $_SESSION[cart][total] > 0 ? $_SESSION[cart][total] : 0;
$_cart = new CartManagement($_SESSION[cart]);
strlen($_GET[add_to_cart]) ? $_cart->addToCart($_GET[add_to_cart], $_GET[cant]) : '';
isset($_POST[s_update_cart]) ? $_cart->cantUpdate($_POST[cant]) : '';
strlen($_GET[remove_from_cart]) ? $_cart->removeFromCart($_GET[remove_from_cart]) : '';
#printr($_SESSION[cart]);

*/

# LOGIN && LOGOUT
$Login = new LoginManagement;
$_err_login = 0;
if(isset($_POST[s_login])) {
	if($Login->login($_POST[username], $_POST[password])) {
		header('location: ' . $_SERVER[REQUEST_URI]);
		exit;
	} else {
		$_err_login = 1;
	}
}
if($_GET[logout]) {
	$Login->logout();
	header('location: ' . SITE_URL);
	exit;
}




$scr = $_SERVER['PHP_SELF'];




function get_link_produs($id, $produs) {
	return SITE_URL . url_shape(strtolower($produs), 200) . '-p' . $id . '.html';
}
function get_link_search($s_key, $page) {
	return SITE_URL . 'rezultate-dupa-?s_key=' . $s_key . '&page=' . $page;
}

function get_link_checkout() {
	return SITE_URL . 'checkout';
}


function get_link_cat($id, $cat, $page = 0) {
	return SITE_URL . url_shape(strtolower($cat), 200) . '-c' . $id . '-p' . $page . '.html';
}

function get_link_domeniu($dom, $page = 0) {
	return SITE_URL . url_shape(strtolower($dom), 200) . '-pg' . $page . '.html';
}

function get_link_judet($id, $judet, $page = 0) {
	return SITE_URL . 'lista-banci-judet-' . url_shape(strtolower($judet), 200) .'-jd'. $id . '-p' . $page . '.html';
}

function get_link_oras($id, $oras, $id_inst = 0,  $page = 0) {
	return SITE_URL . 'lista-banci-' . url_shape(strtolower($oras), 200) .'-o'. $id .'-i'.$id_inst. '-p' . $page . '.html';
}

function get_link_filiale($id, $inst, $jud=0,  $page = 0) {
	return SITE_URL . 'lista-filiale-' . url_shape(strtolower($inst), 200) .'-i'.$id. '-j'.$jud. '-p' . $page . '.html';
}

function get_link_filiale_oras($id_inst, $inst, $id_oras, $oras,  $page = 0) {
	return SITE_URL . 'lista-filiale-' .url_shape(strtolower($inst), 200).'-din-'.url_shape(strtolower($oras), 200).'-i'.$id_inst. '-o'.$id_oras. '-p' . $page . '.html';
}

function get_link_inst($id, $inst) {
	return SITE_URL . url_shape(strtolower($inst), 200) . '-i' . $id . '.html';
}

function get_link_filiala($id, $filiala) {
	return SITE_URL . url_shape(strtolower($filiala), 200) . '-f' . $id . '.html';
}

function get_link_swift($id_cod, $inst) {
	return SITE_URL .'cod-swift-'. url_shape(strtolower($inst), 250) .'-cs'.$id_cod. '.html';
}


function get_link_add_to_cart($id, $cant = 1) {
	return SITE_URL . add_to_cart . '/' . $id . '/' . $cant;
}

function get_link_tematica($id, $cat, $page = 0) {
	return SITE_URL .'articole-stiri-'. url_shape(strtolower($cat), 200) . '-t' . $id . '-p' . $page . '.html';
}

function get_link_brand($id, $cat, $page = 0) {
	return SITE_URL . url_shape(strtolower($cat), 200) . '-b' . $id . '-p' . $page . '.html';
}

function get_link_articol($ids, $s, $idc, $c, $i) {
	global $_url_data;
	return SITE_URL .url_shape($c, 150) . '/' . url_shape($s, 150). '-' . $idc . '-' . $ids . '.html';
}

function get_link_meniu($idc, $c, $i) {
	global $_url_data;
	return SITE_URL . url_shape($c, 150) . '-' . $idc. '-m'. $i . '.html';
}

function get_link_promotie($id, $produs) {
	return SITE_URL . url_shape(strtolower($produs), 200) . '-promo' . $id . '.html';
}

function pret_format($c) {
	return number_format($c, 2, ',', '.');
}


function getpic($pic, $type, $size) {
	return ($type == 1 ? SITE_URL : SITE_DIR) . ($size == 1 ? PICS_DIR_THUMB : PICS_DIR_LARGE) . $pic;
}






?>
