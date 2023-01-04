

<!--social-->

<div id="social_box" class="radius3">

<!--facebook-->
<div style="margin-bottom:4px;  ">
 
 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=137261696349537";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like" data-layout="box_count" data-href="<?=curPageURL();?>" data-width="42" data-show-faces="false"></div>
</div>
<!--/facebook-->

<!--gplus-->
<div  style="margin-bottom:4px;   ">
<g:plusone size="tall"></g:plusone>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>
<!--/gplus-->


<!--twitter-->
<div >
<a href="https://twitter.com/share" class="twitter-share-button" data-via="BanciInfoRo" data-lang="en" data-count="vertical">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<!--/twitter-->

</div>
<!--/social-->