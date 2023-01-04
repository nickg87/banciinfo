<?
include('settings/s_settings.php');


$select =mysql_query_assoc( "SELECT 
erad_produse.id_categorie as 'id_categorie', 
erad_categorii.link as 'categorie', 
erad_produse.produs as 'produs',
erad_produse.id_produs as 'cod_produs', 
erad_produse.descriere as 'descriere',
erad_galerie.pic as 'link_poza',
erad_produse.produs as 'keyword',
erad_brands.denumire_brand as 'producator',
erad_produse.pret as 'pret',
erad_produse.id_moneda as 'moneda' 

FROM erad_produse 
left join erad_categorii on erad_categorii.id_categorie=erad_produse.id_categorie
left join erad_galerie on erad_galerie.id_produs=erad_produse.id_produs
left join erad_brands on erad_brands.id_brand=erad_produse.id_brand
 "); 
 
 foreach($select as $s) {
 
 echo '"'.base64_encode($s[id_categorie]).'";';
echo '"'.base64_encode($s[categorie]).'";';
echo '"'.base64_encode($s[produs]).'";';
echo '"'.base64_encode($s[cod_produs]).'";';
echo '"'.base64_encode($s[descriere]).'";';
echo '"'.base64_encode(PICS_URL_LARGE.$s[link_poza]).'";';
echo '"'.base64_encode($s["keyword"]).'";';
echo '"'.'";';
echo '"'.'";';
echo '"'.base64_encode($s[producator]).'";';
echo '"'.base64_encode(fx($s[pret])).'";';
echo '"'.base64_encode(($s[moneda]+1)).'";';
echo "\r\n";
 
 }
 
 
 /*
$export = mysql_query($select);
  $fields = mysql_num_fields($export);
 
for ($i = 0; $i < $fields; $i++) {
 // $header .= mysql_field_name($export, $i) . "\t";
}  


while($row = mysql_fetch_row($export)) {
 $c=0;   $line = '';
    foreach($row as $value) {    
	     if ((!isset($value)) OR ($value == "")) {
            $value = "\t";
        } else {
          
         if($c==5) $value = '"' . PICS_URL_LARGE.$value .  "\t"; 
		 
		 if($c==6) {
		 		$xx=explode(' ',$value);
		 		 $value =  implode(',',$xx) .  "\t"; 
		 		}
				
	    if($c==10)  $value =  ($value+1) .  "\t"; 
		if($c==8)  $value =  fx($value) .  "\t"; 
				
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
 */
 
 ?>