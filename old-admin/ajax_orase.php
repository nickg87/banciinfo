<? include('a_settings.php');
 
$orase = mysql_query_assoc("SELECT * FROM erad_orase 
where id_parinte='".$_GET["id_judet"]."' 
ORDER BY `oras` ASC");

 ?>

 <? if (count($orase)>0) {?>
 
 

<select name="id_oras" class="content" style="width:300px;"  >
   <?  foreach($orase as $ors)  
	{   ?>
 	   <option value="<?=$ors[id_oras]?>" <? if ($_GET["val"]==$ors[id_oras]) echo "selected"; ?> ><?=$ors['oras']?>  </option>
        								   
	<? }?>
</select>

 	<? }?>

