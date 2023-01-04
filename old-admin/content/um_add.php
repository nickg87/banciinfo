<?


if(isset($_POST['s_add'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_um']);  


	$vl = array();
	$vl = $_POST;

    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 
		if($ins) {
		update_order('erad_um', 'id_um', 'ord', "");
 			echo js_redirect($scr.'?section='.$mnp1.'_6&msg=Adaugare efectuata.');
		}
	}
}

?>
 
 
 

 <? include('menu_sub.php'); ?> 


 
<? //////////////form validation
$form_name="campuri";
include('validari_formulare.php');
include('validari_js.php');
?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
  
  </tr>
</table>
<br />

<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
  
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">
  
   <form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );">
<fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Denumire  </td>
  <td bgcolor="#ffffff">
  <input type="text"  id="um" name="um" size="50"   value="<?=$um?>">  </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_add" value="Salveaza" class="but"></td>
 </tr>
 </table>
 </fieldset>
 
   </form>   </td>
   </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  
 
 