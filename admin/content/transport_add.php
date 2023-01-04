<?


$judete=mysql_query_assoc("select * from erad_judete order by  judet"); 

if(isset($_POST['s_mod'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';


$Usr = new UserManagement($DBF['erad_curier']);  


	$vl = array();
	$vl = $_POST;
     	$vldb = $Usr->FormToDb($vl);
 	#verificari
 
	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 $id_curier=get_last_mysql_id('erad_curier');
		if($ins) {
		
		
			for($j=0; $j<count($judete); $j++) {
			 
					mysql_query("insert into erad_judete_curier set 
				taxa_standard='".$vl[taxa_standard][$judete[$j][id_judet]]."', 
				taxa_per_kg='".$vl[taxa_per_kg][$judete[$j][id_judet]]."', 
				taxa_express='".$vl[taxa_express][$judete[$j][id_judet]]."', 
				taxa_express_per_kg='".$vl[taxa_express_per_kg][$judete[$j][id_judet]]."', 
				suma_transport_gratuit='".$vl[suma_transport_gratuit][$judete[$j][id_judet]]."',
				id_curier='".$id_curier."', 
				id_judet='".$judete[$j][id_judet]."' ");
			
			
			}
		
 		echo js_redirect($scr.'?section='.$mnp1.'_1');
		}
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
  <td width="17%" align="right" bgcolor="#ffffff"><strong>Denumire Curier   </strong></td>
  <td width="83%" bgcolor="#ffffff"><input type="text" name="curier_nume" size="70" maxlength="255" value="<?=$vl[curier_nume]?>"></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"></td>
   <td bgcolor="#ffffff">   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Durata expeditie </strong></td>
   <td bgcolor="#ffffff"><input type="text" name="durata_expeditie" size="70" maxlength="255" value="<?=$vl[durata_expeditie]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Descriere </strong></td>
   <td bgcolor="#ffffff"><textarea name="descriere_curier" cols="70" rows="10" ><?=$vl[descriere_curier]?> </textarea>
   </td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#ffffff"></td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Zone livrare</strong></td>
   <td bgcolor="#ffffff">   </td>
 </tr>
 

   
 
   <? for($j=0; $j<count($judete); $j++){?>
    
     <tr>
   <td align="right" bgcolor="#ffffff"> <strong><?=$judete[$j][judet]?></strong></td>
   <td bgcolor="#ffffff">
   <table width="400" border="0" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="3" bgcolor="#999999">&nbsp;</td>
    <td width="98" bgcolor="#FFFFFF"><strong>Taxa standard:</strong></td>
    <td width="115" bgcolor="#FFFFFF"><input type="text"   name="taxa_standard[<?=$judete[$j][id_judet]?>]" size="10" maxlength="255" value="<?=$vl[taxa_standard][$judete[$j][id_judet]]?>" />
lei</td>
    <td width="3" bgcolor="#999999">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#999999">&nbsp;</td>
    <td bgcolor="#FFFFFF"><strong>Taxa per kg:</strong></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text"    name="taxa_per_kg[<?=$judete[$j][id_judet]?>]" size="10" maxlength="255" value="<?=$vl[taxa_per_kg][$judete[$j][id_judet]]?>" />
lei/kg</td>
    <td nowrap="nowrap" bgcolor="#999999">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#999999">&nbsp;</td>
    <td bgcolor="#FFFFFF"><strong>Suma transport gratuit:</strong></td>
    <td nowrap="nowrap" bgcolor="#FFFFFF"><input type="text"   name="suma_transport_gratuit[<?=$judete[$j][id_judet]?>]" size="10" maxlength="255" value="<?=$vl[suma_transport_gratuit][$judete[$j][id_judet]]?>" />
lei</td>
    <td nowrap="nowrap" bgcolor="#999999">&nbsp;</td>
  </tr>
</table></td>
 </tr>
     
     <? }?>
 

 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_mod" value="Salveaza" class="but">  </td>
 </tr>
</table>

 
</form>
</fieldset>
  
  
 