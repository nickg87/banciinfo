<?
include('settings/s_settings.php');



$produse=mysql_query_assoc("select * from erad_produse 
left join erad_categorii on erad_categorii.id_categorie=erad_produse.id_categorie
left join erad_brands on erad_brands.id_brand=erad_produse.id_brand
where erad_produse.activ=1
order by produs asc");
?>
 <? 
foreach($produse as $pp){
$cat=array();
$cat = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, $pp[id_categorie],0); 
$cc=array();
  foreach ($cat as $n) if ($n[id_categorie]<>0){  
		$cc[]=$n[link];
  } 
  
 $categorie= implode('/', $cc);

$pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$pp[id_produs]."' order by prim desc");	
  $prod_desc = replace_not_in_tags("\n", "<BR />", $pp[descriere]);
		$prod_desc = str_replace("\n", " ", $prod_desc);
		$prod_desc = str_replace("\r", "", $prod_desc);
 ?> <?=$pp[id_produs]?>|<?=$categorie?>|<?=$pp[denumire_brand]?>|<?=$pp[produs]?>| |<? if($pp[pret_oferta]>0) echo $pp[pret_oferta]; else echo $pp[pret];?>|RON| | |<?=get_link_produs($pp[id_produs], $pp[produs])?> | <? if(is_file(PICS_DIR_LARGE.$pic[0][pic])) {?><?=PICS_URL_MEDIU.$pic[0][pic]?><? }?>|<?=$prod_desc?>|
 <? }?><?
 
 
function html_to_text($string){

	$search = array (
		"'<script[^>]*?>.*?</script>'si",  // Strip out javascript
		"'<[\/\!]*?[^<>]*?>'si",  // Strip out html tags
		"'([\r\n])[\s]+'",  // Strip out white space
		"'&(quot|#34);'i",  // Replace html entities
		"'&(amp|#38);'i",
		"'&(lt|#60);'i",
		"'&(gt|#62);'i",
		"'&(nbsp|#160);'i",
		"'&(iexcl|#161);'i",
		"'&(cent|#162);'i",
		"'&(pound|#163);'i",
		"'&(copy|#169);'i",
		"'&(reg|#174);'i",
		"'&#8482;'i",
		"'&#149;'i",
		"'&#151;'i",
		"'&#(\d+);'e"
		);  // evaluate as php
	
	$replace = array (
		" ",
		" ",
		"\\1",
		"\"",
		"&",
		"<",
		">",
		" ",
		"&iexcl;",
		"&cent;",
		"&pound;",
		"&copy;",
		"&reg;",
		"<sup><small>TM</small></sup>",
		"&bull;",
		"-",
		"uchr(\\1)"
		);
	
	$text = preg_replace ($search, $replace, $string);
	return $text;
	
}

function replace_not_in_tags($find_str, $replace_str, $string) {
	
	$find = array($find_str);
	$replace = array($replace_str);	
	preg_match_all('#[^>]+(?=<)|[^>]+$#', $string, $matches, PREG_SET_ORDER);	
	foreach ($matches as $val) {	
		if (trim($val[0]) != "") {
			$string = str_replace($val[0], str_replace($find, $replace, $val[0]), $string);
		}
	}	
	return $string;
}


 
 
 ?>