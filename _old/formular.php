 
<div id="quick_f"  style=" <? if(count($error)==0 and $_GET[link]<>'ok') { ?> display:none; <? }?>   width:560px; padding:10px; padding-right:20px; height:auto; position:absolute;  margin-top:40px; z-index:999999;  background-color:#f8f8f8; border:20px solid #efefef;" class="vizibil">
  <a name="formular"></a> <a href="#" onclick="hide_x('quick_f');"   style=" padding:4px; float:right; background-color:#666666; color:#ffffff; display:block;" >X inchide</a>
 
        <h2 class="sapou" > 
        <br />
        
<? if ($id_institutie<>'') {
$titlu_formular=$inst[0][denumire_institutie]; 
$link_formular=get_link_inst($inst[0][id_tematica],$inst[0][denumire_institutie]);
}
 else if  ($id_filiala<>'') {
  $titlu_formular=$filiala[0][denumire_filiala]; 
  $link_formular=get_link_filiala($filiala[0][id_filiala],$filiala[0][denumire_filiala]);
  } ?>

       <? if($_GET[link]=='ok') { ?>
                <div class="ok" style="text-align:center;">
                <br/>
                    Mesajul dumneavoastra a fost trimis.<br/>
                    Va multumim!
                    <br/><br/>
				</div>
            <? } else { ?> 


<br /><strong>Ai gasit date eronate privind <?=$titlu_formular?>? Semnaleaza acesata eroare si o vom verifica si remedia imediat.</strong></h2><br>
 

   
    

    
   
     <? if(count($error)>0) { ?>
                <div class="error" style="width:500px;">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?> 

<form name="sform"  action="<?=$link_formular?>#formular" method="post">
  <table width="100%" border="0" class="content">
  <tr>
    <td width="40" align="left"><strong>Nume*      </strong></td>
    <td align="left"><input name="nume"  type="text" class="input_style2" value="<?=$nume?>" size="30" style="margin-left:0;" /></td>
  </tr>
 
  <tr align="left">
    <td><strong>Email*</strong></td>
    <td><input name="email"  type="text" class="input_style2" size="30" value="<?=$email?>" style="margin-left:0;" /></td>
  </tr>
  
  <tr align="left">
    <td><strong>Mesaj*</strong></td>
    <td><textarea style="border:1px solid #cccccc;" class="textarea_style2" name="mesaj" rows="3" cols="25" ><?=$mesaj?></textarea></td>
  </tr>

  <tr>
    <td colspan="2" align="left"><strong>Dovedeste-ne ca nu esti robot*</strong></td>
    </tr>
  <tr>
    <td colspan="2">
    <span class="titlu_secundar_pagina"><?=nrTOtext($r1).' + '.nrTOtext($r2).' = '?></span>
    <input name="r1t"  type="hidden" value="<?=$r1?>"/><input name="r2t"  type="hidden" value="<?=$r2?>"/>
    <input name="rezultat" type="text" id="rezultat" size="1" class="input_style_Capcha" tabindex="6" />
    &nbsp; [ Ex: <i>unu + sapte = <strong style="color:#FF0000">8</strong></i> ]
    </td>
  </tr>
  
  <?php /*?><tr>
    <td align="left"><strong>Cod de securitate*</strong></td>
    <td align="left">
    
    <img src="<?=SITE_URL?>generateCaptcha.php" align="top" />
    <input name="number" type="text" id="number" size="5" class="input_style_Capcha" />    </td>
  </tr><?php */?>
  <tr>
    <td colspan="2">&nbsp;    </td>
    </tr>
  <tr>
    <td colspan="2" class="small_text">Campurile notate cu * sunt obligatorii</td>
  </tr>
  <tr>
    <td colspan="2" class="small_text">
      
    
    <input type="hidden" name="s_go" value="1"  />
    <input type="hidden" name="link" value="<?=curPageURL()?>"  />
   
    <div class="buton_style1" style="margin-left:45%;"  >
    <button type="submit" name="s_go"    >
   Trimite
      </button>
    </div>
    
    </td>
    </tr>

</table>


</form>
<? } ?>

</div>

 