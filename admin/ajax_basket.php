<? include('a_settings.php');
  $val=$_GET[v];
  $op=$_GET['op'];
 
 
 

  
if($op=='add' and $val<>'0') {

 $subcategorii = mysql_query_assoc("SELECT * FROM erad_subcategorii
 left join erad_categorii on erad_subcategorii.id_cat=erad_categorii.id_cat
 
  where id_subcategorie='".$val."' ORDER BY `subcategorie` ASC");

 //$_SESSION[szs][id]=$_GET[id_subcategorie];
 $_SESSION[szs][$val][nume]='['.$subcategorii[0][categorie].'] <b>'.$subcategorii[0][subcategorie].'</b>';
 $_SESSION[szs][$val][cat]=$subcategorii[0][id_cat];
 $_SESSION[szs][$val][sub]=$subcategorii[0][id_subcategorie];
 }

if($op=='add_zona' and $val<>'0') {

 $subcategorii = mysql_query_assoc("SELECT * FROM erad_subcategorii 
 left join erad_categorii on erad_subcategorii.id_cat=erad_categorii.id_cat
 where erad_subcategorii.id_cat='".$val."' ORDER BY `subcategorie` ASC");

if(count($subcategorii)<>0) foreach ($subcategorii as $sz) {

//$_SESSION[szs][$sz[id_subcategorie]]='['.$sz[categorie].'] <b>'.$sz[subcategorie].'</b>';
$_SESSION[szs][$sz[id_subcategorie]][nume]='['.$sz[categorie].'] <b>'.$sz[subcategorie].'</b>';
$_SESSION[szs][$sz[id_subcategorie]][cat]=$sz[id_cat];
$_SESSION[szs][$sz[id_subcategorie]][sub]=$sz[id_subcategorie];
} else {

 $cats = mysql_query_assoc("SELECT * FROM erad_categorii where id_cat='".$val."'  ");

$_SESSION[szs][1000+$val][nume]='[ <b>'.$cats[0]['categorie'].'</b> ]';
$_SESSION[szs][1000+$val][cat]=$val;
$_SESSION[szs][1000+$val][sub]='0';


}

 }

if($op=='del') {
 //$_SESSION[szs][id]=$_GET[id_subcategorie];
//unset($_SESSION[xxx][$_GET['id_serv']]);
unset ($_SESSION[szs][$val]);

 
 }
?>

 

  <?  //print_r($_SESSION[szs]); if($_GET[slp]) sleep ($_GET[slp]); ?>
 
  
  
  <? foreach($_SESSION['szs'] as $index => $z) { ?>

 &nbsp;&nbsp;<a href="#bask" onclick="load_basket(<?=$index?>, 'del')" style="color: #FF0000;" title="Sterge <?=$z?> ">[x]</a>

<input type="hidden"name="subcategoria[]" id="subcategoria" value="<?=$index?>" /><?=$z[nume]?>
<br />

       <? }?>
 
    
   
   

 