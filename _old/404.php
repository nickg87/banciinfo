<? include('settings/s_settings.php');
$title=SITE_NAME.' :: Pagina inexistenta ';
$keywords=KEYWORDS_GENERAL;
$description=DESCRIPTION_GENERAL;
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
  <div   id="centru"   >
  <div class="erorr404"> #404  </div>
<span id="titlu_pricipal_pagina">Pagina pe care ati incercat sa o accesati nu mai exista.</span><br/>

<span class="titlu_secundar_pagina">
Puteti incerca lista urmatoare de sugestii de cautari:
</span>
	
<div id="lista_sugestii_cautari" class="radius2">
<?
$sugestii=mysql_query_assoc("select * from erad_keywords where activ = 1 order by accesari desc");
?>
<? for($i = 0; $i < count($sugestii); $i++) { ?>
<div class="titlu_articol_sugestii">
<a href="<?=SITE_URL?>cauta.php?keyword=<?=$sugestii[$i][keyword]?>" title="Cautari dupa <?=$sugestii[$i][keyword]?>">&bull;&nbsp;<?=$sugestii[$i][keyword]?></a>
</div>

<? } ?>
</div>
<div style="clear:both"></div>
<span class="titlu_secundar_pagina">
Sau puteti consulta lista tuturor articolelor din site accesand acest <a class="blue" href="<?=SITE_URL?>site_map.php">link</a>
</span>

 

  </div>  
      <div id="col_right">
        <? include "right.php";?>
    </div>
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
