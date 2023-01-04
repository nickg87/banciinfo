<? $promo=mysql_query_assoc("select * from erad_promotii 
 
where activ=1 order by ord");
$nr=count($promo);

$latime=BANNER_PROMO;
$inaltime=BANNER_PROMO_H;
?>

<? if($nr>0) {?>
<div class="slider-wrap">
		<div id="main-photo-slider" class="csw">
			<div class="panelContainer">

<? for ($i=0;$i<count($promo); $i++) {?>
 <? 
 


$cale=$promo[$i][link_promo];

?>
					 



				<div class="panel" title="<?=$promo[$i][nume_promotie]?>">
					<div class="wrapper">
						<a target="_blank" href="<?=$cale?>"><img src="<?=PICS_URL_PROMO?><?=$promo[$i][pic]?>" alt="temp" border="0" /></a>
						 
					</div>
				</div>
                
 <? }?>	               

			</div>
		</div>

		 <a href="#1" class="cross-link" style="margin-top:5px;" ><span class="nav-thumb"  >1</span></a></a>
		<div id="movers-row">
		
        <? for ($i=1;$i<=count($promo)-1; $i++) {?>
        	<div><a href="#<?=$i+1?>" class="cross-link" title="<?=$promo[$i][nume_promotie]?>"><span class="nav-thumb" alt="temp-thumb" ><?=$i+1?></span></a></div>
            
			 <? }?>
			</div>

		</div>

<? }?>