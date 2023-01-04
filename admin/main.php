<? 
include('a_settings.php');

  $section=$_GET[section];
$file=$_GET[file];

$xpld=explode('_',$section);
$mnp1=$xpld[0];
$mnp2=$xpld[1];

if ($_GET[section]=='') header('location: '.$scr.'?section='.$default_section);
 


include('top.php'); 
?>


<table width="100%" cellpadding="5" cellspacing="0" bgcolor="#ffffff" align="center">
 <tr>
  <td width="140" height="670" align="left" valign="top" bgcolor="#ffffff" style="border-right: 1px dashed #999999; background-image:url(img/xx.jpg); background-position:top; background-repeat:no-repeat;">
  <? include('menu.php'); ?>  </td>
  <td align="center" valign="top">
  <? 
  		if(strlen($_GET['file'])<>'') 
  			include($_GET['file']);
  		else 
  			include(get_section_file($section));
  	?></td>
 </tr>
</table>

<? include('foot.php'); ?>