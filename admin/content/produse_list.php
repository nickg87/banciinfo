 <? include('menu_sub.php'); ?> 

<?
$z=explode('php?',$_SERVER['REQUEST_URI']); 

  $_SESSION[url]=$z[1];


if ($_POST[sterge]<>'' and $_POST[sterge]==1 and count($_POST['id_produsm']>0) ) {
 
 foreach ($_POST['id_produsm'] as $p=>$val) {
 
 
 $pics=mysql_query_assoc("select * from erad_galerie where id_produs='".$val."'");

for($j=0; $j<count($pics); $j++){
 if(is_file(PICS_DIR_THUMB . $pics[$j]["pic"])) 
			unlink(PICS_DIR_THUMB . $pics[$j]["pic"]);
if(is_file(PICS_DIR_LARGE . $pics[$j]["pic"])) 
		unlink(PICS_DIR_LARGE . $pics[$j]["pic"]);
if(is_file(PICS_DIR_MEDIU . $pics[$j]["pic"])) 
		unlink(PICS_DIR_MEDIU . $pics[$j]["pic"]);
if(is_file(PICS_DIR_SMALL . $pics[$j]["pic"])) 
		unlink(PICS_DIR_SMALL . $pics[$j]["pic"]);
}
 

$files=mysql_query_assoc("select * from erad_fisiere where id_produs='".$val."'");
for($j=0; $j<count($files); $j++){
 if(is_file(FILE_DIR . $files[$j]["file"])) 
			unlink(FILE_DIR . $files[$j]["file"]);
 
}
 mysql_query("DELETE FROM erad_fisiere WHERE id_produs = '".$val."'");
 mysql_query("DELETE FROM erad_galerie WHERE id_produs = '".$val."'");
 mysql_query("DELETE FROM erad_produse WHERE id_produs = '".$val."'");
  mysql_query("DELETE FROM erad_produse_tematici WHERE id_produs = '".$val."'");
  mysql_query("DELETE FROM erad_produse_valori WHERE id_produs = '".$val."'");
	update_order('erad_produse', 'id_produs', 'ord', "AND id_categorie = '".$_POST['id_categorie']."'");
	update_order('erad_produse', 'id_produs', 'ord_oferta',' and oferta_speciala=1' ); 
 
 
 
 }
 
 
 echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_POST['id_categorie'].'&id_brand='.$_POST[id_brand]);
}

update_order('erad_produse', 'id_produs', 'ord_oferta',' and oferta_speciala=1' );  

  //update_order('erad_produse', 'id_produs', 'ord',' and oferta_speciala=1' ); 
 



if ($_POST[id_categoriem]<>'' and count($_POST['id_produsm']>0)) {
 
foreach ($_POST['id_produsm'] as $p=>$val) mysql_query("UPDATE erad_produse SET id_categorie = '".$_POST[id_categoriem]."' WHERE id_produs = '".$val."'");

 echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_POST[id_categoriem].'&id_brand='.$_POST[id_brand]);
}

if ($_POST[activ]<>''  and count($_POST['id_produsm']>0)) {
 foreach ($_POST['id_produsm'] as $p=>$val)
mysql_query("UPDATE erad_produse SET activ = '".$_POST[activ]."' WHERE id_produs = '".$val."'");
	echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_POST[id_categorie].'&id_brand='.$_POST[id_brand]);

}


if ($_POST[stoc]<>''  and count($_POST['id_produsm']>0)) {
 foreach ($_POST['id_produsm'] as $p=>$val)
mysql_query("UPDATE erad_produse SET in_curand = '".$_POST[stoc]."' WHERE id_produs = '".$val."'");
	echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_POST[id_categorie].'&id_brand='.$_POST[id_brand]);
}






$id_brand=$_GET[id_brand];
$id_categorie=$_GET[id_categorie]; 
 //if ($id_categorie<>'') unset ($_SESSION[of]);


if(isset($_GET['new_move']) && isset($_GET['id_move']) and $_GET["id_categorie"]<>'') {
	 new_order('erad_produse', 'id_produs', 'ord', $_GET['id_move'], $_GET['new_move'], ' and id_categorie='.$id_categorie);
	 // update_order('erad_produse', 'id_produs', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_GET["id_categorie"]);
}

if(isset($_GET['new_move']) && isset($_GET['id_move']) and $_SESSION[of]==1) {
	 new_order('erad_produse', 'id_produs', 'ord_oferta', $_GET['id_move'], $_GET['new_move'], ' and oferta_speciala=1');
	 // update_order('erad_produse', 'id_produs', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_GET["id_categorie"]);
}


 
if(is_numeric($_GET['id_produs']) && $_GET['act'] == 'del_produs') {
	//delete
$pics=mysql_query_assoc("select * from erad_galerie where id_produs='".$_GET[id_produs]."'");

for($j=0; $j<count($pics); $j++){
 if(is_file(PICS_DIR_THUMB . $pics[$j]["pic"])) 
			unlink(PICS_DIR_THUMB . $pics[$j]["pic"]);
if(is_file(PICS_DIR_LARGE . $pics[$j]["pic"])) 
		unlink(PICS_DIR_LARGE . $pics[$j]["pic"]);
if(is_file(PICS_DIR_MEDIU . $pics[$j]["pic"])) 
		unlink(PICS_DIR_MEDIU . $pics[$j]["pic"]);
if(is_file(PICS_DIR_SMALL . $pics[$j]["pic"])) 
		unlink(PICS_DIR_SMALL . $pics[$j]["pic"]);
}
 

$files=mysql_query_assoc("select * from erad_fisiere where id_produs='".$_GET[id_produs]."'");
for($j=0; $j<count($files); $j++){
 if(is_file(FILE_DIR . $files[$j]["file"])) 
			unlink(FILE_DIR . $files[$j]["file"]);
 
}
 mysql_query("DELETE FROM erad_fisiere WHERE id_produs = '".$_GET['id_produs']."'");
 mysql_query("DELETE FROM erad_galerie WHERE id_produs = '".$_GET['id_produs']."'");
 mysql_query("DELETE FROM erad_produse WHERE id_produs = '".$_GET['id_produs']."'");
  mysql_query("DELETE FROM erad_produse_tematici WHERE id_produs = '".$_GET['id_produs']."'");
 mysql_query("DELETE FROM erad_produse_valori WHERE id_produs = '".$val."'"); 
	update_order('erad_produse', 'id_produs', 'ord', "AND id_categorie = '".$_GET['id_categorie']."'");
	update_order('erad_produse', 'id_produs', 'ord_oferta',' and oferta_speciala=1' ); 
	echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_GET[id_categorie]);
}

 
if(strlen($_GET['set_oferta_speciala'])) {
	mysql_query("UPDATE erad_produse SET oferta_speciala = '".$_GET['set_oferta_speciala']."' WHERE id_produs = '".$_GET['id_produs']."'");
	  update_order('erad_produse', 'id_produs', 'ord_oferta',' and oferta_speciala=1' ); 
	echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_GET[id_categorie].'&id_brand='.$_GET[id_brand].'&cnt='.$_GET[cnt]);
}
if(strlen($_GET['set_activ'])) {
	mysql_query("UPDATE erad_produse SET activ = '".$_GET['set_activ']."' WHERE id_produs = '".$_GET['id_produs']."'");
	echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_GET[id_categorie].'&id_brand='.$_GET[id_brand].'&cnt='.$_GET[cnt]);
}

if(strlen($_GET['set_in_curand'])) {
	mysql_query("UPDATE erad_produse SET in_curand = '".$_GET['set_in_curand']."' WHERE id_produs = '".$_GET['id_produs']."'");
	echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_GET[id_categorie].'&id_brand='.$_GET[id_brand].'&cnt='.$_GET[cnt]);
} 
 
 if(strlen($_GET['set_produs_nou'])) {
	mysql_query("UPDATE erad_produse SET produs_nou = '".$_GET['set_produs_nou']."' WHERE id_produs = '".$_GET['id_produs']."'");
	echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_GET[id_categorie].'&id_brand='.$_GET[id_brand].'&cnt='.$_GET[cnt]);
} 
 
if (isset($_GET[rec])) { unset ($_SESSION[of]); unset ($_SESSION[curand]);unset ($_SESSION[inactiv]); unset ($_SESSION[produs_nou]); $_SESSION[rec]=$_GET[rec];}
if (isset($_GET[of])) {unset ($_SESSION[rec]); unset ($_SESSION[curand]) ;unset ($_SESSION[inactiv]); unset ($_SESSION[produs_nou]);$_SESSION[of]=$_GET[of];}
if (isset($_GET[curand])) {unset ($_SESSION[of]); unset ($_SESSION[rec]) ;unset ($_SESSION[inactiv]); unset ($_SESSION[produs_nou]);$_SESSION[curand]=$_GET[curand];}
if (isset($_GET[inactiv])) {unset ($_SESSION[of]); unset ($_SESSION[rec]) ;unset ($_SESSION[curand]) ; unset ($_SESSION[produs_nou]);$_SESSION[inactiv]=$_GET[inactiv];}
if (isset($_GET[produs_nou])) {unset ($_SESSION[of]); unset ($_SESSION[rec]) ;unset ($_SESSION[curand]) ;unset ($_SESSION[inactiv]) ;$_SESSION[produs_nou]=$_GET[produs_nou];}
 

if (!isset($_SESSION[rec])) $_SESSION[rec]=0;
 if ($_SESSION[rec]==1) $p[] = " erad_produse.produs_nou ='".$_SESSION[rec]."' ";

if (!isset($_SESSION[of])) $_SESSION[of]=0;
 if ($_SESSION[of]==1) $p[] = " erad_produse.oferta_speciala ='".$_SESSION[of]."' ";

if (!isset($_SESSION[curand])) $_SESSION[curand]=0;
 if ($_SESSION[curand]==1) $p[] = " erad_produse.in_curand ='".$_SESSION[curand]."' ";

if (!isset($_SESSION[inactiv])) $_SESSION[inactiv]=1;
 if ($_SESSION[inactiv]==0) $p[] = " erad_produse.activ ='".$_SESSION[inactiv]."' ";
 
if (!isset($_SESSION[produs_nou])) $_SESSION[produs_nou]=0;
 if ($_SESSION[produs_nou]==1) $p[] = " erad_produse.produs_nou ='".$_SESSION[produs_nou]."' ";



$keyword=trim($_GET[keyword]);
 if ($keyword<>'') $p[] = " erad_produse.produs like '%".$keyword."%' or erad_produse.produs_cod like '%".$keyword."%'";



 
 
 if ($id_categorie<>0) $p[] = " erad_produse.id_categorie = '".$id_categorie."' ";

	 

 if ($id_brand<>0) $p[] = " erad_produse.id_brand = '".$id_brand."' ";
 

 
$p[] = "  erad_produse.status <> 9 ";


//echo implode(' AND ', $p);

////////////////////
 
if (isset($_GET['cheie']) and isset($_GET['directie'])) {
$ord[]=$_GET[cheie].' '.$_GET[directie];
$q[]='cheie='.$_GET[cheie].'&directie='.$_GET[directie].'&id_categorie='.$_GET[id_categorie];
} else if($_SESSION[of]==1) $ord[]="ord_oferta asc";
else $ord[]=" ord asc";
  
$order= ' order by '. implode(' , ', $ord);

//echo $order;
 
$xtras='&id_categorie='.$_GET[id_categorie].'&id_brand='.$_GET[id_brand];
$nex=implode('&', $q);

//////////////////////////

$produse = mysql_query_assoc("
	SELECT id_produs,produs,id_categorie, data_aparitie, produs_cod, pret, pret_oferta, accesari, oferta_speciala, activ, in_curand,produs_nou, id_moneda, ord,added_on FROM erad_produse
	WHERE  
	".implode(' AND ', $p)."
	 {$order}
");

$it=$produse;

  $total_produse = mysql_query_scalar("	SELECT count(id_produs) as nr FROM erad_produse");

 
if ($_SESSION[of]==1) $interval = mysql_query_assoc("	SELECT   min(erad_produse.ord_oferta) as min,  max(erad_produse.ord_oferta) as max from  erad_produse  WHERE  	".implode(' AND ', $p)." ");

if ($_GET[id_categorie]<>'') $interval = mysql_query_assoc("	SELECT   min(erad_produse.ord) as min,  max(erad_produse.ord) as max from  erad_produse  WHERE  	".implode(' AND ', $p)." ");

$min=$interval[0]['min'];
$max=$interval[0]['max'];



if(!$_GET['cnt'] ) $_SESSION['fact_cnt']=0; 
if(!isset($_SESSION[nr_pg]))  $_SESSION[nr_pg] =  25; else if(isset($_GET[nr_pg])) $_SESSION[nr_pg] =  $_GET[nr_pg];

 
if(is_numeric($_GET['cnt']) && $_GET['cnt'] >= 0)
	$_SESSION['fact_cnt'] = $_GET['cnt'];
else 
	$_SESSION['fact_cnt'] = $_SESSION['fact_cnt'] != 0 ? $_SESSION['fact_cnt'] : 0;
$cnt = $_SESSION['fact_cnt'];
$prev = $cnt - $_SESSION[nr_pg];
if($prev >= 0) $prev = $prev < 0 ? 0 : $prev;
else $prev = -1;
$next = $cnt + $_SESSION[nr_pg];
$next = $next > count($it) ? count($it) : $next;
 
 
 ?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="64%" height="30" bgcolor="#efefef" class="titlu" ><b>
   
   <?=get_section_name($section)?></b>  </td>
 
  <td width="36%" height="30" align="right" bgcolor="#efefef" class="titlu" >
  <form action="<?=$src?>" method="get" style="margin:0px;">
  Cauta in <strong><?=$total_produse?></strong> articole <input name="keyword" type="text" size="15" value="<?=$keyword?>"  />
  <input type="hidden" name="section" value="<?=$section?>"  />
  <input type="submit"   class="but" value="Cauta"   />
  </form>
  </td>
 </tr>
</table>
<br />


<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF"  >
  <tr>
    <td height="41" colspan="6" bgcolor="#efefef">
	Categorie: 
	<?  $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0); ?>
			
  <select name="id_categorie" onchange="window.open(this.options[this.selectedIndex].value,'_self')"    >  
	 <option value="<?=$scr?>?section=<?=$section?>">--- Alege categoria ---</option>
	<? for($j = 0; $j < count($cat); $j++) { 
	
	 $copii=mysql_query_scalar("select count(id_categorie) from erad_categorii where id_parinte='".$cat[$j][id_categorie]."'");
				?>
				<? if ($copii>0) {?>
					   <optgroup label="<?=$cat[$j][link]?>" style="color:#666666;"></optgroup>
				<? } else {?>
					
                     <? $nr_prds=mysql_query_assoc("select id_produs from erad_produse where id_categorie='".$cat[$j][id_categorie]."'"); ?> 
	<option value="<?=$src?>?section=<?=$section?>&id_categorie=<?=$cat[$j][id_categorie]?>"  <? if ($cat[$j][id_categorie]==$id_categorie) echo "selected"; ?>> <?=$cat[$j][link]?> <? if($cat[$j][lvl]>1) echo '['.count($nr_prds).']';?>  </option>

                    
				<? }?>
 
	<? }?>
</select>
	
       
&nbsp;    </td>
<?php /*?>    <td width="41%" height="41" bgcolor="#efefef">
    
  Autor:
    <?  $brand = mysql_query_assoc("select * from erad_brands order by denumire_brand"); ?>
			
  <select name="id_brand" onchange="window.open(this.options[this.selectedIndex].value,'_self')"    >  
	 <option value="<?=$scr?>?section=<?=$section?>">--- Alege Autor ---</option>
	<? for($j = 0; $j < count($brand); $j++) {?>
 <? $nr_prds=mysql_query_assoc("select id_produs from erad_produse where id_brand='".$brand[$j][id_brand]."'"); ?> 
	<option value="<?=$src?>?section=<?=$section?>&id_brand=<?=$brand[$j][id_brand]?>"  <? if ($brand[$j][id_brand]==$id_brand) echo "selected"; ?>>   <?=$brand[$j][denumire_brand]?> [<?=count($nr_prds)?>]  </option>
	<? }?>
</select>
    
    </td><?php */?>
    <td width="26%" height="41" colspan="3" bgcolor="#efefef">
 <!--   <a href="#" onclick="javascript:popUp('export.php?r=1&keyword=<?=$keyword?>&<?=$nex?><?=$xtras?>');"   class="but">Exporta lista</a> 
    <a href="#" onclick="javascript:popUp('export.php');"   class="but">Importa</a> -->
       </td>
  </tr>
  <tr>
    <td height="41" colspan="7" bgcolor="#efefef">&nbsp;Afiseaza doar: &nbsp;&nbsp;&nbsp; 
          
     &nbsp;&nbsp;&nbsp;&nbsp; <a href="<?=$src?>?section=<?=$section?>&inactiv=<?=($_SESSION[inactiv]==1)?'0':'1'?>" <? if ($_SESSION[inactiv]==0) echo 'class=but style="background:#2691b9;"'; else echo 'class=but';?> >Inactive </a>
     &nbsp;&nbsp;&nbsp;&nbsp; <a href="<?=$src?>?section=<?=$section?>&produs_nou=<?=($_SESSION[produs_nou]==1)?'0':'1'?>" <? if ($_SESSION[produs_nou]==1) echo 'class=but style="background:#2691b9;"'; else echo 'class=but';?> >Homepage </a>
          
     
     </td>
    <td height="41" colspan="3" bgcolor="#efefef">&nbsp;</td>
  </tr>
  </table>
  
  <form name="multi" action="<?=$src?>" method="post">
  <input type="hidden" name="id_categorie" value="<?=$_GET[id_categorie]?>" />
    <input type="hidden" name="id_brand" value="<?=$_GET[id_brand]?>" />
    <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF"  ><tr  onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'"><td style="border-bottom:1px solid #ccc;" align="center" nowrap><table width="95%" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF"  >
      <tr>
        <td width="38" align="center"  background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header"><a href="<?=$src?>?section=<?=$section?>&cheie=id_produs&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?><?=$xtras?> " class="titlu_header"> ID</a> </td>
        <td width="50" align="center"  background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Ord</td>
        <td width="50" align="center" bgcolor="#cccccc" background="img/butbk.jpg"   class="titlu_header">Poza</td>
        <td width="400" align="left" bgcolor="#cccccc" background="img/butbk.jpg"   class="titlu_header"><a href="<?=$src?>?section=<?=$section?>&cheie=produs&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?><?=$xtras?> " class="titlu_header"> Titlu articol</a></td>
        <td width="243" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header"><div align="left">Categorie</div></td>
        <td width="4%" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">
        <a href="<?=$src?>?section=<?=$section?>&cheie=accesari&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?><?=$xtras?> " title="Ultima modificare a produsului" class="titlu_header">Accesari</a>
        </td>
        <td width="40" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Homepage</td>
        <td width="40" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Activ</td>
		<td width="8%" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Data aparitie</td>
        <td width="21" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header"><a href="<?=$src?>?section=<?=$section?>&cheie=added_on&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?><?=$xtras?> " title="Ultima modificare a produsului" class="titlu_header">Modificat</a></td>
        <td width="50" align="center" background="img/butbk.jpg"   class="titlu_header"> Actiuni </td>
      </tr>
      <?  
$k = -1;
for($i=$cnt; $i<$cnt+$_SESSION[nr_pg]; $i++) { 
if(is_array($it[$i])) { $k++;
 
	$p = SITE_URL . PICS_THUMB . $it[$i]['poza'];
	$p1 = SITE_DIR . PICS_THUMB . $it[$i]['poza'];
?>
      <tr  onmouseover="this.bgColor = '#efefef'"  onmouseout ="this.bgColor = '#FFFFFF'">
        <td  height="25" align="center" nowrap style="border-bottom:1px solid #ccc;"><input type="checkbox" id="produse" name="id_produsm[]" value="<?=$it[$i]['id_produs']?>" />
            <?=$it[$i]['id_produs']?>
            <br />        </td>
        <td align="center" nowrap style="border-bottom:1px solid #ccc;"><? if ($id_categorie<>'') {?>
            <select name="pos" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
              <? for($c=$min; $c<=$max; $c++) {?>
              <option value="<?=$scr?>?section=<?=$section?>&amp;new_move=<?=$c?>&amp;id_move=<?=$it[$i]["id_produs"]?>&amp;id_categorie=<?=$it[$i]["id_categorie"]?> <?="selected($c,$it[$i][&quot;ord&quot;])"?>&id_categorie=<?=$it[$i]["id_categorie"]?>" <?=selected($c,$it[$i]["ord"])?> >
                <?=$c?>
                </option>
              <? }?>
            </select>
            <? }?>
            <? /*if ($_SESSION[of]==1) {?>
     <select name="pos" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
		 <? for($c=$min; $c<=$max; $c++) {?>
            <option value="<?=$scr?>?section=<?=$section?>&amp;new_move=<?=$c?>&amp;id_move=<?=$it[$i]["id_produs"]?>" <?="selected($c,$it[$i][&quot;ord_oferta&quot;])"?>" <?=selected($c,$it[$i]["ord_oferta"])?> ><?=$c?></option>
        <? }?>
   </select>
    <? } */?>        </td>
        <td align="center"  style="border-bottom:1px solid #ccc;"><? 
$pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$it[$i]['id_produs']."' order by prim desc");

?>
            <? if(is_file(PICS_DIR_THUMB . $pic[0][pic])) {?>
            <a href="#" onclick="show_large_pic('div_abs', '<?=PICS_URL_LARGE?><?=$pic[0][pic]?>', '<?=$s[0]?>', '<?=$s[1]?>')"> <img src="<?=PICS_URL_THUMB?><?=$pic[0][pic]?>" border="1"  width="25" height="25"    align="middle" /> </a>
            <? } else {?>
          -
          <? }?>        </td>
        <td  style="border-bottom:1px solid #ccc;">

	<a href="http://www.google.ro/#hl=ro&source=hp&biw=1152&bih=706&q=<?=htmlspecialchars($produse[$i]['produs_cod'])?>&fp=d2dfb261a4f7ae30" title="Verifica pozitia pe Google" target="_blank">
	<b><?=$it[$i]['produs_cod']?></b>
	</a>
	<br>

	<a href="<?=$scr?>?section=<?=$mnp1?>_2&id_produs=<?=$it[$i]['id_produs']?>" title="Editeaza">
          <?=$it[$i]['produs']?>
        </a> </td>
        <td align="center"  style="border-bottom:1px solid #ccc;"><div align="left">
            <?=categorie_produs($it[$i]['id_categorie'], 'erad_categorii');?>
        </div></td>
        
        <td align="center"  style="border-bottom:1px solid #ccc;">
            <?=$it[$i]['accesari']?>
		</td>
            
		<td align="center"   style="border-bottom:1px solid #ccc;"><? if($it[$i]['produs_nou'] == 1) { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_produs_nou=0&id_produs=<?=$it[$i]['id_produs']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>"><font color="#FF5A00">da</font></a>
            <? } else { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_produs_nou=1&id_produs=<?=$it[$i]['id_produs']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>">nu</a>
            <? } ?></td>
            
        
        <td align="center"   style="border-bottom:1px solid #ccc;"><? if($it[$i]['activ'] == 1) { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_activ=0&id_produs=<?=$it[$i]['id_produs']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>"><font color="#FF5A00">da</font></a>
            <? } else { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_activ=1&id_produs=<?=$it[$i]['id_produs']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>">nu</a>
            <? } ?></td>

 <td align="center"   style="border-bottom:1px solid #ccc; background-color:#ccffee;"   ><span style=" font-size:9px;">
          <?=show_date_ro(substr($it[$i]['data_aparitie'],0,10))?>
        </span> </td>


            
                   <td align="center"   style="border-bottom:1px solid #ccc;"   ><span style=" font-size:9px;">
          <?=show_date_ro(substr($it[$i]['added_on'],0,10))?>
        </span> </td>
        <td style="border-bottom:1px solid #ccc;" align="center" nowrap><a href="<?=$scr?>?section=<?=$mnp1?>_2&id_produs=<?=$it[$i]['id_produs']?>" title="Edit"></a><a href="<?=$scr?>?section=<?=$mnp1?>_2&id_produs=<?=$it[$i]['id_produs']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle" /></a>&nbsp; <a href="#" onclick="confirm_del('<?=$it[$i]['produs']?>', '<?=$scr?>?section=<?=$section?>&act=del_produs&id_produs=<?=$it[$i]['id_produs']?>&id_categorie=<?=$it[$i]['id_categorie']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle" /></a> </td>
      </tr>
      <? } }?>
    </table></td>
  </tr>
    </table>




<table width="95%" border="0" cellpadding="5" cellspacing="0"  bgcolor="#B5C6CF" style="border-top:1px dashed #999999;border-bottom:1px dashed #999999; margin-top:5px;  "   >
   
   <tr>
     <td width="28%" height="30" align="left" valign="middle" bgcolor="#efefef"   style="color:#000000;">
    <? $x=0;
	  $y=$k+1;
	?>
    
 
     <input type="button" name="CheckAll" value="Tot" onclick="javascript:check_all(<?=$x?>,<?=$y?>)" class="but"   />
       <input type="button" name="UnCheckAll" value="Nimic" onclick="javascript:uncheck_all(<?=$x?>,<?=$y?>)" class="but"   />
    &nbsp;&nbsp;&nbsp;&nbsp;
     <strong>Cu articolele selectate:</strong></td>
     <td width="13%" height="30" align="left" valign="middle" bgcolor="#efefef"  >
      
     
      <select name="activ" style="font-size:10px;  " onchange="this.form.submit();"     >  
	 <option value=""> - Activ / inactiv  -</option>
     <option value="1">Active</option>
     <option value="0">Inactive</option>
     </select>      </td>
     <td width="47%" height="30" align="left" valign="middle" bgcolor="#efefef"  style="color:#000000;">
     
      <strong>Muta in:</strong>&nbsp;
        <select name="id_categoriem" style="font-size:9px; width:150px;" onchange="this.form.submit();"     >  
	 <option value="">--- Alege categoria ---</option>
	<? for($j = 0; $j < count($cat); $j++) { 
	
	 $copii=mysql_query_scalar("select count(id_categorie) from erad_categorii where id_parinte='".$cat[$j][id_categorie]."'");
				?>
				<? if ($copii>0) {?>
					   <optgroup label="<?=$cat[$j][link]?>" style="color:#666666;"></optgroup>
				<? } else {?>
					
                    
	<option value="<?=$cat[$j][id_categorie]?>"  >   <?=$cat[$j][link]?>   </option>

                    
				<? }?>
 
	<? }?>
</select>     </td>
     <td width="12%" align="left" valign="middle" bgcolor="#efefef"   >


       <div align="right">
  <input type="hidden" id="sterge" name="sterge" value="0" />
  <input type="button" name="submit_mult" value="Sterge" onclick="confirm_del_multi('', 'xx');" title="Sterge" class="but" />
     </div>     </tr>
   </table>
   
</form> 
   
<table width="95%" border="0" cellpadding="5" cellspacing="0"  bgcolor="#B5C6CF" style="border-top:1px dashed #999999;">
   
<tr>
     <td width="13%" height="30" align="right" valign="middle" bgcolor="#efefef"><? if($prev >= 0) { ?>
       <a href="<?=$scr?>?section=<?=$section?>&cnt=<?=$prev?>&keyword=<?=$keyword?>&<?=$nex?><?=$xtras?>" class="but">&laquo;&laquo; previous</a>
      <? }else{ echo '&nbsp;'; } ?></td>
    <td bgcolor="#efefef" width="10%" align="center" valign="middle">
	 
	 Pagina:	
      <select onchange="window.open(this.options[this.selectedIndex].value,'_self')">
	
	 <? for($i=0; $i<count($it); $i+=$_SESSION[nr_pg]) { ?>
<option value="<?=$scr?>?section=<?=$section?>&cnt=<?=$i?>&keyword=<?=$keyword?>&<?=$nex?><?=$xtras?>" <?=selected($i,$cnt );?>>

           <?=(($cnt==$i)?'<font color="#0B6ABF">':'')?>
           <?=$i/$_SESSION[nr_pg]+1?>
           <?=(($cnt==$i)?'</font>':'')?>
</option>
         <? } ?>
	 </select>     </td>
 <td bgcolor="#efefef" width="12%" valign="middle" align="left"><? if($next < count($it)) { ?>
         <a href="<?=$scr?>?section=<?=$section?>&cnt=<?=$next?>&keyword=<?=$keyword?>&<?=$nex?><?=$xtras?>" class="but">next &raquo;&raquo;</a>
       <? }else{ echo '&nbsp;'; } ?></td>
    <td bgcolor="#efefef" width="13%" valign="middle" align="center">
    
    Articole pe pagina:
     <select name="nr_pg" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=25" <?=selected('25',$_SESSION[nr_pg])?>>25</option>
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=50" <?=selected('50',$_SESSION[nr_pg])?>>50</option>
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=100" <?=selected('100',$_SESSION[nr_pg])?>>100</option>
     </select>     </td>
  </tr>
</table>
