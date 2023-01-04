 <? include('menu_sub.php'); ?> 

<?
$z=explode('php?',$_SERVER['REQUEST_URI']); 

  $_SESSION[url]=$z[1];


if(is_numeric($_GET['id_user']) && $_GET['act'] == 'del_users') {
	//delete
	mysql_query("DELETE FROM erad_newsletter WHERE id_user = '".$_GET['id_user']."'");
	echo js_redirect($scr.'?section='.$section);
}

if(isset($_GET['set_active'])) {
	mysql_query("UPDATE erad_newsletter SET activ = '1' WHERE id_user = '".$_GET['set_active']."'");
	echo js_redirect($scr.'?section='.$section);
}

if(isset($_GET['set_inactive'])) {
	mysql_query("UPDATE erad_newsletter SET activ = '0' WHERE id_user = '".$_GET['set_inactive']."'");
	echo js_redirect($scr.'?section='.$section);
}

$users = mysql_query_assoc("SELECT * FROM erad_newsletter ORDER BY nl_nume");


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
   
  <td height="30" bgcolor="#efefef" >
  
  Pentru dezabonare folositii link-ul: 

<strong>  <?=SITE_URL?>unsubscribe.php</strong>
  </td>
 </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>
<br />

<table width="95%" align="center" cellpadding="5" cellspacing="1"bgcolor="#efefef">
 
 <tr>
  <td width="138" bgcolor="#f8f8f8" background="img/butbk.jpg"   class="titlu_header"><b>Nume</b></td>
  <td width="523" bgcolor="#f8f8f8" background="img/butbk.jpg"   class="titlu_header"><b>Email</b></td>
  <td width="167" bgcolor="#f8f8f8" background="img/butbk.jpg"   class="titlu_header"><b>Status</b></td>
  <td bgcolor="#f8f8f8" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
   <?  
$k = -1;
for($i=$cnt; $i<$cnt+$_SESSION[nr_pg]; $i++) { 
if(is_array($it[$i])) { $k++;
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td  height="20"  ><?=$users[$i]['nl_nume']?></td>
  <td  ><?=$users[$i]['nl_email']?></td>
  <td   >
  		<? if($users[$i]['activ'] == 1) { ?>
  			<a href="<?=$scr?>?section=<?=$section?>&set_inactive=<?=$users[$i]['id_user']?>">active</a>
  		<? } else { ?>
  			<a href="<?=$scr?>?section=<?=$section?>&set_active=<?=$users[$i]['id_user']?>">inactive</a>
  		<? } ?>  </td>
  <td  width="75" align="center"  >
  		<a href="#" onClick="confirm_del('<?=$users[$i]['name']?>', '<?=$scr?>?section=<?=$section?>&act=del_users&id_user=<?=$users[$i]['id_user']?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>  </td>
 </tr>
<? } } ?>
</table>




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
    
    Items pe pagina:
     <select name="nr_pg" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=25" <?=selected('25',$_SESSION[nr_pg])?>>25</option>
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=50" <?=selected('50',$_SESSION[nr_pg])?>>50</option>
     <option value="main.php?<?=$_SESSION[url]?>&nr_pg=100" <?=selected('100',$_SESSION[nr_pg])?>>100</option>
     </select>     </td>
  </tr>
</table>

