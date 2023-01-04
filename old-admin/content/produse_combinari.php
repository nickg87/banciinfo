<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';
 $id_produs=$_GET[id_produs];
$today=date('Y-m-d');

#print_r($_FILES['poza']);

if($_SESSION[tab]=='') $_SESSION[tab]=1; else  $_SESSION[tab]=$_GET[tab];

$Usr = new UserManagement($DBF['erad_produse']);  

$vldb=$Usr->get01($_GET[id_produs]);
 
$vl=$Usr->DbToForm($vldb);

if(isset($_POST['s_add_produs'])) {
	$vl = array();
	$vl = $_POST;

    	$vldb = $Usr->FormToDb($vl);
 	#verificari

 
  
  
 
 	 
mysql_query("delete from erad_produse_valori where id_produs='".$id_produs."'");
foreach ($vl['valoare'] as $camp=>$val) 
		{
		 
		foreach ($val as $xx=>$valoare) {
		 if($valoare<>'') mysql_query("INSERT into erad_produse_valori set id_produs='".$id_produs."', id_camp='".$camp."' , id_valoare='".$valoare."'"); 
			}
		
		}
  
echo js_redirect($src.'?section='.$mnp1.'_6&tab=4&id_produs='.$id_produs);
 	 

	}
	//*/
  
 
  
 

?>




 <? include('menu_sub.php'); ?> 


<? //////////////form validation
$form_name="produse_add";
include('validari_formulare.php');
include('validari_js.php');
?>

 
 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" bgcolor="#efefef" class="titlu">
  
  <b><?=get_section_name($section)?> &raquo; <?=htmlspecialchars($vl[produs])?> | id <?=$vl[id_produs]?></b>   </td>
 
  <td width="31%" align="right" bgcolor="#efefef" class="titlu">
    <form action="<?=$scr?>" method="get" style="margin:0px;">
  Cauta   <input name="keyword" type="text" size="25" value="<?=$keyword?>"  />
  <input type="hidden" name="section" value="<?=$mnp1?>_0"  />
  <input type="submit"   class="but" value="Cauta"   />
    </form>  </td>
 </tr>
 <tr>
   <td height="30" bgcolor="#efefef"  >
    Mergi la:
<? $nav = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $nav, $vl[id_categorie],0);  ?>

<? foreach ($nav as $n) {?>
<? if ($n[lvl]>1){ ?>
&raquo; <a href="<?=$scr?>?section=<?=$mnp1?>_0&id_categorie=<?=$n[id_categorie]?>" ><strong><?=$n[link]?></strong></a>  
<? } else {?> 
 <strong><?=$n[link]?></strong>
<? }?>
<? }?> 
   </td>
   <td align="right" bgcolor="#efefef" class="titlu">
   
    <a href="<?=get_link_produs($id_produs, $vl[produs])?>" target="_blank"  > <strong> <img src="img/magnifier.png" alt="vezi produsul" border="0" align="top" />Vezi produsul pe site</strong></a>   </td>
 </tr>
</table>

<br />

<? include "tabs.php";?>

 <form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>&id_produs=<?=$id_produs?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );" enctype="multipart/form-data"> 
 

 <table cellpadding="5" cellspacing="1"  width="95%" >

 <tr>
 <td bgcolor="#FFFFFF">
 
 
  <strong> </strong></td>
</tr>



 <tr>
 <td bgcolor="#FFFFFF">
  <fieldset class="">
    <legend class="titlu"><b>Combinari si atribute  </b></legend> 

    <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 
  <? /////////////////////////////////////// specs extra?>


<? $specs=mysql_query_assoc("select   	denumire_camp, erad_campuri.id_camp from erad_campuri
							left join erad_campuri_categorii on erad_campuri_categorii.id_camp=erad_campuri.id_camp
							 where activ=1 and id_categorie='".$vl[id_categorie]."'
							 group by erad_campuri.id_camp
							 ");
?>

 
 
 <tr>
   <td width="103" align="right" nowrap="nowrap" bgcolor="#ffffff">   </td>
   <td width="1024" bgcolor="#ffffff">
 
 <? foreach ($specs as $campuri) {?>
 <table border="0" cellpadding="5" cellspacing="0" style="float:left; width:150px; border-right:1px solid #999999; margin-right:5px;">
 <tr>
 <td bgcolor="#5379C1" style="color:#FFFFFF;">
  
    <strong><?=$campuri[denumire_camp]?></strong>
   <input type="hidden" name="id_camp" value="<?=$campuri[id_camp]?>" /></td>
 </tr>
  
   <?   $valori = mysql_query_assoc("select * from erad_campuri_valori where id_camp='".$campuri[id_camp]."'");?>
       
         <? for($j = 0; $j < count($valori); $j++) {
		 
		 $vlprd=mysql_query_assoc("select * from erad_produse_valori 
		 where id_produs='".$id_produs."' 
		 and id_camp='".$campuri[id_camp]."' 
		 and id_valoare='".$valori[$j][id_valoare]."'
		 ");
	 
		 ?>
       
       <tr>
       <td style="border-bottom:1px dashed #CCCCCC;">
         <input type="checkbox" name="valoare[<?=$campuri[id_camp]?>][]" value="<?=$valori[$j][id_valoare]?>" <? if (count($vlprd)>0) echo "checked";?>    >
         <?=$valori[$j][valoare_camp]?> 
</td>
</tr>
         <? }?>
     </table>   
     
      <? }?>         </td>
   </tr>
   
  
   <tr>
     <td align="right" nowrap="nowrap" bgcolor="#ffffff">&nbsp;</td>
     <td bgcolor="#ffffff">&nbsp;</td>
   </tr>
   <tr>
   <td align="right" nowrap="nowrap" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_add_produs" class="but" value="Salveaza" /></td>
 </tr>
 
 
 
 
 
 
 <? /////////////////////////////////////// ?>
 </table>
 </fieldset>
 

 <strong> </strong>
 </form>
 