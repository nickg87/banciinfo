 
<div class="left_cat_pp"><span class="left_cat_pp_text"> Filtrare</span></div> 
 <? if(count($_SESSION[filtre])>0) {?>
 <div class="left_filtre">
<div class="left_cat_ff_activ"  >
Filtre active:
</div>
<? foreach($_SESSION[filtre] as $filtre=>$val){
$nume_filtru=array();
if($filtre=='brand') $nume_filtru=mysql_query_scalar(" select denumire_brand from erad_brands where id_brand='".$val."' ");
if(is_numeric($filtre)) $nume_filtru=mysql_query_scalar(" select valoare_camp from erad_campuri_valori where id_valoare='".$val."' ");
if($filtre=='tematica') $nume_filtru=mysql_query_scalar(" select denumire_tematica from erad_tematici where id_tematica='".$val."' ");
if($filtre=='produs_nou') $nume_filtru='Produse noi';
if($filtre=='oferte_speciale') $nume_filtru='Oferte speciale';
if($filtre=='stoc') $nume_filtru='In stoc';
if($filtre=='in_curand') $nume_filtru='In curand';
if($filtre=='pret') {
	$pr_ex=explode('~',$val);
if($pr_ex[0]==0) $nume_filtru='Pret sub '.$pr_ex[1]. ' Lei';
else 
if($pr_ex[1]=='x') $nume_filtru='Pret peste '.$pr_ex[0]. ' Lei';
else
  $nume_filtru='Pret ('. $val.') Lei';

}
?>



<a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru_del=<?=$filtre?>&val=<?=$val?>"  class="left_ff_text_activ"    title="Sterge filtrul <?=$nume_filtru?>"><strong>[x]</strong>&nbsp; <?=$nume_filtru?></a></span>  

<? }?>
</div>

 <? }?>
 
 
 <?  
 if($id_categorie<>'') {
 $catsub = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $catsub, $id_categorie,0); 
 $all=array();
  $all[]=$id_categorie;
  for($j = 0; $j < count($catsub); $j++) 
   $all[]=$catsub[$j][id_categorie];
	 
 if(count($all)>0)    $s=implode(',', array_unique($all));
 }
 ?>
 
 
  <?  
 if($x[0][price_range]<>'' ) {
 $preturi=explode('~',$x[0][price_range]);

 $ranges=count($preturi);
 ?>
 
 <div class="left_filtre">
    <div class="left_cat_ff">
     Pret (Lei): 
    </div>
    
<?  $disp=array(); 
$disp=mysql_query_assoc("select   erad_produse.id_produs   from erad_produse
 
 where (IF(erad_produse.pret_oferta != 0, erad_produse.pret_oferta, erad_produse.pret)<='".$preturi[0]."' and  erad_produse.activ=1 and erad_produse.id_categorie IN ($s))   
   group by erad_produse.id_produs
  ");?>

<a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=pret&val=0~<?=$preturi[0]?>"  class="left_ff_text"  title="<?=$brd[$j][denumire_brand]?>">Sub <strong><?=$preturi[0]?></strong> Lei   [ <?=count($disp)?> ]</a> 

<? for ($j=0; $j<$ranges-1; $j++){?>
  <? if(trim($preturi[$j])<>'' and trim($preturi[$j+1])<>''){  ?>  
  
  <?  $disp=array(); 
$disp=mysql_query_assoc("select   erad_produse.id_produs   from erad_produse
  
 where (IF(erad_produse.pret_oferta != 0, erad_produse.pret_oferta, erad_produse.pret)>='".$preturi[$j]."' and IF(erad_produse.pret_oferta != 0, erad_produse.pret_oferta, erad_produse.pret)<='".$preturi[$j+1]."' and  erad_produse.activ=1 and erad_produse.id_categorie IN ($s))    
   group by erad_produse.id_produs
  ");?>
   <a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=pret&val=<?=$preturi[$j]?>~<?=$preturi[$j+1]?>"  class="left_ff_text"  title="Pret intre <?=$preturi[$j]?>~<?=$preturi[$j+1]?>">   <strong><?=$preturi[$j]?></strong> - <strong><?=$preturi[$j+1]?></strong>  Lei [ <?=count($disp)?> ] </a> <? }?>
    <? }?>

<?  $disp=array(); 
$disp=mysql_query_assoc("select   erad_produse.id_produs   from erad_produse
 
 where (IF(erad_produse.pret_oferta != 0, erad_produse.pret_oferta, erad_produse.pret)>='".$preturi[$ranges-1]."' and  erad_produse.activ=1 and erad_produse.id_categorie IN ($s))    
   group by erad_produse.id_produs
  ");?>

<a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=pret&val=<?=$preturi[$ranges-1]?>~x"  class="left_ff_text"  title="Pret peste <?=$preturi[$ranges-1]?>">Peste <strong><?=$preturi[$ranges-1]?></strong>  Lei  [ <?=count($disp)?> ]</a> 
    
</div>
 
<? }?>
 
 
 
 
 <? ///brands
 
if($id_categorie<>'') { ?>

<div class="left_filtre">

<?
   $brd =mysql_query_assoc("select erad_brands.* from erad_brands
 left join erad_produse on erad_produse.id_brand=erad_brands.id_brand 
 LEFT JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
	 left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 	 left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
	left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
   where  erad_produse.id_categorie IN ($s)  
 group by erad_produse.id_brand
  order by erad_brands.ord "); ?>
  
 <? if(count($brd)>0) {?>
 <div class="left_cat_ff">
 Marci: 
</div>

<? for($j = 0; $j < count($brd); $j++) {?>
 
 <?   $disp=mysql_query_assoc("select erad_produse.id_produs from erad_produse
    LEFT JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
	 left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 	 left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
	left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
  where  id_brand='".$brd[$j][id_brand]."' and  erad_produse.activ=1 and erad_produse.id_categorie IN ($s)   and (".implode(' AND ', $p).")
  group by erad_produse.id_produs
   ");?> 
          
 <? if(count($disp)>0){?><a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=brand&val=<?=$brd[$j][id_brand]?>"  class="left_ff_text"  title="<?=$brd[$j][denumire_brand]?>"><?=$brd[$j][denumire_brand]?> [<?=count($disp)?>]</a>   <? }?>
		    
 	<? }?>
  
 <? }?>

</div>

  <? }?> 












<?  ///tematica
 
if($id_categorie<>'') { ?>


<?
  
  
 
  $tem =mysql_query_assoc("select * from erad_tematici
 left join erad_produse_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
 left join erad_produse on erad_produse_tematici.id_produs=erad_produse.id_produs
 left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
   where  erad_produse.id_categorie IN ($s)  and (".implode(' AND ', $p).")
 group by erad_produse_tematici.id_tematica
  order by erad_tematici.ord "); ?>
  
 <? if(count($tem)>0) {?>
 <div class="left_cat_ff">
 Utilizare: 
</div>

<div class="left_filtre">
<? for($j = 0; $j < count($tem); $j++) {?>
          
 <a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=tematica&val=<?=$tem[$j][id_tematica]?>"  class="left_ff_text"  title="<?=$tem[$j][denumire_tematica]?>"><?=$tem[$j][denumire_tematica]?></a></span>  
		    
     
                 <? }?>
 </div> 
 <? }?>



  <? }?>


 <? ///disponibilitate
 
if($id_categorie<>'') { ?>

 

<?
 
?>
 
<div class="left_filtre">
<div class="left_cat_ff">
 Disponibilitate 
</div> 

<?  $disp=array(); 
$disp=mysql_query_assoc("select  erad_produse.id_produs  from erad_produse
   left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
 where (produs_nou=1 and  erad_produse.activ=1 and erad_produse.id_categorie IN ($s))   and (".implode(' AND ', $p).")
   group by erad_produse.id_produs
 
 ");?> 
<? if(count($disp)>0){?><a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=produs_nou&val=1"  class="left_ff_text"  title="<?=$tem[$j][denumire_tematica]?>">Produse noi [<?=count($disp)?>]</a></span>  <? }?>

<?  $disp=array(); 
$disp=mysql_query_assoc("select  erad_produse.id_produs  from erad_produse
   left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
 where (oferta_speciala=1 and  erad_produse.activ=1 and erad_produse.id_categorie IN ($s))   and (".implode(' AND ', $p).")
   group by erad_produse.id_produs
 
 ");?>
<? if(count($disp)>0){?><a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=oferte_speciale&val=1"  class="left_ff_text"  title="<?=$tem[$j][denumire_tematica]?>">Oferte speciale [<?=count($disp)?>]</a></span>  <? }?>

<?  $disp=array(); 
$disp=mysql_query_assoc("select  erad_produse.id_produs  from erad_produse
   left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
 where (in_curand=0 and  erad_produse.activ=1 and erad_produse.id_categorie IN ($s))   and (".implode(' AND ', $p).")
   group by erad_produse.id_produs
 
 ");?> 
<? if(count($disp)>0){?><a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=stoc&val=0"  class="left_ff_text"  title="<?=$tem[$j][denumire_tematica]?>">In stoc [<?=count($disp)?>]</a></span>  <? }?>

<?  $disp=array(); 
$disp=mysql_query_assoc("select  erad_produse.id_produs  from erad_produse
   left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
 where (in_curand=1 and  erad_produse.activ=1 and erad_produse.id_categorie IN ($s))   and (".implode(' AND ', $p).")
   group by erad_produse.id_produs
 
 ");?> 
<? if(count($disp)>0){?><a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=in_curand&val=1"  class="left_ff_text"  title="<?=$tem[$j][denumire_tematica]?>">In curand [<?=count($disp)?>]</a></span>  <? }?>

 
 </div>
 
 <? }?>

 
 <? //specificatii
 
 $specs=mysql_query_assoc("select denumire_camp, erad_campuri.id_camp from erad_campuri
	left join erad_campuri_categorii on erad_campuri_categorii.id_camp=erad_campuri.id_camp
	left join erad_produse on erad_campuri_categorii.id_categorie=erad_produse.id_categorie
	
	 left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 	left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
	
	 where  erad_produse.id_categorie IN ($s)  and (".implode(' AND ', $p).")
	 group by erad_campuri.id_camp
	 ");

foreach ($specs as $campuri) {?>

 <?   $valori = mysql_query_assoc("select * from erad_campuri_valori where id_camp='".$campuri[id_camp]."'");?>

<? $vlprd1=0;
for($j = 0; $j < count($valori); $j++) {
		 
  $vlprd1+=mysql_query_scalar("select count(erad_produse.id_produs) from erad_produse_valori 
  left join erad_produse on erad_produse.id_produs=erad_produse_valori.id_produs
	 left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 	left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
		 where  
		 id_camp='".$campuri[id_camp]."' 
		 and id_valoare='".$valori[$j][id_valoare]."'
		 and
		 erad_produse.id_categorie IN ($s)  and (".implode(' AND ', $p).") and erad_produse.activ=1
		 ");
	 
		 
  }
 
  ?>


<? if($vlprd1>0) {?>

    <div class="left_filtre">
    <div class="left_cat_ff">
     <?=$campuri[denumire_camp]?> 
    </div>


       
         <? for($j = 0; $j < count($valori); $j++) {
		 
  $vlprd=mysql_query_scalar("select count(erad_produse.id_produs) from erad_produse_valori 
  left join erad_produse on erad_produse.id_produs=erad_produse_valori.id_produs
	 left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 	left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
		 where  
		 id_camp='".$campuri[id_camp]."' 
		 and id_valoare='".$valori[$j][id_valoare]."'
		 and
		 erad_produse.id_categorie IN ($s)  and (".implode(' AND ', $p).") and erad_produse.activ=1
		 ");
	 
		 ?>
<? if($vlprd>0) {?>
	<a href="<?=get_link_cat($id_categorie, $cat_curenta, 0)?>?filtru=<?=$campuri[id_camp]?>&val=<?=$valori[$j][id_valoare]?>" class="left_ff_text"    ><?=$valori[$j][valoare_camp]?> [<?=$vlprd?>]</a> 
 <? }?>
         <? }?> 
 
 
 </div> 
   <? }?>


<? }?>