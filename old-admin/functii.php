<?


function curs_valoare ($id_moneda){
 $valute=mysql_query_assoc("select curs from erad_curs_monede where id_moneda='".$id_moneda."'"); 
 return $valute[0][curs];
}



function curs_moneda ($id_moneda){
 $valute=mysql_query_assoc("select moneda from erad_curs_monede where id_moneda='".$id_moneda."'"); 

if($id_moneda==0) $valute[0][moneda]='Lei';

 return $valute[0][moneda];
}


function get_judet ($id_judet) {
$rs=mysql_query_assoc("select judet from erad_judete where id_judet = '".$id_judet."'");
return $rs[0][judet];
}



function watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile) {
   list($width, $height) = getimagesize($SourceFile);
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($SourceFile);
   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
   $black = imagecolorallocate($image_p, 0, 0, 0);
    $white = imagecolorallocate($image_p, 255, 255, 255);
   $font = 'COMPCTAL.TTF';
   $font_size = 30;
  $size = getimagesize($SourceFile);  
$dest_x = 55;  
$dest_y = $size[1] -10;  

  
   imagettftext($image_p, $font_size, 0, $dest_x, $dest_y, $black, $font, $WaterMarkText);
    imagettftext($image_p, $font_size, 0, $dest_x-1, $dest_y-1, $white, $font, $WaterMarkText);
   if ($DestinationFile<>'') {
      imagejpeg ($image_p, $DestinationFile, 100);
   } else {
      header('Content-Type: image/jpeg');
      imagejpeg($image_p, null, 100);
   };
   imagedestroy($image);
   imagedestroy($image_p);
};



function watermarkImagePic ($SourceFile, $watermark, $DestinationFile) {
 
$watermark = imagecreatefrompng($watermark);  
$watermark_width = imagesx($watermark);  
$watermark_height = imagesy($watermark);  
$image = imagecreatetruecolor($watermark_width, $watermark_height);  
$image = imagecreatefromjpeg($SourceFile);  
$size = getimagesize($SourceFile);  
$dest_x = $size[0] - $watermark_width ;  
$dest_y = $size[1] - $watermark_height - 5;  
imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 30);  
if ($DestinationFile<>'') {
      imagejpeg ($image, $DestinationFile, 100);
   } else {
      header('Content-Type: image/jpeg');
      imagejpeg($image, null, 100);
   }; 
imagedestroy($image);  
imagedestroy($watermark);  
 }




function transport ($greutate, $taxa_default, $taxa_per_kg){
 

$taxa_add=0;

if ($greutate<=1) $taxa=$taxa_default;

else  {
 for ($i=1;$i<=(ceil($greutate)); $i++) 
 if ($greutate >$i ) $taxa_add+=$taxa_per_kg;
}
	$taxa=$taxa_default+$taxa_add;
return $taxa;
}



function fx ( $x ) { return number_format($x, 2, '.', ''); }

//////////////////////////////////////////////////////////////////

function get_nav_link_by_key($section, $key, $id = '') {
	global $MENU2;
	
	list($i, $j) = explode('_', $section);
	
	$ki = 0;
	foreach($MENU2 as $k => $v) {
		if($i == $ki++) {
			$kj = 0;
			foreach($v as $v2) {
				if($v2[key] == $key) {
					return get_nav_link($MENU2, $i, $kj, $id);
				}
				$kj++;
			}
		}
	}
	
	return '';
}


 function get_nav_link($menu, $i = 0, $j = 0, $id = '') {
	$x = array_keys($menu);
	
	$ki = 0;
	foreach($menu as $k => $v) {
		if($i == $ki++) {
#			return ADMIN_URL . 'nav/' . strtolower($k) . '/' . $menu[$k][$j][sufix] . (strlen($id) ? '-' . $id : '') . '-' . $i . '_' . $j . '.html';
			$kkt1 = $menu[$k][$j][file].'&id_edit='.(strlen($id) ? $id : '');
			$kkt = str_replace('-del.php&id_edit=', '.php&id_del=', $kkt1);
			return SITE_URL . 'admin/main.php?file='.$kkt.'&amp;'.'section='.$i.'_'. $j;
		}
	}
	
	return '';
}

function get_section_url($section, $id) {
	global $MENU2;
	list($i, $j) = explode('_', $section);
	return get_nav_link($MENU2, $i, $j, $id);
}


function str_shape($c, $rc) {
        $c = preg_replace('/[^a-zA-Z0-9]/', $rc, $c);
        $c = preg_replace('/'.$rc.$rc.'+/', $rc, $c);
        return $c;
}
function str_shape2($c) {
	return strtolower(str_shape($c, '_'));
}

function str_shape3($c) {
	return strtolower(str_shape($c, ', '));
}

function get_section_name($section) {
	global $MENU2, $MENU_TRANSL;
	
	$ret = '';
	list($i, $j) = explode('_', $section);

	$ki = 0;
	foreach($MENU2 as $k => $v) {
		if($i == $ki++) {
			$ret .= $MENU_TRANSL[$k];

			$kj = 0;
			foreach($v as $v2) {
				if($kj++ == $j) {
					$ret .= ' &raquo; ' . $v2[titlu];
					break 2;
				}
			}
		}
	}
	return $ret;
}
 
function get_section_file($section) {
	global $MENU2, $MENU_TRANSL;
	
	$ret = '';
	list($i, $j) = explode('_', $section);

	$ki = 0;
	foreach($MENU2 as $k => $v) {
		if($i == $ki++) {
		 

			$kj = 0;
			foreach($v as $v2) {
				if($kj++ == $j) {
					$ret .= $v2['file'];
					break 2;
				}
			}
		}
	}
	return $ret;
}
 

//////////////////////////////////////////////////////////////// GENERAL PURPOSE

function categorie_produs($id_categorie, $tabela_categorie) {
$cat=mysql_query_assoc("SELECT * from $tabela_categorie where id_categorie='".$id_categorie."'");

return $cat[0][link];

}

//define('MYSQL_A', 'localhost');
//define('MYSQL_U', 'root');
//define('MYSQL_P', 'Prometeu1234#');
//define('MYSQL_DB', 'banci_info');
//mysqli_connect(host, username, password, dbname, port, socket)

function connectdb($a, $u, $p, $db) {
	$conn = mysqli_connect($a, $u, $p, $db);
	if(!$conn) { echo 'could not connect to mysql.'; exit; } else { /*var_dump($conn);*/ }
	if(!mysqli_select_db($conn, $db)) { echo 'could not select database.'; exit; }
}

function get_next_mysql_id($tabel){
 $conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
 $result=mysqli_query($conn,"show table status like '$tabel'");
 $row=mysqli_fetch_array($result);
 return $row["Auto_increment"];
}

function get_last_mysql_id($tabel){
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
 $result=mysqli_query($conn,"select distinct last_insert_id() from $tabel");
 $row=mysqli_fetch_row($result);
 return $row[0];
}

function luna_ro() {
	$luna[]="Ianuarie";
	$luna[]="Februarie";
	$luna[]="Martie";
	$luna[]="Aprilie";
	$luna[]="Mai";
	$luna[]="Iunie";
	$luna[]="Iulie";
	$luna[]="August";
	$luna[]="Septembrie";
	$luna[]="Octombrie";
	$luna[]="Noiembrie";
	$luna[]="Decembrie";
	return $luna;
}

function luna_en() {
	$luna[]="January";
	$luna[]="February";
	$luna[]="March";
	$luna[]="April";
	$luna[]="May";
	$luna[]="June";
	$luna[]="July";
	$luna[]="August";
	$luna[]="September";
	$luna[]="October";
	$luna[]="November";
	$luna[]="December";
	return $luna;
}


function nrTOtext($v) {
	if ($v==0) $cv="zero"; 
	if ($v==1) $cv="unu";
	if ($v==2) $cv="doi";
	if ($v==3) $cv="trei"; 
	if ($v==4) $cv="patru";
	if ($v==5) $cv="cinci";
	if ($v==6) $cv="sase"; 
	if ($v==7) $cv="sapte";
	if ($v==8) $cv="opt";
	if ($v==9) $cv="noua";
	return $cv;
}

 
function show_date_ro($c){ //$d -> mysql
	$d = substr($d, 0, 10);
	$d = explode('-', $c);
	$day = $d[2];
	$l = luna_ro();
	$month = substr($l[$d[1]-1], 0, 14);
	$year = $d[0];
	return $day.' '.$month.' '.$year;
}

function show_date_en($c){ //$d -> mysql
	$d = explode('-', $c);
	$day = $d[2];
	$l = luna_en();
	$month = substr($l[$d[1]-1], 0, 3);
	$year = $d[0];
	return $day.' '.$month.' '.$year;
}

function show_date_en2($c){ //$d -> mysql
	$d = explode('-', $c);
	$day = $d[2];
	$l = luna_en();
	$month = $l[$d[1]-1];
	$year = $d[0];
	return $day.' '.$month.' '.$year;
}

function send_mail($catre, $titlu, $text, $from_name, $from_address) {
	$headers  = "From: $from_name <$from_address>\n";
	$headers .= "Return-Path: <$from_address>\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\n";
	$x = mail($catre, $titlu, $text, $headers);
	if($x) return 1;
	else return 0;
}

function selected($a,$b) {
 if($a==$b) return " selected";
 else return "";
}

function checked($a,$b) {
 if($a==$b) return "checked";
 else return "";
}

function quotes($c){
	if(get_magic_quotes_gpc()==1) return $c;
	else return addslashes($c);
}

function update_order($tabel,$pri,$ord,$extra) {
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
	$rs=mysqli_query($conn,"select $pri from $tabel where $ord<>'' $extra order by $ord");
	$k=1;
	while($r=mysqli_fetch_row($rs)) {
		mysqli_query($conn,"update $tabel set $ord='$k' where $pri='$r[0]' $extra");
		$k++;
	}
	
	$rs=mysqli_query($conn, "select $pri from $tabel where $ord='' $extra order by $pri");
	while($r=mysqli_fetch_row($rs)) {
		mysqli_query($conn,"update $tabel set $ord='$k' where $pri='$r[0]' $extra");
		$k++;
	}
}

function mysqli_result($result, $iRow, $field = 0)
{
	if(!mysqli_data_seek($result, $iRow))
		return false;
	if(!($row = mysqli_fetch_array($result)))
		return false;
	if(!array_key_exists($field, $row))
		return false;
	return $row[$field];
}

function move_order($tabel,$pri,$ord,$id_move,$tip_move,$extra) {
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
	$extra1=substr($extra,4);
	$extra1=(strlen($extra1)>0)?$extra1:"1";
	$rs=mysqli_query($conn,"select count($pri) from $tabel where $extra1");
	$nr=mysqli_result($rs,0,0);

	$rs=mysqli_query($conn,"select $ord from $tabel where $pri='$id_move' $extra");
	$r=mysqli_fetch_row($rs);
	$o=$r[0];
	$up=$o-1;
	$down=$o+1;
	if($tip_move=='up' && $o!=1) {
		mysqli_query($conn,"update $tabel set $ord='$o' where $ord='$up' $extra");
		mysqli_query($conn,"update $tabel set $ord='$up' where $pri='$id_move' $extra");
	}
	if($tip_move=='down' && $o!=$nr) {
		mysqli_query($conn,"update $tabel set $ord='$o' where $ord='$down' $extra");
		mysqli_query($conn,"update $tabel set $ord='$down' where $pri='$id_move' $extra");
	}
}


function new_order($tabel,$pri,$ord, $id_item, $new_move, $extra) {
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
	$old=mysqli_query($conn,"select $ord from $tabel where $pri=$id_item");
	$rold=mysqli_fetch_row($old);
	$old=$rold[0];
	
	if($new_move<$old) {
		 mysqli_query($conn,"update $tabel set $ord=0 where $pri=$id_item");
		$rs=mysqli_query($conn,"select $pri from $tabel where $ord>=$new_move $extra and $ord>0 and $ord<=$old order by $ord");
		 $k=1;
		
		 $o=$new_move;
		while($r=mysqli_fetch_row($rs)) {
		   
			$up=$o+1;
			 mysqli_query($conn, "update $tabel set $ord='$up' where $pri=$r[0] $extra ");
			$k++;
			$o++;
		}
	} else {
		 mysqli_query($conn,"update $tabel set $ord=0 where $pri=$id_item");
	$rs=mysqli_query($conn,"select $pri from $tabel where $ord<=$new_move $extra and $ord>$old order by $ord desc");
		 $k=1;
		
		 $o=$new_move;
		while($rx=mysqli_fetch_row($rs)) {
		   
			$dn=$o-1;
			 mysqli_query($conn, "update $tabel set $ord='$dn' where $pri=$rx[0] ");
			$k++;
			$o--;
		}
	}		
	
	
	mysqli_query($conn, "update $tabel set $ord='$new_move' where $pri=$id_item");
	
//	mysql_query("update $tabel set $ord='$up' where $pri='$rsp' $extra");
	 
}

function js_redirect($url) {
	return '<script language="javascript">document.location.href="'.$url.'";</script>';
}

function valid_email($email){
	if(strlen($email) > 0) {
		$m = array();
		eregi ("(^[a-z0-9\.\_-]{1,})\@([a-z0-9\.-]{1,})\.([a-z]{2,3})$", $email, $m);
		if($m[0] != $email) return false;
		else return true;
	} else {
		return false;
	}
}

function valid_date($d) {
	if(strlen($d)) {
		$m = array();
		eregi ('^[0-9]{4}-[0-9]{2}-[0-9]{2}$', $d, $m);
		if($m[0] != $d) return false;
		else return true;
	} else {
		return false;
	}
}


function rand_pass($length) {
	srand(date("s"));
	$possible_charactors = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$string = "";
	while(strlen($string)<$length) {
		$string .= substr($possible_charactors,(rand()%(strlen($possible_charactors))),1);
	}
	return($string);
}


//Mysql

function mysql_esc($c) {
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
	return mysqli_real_escape_string($conn,$c);
}


function mysql_query_assoc($sql){
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
	$res = mysqli_query($conn, $sql);
	if($res){
		$ret = array();
		while($row = mysqli_fetch_assoc($res))
			$ret[] = $row;
		mysqli_free_result($res);
	}else{
		$ret = NULL;
	}
	if(DEBUG && mysqli_errno($conn)){
		echo mysqli_error($conn);
	}
	return $ret;
}

function mysql_query_rows($sql){
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
	$res = mysqli_query($conn, $sql);
	if($res){
		$ret = array();
		while($row = mysqli_fetch_row($res))
			$ret[] = $row;
		mysqli_free_result($res);
	}else{
		$ret = NULL;
	}
	if(DEBUG && mysqli_errno($conn)){
		echo mysqli_error($conn);
	}
	return $ret;
}

function mysql_query_row($sql){
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
	$res = mysqli_query($conn, $sql);
	if($res){
		if($row = mysqli_fetch_assoc($res))
			$ret = $row;
		mysqli_free_result($res);
	}else{
		$ret = NULL;
	}

	if(DEBUG && mysqli_errno($conn)){
		echo mysqli_error($conn);
	}
	return $ret;
}

function mysql_query_scalar($sql){
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
	$res = mysqli_query($conn, $sql);
	if($res){
		$row = mysqli_fetch_row($res);
		$ret = $row[0];
	}else{
		$ret = NULL;
	}
	if(DEBUG && mysqli_errno($conn)){
		echo mysqli_error($conn);
	}
	return $ret;
}

function array_add_k($a, $new_key, $expr) {
	$v = array();
	for($i = 0; $i < count($new_key); $i++) {
		$x = explode('[[', $expr[$i]);
		if(count($x) == 1) {
			$v[$i] = $expr[$i];
		} else {
			$m = array();
			$p = '`\[\[([^\]\[]+)\]\]`';
			preg_materad_all($p, $expr[$i], $m, PREG_PATTERN_ORDER);
			//print_r($m);
		}
		for($j = 0; $j < count($a); $j++) {
			$e = '';
			$s = array();
			$r = array();
			for($k = 0; $k < count($m[1]); $k++) {
				$s[] = '[['.$m[1][$k].']]';
				$r[] = $a[$j][$m[1][$k]];
			}
			$a[$j][$new_key[$i]] = str_replace($s, $r, $expr[$i]);
		}
	}
	return $a;
}


// Pictures

function verifica_poza($nume, $dim) {
	$valid = 1;
	if( ($_FILES[$nume]['size'] <= $dim) && ($_FILES[$nume]['size'] > 0) ) {
		$imtype=$_FILES[$nume]['type'];
		$imtemp=$_FILES[$nume]['tmp_name'];
		if($_FILES['$nume']['size'] > $dim) {
			$error_message = "The picture is too large";
			$valid = 0;
		} else {
			if($imtype == "image/pjpeg" || $imtype == "image/jpeg") {
				$extension2 = "jpg";
			} elseif($imtype == "image/gif" ) {
			   $extension2 = "gif";
			}elseif($imtype == "image/png" ) {
			   $extension2 = "png";
			} else {
				$error_message="Please upload images with the extension .jpg or .gif only.";
				$valid=0;
			}
		}
	}
	else {
		$valid = 0;
		$error_message = "not good";
	}
	return $valid;
}


function resizeToFile ($sourcefile, $dest_x, $dest_y, $targetfile) {
	$picsize = getimagesize("$sourcefile");
	$source_x  = $picsize[0];
	$source_y  = $picsize[1];
	$a = explode('.', $sourcefile);
	$ext = strtolower(end($a));
	if ($ext == 'jpg' || $ext == 'jpeg') {$source_id  = @imagecreatefromjpeg("$sourcefile");} 
	else if ($ext == 'png') {    $source_id  = @imagecreatefrompng("$sourcefile");
										 } 
	                                 else if ($ext == 'gif') {$source_id  = @imagecreatefromgif("$sourcefile");}
									       else $source_id  = @imagecreatefrompng('images/users/not_available.png');
	

	
	
	
	
	///	
if ($ext == 'png') {
 
 
$target_id=imagecreatetruecolor($dest_x, $dest_y);
imagealphablending($target_id , false);
imagesavealpha($target_id , true);
$target_pic=imagecopyresampled($target_id,$source_id,
	                              0,0,0,0,
	                              $dest_x,$dest_y,
	                              $source_x,$source_y);
 

// saving
imagealphablending($target_id , false);
imagesavealpha($target_id , true);
imagepng ( $target_id,"$targetfile" );

}
///
	
	if ($ext == 'jpg' || $ext == 'jpeg') {
	$target_id=imagecreatetruecolor($dest_x, $dest_y);
	$target_pic=imagecopyresampled($target_id,$source_id,
	                              0,0,0,0,
	                              $dest_x,$dest_y,
	                              $source_x,$source_y);
	imagejpeg ($target_id,"$targetfile", 90);
	
	 	}
	
	
	
	return true;
}


function get_extension($nume) {
	$imtype = $_FILES[$nume]['type'];
	if ($imtype == "image/pjpeg" || $imtype == "image/jpeg" ) 
		$ext = "jpg";
	elseif($imtype == "image/gif" ) 
		$ext = "gif";
	 elseif($imtype == "image/png" ) 
		$ext = "png";
	return $ext;
}




function upload_poza2($nume_poza,$dir_thumb,$dir_large,$width_thumb,$width_large,$db_tabel,$db_camp,$id_tabel,$poza_hdd) {
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
//de adaugat aici verificari suplimentare pentru parametrii care intra in functie ---->>> intr-un week- end liber
 $valid=1;
 if( verifica_poza( $nume_poza, 4000000 )==0 ) $valid=0;
	if($valid==1) 
	 {
	  $size=getimagesize($_FILES[$nume_poza]['tmp_name']);
	  $ok_dim=0; $redimens=1;
	  if( $size[0]<$width_large ) $redimens=0;
	  if($redimens==0) 
	     { 
		  $ext=get_extension($nume_poza);
		  $dir=$dir_large; $last_id=get_last_mysql_id($db_tabel);
		  $nume_poza_hdd=$last_id."_".$poza_hdd.".".$ext;
		  $uploadfile=$dir.$nume_poza_hdd;
		  if(move_uploaded_file($_FILES[$nume_poza]['tmp_name'], $uploadfile))
		   { $pic_add=mysqli_query($conn," update $db_tabel set $db_camp='$nume_poza_hdd' where $id_tabel='$last_id' ");
		    
			
			 if( $size[0]<=$width_thumb and $size[1]<=$width_thumb ) {
			 	$dir=$dir_thumb;$uploadfile2=$dir.$nume_poza_hdd;
				copy($uploadfile, $uploadfile2);
			 		} else {
			$dir=$dir_thumb;$uploadfile2=$dir.$nume_poza_hdd;
			copy($uploadfile, $uploadfile2);
		    $dest_x=$width_thumb;
			$size=getimagesize($uploadfile2);
			
			if($size[0]>$size[1]) {
		
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
			resizeToFile($uploadfile2, $dest_x, $dest_y, $uploadfile2);
			
		 } else { 
		
		$ratio = $size[1] / $dest_x;
 	$dest_y = round($size[0] / $ratio);   
	resizeToFile($uploadfile2, $dest_y, $dest_x, $uploadfile2);
				 }
			
			
					}
		     }
		  }
      else
	     {
		  $ext=get_extension($nume_poza);
		  $dir=$dir_large; $last_id=get_last_mysql_id($db_tabel);
		  $nume_poza_hdd=$last_id."_".$poza_hdd.".".$ext;
		  $uploadfile=$dir.$nume_poza_hdd;
		  if(move_uploaded_file($_FILES[$nume_poza]['tmp_name'], $uploadfile))
		   {
		    $dest_x=$width_large;
			$size=getimagesize($uploadfile);
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
			resizeToFile($uploadfile, $dest_x, $dest_y, $uploadfile);
			$pic_add=mysqli_query($conn," update $db_tabel set $db_camp='$nume_poza_hdd' where $id_tabel='$last_id' ");
			$dir=$dir_thumb;$uploadfile2=$dir.$nume_poza_hdd;
			copy($uploadfile, $uploadfile2);
		    $dest_x=$width_thumb;
			$size=getimagesize($uploadfile2);
			
				if($size[0]>$size[1]) {
		
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
			resizeToFile($uploadfile2, $dest_x, $dest_y, $uploadfile2);
			
			} else { 
		
 	$ratio = $size[1] / $dest_x;
 	$dest_y = round($size[0] / $ratio);   
	resizeToFile($uploadfile2, $dest_y, $dest_x, $uploadfile2);
				 }
			
			
			}
		  }
	  }
}




function upload_poza2_mod($nume_poza,$dir_thumb,$dir_large,$width_thumb,$width_large, $height_thumb, $height_large,$db_tabel,$db_camp,$id_tabel,$poza_hdd, $id) {
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
//de adaugat aici verificari suplimentare pentru parametrii care intra in functie ---->>> intr-un week- end liber

    $valid=1;
    if(verifica_poza( $nume_poza, 4000000 )==0 ) $valid=0;
    if($valid==1) {

        $ext=get_extension($nume_poza);
        $last_id=get_last_mysql_id($db_tabel);
        $nume_poza_hdd=$id."_".$poza_hdd.".".$ext;
        
        $uploadfile_thumb = $dir_thumb.$nume_poza_hdd;
        $uploadfile_large = $dir_large.$nume_poza_hdd;
        
        $temp_location = $dir_thumb.$_FILES[$nume_poza]['name'];

        if(move_uploaded_file($_FILES[$nume_poza]['tmp_name'], $temp_location)) {

            $pic_add = mysqli_query($conn,'UPDATE '.$db_tabel.' SET '.$db_camp.' = "'.$nume_poza_hdd.'" WHERE '.$id_tabel.' = "'.$id.'" ');
            
            imageresize($temp_location, $uploadfile_thumb, $width_thumb, $height_thumb);
            imageresize($temp_location, $uploadfile_large, $width_large, $height_large);
            
            if(is_file($temp_location)) unlink($temp_location);

        }
    }
}



function upload_poza2_peste($nume_poza,$dir_thumb,$dir_large,$width_thumb,$width_large,$db_tabel,$db_camp,$id_tabel,$poza_hdd,$id_modif) {
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
//de adaugat aici verificari suplimentare pentru parametrii care intra in functie ---->>> intr-un week- end liber
 $valid=1;
 if( verifica_poza( $nume_poza, 4000000 )==0 ) $valid=0;
	if($valid==1) 
	 {
	  $size=getimagesize($_FILES[$nume_poza]['tmp_name']);
	  $ok_dim=0; $redimens=1;
	  if( $size[0]<=$width_large ) $redimens=0;
	  if($redimens==0) 
	     { 
		  $ext=get_extension($nume_poza);
		  $dir=$dir_large; $last_id=$id_modif;
		  $nume_poza_hdd=$last_id."_".$poza_hdd.".".$ext;
		  $uploadfile=$dir.$nume_poza_hdd;
		  if(move_uploaded_file($_FILES[$nume_poza]['tmp_name'], $uploadfile))
		   { $pic_add=mysqli_query($conn," update $db_tabel set $db_camp='$nume_poza_hdd' where $id_tabel='$last_id' ");
		     if( $size[0]<=$width_thumb ) {
			 	$dir=$dir_thumb;$uploadfile2=$dir.$nume_poza_hdd;
				copy($uploadfile, $uploadfile2);
			 		} else {
			$dir=$dir_thumb;$uploadfile2=$dir.$nume_poza_hdd;
			copy($uploadfile, $uploadfile2);
		    $dest_x=$width_thumb;
			$size=getimagesize($uploadfile2);
				if($size[0]>$size[1]) {
		
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
			resizeToFile($uploadfile2, $dest_x, $dest_y, $uploadfile2);
			
			} else { 
		
		$ratio = $size[1] / $dest_x;
 	$dest_y = round($size[0] / $ratio);   
	resizeToFile($uploadfile2, $dest_y, $dest_x, $uploadfile2);
				 }
				 
					}
		     }
		  }
      else
	     {
		  $ext=get_extension($nume_poza);
		  $dir=$dir_large; $last_id=$id_modif;
		  $nume_poza_hdd=$last_id."_".$poza_hdd.".".$ext;
		  $uploadfile=$dir.$nume_poza_hdd;
		  if(move_uploaded_file($_FILES[$nume_poza]['tmp_name'], $uploadfile))
		   {
		    $dest_x=$width_large;
			$size=getimagesize($uploadfile);
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
			resizeToFile($uploadfile, $dest_x, $dest_y, $uploadfile);
			$pic_add=mysqli_query($conn," update $db_tabel set $db_camp='$nume_poza_hdd' where $id_tabel='$last_id' ");
			$dir=$dir_thumb;$uploadfile2=$dir.$nume_poza_hdd;
			copy($uploadfile, $uploadfile2);
		    $dest_x=$width_thumb;
			$size=getimagesize($uploadfile2);
		
			if($size[0]>$size[1]) {
		
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
			resizeToFile($uploadfile2, $dest_x, $dest_y, $uploadfile2);
			
			} else { 
		
		$ratio = $size[1] / $dest_x;
 	$dest_y = round($size[0] / $ratio);   
	resizeToFile($uploadfile2, $dest_y, $dest_x, $uploadfile2);
				 }
		
			}
		  }
	  }
}

function upload_poza3($nume_poza,$dir_thumb,$dir_large,$x_thumb,$y_thumb,$db_tabel,$db_camp,$id_tabel,$poza_hdd) {
	$conn = mysqli_connect(MYSQL_A, MYSQL_U, MYSQL_P, MYSQL_DB);
// poza mare neshimbata rezolutia
// thumbnail creat la dimensiunile date
	if(verifica_poza($nume_poza, 1000000 ) != 0) {
		$size = getimagesize($_FILES[$nume_poza]['tmp_name']);
		$ok_dim = 0;
		$ext = get_extension($nume_poza);
		$dir = $dir_large;
		$last_id = get_last_mysql_id($db_tabel);
		//$nume_poza_hdd = $last_id."_".$poza_hdd.".".$ext; // NUME POZA PT. SALVARE
		$nume_poza_hdd = $poza_hdd.$last_id.'.'.$ext;
		$uploadfile = $dir.$nume_poza_hdd;
		if(move_uploaded_file($_FILES[$nume_poza]['tmp_name'], $uploadfile)) {
			$pic_add = mysqli_query($conn,"UPDATE $db_tabel SET $db_camp='$nume_poza_hdd' WHERE $id_tabel='$last_id'");
	   	if($size[0] <= $x_thumb) {
	 			$dir = $dir_thumb;
	 			$uploadfile2 = $dir.$nume_poza_hdd;
				copy($uploadfile, $uploadfile2);
	 		} else {
				$dir = $dir_thumb;
				$uploadfile2 = $dir.$nume_poza_hdd;
				copy($uploadfile, $uploadfile2);
	   		
				resizeToFile($uploadfile2, $x_thumb, $y_thumb, $uploadfile2);
			}
		}
	}
	if(is_file($dir_thumb.$nume_poza_hdd) && is_file($dir_large.$nume_poza_hdd))
		return true;
	else
		return false;
}


function printr($a) {
	echo '<pre>';
	print_r($a);
	echo '</pre>';
}

function array_empty($a) {
	if(!is_array($a))
		return true;
	elseif(empty($a))
		return true;
	else
		return false;
}


////////////////////////////////////////////////////////////////  

 

 
  function get_cat_list_rec($cat_table, $fld_id_parent, $fld_pri, $fld_cat_name, $fld_ord, &$cat, $id_parentv = 0, $lvl = 0) {
	$cat = array_empty($cat) ? array() : $cat;
	
	
	$c0 = mysql_query_assoc("SELECT * FROM $cat_table WHERE $fld_id_parent = $id_parentv  ORDER BY $fld_ord");
	
	
	for($i = 0; $i < count($c0); $i++) {
		$cat[count($cat)] = $c0[$i];
		//$cat[count($cat) - 1][$fld_cat_name] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;', $lvl > 0 ? $lvl + 1 : $lvl) . $cat[count($cat) - 1][$fld_cat_name];
		$cat[count($cat) - 1][$fld_cat_name] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $c0[$i][lvl]-1) .$cat[count($cat) - 1][$fld_cat_name];
		
		
		$c1 = mysql_query_assoc("SELECT * FROM $cat_table WHERE $fld_id_parent = '".$c0[$i][$fld_pri]."' ORDER BY $fld_ord asc");
		
		
		for($j = 0; $j < count($c1); $j++) {
			$c1[$j][$fld_cat_name] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',  $c1[$j][lvl]-1) . $c1[$j][$fld_cat_name];
			$cat[count($cat)] = $c1[$j];
			get_cat_list_rec($cat_table, $fld_id_parent, $fld_pri, $fld_cat_name, $fld_ord, $cat, $c1[$j][$fld_pri], $lvl + 1);
		}
	}
	return $cat;
}


function get_cat_children($cat_table, $fld_id_parent, $fld_pri, $fld_cat_name, $fld_ord, $cat, $id_categoriev = 0, $lvl = 0) {
	$cat = array_empty($cat) ? array() : $cat;
	
	
	 $c0 = mysql_query_assoc("SELECT * FROM $cat_table WHERE $fld_pri = $id_categoriev  ORDER BY $fld_ord");
	
	
	 if (count($c0)>0) {
		$cat[count($cat)] = $c0[0];
	
		//$cat[count($cat) - 1][$fld_cat_name] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;', $lvl > 0 ? $lvl + 1 : $lvl) . $cat[count($cat) - 1][$fld_cat_name];
		$cat[count($cat) ][$fld_cat_name] = str_repeat('', $c0[0][lvl]+1) .$cat[count($cat) ][$fld_cat_name];
		
		
		$c1 = mysql_query_assoc("SELECT * FROM $cat_table WHERE $fld_pri = '".$c0[0][id_parinte]."' ORDER BY $fld_ord asc");
		
		 if (count($c1)>0) {
	 
			$c1[0][$fld_cat_name] = str_repeat('',  $c1[0][lvl]+1) . $c1[0][$fld_cat_name];
			$cat[count($cat)] = $c1[0];
			get_cat_children($cat_table, $fld_id_parent, $fld_pri, $fld_cat_name, $fld_ord, $cat, $c1[0][id_parinte], $lvl - 1);
		
		}
	 }
	 
	return array_reverse($cat);
}


/////////////////////////////////////////////////////////////////  

function url_shape($c, $length) {

$patterns = array();
 $patterns[4] = '/([^A-Za-z0-9_]+)/';
// $patterns[5] = '/__/';

$replacements = array();
 $replacements[4] = '-';
 //$replacements[5] = '-';

 $c = preg_replace($patterns, $replacements, trim($c));
 
 $last = $c[strlen($c)-1]; 
 if($last=='-') $c=rtrim($c,'-');
 
 $c = substr($c, 0, $length);
	return $c;
}


function url_shape2($c, $length) {
	$c = preg_replace('/[^a-zA-Z0-9.]/', '_', $c);
	$c = preg_replace('/__+/', '_', $c);
	$c = substr($c, 0, $length);
	return $c;
}

function show_text($c) {
	$s = array('&amp;', '&gt;', '&lt;');
	$r = array('&', '>', '<');
	$c = str_replace($s, $r, $c);
	$c = html_entity_decode($c);
	return $c;
}



function chk_empty($c) {
	if(!strlen($c))
		return 0;
		else return 1;
}

function chk_email($c) {
	if(!valid_email($c))
		return 0;
		else return 1;
}

function chk_user($c,  $table) {
$res=mysql_query_assoc("SELECT email from {$table} where email LIKE '".$c."'");
	if(count($res)>0)
		return 0;
		else return 1;
}

function chk_date($c, $fn, $er) {
	if(!valid_date($c))
		$er[] = $fn . ' &raquo; camp invalid';
}

function chk_number($c, $fn, $er) {
	if(!valid_number($c))
		$er[] = $fn . ' &raquo; camp invalid';
}

function chk_cnp($c, $fn, $er) {
	if(!valid_cnp($c))
		return 0;
		else return 1;
}

function valid_cnp($c) {
	$y = substr($c, 1, 2);
	$y = $y[0] == '0' ? '20' . $y : '19' . $y;
	$m = substr($c, 3, 2);
	$d = substr($c, 5, 2);
	
	if(strlen($c) == 13)
		if(valid_number($c))
			if($c[0] == '1' || $c[0] == '2')
				if(checkdate($m, $d, $y))
					return true;
	return false;
}

function valid_number($number){
	if(strlen($number) > 0) {
		$m = array();
		eregi ("^([0-9]+)$", $number, $m);
		if($m[0] != $number) return false;
		else return true;
	} else {
		return false;
	}
}


function get_pret_livrare($id_judet, $data) {
	$pret = 0;
	$pret += $id_judet == 10 ? 0 : PRET_LIVRARE_TARA; # Bucuresti
	$x = explode('-', $data);
	$dw = date('w', mktime(0, 0, 0, $x[1], $x[2], $x[0]));
	return $pret += (int)$dw  === 0 || $dw == 6 ? PRET_LIVRARE_WEEKEND : 0;
}
function get_proforma($pid) {
	return ($pid > 0) ? $pid + PROFORMA_INC : '';
}


?>
