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
   
  <td height="30" bgcolor="#efefef" >&nbsp;</td>
 </tr>
</table> 


<br />
<br />
<br />

 
<table width="81%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td width="34%" class="titlu"><strong>Platforma E-volution</strong></td>
    <td width="66%" class="titlu"><strong>Ultimele articole pe Blogul E-volution</strong></td>
  </tr>
  <tr>
    <td valign="top" >
    
 <a href="http://www.e-vo.ro" target="_blank"><img src="http://www.e-vo.ro/images/logo-e-vo.gif" border="0" /></a>
 
 <br />
    <br />

    <p class="titlu">Platforma E-volution este intr-o continua evolutie.<br /><br />

    Pentru ultimele noutati, oferte speciale, update-uri, 
 vizitati <a href="http://www.e-vo.ro" target="_blank" class="titlu" style="font-size:16px;">www.e-vo.ro</a>.</p>
    <p>&nbsp;</p>
  
    </td>
    <td valign="top" class="titlu">
<script src="http://feeds.feedburner.com/E-volutionBlog?format=sigpro" type="text/javascript" ></script> 
 </td>
  </tr>
</table>
