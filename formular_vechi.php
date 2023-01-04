<a name="formular"></a>
   
    
       <? if($gg=='ok') { ?>

             <div class="ok">
                   <strong>Va multumim pentru mesajul trimis.</strong>
                   <br />

                    Mesajul dumneavoastra a ajuns la noi.
                    <br />
					Veti fi contactat in cel mai scurt timp de administratorii site-lui.
					<br />

			</div>

            <? } ?> 
    
   
     <? if(count($error)>0) { ?>

                <div class="error">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?> 

 
 <? if($gg<>'ok') { ?>
 


<form name="sform"  action="contact.php" method="post">
  <table width="100%" border="0" class="content">
  <tr>
    <td width="34%" align="left"><strong>Nume*      </strong></td>
  </tr>
  <tr>
    <td align="left">
	<input name="nume"  type="text" class="input_style1" value="<?=$nume?>" size="40" style="margin-left:0;" tabindex="1"></td>
  </tr>

 

  <tr align="left">
    <td><strong>Email*</strong></td>
    </tr>
  <tr align="left">
    <td>
	<input name="de_la"  type="text" class="input_style1" size="80" value="<?=$de_la?>" style="margin-left:0;" tabindex="3" /></td>
    </tr>

 
  <tr align="left">
    <td>
	<strong>Mesaj* </strong></td>
    </tr>
  <tr align="left">
    <td>
	<textarea name="mesaj" cols="54" rows="5" class="textarea_style1" style="height:200px;margin-left:0;  " tabindex="5"  ><?=$mesaj?></textarea></td>
    </tr>
<?php /*?>  <tr>
    <td align="left"><strong>Cod de securitate*</strong></td>
    </tr>
  <tr>
    <td>
    <img src="generateCaptcha.php" align="top" />
    <input name="number" type="text" id="number" size="1" class="input_style_Capcha" tabindex="6" />
&nbsp; 
    </td>
  </tr><?php */?>
  <tr>
    <td align="left"><strong>Dovedeste-ne ca nu esti robot*</strong></td>
    </tr>
  <tr>
    <td>
    <span class="titlu_secundar_pagina"><?=nrTOtext($r1).' + '.nrTOtext($r2).' = '?></span>
    <input name="r1t"  type="hidden" value="<?=$r1?>"/><input name="r2t"  type="hidden" value="<?=$r2?>"/>
    <input name="rezultat" type="text" id="rezultat" size="1" class="input_style_Capcha" tabindex="6" />
    &nbsp; [ Ex: <i>unu + sapte = <strong style="color:#FF0000">8</strong></i> ]
    </td>
  </tr>
  <tr>
    <td class="small_text"><font color="#FF0000" size="-1">Campurile notate cu * sunt obligatorii</font></td>
  </tr>
  <tr>
    <td class="small_text">
    <div class="buton_style1">
    <input type="submit" name="s_go" value="Trimite" >
    </div>
    </td>
  </tr>
</table>


</form>

<? }?>