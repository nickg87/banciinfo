<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$year = date('Y');
$month = date('m');
$day = date('d');

 
if(isset($_POST['s_add'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_campuri_valori']);  
 
	$vl = array();
	$vl = $_POST;
 
    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 
		if($ins) {
		
 			echo js_redirect($scr.'?section='.$mnp1.'_3&id_camp='.$vl[id_camp]);
		}
	}
}

?>
 
 <? //////////////form validation
$form_name="valori";
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
<form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>" method="post"  onSubmit="return validate_form_<?=$form_name?> ( );">
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF" align="center">
 
 <tr>
  <td align="center" bgcolor="#ffffff" colspan="2">&nbsp;<?=$_GET['msg']?></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Camp extra :</td>
   <td bgcolor="#ffffff">
 <?    $campuri = mysql_query_assoc("select * from erad_campuri order by denumire_camp");?>

	<select name="id_camp"  >
 	<? foreach ($campuri as $mnu) {
	 
	?>
	<option value="<?=$mnu[id_camp]?>" <?=selected($mnu[id_camp], $_GET[id_camp]);?>><?=$mnu[denumire_camp]?>  </option>
	<? }?>
	</select>   </td>
 </tr>
 <tr>
  <td width="13%" align="right" bgcolor="#ffffff"><strong>Valoare    </strong></td>
  <td bgcolor="#ffffff"><input type="text" name="valoare_camp" size="70" maxlength="255" value="<?=$valoare_camp?>"></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_add" value="Salveaza" class="but">  </td>
 </tr>
</table>
</form>
</fieldset>