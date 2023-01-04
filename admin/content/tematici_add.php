<?

$empty = '<br /><font color=red style="font-size: 9px;">camp lipsa</font>';

if(isset($_POST['s_add_cat'])) {
$empty = '<br /><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_tematici']);  


	$vl = array();
	$vl = $_POST;

 

    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 
		if($ins) {
		
		$id_tematica=get_last_mysql_id('erad_tematici');
		$name=$id_tematica.'_institutie';
		
		$u = upload_poza2('logo_institutie', PICS_DIR_MEDIU, PICS_DIR_LARGE, PICS_SIZE1, PICS_SIZE2, 'erad_tematici', 'logo_institutie', 'id_tematica',  $name);
		
		

		 $p=mysql_query_assoc("select * from erad_tematici where id_tematica='".$id_tematica."'");
				
		$dest_x =  PICS_SIZE3;
		$size = getimagesize(PICS_DIR_MEDIU.$p[0][logo_institutie]);
		
					if($size[0]>$size[1]) {
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
				resizeToFile (PICS_DIR_MEDIU.$p[0][logo_institutie], $dest_x ,$dest_y, PICS_DIR_THUMB.$p[0][logo_institutie], $quality = 100); 
			} else {
			
			$ratio = $size[1] / $dest_x;
 			$dest_y = round($size[0] / $ratio);
				resizeToFile (PICS_DIR_MEDIU.$p[0][logo_institutie], $dest_y ,$dest_x, PICS_DIR_THUMB.$p[0][logo_institutie], $quality = 100); 
			}
			
			
		$dest_x =  PICS_SIZE4;
		$size = getimagesize(PICS_DIR_MEDIU.$p[0][logo_institutie]);
		
		
			if($size[0]>$size[1]) {
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
				resizeToFile (PICS_DIR_MEDIU.$p[0][logo_institutie], $dest_x ,$dest_y, PICS_DIR_SMALL.$p[0][logo_institutie], $quality = 100); 
			} else {
			
			$ratio = $size[1] / $dest_x;
 			$dest_y = round($size[0] / $ratio);
				resizeToFile (PICS_DIR_MEDIU.$p[0][logo_institutie], $dest_y ,$dest_x, PICS_DIR_SMALL.$p[0][logo_institutie], $quality = 100); 
			}
		

		update_order('erad_tematici', 'id_tematica', 'ord', $extra);
 			echo js_redirect($scr.'?section='.$mnp1.'_0&msg=Adaugare efectuata.');
		}
	}
}

?>
 
 
<? //////////////form validation
$form_name="tematici_add";
include('validari_formulare.php');
include('validari_js.php');
?>


 <? include('menu_sub.php'); ?> 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
  <td height="30" bgcolor="#efefef">
   <a href="#" onclick="show_x('add');hide_x('mod');hide_x('msg');" class="but">Adauga o institutie noua</a>  </td>
  </tr>
</table>
<br />

<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
   <td width="100%" height="30" bgcolor="#efefef">
  
   <form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );"  enctype="multipart/form-data">
<fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Denumire institutie </td>
  <td bgcolor="#ffffff"><input type="text"  id="denumire_institutie" name="denumire_institutie" size="50"   value="<?=$denumire_institutie?>"></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>

 <tr>
   <td align="right" bgcolor="#ffffff">Logo</td>
   <td bgcolor="#ffffff"><input type="file" name="logo_institutie" size="20" /></td>
 </tr>
 
 
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>

 <tr>
   <td align="right" bgcolor="#ffffff">Descriere institutie</td>
   <td bgcolor="#ffffff">
   <textarea name="descriere_inst" class="content" rows="3" style="width: 700; height: 150;"><?=$vl[descriere_inst]?></textarea></td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 
<? $judete = mysql_query_assoc ("select * from erad_judete order by judet asc");  ?>
 <? if (count($judete)>0) {?>

 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Judet:</td>
  <td bgcolor="#ffffff">
		 
               <select name="id_judet" class="content" style="width:300px;"   onchange="load_orase(this.options[this.selectedIndex].value, 0)"   >
                <option value="">-- Alegeti judetul --</option>
                 <? for($j = 0; $j < count($judete); $j++) {?>
                 <option value="<?=$judete[$j][id_judet]?>"  <? if ($judete[$j][id_judet]==$vl[id_judet]) echo "selected"; ?>>
                 <?=$judete[$j][judet]?>
                 </option>
                 <? }?>
               </select>
  </td>
 </tr>
 <? } ?>
 
 
 
  <tr>
   <td align="right" bgcolor="#ffffff">Oras:</td>
   <td bgcolor="#ffffff"> <span id="orase"></span>&nbsp;<br/></td>
 </tr>
 

 
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Adresa: </td>
  <td bgcolor="#ffffff"><input type="text"  id="adresa" name="adresa" size="50"   value="<?=$vl[adresa]?>"></td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Telefon: </td>
  <td bgcolor="#ffffff"><input type="text"  id="telefon" name="telefon" size="50"   value="<?=$vl[telefon]?>"></td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Fax: </td>
  <td bgcolor="#ffffff"><input type="text"  id="fax" name="fax" size="50"   value="<?=$vl[fax]?>"></td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Email: </td>
  <td bgcolor="#ffffff"><input type="text"  id="email" name="email" size="50"   value="<?=$vl[email]?>"></td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">www: </td>
  <td bgcolor="#ffffff"><input type="text"  id="www" name="www" size="50"   value="<?=$vl[www]?>"> ex: http://www.exemplu.ro</td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Cod SWIFT: </td>
  <td bgcolor="#ffffff"><input type="text"  id="swift" name="swift" size="50"   value="<?=$vl[swift]?>"> </td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">CUI: </td>
  <td bgcolor="#ffffff"><input type="text"  id="cui" name="cui" size="50"   value="<?=$vl[cui]?>"> </td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Reg. Com.: </td>
  <td bgcolor="#ffffff"><input type="text"  id="reg_com" name="reg_com" size="50"   value="<?=$vl[reg_com]?>"> </td>
 </tr>
 
 <tr>
 <td align="right" width="150" bgcolor="#ffffff">Activ: </td>
  <td bgcolor="#ffffff">
  	<input type="checkbox" name="activ" value="1" <?=checked($vl[activ], 1)?>>
  	<font style="font-size:9px; font-family:tahoma;">(apare pe site)</font>  </td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_add_cat" value="Salveaza" class="but" /></td>
 </tr>
 </table>
 </fieldset>
 
 
</form>   </td>
   </tr>
 <tr>
   <td height="30" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  
 

