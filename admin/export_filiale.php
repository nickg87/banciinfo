<?  include('a_settings.php');

$today=date('Y-m-d');


if ($_GET[r]==1) {


if (!isset($_SESSION[rec])) $_SESSION[rec]=0;
 if ($_SESSION[rec]==1) $p[] = " erad_produse.produs_nou ='".$_SESSION[rec]."' ";

if (!isset($_SESSION[of])) $_SESSION[of]=0;
 if ($_SESSION[of]==1) $p[] = " erad_produse.oferta_speciala ='".$_SESSION[of]."' ";

if (!isset($_SESSION[curand])) $_SESSION[curand]=0;
 if ($_SESSION[curand]==1) $p[] = " erad_produse.in_curand ='".$_SESSION[curand]."' ";

if (!isset($_SESSION[inactiv])) $_SESSION[inactiv]=1;
 if ($_SESSION[inactiv]==0) $p[] = " erad_produse.activ ='".$_SESSION[inactiv]."' ";


$keyword=trim($_GET[keyword]);
$id_categorie=trim($_GET[id_categorie]);
$id_brand=trim($_GET[id_brand]);
 if ($keyword<>'') $p[] = " erad_produse.produs like '%".$keyword."%' or erad_produse.produs_cod like '%".$keyword."%'";
 if ($id_categorie<>0) $p[] = " erad_produse.id_categorie = '".$id_categorie."' ";
 if ($id_brand<>0) $p[] = " erad_produse.id_brand = '".$id_brand."' ";
 $p[] = "  erad_produse.status <> 9 ";

 //echo   implode(' AND ', $p); exit;
 
$select = "SELECT 
erad_produse.id_produs as 'id_produs', 
erad_produse.produs as 'produs',
erad_produse.produs_cod as 'produs_cod', 
erad_produse.pret as 'pret',
erad_produse.pret_oferta as 'pret_oferta',
erad_produse.activ as 'activ' 
FROM erad_produse 
 WHERE  
	".implode(' AND ', $p)."

";                
//erad_produse.id_produs as '$$'

 
$export = mysql_query($select);
  $fields = mysql_num_fields($export);
 
for ($i = 0; $i < $fields; $i++) {
  $header .= mysql_field_name($export, $i) . "\t";
}  


while($row = mysql_fetch_row($export)) {
 $c=0;   $line = '';
    foreach($row as $value) {    
	     if ((!isset($value)) OR ($value == "")) {
            $value = "\t";
        } else {
          
        // if($c==5)  $value = "$$";
		  $value = '"' . $value . '"' . "\t"; 
			
        }
      $c++;  $line .= $value;
    }
  $data .= trim($line)."\n";
}

$data = str_replace("\r","",$data); 



if ($data == "") {
    $data = "\n(0) Records Found!\n";                        
} 

header("Cache-Control: maxage=1"); //In seconds
header("Pragma: public");  
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=produse_site_".$today.".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";   
 
 ?>
 
<? }?>





<? 

if ($_GET[i]==1) {
$table='erad_orase';

if(isset($_POST['s_upload'])) { 
	if(strlen($_FILES['uploadedfile']['tmp_name'])) {
		 $target_path = SITE_DIR."admin/excel/";
		
		$target_path = $target_path . 'export_filiale.xls';
		unlink($target_path);
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { 
		
 require_once SITE_DIR."admin/excel/reader.php";
$data = new Spreadsheet_Excel_Reader();

$data->read(SITE_DIR."admin/excel/export_filiale.xls");


 $flds=array(); error_reporting(E_ALL ^ E_NOTICE);
for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++)
{
$flds[]=$data->sheets[0]['cells'][1][$j]." varchar(250) NOT NULL default '' ";
$flds_insert[]=$data->sheets[0]['cells'][1][$j];
//echo "<td>".$data->sheets[0]['cells'][1][$j]."</td>";
}

  $all=implode(', ',$flds);
 
 $capete=implode(', ',$flds_insert);
 
//mysql_query("delete from {$table} where id_util='".$id."' ");
 

$linie=array();
for ($j = 1; $j <= $data->sheets[0]['numRows']; $j++)
		 {
 $upd_arr=array();
 $whr=''; 
  for ($k = 1; $k <= $data->sheets[0]['numCols']; $k++) {
  	    $linie[]="'".$data->sheets[0]['cells'][$j+1][$k]."'";

  if($data->sheets[0]['cells'][$j+1][1]<>'') {
   if($flds_insert[$k]<>'') $upd_arr[]=$flds_insert[$k].' = '.'"'.addslashes($data->sheets[0]['cells'][$j+1][$k+1]).'"';
	  $whr=$flds_insert[0].' = '."'".$data->sheets[0]['cells'][$j+1][1]."'"; 
	}
 
			}
 
if(!empty($upd_arr) )   $valori=implode(', ',$upd_arr);
// echo  $whr;
// echo  $valori;  
 if(  $whr<>'') $updi=mysql_query   ( "INSERT INTO  erad_filiale set id_filiala={$whr} ");
 if(  $whr<>'') $upd=mysql_query   ( "UPDATE  erad_filiale set {$valori} WHERE {$whr} ");
// if(  $whr<>'') $upd=mysql_query   ( "INSERT INTO  erad_orase (id_oras, id_parinte, oras) values ({$valori})  ");

 
 		}
 

 
	
	
	 $msg= "Date updatate";	
		
		} else{
		     $msg= "Eroare la incarcarea fisierului! Va rugam incercati din nou!";
		}
	}
//  echo js_redirect($scr.'?msg='.$msg."&id=".$id."&tip=".$tip);
}



}
?>

<? if ($_GET[r]<>1) {?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<script>
// (C) 2001 www.CodeLifter.com
// http://www.codelifter.com
// Free for all users, but leave in this header

var howLong = 10000;

t = null;
function closeMe(){
t = setTimeout("self.close()",howLong);
}

</script>
    
    <title>Actualizare preturi</title>
	<style type="text/css">
	body{
		/*
		You can remove these four options 
		
		*/
		background-repeat:no-repeat;
		font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
		margin:0px;
		

	}
	#ad{
		padding-top:220px;
		padding-left:10px;
	}
	 td {
 font-family: verdana;
	font-size: 11px;
	font-weight: normal;
	color: #000000;
	 
	 
}
	</style>
<link rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
	
<style media="all" type="text/css">
	@import "style.css";
</style>	

</head>
<? // onload="closeMe();self.focus()" ?>
<body >
<table width="100%" cellpadding="0" cellspacing="0" border="0"   style="border:0; background-image:url(img/top.jpg); background-repeat:repeat-x;"  >
   <tr>
     <td width="170" height="66" align="center"  class="head"    ><?=SITE_NAME?></td>
     <td width="1081" height="50"  class="head" style="border:0;  ">
	 <div style="text-align:center;   float:left">&nbsp;Export / Import actualizare filiale </div>
     </td>
   </tr>
</table>


<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:17px; margin:5px; text-align:center ">
<?=$_GET['msg']?>
</div>
<? }?>




<table width="90%" align="center">
<tr>
<td align="center">


 
<br>
<br>
<br>
<br>
<br>



<fieldset style="width:80%;  ">
    <legend class="titlu"><b>Import</b></legend> 

<form action="<?=$src?>?i=1" method="POST" name="234" id="432432aa" enctype="multipart/form-data">
	   <table width="100%" border="0" cellspacing="1" cellpadding="1">
	  <tr>
		<td align="center"> Importa lista filiale </td>
	  </tr>
	  <tr>
		<td height="69" align="center">
	<input type="file" name="uploadedfile"    > 
	<input type="submit" name="s_upload" value="Importa"  class="but">  
	&nbsp;
    <br><br>
    
    <table width="100%" border="0" bordercolor="#cce5ff" cellpadding="5" cellspacing="0">
  <tr bgcolor="#cce5ff" >
    <td style="color:#414141" align="center"><strong>id_filiala</strong></td>
    <td style="color:#414141" align="center"><strong>id_institutie</strong></td>
    <td style="color:#414141" align="center"><strong>denumire_filiala</strong></td>
    <td style="color:#414141" align="center"><strong>adresa</strong></td>
    <td style="color:#414141" align="center"><strong>telefon</strong></td>
    <td style="color:#414141" align="center"><strong>fax</strong></td>
    <td style="color:#414141" align="center"><strong>email</strong></td>
    <td style="color:#414141" align="center"><strong>id_judet</strong></td>
    <td style="color:#414141" align="center"><strong>id_oras</strong></td>
    <td style="color:#414141" align="center"><strong>activ</strong></td>
  </tr>
  <tr>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">1</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">3</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">Filiala BCR Crangasi</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">Calea Crangasi, Nr. 1, Bl. 1, Sc.A</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">021 31 31 333</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">021 31 31 333</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">crangasi@bcr.ro</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">10</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">3484</td>
    <td style="color:#414141; border:1px solid #cce5ff;" align="center">1</td>
  </tr>
</table>


<strong>(Aveti grija ca fisierul de import sa fie in format EXCEL, nu Text Tab Delimited)</strong>
	 </td>
	  </tr>
	</table>
</form>
</fieldset>
</td>
</tr>
</table>

  <? }?>