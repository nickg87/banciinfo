<? $promo=mysql_query_assoc("select * from erad_promotii where activ=1 order by ord");
$nr=count($promo);

$latime=BANNER_PROMO;
$inaltime=BANNER_PROMO_H;
?>

 
<? if($nr>0) {?> 

<div id="promo">

    <div id="jslidernews3" class="lof-slidecontent" style="width:<?=$latime?>px; height:<?=$inaltime?>px;">
        <div class="preload"></div>

		<? for ($i=1;$i<=count($promo)-1; $i++) {?>
			<div><a href="#<?=$i-1?>" class="button-previous" title="<?=$promo[$i][nume_promotie]?>"><?=$i-1?></a></div>
		<? }?>
                    	<!-- MAIN CONTENT --> 
				<div class="main-slider-content" style="width:<?=$latime?>px; height:<?=$inaltime?>px;">
                    <ul class="sliders-wrap-inner">
				<? for ($i=0;$i<count($promo); $i++) 
                    {?> <? $cale=$promo[$i][link_promo]; ?>   
                        <li>
                           <a target="_blank" href="<?=$cale?>">
                           <img src="<?=PICS_URL_PROMO?><?=$promo[$i][pic]?>" alt="temp" border="0" />
                           </a>
							<? $descriere=$promo[$i][text_promotie]; ?>
                            <? if (strlen($descriere)>0) {?> 
                            <div class="slider-description">
                                <div class="description-wrapper">
                                    <div class="slider-meta">
                                        <a target="_parent" title="<?=$promo[$i][nume_promotie]?>" href="<?=$cale?>">
                                        <?=$promo[$i][nume_promotie]?>
                                        </a> 
                                    </div>
                                    <p class="text_simplu_alb"><?=$promo[$i][text_promotie]?></p>
                                </div>
                            </div> <? }?>
                        </li> <? }?>
                    </ul>  	
                </div>
               <!-- END MAIN CONTENT -->      	
           
		<? for ($i=1;$i<=count($promo)-1; $i++) {?>
			<div><a href="#<?=$i+1?>" class="button-next" title="<?=$promo[$i][nume_promotie]?>"></a></div>
		<? }?>

                </div>
</div> <!-- END promo --> 

<? }?> 
