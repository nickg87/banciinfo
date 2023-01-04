<? include('a_settings.php');
 
$Usr = new UserManagement($DBF['erad_autori']);  
$vldb=$Usr->get01($_GET[id_autor]);
 
$vl=$Usr->DbToForm($vldb);
?>

<div id="mod"  >
<table width="950" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="90%" height="30" bgcolor="#efefef" background="img/butbk.jpg" class="titlu_header"><b>Editeaza autor </b>
    <input type="hidden" name="id_autor" value="<?=$_GET[id_autor]?>"></td>
  <td width="10%" height="30" nowrap="nowrap" bgcolor="#efefef" background="img/butbk.jpg"><a href="#" onclick="hide('mod');" class="but">[X] Inchide</a></td>
 </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">
  
 <fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Nume autor  </td>
  <td bgcolor="#ffffff"><input type="text"  id="nume_autor" name="nume_autor" size="50"   value="<?=$vl[nume_autor]?>"></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">CV</td>
   <td bgcolor="#ffffff"><textarea name="cv_autor" cols="100" rows="15"><?=$vl[cv_autor]?></textarea></td>
 </tr>
 </table>
 </fieldset>
 
<fieldset class="">
    <legend class="titlu"><b>Optimizare SEO</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

  
 <tr>
   <td width="150" align="right" bgcolor="#ffffff">Description:       </td>
   <td bgcolor="#ffffff"><input type="text" name="description" size="100" value="<?=$vl[description]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Keywords:      </td>
   <td bgcolor="#ffffff"><input type="text" name="keywords" size="100" value="<?=$vl[keywords]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">   </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff"><div id="inp"><input type="submit" name="s_mod_cat" value="Salveaza" class="but"> </div></td>
 </tr>
</table>
</fieldset>
    </td>
   </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  
 </div>

