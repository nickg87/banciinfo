<?

$empty = '<br><font color=red style="font-size: 9px;">empty field</font>';
$id_campanie=$_GET[id_campanie];
$Usr = new UserManagement($DBF['erad_bannere']);  


if(isset($_POST['s_add_new'])) {
	$vl = array();
	$vl = $_POST;

if (isset($vl[activ])) $vl[activ]=1; else $vl[activ]=0;
 	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->update($vldb, $id_campanie);

  
	if($ins) {
 	
	
	 $target_path = BANNERS_DIR;
	 
	 	$ff=$id_campanie.'_'.url_shape2(basename($_FILES['banner']['name']) , 150); 
 	$target_path = $target_path . $ff;
 
		if(move_uploaded_file($_FILES['banner']['tmp_name'], $target_path)) {

$fis = mysql_query("
			UPDATE erad_bannere SET
			 
			banner='".$ff."' 
			where id_campanie='".$id_campanie."'
			
			");
			
 }
			echo js_redirect($src.'?section='.$mnp1.'_0');
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		

	}


 }
 
 
$vldb=$Usr->get01($id_campanie);
 
$vl=$Usr->DbToForm($vldb);

?>


 <? include('menu_sub.php'); ?> 

<? //////////////form validation
$form_name="bannere";
include('validari_formulare.php');
include('validari_js.php');
?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="73%" height="30" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
 
   
 </tr>
</table>
<br />

<fieldset  style="width:94%">
    <legend class="titlu"><b>Coordonate</b></legend>

<form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>&id_campanie=<?=$id_campanie?>" method="post" enctype="multipart/form-data" onSubmit="return validate_form_<?=$form_name?> ( );">

	<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
 <tr>
   <td width="17%" align="right" bgcolor="#FFFFFF">Denumire campanie    </td>
   <td width="83%" bgcolor="#ffffff"><input type="text" name="denumire_campanie" size="50" maxlength="255" value="<?=$vl[denumire_campanie]?>" /></td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#FFFFFF"> Pozitie banner </td>
   <td bgcolor="#ffffff">
   
   
      <select name="tip_banner" >
<? foreach ($pozitii_banner as $bn=>$label) {?>
   <option value="<?=$bn?>" <?=selected($vl[tip_banner], $bn)?>><?=$label?></option>
   
   <? }?>
   </select>    </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#FFFFFF">Tip fisier </td>
   <td bgcolor="#ffffff"><input type="radio" name="tip_fisier" value="1"  <?=checked($vl[tip_fisier],1)?>>
     SWF     &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
     <input type="radio" name="tip_fisier" value="2"  <?=checked($vl[tip_fisier],2)?>>
    JPG /GIF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     2Parale   
     <input type="radio" name="tip_fisier" value="3"  <?=checked($vl[tip_fisier],3)?>>
     </td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#FFFFFF">Cod banner </td>
   <td bgcolor="#ffffff">
   	<textarea name="script" class="content" rows="3" style="width: 70%; height: 150;"><?=$vl[script]?></textarea>

     </td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#FFFFFF"> Fisier </td>
   <td bgcolor="#ffffff"><input type="file" name="banner" />  
   
   &nbsp;&nbsp;&nbsp;<br/><br/>
   <? if (is_file(BANNERS_DIR.$vl[banner])) {?>
   <? if ($vl['tip_fisier']<>1) { ?>
   <img src="<?=BANNERS_URL?><?=$vl[banner]?>" height="50%" style="max-width:300px; overflow:hidden"     />
   <? } else { ?>
   <?
       $xx=explode('.swf', $vl[banner]);
      $name=$xx[0];
  ?>
  <a href="<?=SITE_URL?>banner/<?=$vl[banner]?>" target="_blank"> Vezi </a>  
   
   
    <script type="text/javascript">
    AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','<?=$vl[custom_width]?>','height','<?=$vl[custom_height]?>','src','<?=SITE_URL?>banner/<?=$name?>','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','<?=SITE_URL?>banner/<?=$name?>','wmode', 'transparent' ); //end AC code
    </script>
    <noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="<?=$vl[custom_width]?>" height="<?=$vl[custom_height]?>" >
      <param name="movie" value="<?=SITE_URL?>banner/<?=$vl[banner]?>" />
      <param name="quality" value="high" />
      <param name="wmode" value="transparent" />
      <embed src="<?=SITE_URL?>banner/<?=$vl[banner]?>"  wmode="transparent" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?=$vl[custom_width]?>" height="<?=$vl[custom_height]?>"  ></embed>
    </object></noscript>
    
   <? } }?>  <br/>  
   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#FFFFFF">Dimensiunui custom </td>
   <td bgcolor="#ffffff">
    latime: <input type="text" name="custom_width" size="10" maxlength="255" value="<?=$vl[custom_width]?>" />
     inaltime: <input type="text" name="custom_height" size="10" maxlength="255" value="<?=$vl[custom_height]?>" />
   <strong style="color:#0033FF;">Left / Right</strong> Latime: <strong style="color:#FF0000;">205 px;</strong> Inaltime <strong style="color:#FF0000;">variabila</strong> &nbsp;&nbsp;|&nbsp;&nbsp;
   <strong style="color:#0033FF;">Top</strong> <strong>Latime: <strong style="color:#FF0000;">728 px</strong> Inaltime: <strong style="color:#FF0000;">90 px</strong>
     </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#FFFFFF">Link integral (pt jpg) </td>
   <td bgcolor="#ffffff"><input type="text" name="link" size="70" maxlength="255" value="<?=$vl[link]?>" /></td>
 </tr>
<tr>
   <td align="right" bgcolor="#FFFFFF"> Tip link</td>
   <td bgcolor="#ffffff">
   
  
     <select name="tip_link" >
<? foreach ($open_link as $ol=>$label) {?>
   <option value="<?=$ol?>" <?=selected($vl[tip_link], $ol)?>><?=$label?></option>
   
   <? }?>
   </select>   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#FFFFFF">ACTIV</td>
   <td bgcolor="#ffffff">
   <input type="checkbox" name="activ" value="1"  <?=checked($vl[activ], 1)?>/>   </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#FFFFFF"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_add_new" value="Salveaza" class="but">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      </td>
 </tr>
</table>
</form>
</fieldset>
