<? include('a_settings.php');
  $id_certificare=$_GET[id_certificare];
   $val=$_GET['val'];
 $id_brand=$_GET[id_brand];
 
 

  
if($val=='add' and $id_certificare<>'0') {

 $certificari = mysql_query_assoc("SELECT * FROM erad_certificari
  where id_certificare='".$id_certificare."' ");

 //$_SESSION[crt][id]=$_GET[id_subcategorie];
 $_SESSION[crt][$id_certificare][denumire_certificare]=''.$certificari[0][denumire_certificare].'';
 $_SESSION[crt][$id_certificare][id_certificare]=$certificari[0][id_certificare];
  }

 

if($val=='del') {
 //$_SESSION[crt][id]=$_GET[id_subcategorie];
//unset($_SESSION[xxx][$_GET['id_serv']]);
unset ($_SESSION[crt][$id_certificare]);

 
 }
?>

 
<?
if($val=='show' and $id_brand<>'0') {

 $tem = mysql_query_assoc("SELECT erad_certificari.* FROM erad_brands_certificari
  left join erad_certificari on erad_certificari.id_certificare=erad_brands_certificari.id_certificare
  where id_brand='".$id_brand."' ");

   foreach ($tem  as $index=>$t) {
		 $_SESSION[crt][$t[id_certificare]][denumire_certificare]=$t[denumire_certificare];
		 $_SESSION[crt][$t[id_certificare]][id_certificare]=$t[id_certificare];
  }
 
  }
  ?>
  
  
  
 
    <? 
  if (count($_SESSION['crt']==0)) {?>
  <input type="hidden" name="id_certificare[]" id="tematica"   /> 
<?  }?>


  <? 
  
   foreach($_SESSION['crt'] as $index => $z) { ?>
 
 &nbsp;&nbsp;<a href="#bask" onclick="load_certificari(<?=$index?>,<?=$id_brand?>, 'del')" style="color: #FF0000;" title="Sterge <?=$z?> ">[x]</a>

<input type="hidden" name="id_certificare[]" id="tematica" value="<?=$index?>" /><?=$z[denumire_certificare]?>
<br />

       <? }?>
 
    
   
   

 