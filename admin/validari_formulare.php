<?


if ($form_name=="categorie_add" or $form_name=="categorie_mod") {
	$vld_fileds[]="categorie"; $vld_ms['categorie']="Denumire categorie";
	$vld_fileds[]="link";$vld_ms["link"]="Link";
}

 
if ($form_name=="tematici_add" or $form_name=="tematici_mod") {
	$vld_fileds[]="denumire_tematica"; $vld_ms['denumire_tematica']="Denumire tematica";
}


if ($form_name=="autori_add" or $form_name=="autori_mod") {
	$vld_fileds[]="nume_autor";$vld_ms['nume_autor']="Nume autor";
}

if ($form_name=="produse_add" or $form_name=="produse_mod") {
	$vld_fileds[]="produs";			$vld_ms['produs']="Denumire produs";
	$vld_fileds[]="pret";	$vld_ms['pret']="Pret";
	$vld_fileds[]="produs_cod";	$vld_ms['produs_cod']="Cod produs"; 
}

if ($form_name=="promo_add" ) {
	$vld_fileds[]="nume_promotie";$vld_ms['nume_promotie']="Denumire promotie";
	$vld_fileds[]="pic";$vld_ms['pic']="Fisier banner";
	 
}
if ($form_name=="promo_mod" ) {
	$vld_fileds[]="nume_promotie";$vld_ms['nume_promotie']="Denumire promotie";
 
	 
}

if ($form_name=="links" ) {
	$vld_fileds[]="denumire";$vld_ms['denumire']="Denumire link";
 	$vld_fileds[]="link";$vld_ms['link']="Link";
	 
}


if ($form_name=="news" ) {
	$vld_fileds[]="titlu_stire";$vld_ms['titlu_stire']="Titlu articol";
	 
 	 
}

if ($form_name=="meniu" or  $form_name=="meniu_mod") {
	$vld_fileds[]="link_meniu";$vld_ms['link_meniu']="Denumire link meniu";
 	  
}
 
?>