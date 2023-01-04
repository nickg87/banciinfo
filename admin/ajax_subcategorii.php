<? include('a_settings.php');
 
$subcategorii = mysql_query_assoc("SELECT * FROM erad_subcategorii 
where id_cat='".$_GET["id_cat"]."' 
ORDER BY `subcategorie` ASC");

 
 
?>

 
   
  <select id="subcats" name="id_subcategorie" >
<option value="0" >---alege subcategoria -- </option>     
	   <? 
foreach($subcategorii as $sub) 

{ 
  ?>
       <option value="<?=$sub['id_subcategorie']?>" <? if ($_GET["val"]==$sub['id_subcategorie']) echo "selected"; ?>>
     <?=$sub['subcategorie']?>
       </option>
       <? }?>
     </select> 
<input name="bustton"   type="button" class="but" onclick="load_basket(subcats.options[subcats.selectedIndex].value, 'add')"  value=">> Adauga Subcategorie"/>

 