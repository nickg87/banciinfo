<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
 <? include('menu_sub.php'); ?> 

<?

$z=explode('php?',$_SERVER['REQUEST_URI']); 

  $_SESSION[url]=$z[1];

$id_user=$_GET['id_user'];
if(is_numeric($id_user) && $_GET['act'] == 'del_user') {
	//delete
	mysql_query("update  erad_users set del=1 WHERE id_user = '".$id_user."'");
	mysql_query("update  erad_comenzi set id_status=4 WHERE id_user = '".$id_user."'");
	echo js_redirect($scr.'?section='.$section);
	
	
}


////////////////////
 
if (isset($_GET['cheie']) and isset($_GET['directie'])) {
$ord[]=$_GET[cheie].' '.$_GET[directie];
$q[]='cheie='.$_GET[cheie].'&directie='.$_GET[directie].'&id_categorie='.$_GET[id_categorie];
}  
else $ord[]=" id_user desc";
  
$order= ' order by '. implode(' , ', $ord);
 
$xtras='&keyword='.$_GET[keyword];
$nex=implode('&', $q);

//////////////////////////
$keyword=$_GET[keyword];
 if ($keyword<>'') $p[] = " erad_users.nume_user like '%".$keyword."%' or   erad_users.denumire like '%".$keyword."%'  or   erad_users.email like '%".$keyword."%'  or   erad_users.telefon like '%".$keyword."%' ";

$p[] = " erad_users.del<>1";

if(count($p)>0) $where=' where '.implode(' AND ', $p);

$users = mysql_query_assoc("SELECT erad_users .*, count(erad_comenzi.id_comanda) as nr_c, (select max(data_comanda) from erad_comenzi where erad_comenzi.id_user=erad_users.id_user )as data_comanda FROM erad_users 
left join erad_comenzi on erad_comenzi.id_user=erad_users.id_user
{$where}
group by  erad_users.id_user
{$order}");

$it=$users;


 
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
  <td height="30" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
   
  <td height="30" align="right" bgcolor="#efefef" class="titlu">
  
   <form action="<?=$src?>" method="get" style="margin:0px;">
  Cauta nume, firma, tel, email <input name="keyword" type="text" size="20" value="<?=$keyword?>"  />
  <input type="hidden" name="section" value="<?=$section?>"  />
  <input type="submit"   class="but" value="Cauta"   />
   </form>
  
  </td>
 </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>


<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
 
 <tr>
  <td width="281" height="20" background="img/butbk.jpg" bgcolor="#EFEFEF"   class="titlu_header">
  <a href="<?=$src?>?section=<?=$section?>&cheie=nume_user&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?><?=$xtras?> " class="titlu_header"> Nume</a>  
  </td>
  <td width="197" height="20" background="img/butbk.jpg" bgcolor="#EFEFEF"   class="titlu_header">
  <a href="<?=$src?>?section=<?=$section?>&cheie=nr_c&directie=<? if ($_GET[directie]=='desc') echo "asc"; else echo "desc";?><?=$xtras?> " class="titlu_header">Comenzi</a> 
   </td>
  <td width="243" background="img/butbk.jpg" bgcolor="#EFEFEF"   class="titlu_header"><b>E-Mail</b></td>
  <td width="122" background="img/butbk.jpg" bgcolor="#EFEFEF"   class="titlu_header"><b>Telefon</b><b> </b></td>
  <td width="122" background="img/butbk.jpg" bgcolor="#EFEFEF"   class="titlu_header">
  <a href="<?=$src?>?section=<?=$section?>&cheie=data_comanda&directie=<? if ($_GET[directie]=='desc') echo "asc"; else echo "desc";?><?=$xtras?> " class="titlu_header">Ultima comanda</a> 
  </td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
<?
$k = -1;
for($i=$cnt; $i<$cnt+$_SESSION[nr_pg]; $i++) { 
if(is_array($users[$i])) { $k++;
?>
<tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td  height="38">
  <span class="style1">
   <?=$users[$i]['nume_user']?>  <? if ($users[$i]['denumire']<>'') echo '('.$users[$i]['denumire'].')';?> 
   
  
     </span>      </td>
  <td>
  
   

<? if($users[$i]['nr_c']>0) {?>
   <br />
<span ><strong><?=$users[$i]['nr_c']?></strong></span> | <a href="<?=$src?>?section=4_2&id_user=<?=$users[$i]['id_user']?>" class="small_text"> &raquo;vezi istoric</a>
<? }?>  </td>
  <td ><a href="mailto:<?=$users[$i]['email']?>"><?=$users[$i]['email']?></a></td>
  <td ><?=$users[$i]['telefon']?></td>
  <td >
  <?=show_date_ro($users[$i]['data_comanda'])?>
  
  </td>
  <td  width="145" align="center">
  <a href="<?=$scr?>?section=<?=$mnp1?>_1&act=edit&id_user=<?=$users[$i]['id_user']?>" title="Edit"><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('', '<?=$scr?>?section=<?=$section?>&act=del_user&id_user=<?=$users[$i]['id_user']?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>  </td>
 </tr>
<? } } ?>
</table>


<table width="100%" border="0" cellpadding="5" cellspacing="0"  bgcolor="#B5C6CF" style="border-top:1px dashed #999999;">
   
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
    
    Produse pe pagina:
     <select name="nr_pg" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=25" <?=selected('25',$_SESSION[nr_pg])?>>25</option>
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=50" <?=selected('50',$_SESSION[nr_pg])?>>50</option>
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=100" <?=selected('100',$_SESSION[nr_pg])?>>100</option>
     </select>     </td>
  </tr>
</table>
