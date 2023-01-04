<?

$empty = '<br><font color=red style="font-size: 9px;">empty field</font>';

if(isset($_POST['s_add_new'])) {
	$producator = quotes(trim($_POST['producator']));
	 

	$error = array();
	
	if(strlen($producator) < 1) {
		$error['producator'] = $empty;
	}

	if(empty($error)) {
		mysql_query("
			INSERT INTO erad_producatori SET
			producator = '".$producator."'
			
		");

$id_producator=get_last_mysql_id('erad_producatori');
 if(strlen($_FILES['pic']['tmp_name'])) 
$u = upload_poza2('pic', PICS_DIR_THUMB, PICS_DIR_LARGE, PICS_SIZE_PROD1, PICS_SIZE_PROD2, 'erad_producatori', 'pic', 'id_producator', 'prd_'.$id_producator);
		 

	 update_order('erad_producatori', 'id_producator', 'ord',$extra ); 	
	echo js_redirect($scr.'?msg=Adaugat.');
		
	}
}

?>



 <? include('menu_sub.php'); ?> 
<form action="<?=$scr?>" method="post" enctype="multipart/form-data">
<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
 <tr>
  <td bgcolor="#E5E9EB" height="30"><b>Adauga </b></td>
  <td height="30" align="center" bgcolor="#E5E9EB"> <font color=red style="font-size: 12px;"><b><?=$_GET['msg']?></b></font></td>
 </tr>
 <tr>
  <td align="right" width="17%" bgcolor="#ffffff">denumire    <?=$error['producator']?></td>
  <td width="83%" bgcolor="#ffffff"><input type="text" name="producator" size="50" maxlength="255" value="<?=$producator?>"></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Logo
     <?=$error['producator']?></td>
   <td bgcolor="#ffffff"><input type="file" name="pic" size="20" /></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_add_new" value="Add">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      </td>
 </tr>
</table>
</form>
