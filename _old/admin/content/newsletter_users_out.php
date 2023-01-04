 <? include('menu_sub.php'); ?> 

<?
 

$users = mysql_query_assoc("SELECT * FROM erad_newsletter where activ=1 ORDER BY nl_email");

 
?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="34%" height="30" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
  <td width="35%" bgcolor="#efefef" >
  Pentru dezabonare folositii link-ul: 

<strong>  <?=SITE_URL?>unsubscribe.php</strong>
  </td>
 </tr>
</table> 
 
<form >
<br /> <input type=button value="Selecteaza tot" onClick="javascript:this.form.area.focus();this.form.area.select();" class="but">
<br /><br />


<textarea name="area" style="width:80%; height:450px;" >
<? foreach ($users as $u) {?>
<?=$u[nl_email].';'?> 
<? }?></textarea>

</form>