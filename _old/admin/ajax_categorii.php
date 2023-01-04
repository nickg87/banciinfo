<? include('a_settings.php');
   $id_categorie=$_GET[id_categorie];
   $val=$_GET['val'];
 $id_camp=$_GET[id_camp];
 
 

  
if($val=='add' and $id_categorie<>'0') {
$categorii = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $categorii, $id_categorie,0); 
 if (count($categorii)==0) $categorii=mysql_query_assoc("select id_categorie, categorie, link   from erad_categorii where id_categorie='".$id_categorie."' ");

 
 foreach($categorii as $cats) {
 
  $_SESSION[szs][$cats[id_categorie]][categorie]=''.$cats[categorie].'';
  $_SESSION[szs][$cats[id_categorie]][id_categorie]=$cats[id_categorie];
 }
 
  }

 

if($val=='del') {
 //$_SESSION[szs][id]=$_GET[id_subcategorie];
//unset($_SESSION[xxx][$_GET['id_serv']]);
unset ($_SESSION[szs][$id_categorie]);

 
 }
?>

 
<?
if($val=='show' and $id_camp<>'0') {

 $tem = mysql_query_assoc("SELECT erad_categorii.* FROM erad_campuri_categorii
  left join erad_categorii on erad_categorii.id_categorie=erad_campuri_categorii.id_categorie
  where id_camp='".$id_camp."' ");

   foreach ($tem  as $index=>$t) {
		 $_SESSION[szs][$t[id_categorie]][categorie]=$t[categorie];
		 $_SESSION[szs][$t[id_categorie]][id_categorie]=$t[id_categorie];
  }
 
  }
  ?>
  
  
  
 
    <? 
	
	
  if (count($_SESSION['szs']==0)) {?>
  <input type="hidden" name="id_categorie[]" id="categoria"   /> 
<?  }?>


  <? 
  
   foreach($_SESSION['szs'] as $index => $z) { ?>
 
 &nbsp;&nbsp;<a href="#bask" onclick="load_categorii(<?=$index?>,<?=$id_camp?>, 'del')" style="color: #FF0000;" title="Sterge <?=$z?> ">[x]</a>

<input type="hidden" name="id_categorie[]" id="categoria" value="<?=$index?>" /><?=$z[categorie]?>
<br />

       <? }?>
 
    
   
   

 