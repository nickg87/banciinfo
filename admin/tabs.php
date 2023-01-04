<table width="500" align="center" cellpadding="5" cellspacing="1"  >
 <tr>
  <td height="30" colspan="2" align="center"    class="titlu_header" style="border-bottom:2px solid #ccc;">
<? if( $_GET[id_produs]<>'') {?> 
<a href="<?=$scr?>?section=<?=$mnp1?>_2&tab=1&id_produs=<?=$_GET[id_produs]?>" class=" tab"  > General </a> 
<a href="<?=$scr?>?section=<?=$mnp1?>_3&tab=2&id_produs=<?=$_GET[id_produs]?>"  class=" tab"  > Imagini </a>
<!-- <a href="<?=$scr?>?section=<?=$mnp1?>_6&tab=4&id_produs=<?=$_GET[id_produs]?>"  class=" tab"  > Combinatii & atribute  </a> -->
<a href="<?=$scr?>?section=<?=$mnp1?>_4&&tab=3&id_produs=<?=$_GET[id_produs]?>"  class=" tab"  > Fisiere </a>

<? } else { ?>
<span class=" tab"  >General</span> 
<span class=" tab"  >Imagini</span>
<!-- <span class=" tab"  >Combinatii & atribute</span> -->
<span class=" tab"  >Fisiere</span>
<? }?> 
</td>
 </tr>
</table>