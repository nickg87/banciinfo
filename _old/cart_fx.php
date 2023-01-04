<? 

//unset ($_SESSION[cart]);
 
// print_r($_SESSION[cart]);


$greutate_total_colet=0;
$_SESSION[cart_total]=0;
$tva=1; 
 
$_SESSION[greutate_totala_colet]=0;

 
 $k = count($_SESSION[cart]);

 if (isset($_POST["s_add_to_cart"])) {
		
		$id_produs=$_POST[id_produs];
		$extra=$_POST[extra];
	//	 $coord='(';
 
 		foreach ($extra as $ex=>$val) {
	 
		$camp = mysql_query_assoc("SELECT * FROM erad_campuri WHERE id_camp = '{$ex}'");
		$valoare = mysql_query_assoc("SELECT * FROM erad_campuri_valori WHERE id_valoare = '{$val}'");
		
		
		$id_c.='_'.$ex.'x'.$val;
		
		$coord.=$camp[0][denumire_camp].': '.$valoare[0][valoare_camp].' ';
		}
		 // $coord.=')' ;
		
		$prd=mysql_query_assoc("select * from erad_produse where id_produs= '".$_POST[id_produs]."'"); 
	 
			if($prd[0]["produs_cod"]<>'') { 
			$_SESSION[cart][$id_produs]["produs"]=$prd[0]["produs"].' ['.$prd[0]["produs_cod"].']';
			$_SESSION[cart][$id_produs]["produs_cod"]=$prd[0]["produs_cod"];
					 
			}
			else $_SESSION[cart][$id_produs]["produs"]=$prd[0]["produs"];
			$_SESSION[cart][$id_produs]["greutate"]=$prd[0]["greutate"];
			$_SESSION[cart][$id_produs]["cant"]+=$_POST["cant"];
			 
			
			$_SESSION[cart][$id_produs]["pret"]=$prd[0][pret_oferta] > 0 ? $prd[0][pret_oferta]*$tva : $prd[0][pret]*$tva;
			
 			
			if($prd[0][id_moneda]<>0) {
 				if($prd[0][pret_oferta] > 0) $_SESSION[cart][$id_produs]["pret"]=fx(curs_valoare($prd[0][id_moneda])*$prd[0]["pret_oferta"]*$tva); 
						else $_SESSION[cart][$id_produs]["pret"]=fx(curs_valoare($prd[0][id_moneda])*$prd[0]["pret"]*$tva);
				}
							 
			 else 
			 	if($prd[0][pret_oferta] > 0) $_SESSION[cart][$id_produs]["pret"]=$prd[0]["pret_oferta"]*$tva; 
						else $_SESSION[cart][$id_produs]["pret"]=$prd[0]["pret"]*$tva;
			 
			if($coord<>'') $_SESSION[cart][$id_produs]["coordx"]='('.$coord.')';
		 	$_SESSION[cart][$id_produs]["id_produs"]=$id_produs;
		  
 echo js_redirect(SITE_URL.'viewcart');
}



if (isset($_GET["remove_from_cart"])) {
  $id_produs=$_GET[remove_from_cart];  
  unset ($_SESSION[cart][$id_produs]); 
   if ($id_produs=99999) $_SESSION[mod_plata]=2;
}
 
 
 
if (isset($_POST["s_update_cart"])) {
    foreach ($_POST["cant"] as $idp=>$p) {
 	$_SESSION[cart][$idp]["cant"]=$p;
 	  }
 } 




foreach($_SESSION[cart] as $k => $v) {

	$q=mysql_query_assoc("select * from erad_produse where id_produs='".$k."'");
	$_SESSION[greutate_totala_colet]+=fx($q[0][greutate]*$v[cant]);

	 $_SESSION[cart_total]+=fx($v[pret]*$v[cant]);
}



 


 /*
	if($k>0) {
	$_SESSION[pret_transport]=transport($greutate_total_colet);
/// peste pret reducere

	if($_SESSION[cart_total] >SUMA_MINIMA_ACHIZITIONATA) $_SESSION[pret_transport]=0;
	$_SESSION[comanda_total]=$_SESSION[cart_total]+$_SESSION[pret_transport];
}
  
*/
// print_r ($_SESSION[cart]);
?>