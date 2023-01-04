<?
include('settings/s_settings.php');
include('cart_fx.php');
$title=SITE_NAME.' '. SITE_NAME_SEO;
$keywords=str_shape3(KEYWORDS_GENERAL);
$description=DESCRIPTION_GENERAL;
$index=1;

include "head_data.php";

?>


<body> 

<? include "header.php";?>



<div id="wrap">

<div id="container" class="radius3">

<div id="col_left">
	<? include "left_produse.php";?>
</div>

<div id="main">
	<? include "main_produse.php";?>
</div>

<div id="liste_under">
	<? include "liste_under.php";?>
</div>

</div> <!-- end container -->
</div> <!-- end wrap -->

<div id="footer">
	<? include "foot.php";?>
</div>

</body>
</html>
