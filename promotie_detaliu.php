<?
include('settings/s_settings.php');



// 	INNER JOIN erad_subcategorii ON erad_produse.id_subcategorie = erad_subcategorii.id_subcategorie

?>
<? 
///google
$cat = mysql_query_assoc("SELECT * FROM erad_categorii ORDER BY ord");  
  foreach ($cat as $cc)   $categorii_titlu=$title.	' '.$cc[categorie].' | ';  

 
$title=SITE_NAME;
$description= ' '.$categorii_titlu.' oferite de '.SITE_NAME ;

?>
<? $promo=mysql_query_assoc("select * from erad_promotii 
 
where activ=1 order by ord");
$nr=count($promo);
?>


<? include "head_data.php";?>



<body style="margin:0;"> 
 
<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
      <div id="LEFT" class="left" >
                
            <? //include "box_cos.php";?>
          <? include "box_intrebari.php";?>
            <? include "banner_left.php";?>
           <div  style="     height:30px; width:230px;  float:left;"></div> 
           
            
            
       
            
        </div>
        
        
        
        
        
              <div  class="centru"  >

       
                        
                 <?
                
                $promotii=mysql_query_assoc("SELECT * from erad_promotii where activ=1  and id_promotie='".$_GET[id_promotie]."' 
                ");
                
                foreach ($promotii as $promo){?>
                 
                 <div style="width:470px; margin-top:30px;  margin-bottom:30px;height:auto; float:left; text-align:left; padding-left:0px; " class="titlu_mare">
				 <?=$promo[nume_promotie]?>
                 </div>
                
                
                <? if(is_file(PICS_DIR_PROMO .$promo[pic])) { ?>
                
                <? if ($promo['tip_promotie']==1) { ?>
                 
                  <img src="<?=PICS_URL_PROMO?><?=$promo[pic]?>"  border="0"  />
                 
                <div style="width:580px;   margin-top:30px;  margin-bottom:30px; height:auto; float:left; text-align:left; " class="content">
                <?=nl2br($promo[text_promotie])?>
                </div>  
                <? for ($j=1; $j<5; $j++) {
                 if(is_file(PICS_DIR_PROMO .$promo['poza'.$j])) { ?>
                
                <img src="<?=PICS_URL_PROMO?><?=$promo['poza'.$j]?>" border="0" vspace="10"  />
                  
                <? }
                }?>  
                
                <? } ?>
                 
                <? }?>
                
                
                <? } // end promo?>
                 
                            
                            
		
         
         
         
        </div>
        
       
         
      
        
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
