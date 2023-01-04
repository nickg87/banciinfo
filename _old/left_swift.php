 <? include "linkleft_ad.php";?>
<div id="container_left">
<? if ($id_institutie<>'') { ?> 
    <div id="titlu_left">
		Cod Swift <br/><?=$inst[0][denumire_institutie]?>
    </div>
 
    <br/>    <br/>    <br/>
	<div style=" margin:0px auto; margin-top:15px; margin-bottom:5px; text-align:center;">
    <a title="Vezi toate codurile SWIFT ale bancilor inscrise in site" href="<?=SITE_URL?>coduri-swift-banci-romania.php" class="buton_style1" style="float:none;">
    Vezi toate codurile</a>
    </div>
                     
    <? } ?>
</div>

<? include('left_ad.php');?>  
 
<? include('banner_left.php');?>  
 
