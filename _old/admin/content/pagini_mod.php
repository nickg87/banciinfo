<?
  $id_page=$_GET[id_page];
if(isset($_POST['s_mod'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_pagini']);  


	$vl = array();
	$vl = $_POST;
if (isset($vl[lateral])) $vl[lateral]=1; else $vl[lateral]=0;
if (isset($vl[principal])) $vl[principal]=1; else $vl[principal]=0;
if (isset($vl[home])) $vl[home]=1; else $vl[home]=0;
    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->update($vldb, $id_page);
 
		if($ins) {
		 update_order('erad_pagini', 'id_page', 'ord','and id_meniu='.$vl[id_meniu]); 
 			echo js_redirect($scr.'?section='.$section.'&tab=2&gal=2&id_page='.$id_page.'&msg=Modificare efectuata.');
		}
	}
}

$Usr = new UserManagement($DBF['erad_pagini']);  
$vldb=$Usr->get01($id_page);
 
$vl=$Usr->DbToForm($vldb);


function get_link_articol($ids, $s, $idc, $c, $i) {
	global $_url_data;
	return SITE_URL .url_shape($c, 150) . '/' . url_shape($s, 150). '-' . $idc . '-' . $ids . '.html';
}

?>
 <? //////////////form validation
$form_name="news";
include('validari_formulare.php');
include('validari_js.php');
?>

 <? include('menu_sub.php'); ?> 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
   
  <td height="30" bgcolor="#efefef" class="titlu">
   <a href="<?=get_link_articol($id_page, $vl[titlu_stire],$vl[id_meniu],'xx')?>" target="_blank"  > <strong>&raquo; Vezi articolul pe site</strong></a> 
  
  </td>
 </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>

<? include "tabs_pagini.php";?>

<fieldset class="" style="width:94%;">
    <legend class="titlu"><b>Date</b></legend>  

<form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>&id_page=<?=$id_page?>"   method="post"  onSubmit="return validate_form_<?=$form_name?> ( );">

 
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF" align="center">
 
 <tr>
  <td align="center" bgcolor="#ffffff" colspan="2">&nbsp;<?=$_GET['msg']?></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Link meniu:</td>
   <td bgcolor="#ffffff">
   <?    $meniuri = mysql_query_assoc("select * from erad_meniu_set order by link_meniu");?>
       <select name="id_meniu">
         <? foreach ($meniuri as $mnu) {?>
         <option value="<?=$mnu[id_meniu]?>" <?=selected($mnu[id_meniu],$vl[id_meniu]);?>>
           <?=$mnu[link_meniu]?>
          </option>
         <? }?>
       </select>   
        </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 
 
 
 <tr>
  <td width="13%" align="right" bgcolor="#ffffff"><strong>Titlu    </strong></td>
  <td bgcolor="#ffffff"><input type="text" name="titlu_stire" size="70" maxlength="255" value="<?=$vl[titlu_stire]?>"></td>
 </tr>
 
 <tr>
 
   <td align="right" bgcolor="#ffffff"><strong>Sapou</strong><br />
     (scurta fraza pt captarea atentiei publicului) </td>
   <td bgcolor="#ffffff"><font style="font-size: 3px;"><br />
     </font>
       <textarea name="sapou"  rows="5" style="width: 80%;"><?=$vl[sapou]?></textarea>   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Body</strong> </td>
   <td bgcolor="#ffffff"><font style="font-size: 3px;"><br />
     </font>
      <textarea name="body"  rows="20" style="width: 80%;"><?=$vl[body]?></textarea>   </td>
   </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"></td>
   <td bgcolor="#ffffff">   </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_mod" value="Salveaza" class="but">  </td>
 </tr>
</table>

 
</form>
</fieldset>
<? include "tabs_pagini.php";?> 
   <fieldset class="" style="width:94%;"  >
    <legend class="titlu"><b>Galerie foto</b></legend>     
 
	<? 
$pics=mysql_query_assoc("select * from erad_galerie_pagini where id_page='".$id_page."' order by prim desc, id_pic desc");

for($j=0; $j<count($pics); $j++){?>


<? if(is_file(PICS_DIR_THUMB . $pics[$j]['pic'])) {?>
	
	
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" style="border:1px solid #ccc; margin:5px;">
  <tr>
    <td width="150" align="center" valign="middle" bgcolor="#efefef">
	 <a href="#" onClick="show_large_pic('div_abs', '<?=PICS_URL_LARGE?><?=$pics[$j]['pic']?>', '<?=$s[0]?>', '<?=$s[1]?>')">
	    <img src="<?=PICS_URL_THUMB?><?=$pics[$j]['pic']?>" border="1"    align="middle"   width="50" ></a>	</td>
    <td bgcolor="#efefef">
	<strong>Titlu:</strong> 
	<?=$pics[$j]['titlu']?>
	<br />
	<br />

    <strong>Descriere:</strong>    <?=$pics[$j]['descriere']?>	</td>
    </tr>
</table>

	 <? }?>
 	<? }?> 
</fieldset>	
 <br />

<fieldset class="" style="width:94%;"  >
    <legend class="titlu"><b>Lista fisiere</b></legend> 
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#EFEFEF">
<tr>
<td width="150">
Denumire</td>
<td>
Descriere</td>	 
<td width="42">&nbsp;</td>	 
</tr>
<? 
$files=mysql_query_assoc("select * from erad_fisiere_pagini where id_page='".$id_page."'");

for($j=0; $j<count($files); $j++){?>


<? if(is_file(FILE_DIR . $files[$j]['file'])) {?>
<tr>
<td height="20" nowrap="nowrap" bgcolor="#FFFFFF"><a href="<?=FILE_URL?><?=$files[$j]['file']?>">
  <strong><?=$files[$j]['file']?></strong>
</a></td>
<td bgcolor="#FFFFFF">
&nbsp;
<?=$files[$j]['file_desc']?> </td>
<td bgcolor="#FFFFFF">&nbsp;</td>
</tr>
 <? }?>

<? }?>
</table>
 </fieldset>  
 