 &nbsp;&nbsp;&nbsp; <a href="#" onclick="show_all(); " class="bulina">deschide</a> &nbsp;&nbsp;&nbsp;
 <a href="#" onclick="hide_all(); " class="bulina">inchide</a> 
 <br />
<br />

<?
 
  $sc=explode('_',$section);
 
  
 $ki = 0;
foreach($MENU2 as $key => $val) {
 
 
  

if ($ki==$sc[0]) 	 { ?> 
	<div   class="meniu_sel">
	 <a href="#" id="sh<?=$ki?>" onclick="show_x('p<?=$ki?>');  hide_x('sh<?=$ki?>');show_x('hd<?=$ki?>'); " class="bulina" >+</a><a href="#" id="hd<?=$ki?>" onclick="hide_x('p<?=$ki?>');hide_x('hd<?=$ki?>'); show_x('sh<?=$ki?>');  " class="bulina" style="display:none;">+</a> 
	<a href="<?=get_section_url($ki.'_0',"")?>"  style="text-decoration:none;	color:#000000;" ><b><?=$key?></b></a>
	</div>
<? } else { ?>
	<div   class="meniu_sel">
	 	<a href="#" id="sh<?=$ki?>" onclick="show_x('p<?=$ki?>');  hide_x('sh<?=$ki?>');show_x('hd<?=$ki?>'); " class="bulina" >+</a><a href="#" id="hd<?=$ki?>" onclick="hide_x('p<?=$ki?>');hide_x('hd<?=$ki?>'); show_x('sh<?=$ki?>');  " class="bulina" style="display:none;">+</a> 
		<a href="<?=get_section_url($ki.'_0',"")?>" style="text-decoration:none;	color:#0066CC;"	  ><b><?=$key?></b></a>
	</div>
<? } ?>
	
	
	<div id="p<?=$ki?>"  style="padding-top:5px; <? if ($ki<>$sc[0]) {?>display:none;<? }?>">
	<? $kj = 0;
	foreach($val as $sub => $x) {
	 
	if ($x[display]==1) 	if ($kj==$sc[1] and $ki==$sc[0]) {?>
	
	<div  style="height:15px;  " >
	<a href="<?=get_section_url($ki.'_'.$kj,"")?>"  class="submeniu"   ><img src="img/tree_blu.jpg" border="0" style="margin-top:-13px;" /> <b><?=$x[titlu]?></b></a>
	</div>
	<? }else { ?>
	<div  style="height:15px;  " >
	<a href="<?=get_section_url($ki.'_'.$kj,"")?>"  class="submeniu"  ><img src="img/tree_blu.jpg" border="0" style="margin-top:-13px;" /> <?=$x[titlu]?></a>	</div>
	<? }?>
	
	<?
	
	$kj++;
	}?>
	
	</div>
<?	
  $ki++;

		 
}
 

?>

 

 