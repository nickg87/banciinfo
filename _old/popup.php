<? 
// unset($_SESSION[sessid]);  
if (!isset($_SESSION[sessidpop]) ) { $_SESSION[sessidpop]=0; } else {  $_SESSION[sessidpop]++; }
?> 

<? if($_SESSION[sessidpop]>=0 and $_SESSION[sessidpop]<1 ) {?>
 <script>
  $(document).ready(function() {
		$('.jqmWindow').jqmShow();
	});
  </script>

 
    <div class="jqmWindow radius3 shadow1" id="dialog" style=" text-align:center; background:#f9f9f9;  z-index:199999;">
    <a href="#" onClick="hidePP(); "  style="width:30px; height:30px; background:url(images/close.png) top no-repeat; float:right; margin-top:0px; margin-right:-30px;     display:block;"> </a>
        <div style="width:336px; padding:10px;"> 
		<?php /*?><a href='https://bit.ly/13L2syr' target='_blank' rel='nofollow'><img src='https://bit.ly/13L2syw' alt='FRFS' title='FRFS' border='0' /></a><?php */?>
        <object height='250px' width='300px'><param name='movie' height='250px' width='300px' value="https://img.2parale.ro/system/paperclip/banner_pictures/pics/140619/original/140619.swf?clickTAG=http%3A%2F%2Fevent.2parale.ro%2Fevents%2Fclick%3Fad_type%3Dbanner%26aff_code%3D304d17cda%26campaign_unique%3D4ed5c9d68%26unique%3D416d7a309" /><PARAM NAME='menu' VALUE='false'><PARAM NAME='quality' VALUE='medium'><PARAM NAME='wmode' VALUE='Opaque'> <embed src="https://img.2parale.ro/system/paperclip/banner_pictures/pics/140619/original/140619.swf?clickTAG=http%3A%2F%2Fevent.2parale.ro%2Fevents%2Fclick%3Fad_type%3Dbanner%26aff_code%3D304d17cda%26campaign_unique%3D4ed5c9d68%26unique%3D416d7a309" menu='false' swLiveConnect='FALSE' wmode='Opaque' height='250px' width='300px' TYPE='application/x-shockwave-flash'></embed></object>
        <?php /*?><object height='250px' width='300px'><param name='movie' height='250px' width='300px' value="https://img.2parale.ro/system/paperclip/banner_pictures/pics/100379/original/100379.swf?clickTAG=http%3A%2F%2Fevent.2parale.ro%2Fevents%2Fclick%3Fad_type%3Dbanner%26aff_code%3D304d17cda%26campaign_unique%3D8b359cdee%26unique%3De19c6f555" /><PARAM NAME='menu' VALUE='false'><PARAM NAME='quality' VALUE='medium'><PARAM NAME='wmode' VALUE='Opaque'> <embed src="https://img.2parale.ro/system/paperclip/banner_pictures/pics/100379/original/100379.swf?clickTAG=http%3A%2F%2Fevent.2parale.ro%2Fevents%2Fclick%3Fad_type%3Dbanner%26aff_code%3D304d17cda%26campaign_unique%3D8b359cdee%26unique%3De19c6f555" menu='false' swLiveConnect='FALSE' wmode='Opaque' height='250px' width='300px' TYPE='application/x-shockwave-flash'></embed></object><?php */?>
        </div>
    </div>
 
    
<? }?>
