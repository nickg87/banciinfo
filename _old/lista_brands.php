<?
include('settings/s_settings.php');

if (is_numeric($_GET[id])) $id_brand=$_GET[id];	 
  

$page = $_GET[page];
$n_per_page = 15;

$x=mysql_query_assoc("SELECT * FROM erad_brands WHERE id_brand = '".$id_brand."'  ");
$brand_curent=$x[0][denumire_brand];
$brand_curent_logo=$x[0][logo_brand];
$descriere_brand=$x[0][descriere_brand];
////////////////////
 
if (isset($_GET['cheie']) and isset($_GET['directie'])) {
$ord[]=$_GET[cheie].' '.$_GET[directie];
$q[]='cheie='.$_GET[cheie].'&directie='.$_GET[directie];
}
else $ord[]=" erad_produse.id_produs desc";
  
$order= ' order by '. implode(' , ', $ord);
 
$xtras='&id_categorie='.$_GET[id_categorie];
  $nex=implode('&', $q);

//////////////////////////


if (is_numeric($_GET[id])) {
	$lista = mysql_query_assoc("
		SELECT  erad_produse.id_produs, produs, produs_cod, erad_produse.pret,erad_produse.descriere_scurta, erad_produse.pret_oferta, erad_produse.id_categorie,oferta_speciala,produs_nou, id_moneda  FROM erad_produse 
	
		WHERE erad_produse.id_brand = '".$id_brand."' AND activ = '1'
		{$order}
		LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
	  $n_total = mysql_query_scalar("SELECT COUNT(*) FROM erad_produse 
	 
		 
		WHERE erad_produse.id_brand = '".$id_brand."' AND activ = '1'");
 }
 

?>


<? 
///google
 
 
 
$title=$brand_curent.'. '.SITE_NAME. '. Pagina '.($page+1);


$description= ' '.$brand_curent.'  '.SITE_NAME ;
$keywords= $brand_curent.', '. SITE_NAME ;

?>
<?  
include "head_data.php"?>


<body style="margin:0;"> 
 
<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
      <div id="LEFT" class="left" >
                
             <?  include "left_produse.php";?>
       
            <? include "banner_left.php";?>
             <? $tip=3;?>
             <? //include "box_intrebari.php";?>
          
            
           
            
            
       
            
        </div>
        
        <div  class="centru"   >        
 
<? include "nav_brands.php";?>
          
          
 
        <? include "linkcentru_ad.php";?>
			
  
<div   class="titlu_mare">


	<a name ="<?=$brand_curent?>" title ="Articole publicate de <?=$brand_curent?>">

	<h2 class="titlu_mediu_home">Articole publicate de <?=$brand_curent?></h2>

	</a>



<br><a href="#" id="citestex" onClick="show_x('dessc');hide_x('citestex');" class="detalii_brand" >Afla mai multe despre <?=$brand_curent?></a>
</div>
 <br />

<div id="dessc" style=" display:none;  " class="brand_desc"  >	
	<div class="brand_desc_close"><a href="#" onClick="hide_x('dessc');show_x('citestex');" class="but" title="Ascunde detalii"> X </a></div>


 <? if(is_file(PICS_DIR_THUMB .$brand_curent_logo)) { 
  $s = getimagesize(PICS_DIR_THUMB . $brand_curent_logo);
		 $padding=round((80-$s[1])/2);
 ?>
 
 <div class="brand_desc_logo">
   <img src="<?=PICS_URL_THUMB?><?=$brand_curent_logo?>"   style="margin-top:<?=$padding?>px;"  />
 </div>
   <? }?>

<span class="text_brand">
<?=nl2br($descriere_brand)?>
 </span>
  
			
	</div>		
 
  
			
			
	<? 
$it = $lista;
for($i = 0; $i < count($it); $i++) { ?>
		
			
			 <div id="prd<?=$it[$i][id_produs]?>" class="box_produse"  >

                 <table width="100%" border="0" cellspacing="0" cellpadding="0"    >
						<tr>
						  <td align="center"  valign="top">

                    
                    
			</td>
           </tr>
           </table>
          
      <div class="box_produse">

			<a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"  class="home_produs_nume" title="<?=strip_tags($it[$i][produs])?>">
			
			<h3 class="home_produs_nume" >
			<?=strip_tags($it[$i][produs])?>
			</h3>
			</a>

 <?  $pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$it[$i][id_produs]."' order by prim desc");?> 
   
   
    <? if(count($pic)>0) {?>

			<div class="pic_container"  >
           
							<? if(is_file(PICS_DIR_THUMB.$pic[0][pic])) {
								 $s = getimagesize(PICS_DIR_THUMB . $pic[0]['pic']);
								$padding=round((144-$s[1])/2);
								
							?>

				<div class="pic_produse"  >
 				
				<a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"  class="link_pic"  ><img src="<?=PICS_URL_SMALL.$pic[0][pic]?>" alt="Foto <?=$it[$i][produs]?>" title="Detalii <?=$it[$i][produs]?>" border="0" style="margin-top:<?=$padding?>px; "  /></a>

				</div>		
		
				<? } ?>	

                </div>
	<? }?>

		<div class="home_produs_descriere"  >
			
			<span class="content" style="margin-top:5px;"><?=strip_tags(substr($it[$i][descriere_scurta],0,200))?> [...]</span> 

			<a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"  class="link" title="<?=strip_tags($it[$i][produs])?>. Citeste acest articol"> citeste mai mult</a>

		</div>

             </div>
            </div>
		 	
 <? if ($i%4<3) {?> <div class="spacer1"  > </div> <? }?>

<? } ?>		
		

			
			
			
		
		
		
	<div style=" clear:both;  width:520px; height:20px; "></div>		


<? if ($n_total >$n_per_page) {?>

<div id="paginare"  class="head_top_text" >
   
  <? if($page-1>=0) {?> <a href="<?=get_link_brand($id_brand, $brand_curent,($page-1))?>" class="but2">&laquo;&laquo; </a> <? }?>
   
   
 &nbsp; Pagina 
 
  <select onChange="window.open(this.options[this.selectedIndex].value,'_self')" id="slcnt" class="input">
	
	<? for($i = 1; $i <= ceil($n_total / $n_per_page); $i++) { ?>

<option value="<?=get_link_brand($id_brand, $brand_curent,($i-1))?>?<?=$nex?>" <?=selected($i,$page+1 );?>>

         <?=($page + 1 == $i ? '<b>' : '')?><?=$i?><?=($page  == $i ? '</b>' : '')?>
</option>
         <? } ?>
	 </select> 
 din  <?=$i-1?>
  &nbsp;<? if($page+1 < ceil($n_total / $n_per_page)) {?>   <a href="<?=get_link_brand($id_brand, $brand_curent,($page+1))?>" class="but2">&raquo;&raquo; </a> <? }?></div>

<? }?>



     <div class="spacer1"></div>        
        
 	<div  class="lista_titlu">

        <p class="small_text"> 
		<br>
		Sunt afisate toate articolele scrise de <em><strong><?=$brand_curent?></strong></em>. 
		Puteti contacta autorul acestor articole folosind datele din pagina de Contact. 
		Vezi toate articolele scrise de <em> <a class="small_link" title="Toate articolele scrise de <?=$brand_curent?>" href="#<?=$brand_curent?>"><?=$brand_curent?></a>.
		</p></em>

    </div>       

	 
	 
    
         
         
        </div><!-- end centru -->
        

         <div   class="right"  >
            
          <? include "box_right.php";?>
         
        </div> 

         
      
       
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
