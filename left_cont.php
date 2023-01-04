 <? if($Login->check_login()) { ?>
<div class="left_cat_pp" ><span class="left_cat_pp_text" style="font-size:105%;" > CONTUL MEU</span></div> 
 
 <div class="left_cont">
	<div class="left_cont_meniu"  >
	Date cont
	</div>
 

<a href="<?=SITE_URL?>cont_edit.html"  class="left_cont_submeniu"     title="Editeaza cont"> Date personale </a></span>  

<a href="<?=SITE_URL?>cont_pass.html"  class="left_cont_submeniu"      title="Schimba parola">   Schimba parola </a></span>  

 </div>

  
   <div class="left_cont"  >
<div class="left_cont_meniu"  >
Istoric
</div>
 

<a href="<?=SITE_URL?>cont_comenzi.html"  class="left_cont_submeniu"    title="Comenzile mele">   Comenzile mele </a></span>  

 </div>
 <? }?>