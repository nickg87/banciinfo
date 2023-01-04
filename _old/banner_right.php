<?
$bn_cat=mysql_query_assoc("select * from erad_bannere  where tip_banner=3 and activ=1   ORDER BY rand() ");
?>

<?  if(count($bn_cat)>0) {?>
  
	<? for ($i=0; $i<count($bn_cat); $i++) {
        $banner=$bn_cat[$i][banner] ?>
        
            <? if ($bn_cat[$i][tip_fisier]==1) {  
                $link=''; 
                $xyx=explode('.swf', $banner);
                $name=$xyx[0];
            ?>
            
            <div class="banner_left">
                <script type="text/javascript">
                AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','<?=$bn_cat[$i][custom_width]?>','height','<?=$bn_cat[$i][custom_height]?>','src','<?=SITE_URL?>banner/<?=$name?>','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','<?=SITE_URL?>banner/<?=$name?>','wmode', 'transparent' ); //end AC code
                </script>
                <noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="<?=$bn_cat[$i][custom_width]?>" height="<?=$bn_cat[$i][custom_height]?>" >
                  <param name="movie" value="<?=SITE_URL?>banner/<?=$banner?>" />
                  <param name="quality" value="high" />
                  <param name="wmode" value="transparent" />
                  <embed src="<?=SITE_URL?>banner/<?=$banner?>"  wmode="transparent" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?=$bn_cat[$i][custom_width]?>" height="<?=$bn_cat[$i][custom_height]?>"  ></embed>
                </object></noscript>
            </div>
        
            <? } ?>
            
	        <? if ($bn_cat[$i][tip_fisier]==2) {
            $link=$bn_cat[$i][link];
            ?>
            
            <?
            if ($bn_cat[$i][tip_link]=='1') { $linko='_self'; } else if ($bn_cat[$i][tip_link]=='2') { $linko='_blank'; }
            ?>
                <div class="banner_left"   >
                    <a href="<?=$link?>" target="<?=$linko?>"    > <img src="<?=BANNERS_URL?><?=$banner?>" border="0" style="padding:0px; " /></a>
                </div>   
            <? }  ?>
            
			<? if ($bn_cat[$i][tip_fisier]==3) {?>
                <div class="banner_left">   
                <?=$bn_cat[$i][script]?>
                </div>   
            <? } ?>
         
    
    <? } ?>
  
<? } ?>