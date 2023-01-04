<?
  $id_page=1;
if(isset($_POST['s_mod'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_date_firma']);  


	$vl = array();
	$vl = $_POST;
     	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->update($vldb, $id_page);
 
		if($ins) {
		
 			echo js_redirect($scr.'?section='.$section.'&msg=Modificare efectuata.');
		}
	}
}

$Usr = new UserManagement($DBF['erad_date_firma']);  
$vldb=$Usr->get01($id_page);
 
$vl=$Usr->DbToForm($vldb);


?>
 <? //////////////form validation
$form_name="news";
include('validari_formulare.php');
include('validari_js.php');
?>


 <? include('menu_sub.php'); ?> 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
   
  </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>

 

<fieldset class="" style="width:94%;">
    <legend class="titlu"><b>Date</b></legend>  

<form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>"   method="post"  onSubmit="return validate_form_<?=$form_name?> ( );">

 
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF" align="center">
 
 <tr>
  <td align="center" bgcolor="#ffffff" colspan="2">&nbsp; </td>
 </tr>
 <tr>
  <td width="17%" align="right" bgcolor="#ffffff"><strong>Denumire firma    </strong></td>
  <td width="83%" bgcolor="#ffffff"><input type="text" name="firma_denumire" size="70" maxlength="255" value="<?=$vl[firma_denumire]?>"></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"></td>
   <td bgcolor="#ffffff">   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Adresa sediu social </strong></td>
   <td bgcolor="#ffffff"><input type="text" name="firma_sediu" size="70" maxlength="255" value="<?=$vl[firma_sediu]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Reg. Com</strong></td>
   <td bgcolor="#ffffff"><input type="text" name="firma_ro" size="70" maxlength="255" value="<?=$vl[firma_ro]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>CUI </strong></td>
   <td bgcolor="#ffffff"><input type="text" name="firma_cui" size="70" maxlength="255" value="<?=$vl[firma_cui]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Cont bancar</strong></td>
   <td bgcolor="#ffffff"><input type="text" name="firma_cont" size="70" maxlength="255" value="<?=$vl[firma_cont]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Banca </strong></td>
   <td bgcolor="#ffffff"><input type="text" name="firma_banca" size="70" maxlength="255" value="<?=$vl[firma_banca]?>" /></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_mod" value="Salveaza" class="but">  </td>
 </tr>
</table>

 
</form>
</fieldset>
  
  
 