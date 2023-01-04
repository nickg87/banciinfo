<?

 

if($_GET['act'] == 'edit' && isset($_GET['id_producator'])) {
	$empty = '<br><font color=red style="font-size: 9px;">empty field</font>';
	
	$categorii = mysql_query_assoc("SELECT * FROM erad_producatori WHERE id_producator = '".$_GET['id_producator']."'");
	
	$producator = $categorii[0]['producator'];
 $pic = $categorii[0]['pic'];
	
	if(isset($_POST['s_mod_new'])) {
	$producator = quotes(trim($_POST['producator']));
	 
		$error = array();
		
		if(strlen($producator) < 1) {
			$error['producator'] = $empty;
		}
	
		if(empty($error)) {
			mysql_query("
				UPDATE erad_producatori SET
			producator = '".$producator."' 
			WHERE id_producator = '".$_GET['id_producator']."'
			");
 if(strlen($_FILES['pic']['tmp_name'])) 
$u = upload_poza2_peste('pic', PICS_DIR_THUMB, PICS_DIR_LARGE, PICS_SIZE_PROD1, PICS_SIZE_PROD2, 'erad_producatori', 'pic', 'id_producator', 'prd_'.$_GET['id_producator'], $_GET['id_producator']);
				
			echo js_redirect($scr.'?act=edit&id_producator='.$_GET['id_producator'].'&msg=Editat.');
			
		}
	}
}

?>


 <? include('menu_sub.php'); ?> 

<form action="<?=$scr?>?act=edit&id_producator=<?=$_GET['id_producator']?>" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
 <tr>
  <td bgcolor="#E5E9EB" height="30"><b>Edieaza domeniu </b></td>
  <td height="30" align="center" bgcolor="#E5E9EB"><?=$_GET['msg']?></td>
  <td width="1%"></td>
 </tr>
<? if(is_numeric($_GET['id_producator'])) { ?>
 <tr>
  <td align="right" width="21%" bgcolor="#ffffff">denumire :<?=$error['producator']?></td>
  <td width="78%" bgcolor="#ffffff"><input type="text" name="producator" size="50" maxlength="255" value="<?=$producator?>"></td>
 </tr>

 <tr>
   <td align="right" bgcolor="#ffffff">Logo
     <?=$error['producator']?></td>
   <td bgcolor="#ffffff"><input type="file" name="pic" size="20" />
 
 
<? if(is_file(PICS_DIR_THUMB . $pic)) {?>
	 <a href="#" onClick="show_large_pic('div_abs', '<?=PICS_URL_LARGE?><?=$pic?>', '<?=$s[0]?>', '<?=$s[1]?>')">
	 <img src="<?=PICS_URL_THUMB?><?=$pic?>" border="1"     align="middle" ></a> 
 
  <? }?>

 
   
   </td>
  </tr>
 
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_mod_new" value="Update">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      </td>
 </tr>
<? } ?>
</table>
</form>
