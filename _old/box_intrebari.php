<? 
if($tip==1) {$clasabox=''; $clasatext='';}
if($tip==3) {$clasabox='_left'; $clasatext='_left'; }
if($tip==2) {$clasabox='2x'; $clasatext='2x';}

 $tel=explode('|',$hf[0][telefoane]); 

?>

<div  class="box_intrebari<?=$clasabox?>">

  	<div class="content_box<?=$clasatext?>" >
          <span style="font-size:150%; line-height:100%; "><?=$tel[0];?><br /><?=$tel[1];?></strong></span>
         		
  </div>
        
</div>