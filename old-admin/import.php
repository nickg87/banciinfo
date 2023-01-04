<?  include('a_settings.php');

ini_set('memory_limit', '800M');
ini_set('display_errors', 1);
set_time_limit(0);


$today=date('Y-m-d');
include_once CLASSES_DIR.'class.get.image.php';
  ?>





<? 

if ($_GET[i]==1) {
$table='erad_produse';

if(isset($_POST['s_upload'])) { 
	if(strlen($_FILES['uploadedfile']['tmp_name'])) {
		 $target_path = SITE_DIR."admin/excel/";
		
		$target_path = $target_path . 'import.xls';
		unlink($target_path);
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { 
		
 require_once SITE_DIR."admin/excel/reader.php";
$data = new Spreadsheet_Excel_Reader();

$data->read(SITE_DIR."admin/excel/import.xls");


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
$prd_arr=array();
for ($j = 1; $j <= $data->sheets[0]['numRows']; $j++)
		 {
 $upd_arr=array();
 $whr=''; 
 
   for ($k = 1; $k <= $data->sheets[0]['numCols']; $k++) {
  	 //   $linie[]="'".$data->sheets[0]['cells'][$j+1][$k]."'";

  if($data->sheets[0]['cells'][$j+1][1]<>'') {
  // if($flds_insert[$k]<>'')    
    //$upd_arr[]=$flds_insert[$k].' = '.'"'.addslashes(trim($data->sheets[0]['cells'][$j+1][$k+1])).'"';
	
	 // $cat_arr[$data->sheets[0]['cells'][$j+1][1]]='"'.addslashes(trim($data->sheets[0]['cells'][$j+1][2])).'"';
	 //categorie
	 if(trim($data->sheets[0]['cells'][$j+1][2])<>'') {
	  // $prd_arr[$data->sheets[0]['cells'][$j+1][1]]='"'.addslashes(trim($data->sheets[0]['cells'][$j+1][2])).'"';
	   
	   $ecat=mysql_query_assoc("select id_categorie from erad_categorii where lvl=1 and link='".trim($data->sheets[0]['cells'][$j+1][2])."'");
	   	if(count($ecat)==1) { $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_categorie"]=$ecat[0][id_categorie];
				
				$id_parinte=$ecat[0][id_categorie];
				} else { mysql_query("insert into erad_categorii set link='".trim($data->sheets[0]['cells'][$j+1][2])."', categorie='".trim($data->sheets[0]['cells'][$j+1][2])."', lvl=1  ");
					  $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_categorie"]=get_last_mysql_id2('erad_categorie');
				$id_parinte=$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_categorie"];
				}
 
	 //subcats
	  if($prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_categorie"]<>'') {
	   $escat=mysql_query_assoc("select id_categorie from erad_categorii where lvl=2 and link='".trim($data->sheets[0]['cells'][$j+1][3])."'");
	   	if(count($escat)==1) { $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_categorie"]=$escat[0][id_categorie];
				} else { mysql_query("insert into erad_categorii set link='".trim($data->sheets[0]['cells'][$j+1][3])."', categorie='".trim($data->sheets[0]['cells'][$j+1][3])."', id_parinte='".$id_parinte."', lvl=2  ");
					  $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_categorie"]=get_last_mysql_id2('erad_categorie');
				}
	 		 }


	
	//brands
	 if(trim($data->sheets[0]['cells'][$j+1][4])<>'') {
	 
	   
	   $ebrand=mysql_query_assoc("select id_brand from erad_brands where denumire_brand='".trim($data->sheets[0]['cells'][$j+1][4])."'");
	   	if(count($ebrand)==1) { $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_brand"]=$ebrand[0][id_brand];
				
				 
				} else { mysql_query("insert into erad_brands set denumire_brand='".trim($data->sheets[0]['cells'][$j+1][4])."'   ");
					  $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_brand"]=get_last_mysql_id2('erad_brands');
				 
				}
}

$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_produs"]=trim($data->sheets[0]['cells'][$j+1][1]);

$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["produs"]=trim($data->sheets[0]['cells'][$j+1][5]);
$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["produs_cod"]=trim($data->sheets[0]['cells'][$j+1][6]);
$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["descriere_scurta"]=trim($data->sheets[0]['cells'][$j+1][7]);
$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["descriere"]=trim($data->sheets[0]['cells'][$j+1][8]);
$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["pret"]=trim($data->sheets[0]['cells'][$j+1][9]);
$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["pret_oferta"]=trim($data->sheets[0]['cells'][$j+1][10]);

//moneda

if(trim($data->sheets[0]['cells'][$j+1][11])=="EUR") $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_moneda"] =1;
else if(trim($data->sheets[0]['cells'][$j+1][11])=="USD") $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_moneda"] =2;
else $prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_moneda"] =0;

$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_um"]=trim($data->sheets[0]['cells'][$j+1][12]);
$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["in_curand"]=trim($data->sheets[0]['cells'][$j+1][13]);
$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["greutate"]=trim($data->sheets[0]['cells'][$j+1][14]);

$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["pic_arr"]=trim($data->sheets[0]['cells'][$j+1][15]);
	
 	   
	   }





	 
	// $whr=$flds_insert[0].' = '."'".$data->sheets[0]['cells'][$j+1][1]."'"; 
 	}






			}



 	




///////////pozaaaaaa
	
    $id_produs=$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_produs"];
	$poze=array();
	$poze=explode('|',$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["pic_arr"]);
	

	
	foreach($poze as $pi) {
		
if(trim($pi)<>'') {
	//  $pi."<hr>";
	
 
	
	$next_id=get_next_mysql_id('erad_galerie');							 
   	 $name=$id_produs.'_prd_'.$next_id;
	
	
				$a = explode('.', trim($pi));
				$ext = '.'.strtolower(end($a));
								
							
								
							 $ch = curl_init (str_replace(' ','%20',trim($pi)));
								
								curl_setopt($ch, CURLOPT_HEADER, 0);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
								$rawdata=curl_exec ($ch);
								curl_close ($ch);
					 		//$ext=".jpg";
								
								if(is_file(PICS_DIR_LARGE.$id_produs."_tmp".$ext))	unlink(PICS_DIR_LARGE.$id_produs."_tmp".$ext);
								
							 
						 	$fp = fopen(PICS_DIR_LARGE.$id_produs."_tmp".$ext,'wb');
						 	fwrite($fp, $rawdata);
						 	fclose($fp);
 
 					
								
if( getimagesize(PICS_DIR_LARGE.$id_produs."_tmp".$ext) >0)	{	
								// large
								$dest_x =  PICS_SIZE2;
								 $size = getimagesize(PICS_DIR_LARGE.$id_produs."_tmp".$ext);
						
						if($size[0]>$dest_x or $size[1]>$dest_x) { 
								if($size[0]>$size[1]) {
								$ratio=$size[0]/$dest_x;
								$dest_y=round($size[1]/$ratio);
									resizeToFile (PICS_DIR_LARGE.$id_produs."_tmp".$ext, $dest_x ,$dest_y, PICS_DIR_LARGE.$id_produs."_".$next_id.".jpg", $quality = 90); 
								} else {
								
								$ratio = $size[1] / $dest_x;
								$dest_y = round($size[0] / $ratio);
									resizeToFile (PICS_DIR_LARGE.$id_produs."_tmp".$ext, $dest_y ,$dest_x, PICS_DIR_LARGE.$id_produs."_".$next_id.".jpg", $quality = 90); 
								}
							}	else copy(PICS_DIR_LARGE.$id_produs."_tmp".$ext, PICS_DIR_LARGE.$id_produs."_".$next_id.".jpg");
								 
								 
								
							
							// mediu
							 
								 $dest_x =  PICS_SIZE1;
								 $size = getimagesize(PICS_DIR_LARGE.$id_produs."_tmp".$ext);
						
						
								if($size[0]>$size[1]) {
								$ratio=$size[0]/$dest_x;
								$dest_y=round($size[1]/$ratio);
									resizeToFile (PICS_DIR_LARGE.$id_produs."_tmp".$ext, $dest_x ,$dest_y, PICS_DIR_MEDIU.$id_produs."_".$next_id.".jpg", $quality = 90); 
								} else {
								
								$ratio = $size[1] / $dest_x;
								$dest_y = round($size[0] / $ratio);
									resizeToFile (PICS_DIR_LARGE.$id_produs."_tmp".$ext, $dest_y ,$dest_x, PICS_DIR_MEDIU.$id_produs."_".$next_id.".jpg", $quality = 90); 
								}
	
	
	
	
								// thumb
							 
								 $dest_x =  PICS_SIZE3;
								 $size = getimagesize(PICS_DIR_LARGE.$id_produs."_tmp".$ext);
						
						
								if($size[0]>$size[1]) {
								$ratio=$size[0]/$dest_x;
								$dest_y=round($size[1]/$ratio);
									resizeToFile (PICS_DIR_LARGE.$id_produs."_tmp".$ext, $dest_x ,$dest_y, PICS_DIR_THUMB.$id_produs."_".$next_id.".jpg", $quality = 90); 
								} else {
								
								$ratio = $size[1] / $dest_x;
								$dest_y = round($size[0] / $ratio);
									resizeToFile (PICS_DIR_LARGE.$id_produs."_tmp".$ext, $dest_y ,$dest_x, PICS_DIR_THUMB.$id_produs."_".$next_id.".jpg", $quality = 90); 
								}
								
								
								// small
							 
								 $dest_x =  PICS_SIZE4;
								 $size = getimagesize(PICS_DIR_LARGE.$id_produs."_tmp".$ext);
						
						
								if($size[0]>$size[1]) {
								$ratio=$size[0]/$dest_x;
								$dest_y=round($size[1]/$ratio);
									resizeToFile (PICS_DIR_LARGE.$id_produs."_tmp".$ext, $dest_x ,$dest_y, PICS_DIR_SMALL.$id_produs."_".$next_id.".jpg", $quality = 90); 
								} else {
								
								$ratio = $size[1] / $dest_x;
								$dest_y = round($size[0] / $ratio);
									resizeToFile (PICS_DIR_LARGE.$id_produs."_tmp".$ext, $dest_y ,$dest_x, PICS_DIR_SMALL.$id_produs."_".$next_id.".jpg", $quality = 90); 
								}
	
	
	
	}
	
						if(is_file(PICS_DIR_LARGE.$id_produs."_".$next_id.".jpg"))
							{	 mysql_query("insert into erad_galerie set id_produs='".$id_produs."',prim=1,  pic='".$id_produs."_".$next_id.".jpg"."' ");
									
								}
	
   if(is_file(PICS_DIR_LARGE.$id_produs."_tmp".$ext))	unlink(PICS_DIR_LARGE.$id_produs."_tmp".$ext);
									  flush();
	
	}
	
	
	
	
	}							
	
	//////////////// ENDpozeee



$insss=mysql_query("insert into erad_produse set 

id_produs='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_produs"]."',
id_categorie='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_categorie"]."',
id_brand='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_brand"]."',
produs='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["produs"]."',
produs_cod='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["produs_cod"]."',
descriere_scurta='".addslashes($prd_arr[$data->sheets[0]['cells'][$j+1][1]]["descriere_scurta"])."',
descriere='".addslashes($prd_arr[$data->sheets[0]['cells'][$j+1][1]]["descriere"])."',
pret='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["pret"]."',
pret_oferta='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["pret_oferta"]."',
id_moneda='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_moneda"]."',
id_um='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["id_um='"]."',
in_curand='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["in_curand"]."',
greutate='".$prd_arr[$data->sheets[0]['cells'][$j+1][1]]["greutate"]."' ,
activ=1 

");



//if($j==1) break;
 

 		}
 
//echo "<pre>";
//print_r( $prd_arr); exit; 


 
	
	
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
	 <div style="text-align:center;   float:left">&nbsp;Import produse</div>
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
		<td align="center"> Importa lista produselor </td>
	  </tr>
	  <tr>
		<td height="69" align="center">
	<input type="file" name="uploadedfile"    > 
	<input type="submit" name="s_upload" value="Importa"  class="but">  
	&nbsp;
    <br><br>

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