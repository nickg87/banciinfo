<?php /*?> 
 <?
$bn_top=mysql_query_assoc("select * from erad_bannere  where tip_banner=2 and activ=1   ORDER BY rand() LIMIT 0,1  ");
 ?>
<?  if(count($bn_top)>0) {?>
 
<? if ($bn_top[0][tip_fisier]<>3) { ?>
<?  
$bannerT=$bn_top[0][banner];
if($bn_top[0][tip_fisier]==1) $linkbanner=''; else $linkbanner=$bn_top[0]['link'];
 
if($linkbanner=='') {
    $xyx=explode('.swf', $bannerT);
    $name=$xyx[0];
?>
 
    <script type="text/javascript">
    AC_FL_RunContent( 'codebase','https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','728','height','90','src','<?=SITE_URL?>banner/<?=$name?>','quality','high','pluginspage','https://www.macromedia.com/go/getflashplayer','movie','<?=SITE_URL?>banner/<?=$name?>','wmode', 'transparent' ); //end AC code
    </script>
    <noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="728" height="90" >
      <param name="movie" value="<?=SITE_URL?>banner/<?=$bannerT?>" />
      <param name="quality" value="high" />
      <param name="wmode" value="transparent" />
      <embed src="<?=SITE_URL?>banner/<?=$bannerT?>"  wmode="transparent" quality="high" pluginspage="https://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="728" height="90"  ></embed>
    </object></noscript>
   
    <?  } else {?>
  <div id="baner_top"   >   
    <a href="<?=$linkbanner?>" target="_blank"    > <img src="<?=BANNERS_URL?><?=$bannerT?>" border="0" style="padding:0px; margin:0px; margin-bottom:-2px;" /></a>
 </div>   
    <? } } else {?>

  <div id="baner_top"   >   
	<?=$bn_top[0][script]?>
 </div>   

    
    <? }?>
 
 
 
 
  <? } unset($bn_top);   ?>
<?php */?>  
  
<script type="text/javascript"><!--
google_ad_client = "ca-pub-9350127359282666";
/* Banci Info Top 728x90 */
google_ad_slot = "8271010802";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>