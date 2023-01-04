<?


$hf=mysql_query_assoc("select * from erad_extern where id=0 "); 

if(isset($_POST['s_mod'])) {
// echo $_POST[footers]; exit;
$ins = mysql_query("update erad_extern set headers='". mysql_real_escape_string(stripslashes($_POST[headers])) ."', ga='". mysql_real_escape_string(stripslashes($_POST[ga])) ."', gw='". mysql_real_escape_string(stripslashes($_POST[gw])) ."', footers='". mysql_real_escape_string(stripslashes($_POST[footers])) ."' where id=0 ");
 		if($ins) {
  		echo js_redirect($scr.'?section='.$section);
		}
 }

 

?>
 <? //////////////form validation
$form_name="transport";
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
   <td width="17%" align="right" bgcolor="#ffffff"><strong>Google analytics cod<br />
     (in header)
</strong></td>
   <td width="83%" bgcolor="#ffffff"><textarea name="ga" cols="70" rows="5" ><?=htmlspecialchars($hf[0][ga])?></textarea>   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Google Webmasters cod<br />
   (in header)</strong></td>
   <td bgcolor="#ffffff"><textarea name="gw" cols="70" rows="5" ><?=$hf[0][gw]?></textarea>   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Footers </strong></td>
   <td bgcolor="#ffffff"><textarea name="footers" cols="70" rows="10" ><?=htmlentities($hf[0][footers])?></textarea>   </td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#ffffff"></td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 

   
 
   <? for($j=0; $j<count($judete); $j++){?>
     
     <? }?>
 

 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_mod" value="Salveaza" class="but">  </td>
 </tr>
</table>

 
</form>
</fieldset>
  
  
 