<? include('a_settings.php');
   $id_tematica=$_GET[id_tematica];
   $val=$_GET['val'];
 $id_produs=$_GET[id_produs];
 
 

  
if($val=='add' and $id_tematica<>'0') {

 $tematici = mysql_query_assoc("SELECT * FROM erad_tematici
  where id_tematica='".$id_tematica."' ");

 //$_SESSION[szs][id]=$_GET[id_subcategorie];
 $_SESSION[szs][$id_tematica][denumire_institutie]=''.$tematici[0][denumire_institutie].'';
 $_SESSION[szs][$id_tematica][id_tematica]=$tematici[0][id_tematica];
  }

 

if($val=='del') {
 //$_SESSION[szs][id]=$_GET[id_subcategorie];
//unset($_SESSION[xxx][$_GET['id_serv']]);
unset ($_SESSION[szs][$id_tematica]);

 
 }
?>

 
<?
if($val=='show' and $id_produs<>'0') {

 $tem = mysql_query_assoc("SELECT erad_tematici.* FROM erad_produse_tematici
  left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica
  where id_produs='".$id_produs."' ");

   foreach ($tem  as $index=>$t) {
		 $_SESSION[szs][$t[id_tematica]][denumire_institutie]=$t[denumire_institutie];
		 $_SESSION[szs][$t[id_tematica]][id_tematica]=$t[id_tematica];
  }
 
  }
  ?>
  
  
  
 
    <? 
  if (array_empty($_SESSION['szs'])) {?>
  <input type="hidden" name="id_tematica[]" id="tematica"   /> 
  
 <span style="color: #FF0000;"> Nu exista nicio institutie asignata acestui articol</span>
  
<?  }?>


  <? 
  
   foreach($_SESSION['szs'] as $index => $z) { ?>
 
 &nbsp;&nbsp;<a href="#bask" onclick="load_tematici(<?=$index?>,<?=$id_produs?>, 'del')" style="color: #FF0000;" title="Sterge <?=$z?> ">[x]</a>

<input type="hidden" name="id_tematica[]" id="tematica" value="<?=$index?>" /><?=$z[denumire_institutie]?>
<br />

       <? }?>
 
    
   
   

 