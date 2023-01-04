<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';
$id_link=$_GET[id_link];
 $links = mysql_query_assoc("SELECT * FROM erad_links where id_link='".$id_link."'");
$denumire=$links[0][denumire];
$link=$links[0][link];

if(isset($_POST['s_add_cat'])) {
	$denumire = quotes(trim($_POST['denumire']));
	$link = quotes(trim($_POST['link']));
 
	$id_parinte = 0;
	
	$error = array();
	
	if(!strlen($link)) {
		$error['link'] = $empty;
	}

	if(empty($error)) {
		$ins = mysql_query("
			UPDATE erad_links SET
			denumire = '".$denumire."',
			link = '".$link."'
			where id_link='".$id_link."'
		");
		
	
  
		if($ins) {
		
 
		
			update_order('erad_links', 'id_link', 'ord', "");
			echo js_redirect($scr.'?section='.$mnp1.'_0&msg=Link modificat.');
		}
	}
}

 
?>
 <? //////////////form validation
$form_name="links";
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
<br />

<fieldset class="" style="width:94%;">
    <legend class="titlu"><b>Date</b></legend> 
	
<form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>&id_link=<?=$id_link?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );">
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
  
 <tr>
  <td align="right" width="18%" bgcolor="#ffffff">Denumire categorie:<?=$error['categorie']?></td>
  <td width="82%" bgcolor="#ffffff"><input type="text" name="denumire" size="50" maxlength="255" value="<?=$denumire?>"></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Denumire categorie:
       <?=$error['categorie']?></td>
   <td bgcolor="#ffffff"><input type="text" name="link" size="50" maxlength="255" value="<?=$link?>" /></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff"><div id="inp"><input type="submit" name="s_add_cat" value="Adauga"></div></td>
 </tr>
</table>
</form>
</fieldset>
