<style>
#special_top {
	background:url(images/special_top.png) no-repeat top center;
	display:block;
	height:90px;
	width:980px;
	margin:0 auto;
	}
</style>
<?
$link='https://event.2parale.ro/events/click?ad_type=quicklink&aff_code=304d17cda&unique=8b359cdee&redirect_to=https%253A%252F%252Fwww.provident.ro%252Fcredit-rapid%252F%253Fsec%253D1';
?>
<a href="<?=$link?>" target="_blank" id="special_top"></a>

<script type="text/javascript">
$(document).ready(function(){
  $("#special_top").mouseover(function(){
    $("#special_top").animate({height:"200px"},"slow");
  });
  $("#special_top").mouseout(function(){
    $("#special_top").animate({height:"90px"},"slow");
  });
  });
</script> 