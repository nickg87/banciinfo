<?php
 


class UserManagement extends dbt_l2 {
	
	function vld($vl, $er) {
	
	  if($vl[zone] == 'comenzi') {
		chk_empty($vl['c_nume'], 'Nume si prenume', $er);
		chk_empty($vl['c_telefon'], 'Telefon', $er);
		chk_empty($vl['c_localitate'], 'Localitate', $er);
		chk_empty($vl['c_id_judet'], 'Judet', $er);
		chk_empty($vl['c_adresa'], 'Adresa', $er);
		chk_cnp($vl['cnp'], 'CNP', $er);
	//	chk_date($vl['data_livrare'], 'Data livrare', $er);
	// 	chk_empty($vl['interval_orar'], 'Interval orar', $er);
		chk_empty($vl['id_mod_plata'], 'Modalitate de plata', $er);
		chk_empty($vl['de_acord'], 'Trebuie sa fiti de acord cu termenii si conditiile', $er);
	}
	
	  if($vl[zone] == 'users') {

		
		chk_empty($vl['password'], 'Password', $er);
		if($vl[password] != $vl[r_password])
			$er[] = 'Parola retiparita este gresita';
		chk_empty($vl['nume'], '<b>Nume</b>', $er);
		chk_empty($vl['adresa'], '<b>Adresa</b>', $er);
		chk_empty($vl['localitate'], 'Localitate</b>', $er);
		chk_empty($vl['judet'], '<b>Judet</b>', $er);
		chk_empty($vl['cod_postal'], '<b>Cod Postal</b>', $er);
		chk_empty($vl['telefon'], '<b>Telefon</b>', $er);
		chk_email($vl['email'], '<b>Email</b>', $er);
		chk_user($vl['email'], '<b>Email</b>', $er, 'erad_users');
		
		if($vl[tip_persoana] == 1) {
			chk_empty($vl['ci_serie'], 'Serie CI', $er);
			chk_number($vl['ci_nr'], 'Numar CI', $er);
			chk_cnp($vl['cnp'], '<b>CNP</b>', $er);
		} else {
			chk_empty($vl['cui'], 'CUI', $er);
			chk_empty($vl['registrul_comertului'], 'Registrul comertului', $er);
			chk_empty($vl['cod_iban'], 'cod IBAN', $er);
			chk_empty($vl['banca'], 'Banca', $er);
			chk_empty($vl['sucursala'], 'Sucursala', $er);
		}
 }


  if($vl[zone] == 'users_edit') {

		
		 
		chk_empty($vl['nume'], '<b>Nume</b>', $er);
		chk_empty($vl['adresa'], '<b>Adresa</b>', $er);
		chk_empty($vl['localitate'], 'Localitate</b>', $er);
		chk_empty($vl['judet'], '<b>Judet</b>', $er);
		chk_empty($vl['cod_postal'], '<b>Cod Postal</b>', $er);
		chk_empty($vl['telefon'], '<b>Telefon</b>', $er);
 		
		if($vl[tip_persoana] == 1) {
			chk_empty($vl['ci_serie'], 'Serie CI', $er);
			chk_number($vl['ci_nr'], 'Numar CI', $er);
			chk_cnp($vl['cnp'], '<b>CNP</b>', $er);
		} else {
			chk_empty($vl['cui'], 'CUI', $er);
			chk_empty($vl['registrul_comertului'], 'Registrul comertului', $er);
			chk_empty($vl['cod_iban'], 'cod IBAN', $er);
			chk_empty($vl['banca'], 'Banca', $er);
			chk_empty($vl['sucursala'], 'Sucursala', $er);
		}
 }


		if($vl[zone] == 'produse') {
			chk_empty($vl['produs'], 'Denumire produs', $er);
		}		
		
		if($vl[zone] == 'categorii') {
			chk_empty($vl['categorie'], 'Denumire categorie', $er);
		}	
		
		
	}
	
	function FormToDb($vl, $formid = 1) {
		$vldb = $vl;
		switch($formid) {
			case 1:
				break;
		}
		return $vldb;
	}
	
	function DbToForm($vldb, $formid = 1) {
		$vl = $vldb;
		switch($formid) {
			case 1:
				break;
		}
		return $vl;
	}

	
}


?>
