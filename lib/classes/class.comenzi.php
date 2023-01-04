<?php
 


class ComenziManagement extends dbt_l2 {
 
	function vld($vl, $er) {
	
		
 }
	function insert($vldb) {
		#global $_cart;
		
		if(array_empty($_SESSION[cart][items]) || $_SESSION[cart][total] <= 0) {
			return false;
		} else {
			$vldb[id_status] = 1;
				$vldb[total_cart] = $_SESSION[cart][total];
			$vldb[pret_livrare] = get_pret_livrare($vldb[c_id_judet], $vldb[data_livrare]);
			$vldb[data_comanda] = date('Y-m-d H:i:s');
			$vldb[total_comanda] = $vldb[total_cart] + $vldb[pret_livrare];
			$vldb[id_status_plata] = 1;
			$vldb[id_user] = $_SESSION[user][id_user];
			
			
			if(parent::insert($vldb)) {
				$id_comanda = parent::getLastId();
				
				#$Cart = &CartManagement::getInstance();
				$Cart = new CartManagement($_SESSION[cart]);
				if($Cart->insertDB($id_comanda)) {
					return true;
				} else {
					return false;
				}
				
			} else {
				return false;
			}
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
	
	function getCmd($where = '', $order='') {
		return parent::queryAssoc("
			SELECT fac.*, fau.*, facs.status, facsp.status_plata, famp.mod_plata FROM erad_comenzi fac
			LEFT JOIN erad_users fau ON fau.id_user = fac.id_user
			LEFT JOIN erad_comenzi_status facs ON facs.id_status = fac.id_status
			LEFT JOIN erad_comenzi_status_plati facsp ON facsp.id_status_plata = fac.id_status_plata
			LEFT JOIN erad_mod_plata famp ON famp.id_mod_plata = fac.id_mod_plata
			WHERE {$where}
			{$order} 
		");
	}
	
}


?>
