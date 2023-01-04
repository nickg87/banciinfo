<? include('a_settings.php');
 
$id_produs=$_GET[id_produs];
 $label=$_GET[label];
$pret_nou=$_GET[val];

$res=mysql_query_assoc("select pret,pret_oferta  from erad_produse where id_produs='".$id_produs."'");

if ($pret_nou<>'' and $label=='pret') mysql_query("update erad_produse set pret = '".$pret_nou."' where id_produs='".$id_produs."'");
if ($pret_nou<>'' and $label=='oferta') mysql_query("update erad_produse set pret_oferta = '".$pret_nou."' where id_produs='".$id_produs."'");

?>
 
 <? if ($pret_nou<>'' and $label=='pret') {?>
  <a href="#p<?=$id_produs?>"  onclick="load_preturi(<?=$id_produs?>,  '')"><?=$pret_nou?></a>
 <? }?>
 
  <? if ($pret_nou<>'' and $label=='oferta') {?>
  <a href="#p<?=$id_produs?>"  onclick="load_preturi_oferta(<?=$id_produs?>,  '')"><?=$pret_nou?></a>
 <? }?>
 
 <? if ($pret_nou=='' and $label=='pret') {?>
 
    <div id="pretz" style="position:absolute; width:120px; height:30px; text-align:center; background-color:#ffffff; padding:10px; border: 1px solid #0033CC;"  >
      
      <input id="pret_nou" type="text" value="<?=$res[0][pret]?>" size="7"  />
      
      <input type="button" name="ok" value="Ok"  class="but" onclick="load_preturi(<?=$id_produs?>, document.getElementById('pret_nou').value); hide('pretz');" />
     
    </div>

 
<? } ?>
 




 <? if ($pret_nou=='' and $label=='oferta') {?>
 
    <div id="pretz" style="position:absolute; width:120px; height:30px; text-align:center; background-color:#ffffff; padding:10px; border: 1px solid  #0033CC;"  >
     
      <input id="pret_nou" type="text" value="<?=$res[0][pret_oferta]?>" size="7"  />
      
      <input type="button" name="ok" value="Ok"  class="but" onclick="load_preturi_oferta(<?=$id_produs?>, document.getElementById('pret_nou').value); hide('pretz');" />
     
    </div>
 <? } ?>
 
