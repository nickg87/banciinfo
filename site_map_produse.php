<?

$pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$it[$i][id_produs]."' order by prim desc");

$itm = mysql_query_assoc("
	SELECT * from 	  erad_home   	 where activ=1
	order by ord asc
  ");

if (count($itm)>0) {
foreach($itm as $items) {
?>

 <? 
  /////////categorie
 if($items['tip_item']==1) {?>
		 


<?
$cat_home=array();
$cat_home=mysql_query_assoc("select * from erad_categorii where id_categorie='".$items['id_item']."' order by ord");
if (count($cat_home)>0) {

	foreach ($cat_home as $ch) {
	 $catsub=array();
	 $catsub = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $catsub, $ch[id_categorie],0); 
	 $all=array();
	  if (count($catsub)>0)	  {
		  for($j = 0; $j < count($catsub); $j++)        $all[]=' erad_produse.id_categorie='.$catsub[$j][id_categorie];
			 $p = " (erad_produse.id_categorie = ".$ch[id_categorie]." or " .implode(' OR ', $all). ')' ;
		} else  $p = " erad_produse.id_categorie = ".$ch[id_categorie]  ;
	 
	     $p ;
	 
		 //erad_produse.activ=1 and
		$prd=array();
		$prd = mysql_query_assoc("
			SELECT * FROM erad_produse 
			left join erad_categorii on erad_categorii.id_categorie=erad_produse.id_categorie
			 
			WHERE   activ = '1'   and  $p
			order by erad_produse.id_produs desc 
			 

		");
		//ord_oferta asc
?>



<? 
$it = $prd;

if ( count($it)>=1) {
?>

		<div class="titlu_articol_lista"   style="margin:10px 0px; float:left; width:100%;" >
		
		<a href="<?=get_link_cat($ch[id_categorie],$ch[link])?>" class="titlu_cat_home" title="<?=$ch[categorie]?>" ><?=$ch[link]?></a>
		
		</div>       
    
 <div class="box_articol_general"  >

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<? for($i = 0; $i < count($it); $i++) { ?>			
			<tr height="20">
			<td align="left"  valign="top">
            
 
		        <a class="nav_link" href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"  title="Citeste articolul <?=strip_tags($it[$i][produs])?>">
				<?=strip_tags($it[$i][produs])?>
                </a> <br/>
 
 
             
           </td>
           </tr>
  			<? }?>   
           </table>
 
</div>
    
   

 

 
 <? }?>



<? } ?>

<? }  ?>
			
 <?  } //// end categorie  ?>

 

<? }?>



<? } ?>