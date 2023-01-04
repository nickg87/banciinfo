<? include('a_settings.php');
 
$produse = mysql_query_assoc("SELECT * FROM erad_produse 
where id_categorie='".$_GET["id_categorie"]."' and activ=1
ORDER BY `produs` ASC");

 
 ?>

 
   
  <select name="id_produs"  >
     
	   <?  
foreach($produse as $prd) 
 
{ 
  ?>
      
	  
	   <option value="<?=$prd['id_produs']?>" <? if ($_GET["val"]==$prd['id_produs']) echo "selected"; ?>><?=$prd['produs']?>  </option>
       <? }?>
     </select>


 