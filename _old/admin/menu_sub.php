 
 
<?
 
  $sc=explode('_',$section);
 
$sm = array();
 $ki = 0;
foreach($MENU2 as $key => $val) {
		if ($ki==$sc[0]) $submeniu=$val;
		$ki++;
	}

 $kj = 0;
foreach($submeniu as $sub => $x) {
	 
	if ($x[display]==1 ) 	if ($kj==$sc[1] and $ki==$sc[0]) $sm[] = '<a href="'.get_section_url($ki.'_'.$kj,"").'"  class="sub_tab"  >'.$x[titlu].'</a> ';
			else   $sm[] = '<a href="'.get_section_url($sc[0].'_'.$kj,"").'"  class="sub_tab"  ><font style="color: #0a7aa4;">'.$x[titlu].'</font></a> ';
	$kj++;
	}
  

 $sm_text = implode('&nbsp;&nbsp;&nbsp;&nbsp;' , $sm);

?>



 

<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#ffffff" style="margin-top:-4px;">
	<tr>
		<td height="28" align="center" valign="top" style="background-image:url(img/admin-subtabs.jpg); background-repeat:no-repeat; background-position:center;" > &nbsp;&nbsp;&nbsp;&nbsp;<?=$sm_text?> </td>
	</tr>
</table>
<br />

 