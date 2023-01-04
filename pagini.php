<?
include('settings/s_settings.php');

$id_meniu=$_GET[id_meniu];
$pagini = mysql_query_assoc("	SELECT * FROM erad_pagini   where id_meniu='".$id_meniu."'  ORDER BY  erad_pagini.ord asc");
$menius=mysql_query_assoc("select * from erad_meniu_set where id_meniu='".$id_meniu."' ");
 
$title='Lista articole '.$menius[0]['link_meniu'];

$keywords=str_shape3($title);
$description='Lista articole ofetite de '.SITE_NAME.' in sectiunea '.$menius[0]['link_meniu'];
$lista_articole=1;
?>

<?  
include "head_data.php"?>

 
<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">
    
	<? include "nav_articol.php";?>
    

         

<div id="col_left">
	<? include "left_ad.php";?>
    <? include "banner_left.php";?>
</div>
    

    
    <div id="main"> 
    
        <div id="titlu_pricipal_pagina" >    
        <a name="<?=$menius[0]['link_meniu']?>" title="<?=$menius[0]['link_meniu']?>" ><h2>Citeste articolele din sectiunea <?=$menius[0]['link_meniu']?></h2></a>
        </div>
    <div style="margin-bottom:10px;">
	<object height='90px' width='728px'><param name='movie' height='90px' width='728px' value="https://img.2parale.ro/system/paperclip/banner_pictures/pics/120620/original/120620.swf?clickTAG=http%3A%2F%2Fevent.2parale.ro%2Fevents%2Fclick%3Fad_type%3Dbanner%26aff_code%3D304d17cda%26campaign_unique%3D2904f13f4%26unique%3D7f2659515" /><PARAM NAME='menu' VALUE='false'><PARAM NAME='quality' VALUE='medium'><PARAM NAME='wmode' VALUE='Opaque'> <embed src="https://img.2parale.ro/system/paperclip/banner_pictures/pics/120620/original/120620.swf?clickTAG=http%3A%2F%2Fevent.2parale.ro%2Fevents%2Fclick%3Fad_type%3Dbanner%26aff_code%3D304d17cda%26campaign_unique%3D2904f13f4%26unique%3D7f2659515" menu='false' swLiveConnect='FALSE' wmode='Opaque' height='90px' width='728px' TYPE='application/x-shockwave-flash'></embed></object>
    </div>
 
  <div   id="centru"   >
            
 
<? for ($i=0; $i<count($pagini); $i++) {?>

         <div class="box_articol_general">
         
			<table width="100%" border="0" cellspacing="0" cellpadding="0"    >
			
			<tr>
			<td  valign="top">
            
			<div class="titlu_articol_lista">
	        <a href="<?=get_link_articol($pagini[$i][id_page], $pagini[$i][titlu_stire], $id_meniu, $menius[0][link_meniu])?>"  title="Citeste articolul <?=$pagini[$i][titlu_stire]?>">
			<?=$pagini[$i][titlu_stire]?></a>
            </div>


			<?  $pic = mysql_query_assoc(" select * from erad_galerie_pagini where id_page='".$pagini[$i][id_page]."' order by prim desc");?> 
			<? if(count($pic)>0) {?>
				<div class="pic_container">
				<? if(is_file(PICS_DIR_THUMB.$pic[0][pic])) { ?>
                    <div class="pic_articol_lista"  >
                        <a href="<?=get_link_articol($pagini[$i][id_page], $pagini[$i][titlu_stire], $id_meniu, $menius[0][link_meniu])?>" title="Poza <?=$pagini[$i][titlu_stire]?>">
                        <img src="<?=PICS_URL_THUMB.$pic[0][pic]?>" alt="Foto <?=$pagini[$i][titlu_stire]?>" width="80" title="Detalii <?=$pagini[$i][titlu_stire]?>" border="0"   />
                        </a>
                    </div>		
                <? } ?>	
                </div>
			<? }?> 


			<div class="articol_sapou_lista">
                <h3><?=strip_tags(substr($pagini[$i][sapou],0,300))?> [...]
                    <a href="<?=get_link_articol($pagini[$i][id_page], $pagini[$i][titlu_stire], $id_meniu, $menius[0][link_meniu])?>"  class="link" title="<?=strip_tags($it[$i][produs])?>. Citeste acest articol">
                    citeste mai mult
                    </a> 
                </h3>
			</div>

            <div class="detalii_articol_lista">
                <a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="small_link_orange"><?=SITE_NAME?></a>  
                <em><span class="small_link_black"> | <?=$menius[0]['link_meniu']?></span></em>
            </div>

             
           </td>
           </tr>
           </table>
          
 
         </div>
<? }?>
           
 	<div  class="lista_titlu">

        <p class="small_text"> 
		<br>
		Sunt afisate toate articolele din <em><strong><?=$menius[0]['link_meniu']?></strong></em>. 
		Pentru detalii suplimentare privind articolele din <strong><?=$menius[0]['link_meniu']?> </strong> 
		puteti sa ne contactati, folosind datele din pagina de Contact. 
		Mergi la toate articolele din <em> <a class="small_link" title="Toate articolele din <?=$menius[0]['link_meniu']?>" href="#<?=$menius[0]['link_meniu']?>"><?=$menius[0]['link_meniu']?></a>.
		</p></em>

    </div>    
           
           
	</div><!-- end centru -->
        
    <div id="col_right">
        <? include "right.php";?>
    </div>
     
        
  
              
	 
        
        </div><!-- end main -->
        
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
