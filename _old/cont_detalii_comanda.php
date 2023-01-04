<? include('settings/s_settings.php');
$id_comanda=$_GET[id_comanda];
$Cmd = new ComenziManagement($DBF[erad_comenzi]);
$where = "id_comanda = $id_comanda";
$cmd = $Cmd->getCmd($where,'');
$cart = mysql_query_assoc("SELECT * FROM erad_cart WHERE id_comanda = $id_comanda");


$prf = array();
$prf[id_proforma]=$id_comanda;
if($cmd[0][client]==1) $prf[nume] = $cmd[0][nume_user];
if($cmd[0][client]==2) $prf[nume] = $cmd[0][denumire];
 $prf[cui] = $cmd[0][cui] ;
if($cmd[0][client]==1) $prf[cnp] = $cmd[0][cnp] ; else $prf[cnp] ='';
$prf[rc] = $cmd[0][reg_comert]; 
if($cmd[0][client]==1) $prf[ci] = $cmd[0][ci]; else $prf[ci] = '';
$prf[judet] = get_judet($cmd[0][id_judet]);
$prf[localitate] = $cmd[0][localitate];
$prf[adresa_facturare] = $cmd[0][adresa_facturare];
$prf[adresa_livrare] = $cmd[0][adresa_livrare];
$prf[comentarii] = $cmd[0][comentarii];
$prf[comentarii_furnizor] = $cmd[0][comentarii_furnizor];
$prf[cod_postal] = $cmd[0][cod_postal];
$prf[data] = date('d.m.Y');
$prf[total_comanda] = $cmd[0][total_comanda];
$prf[pret_livrare] = $cmd[0][pret_livrare];
 $prf[telefon] = $cmd[0][telefon];
 $date_firma=mysql_query_assoc("select * from erad_date_firma where id_firma=1");

$prf[firma_denumire] = $date_firma[0][firma_denumire];
$prf[firma_cui] = $date_firma[0][firma_cui];
$prf[firma_ro] = $date_firma[0][firma_ro];
$prf[firma_sediu] = $date_firma[0][firma_sediu];
$prf[firma_cont] = $date_firma[0][firma_cont];
$prf[firma_banca] = $date_firma[0][firma_banca];

$prf[site_name] = SITE_NAME;
$prf[site_url] = SITE_URL;
 
  
$prf[data] = date('d.m.Y');
$prf[total_comanda] = $cmd[0][total_comanda];
$prf[pret_livrare] = $cmd[0][pret_livrare];


$prf_tpl = file_get_contents(TPL_COMANDA_CONT);
$prf_tpl = str_replace(array(chr(10), chr(11)), '', $prf_tpl);

$p = '`<\!\-\-CART\-\->(.*)<\!\-\-END\-CART\-\->`m';
preg_match($p, $prf_tpl, $m);
$prf_tpl_cart = $m[1];
$prf_cart = '';
$k = 0;
foreach($cart as $c) {

$prds=mysql_query_assoc("select pret from erad_produse where id_produs='".$c[id_produs]."' ");
$ums=mysql_query_assoc("select um from erad_produse
left join erad_um on erad_um.id_um=erad_produse.id_um where id_produs='".$c[id_produs]."' ");

	$prf_cart .= str_replace(
					array('{crt}', '{cant}', '{produs}', '{pret_unitar}', '{pret_total}', '{pret_baza}','{um}'), 
					array(++$k, $c[cant], strip_tags($c[produs]), $c[pret_unitar], $c[pret_total], $prds[0][pret], $ums[0][um]),
					$prf_tpl_cart);
}


#printr($prf);

$d = $prf_tpl;
# -- facem replace cu datele comenzii
foreach($prf as $k => $v)
	$d = str_replace('{' . $k . '}', $v, $d);
# -- facem replace si pt cart
$d = preg_replace('`(.*<\!\-\-CART\-\->).*(<\!\-\-END\-CART\-\->.*)`', "\\1{$prf_cart}\\2", $d);

 $prftxt_to_send = $d; 
 

# -- scoatem doar ce e in <body> pentru afisarea in pagina asta
  $d = preg_replace('`.*<body[^>]*>(.+)</body>.*`', '\1', $d);
  
  $prftxt = $d;

 
    
 $sent_nr=0;
   $message = '<html><head><style>'.file_get_contents(SITE_DIR.'style/style.css').'</style></head><body class="content_cont" style="background-color:#ffffff;font-size:12px; background:none;">'.$prftxt.'</body></html>';
 


$title=SITE_NAME ." - Date cont | Istoric comenzi";
?>

<? 

include "head_data.php";?>

 


<body  style="margin:0;"> 
 

<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
       <div id="LEFT" class="left" >
                
            <? $tip=3;?>
             <? include "left_cont.php";?>
            <? include "box_intrebari.php";?>
            <? include "banner_left.php";?>
             
          
        </div>
        
         
        
        
        
        <div id="CENTRU" class="centru">
            
 <p class="titlu_mare">Detalii comanda #<?=$id_comanda?></p>
 
 <div class="comanda_detalii" >	
 <?= $prftxt?>				   
					  
 </div>
<br>
       <div class="buttons">
    <a href="<?=SITE_URL?>cont_comenzi.html" >
        <img src="images/icons/arrow_left.png" alt=""/> 
     Inapoi la lista de comenzi
    </a>
  </div>    
         
      </div><!-- end center -->
        
      
      
        
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
