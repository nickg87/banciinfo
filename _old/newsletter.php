<?
include('settings/s_settings.php');
 
  $s = $_GET['s'];

 
 
 if (isset($_POST[s_newslet])) { 
 $email = trim($_POST['nl_email']);
$nume = trim($_POST['nl_nume']);
	
		if (!chk_email($email)) $error[]='Adresa de email necompletata sau incorecta'; 
			 
	 if(!chk_empty($nume)) $error[] = 'Va rugam sa completati numele dumneavoastra.';
	
	if(empty($error)) {
$ins = mysql_query("INSERT INTO erad_newsletter SET
	nl_email = '".$email."',
	nl_nume = '".$nume."',
	activ=1
	");
	echo js_redirect(SITE_URL.'pages.php?link=msg&msg=11');		
	}
 else {
 
 }


}
 
?>
<?  

$title=SITE_NAME ." &raquo; Abonare newsletter";
$keywords=KEYWORDS_GENERAL;
$description=DESCRIPTION_GENERAL;

include "head_data.php"?>


<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">

 <div id="nav">
		<a href="<?=SITE_URL?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
	  <a href="#" class="nav_link blue">Newsletter</a>  
 </div>    
    
<div id="col_left">
	<? include "left_produse.php";?>
</div>

 
<div id="main">

  <div   id="centru"   >
            
 <div class="titlu_secundar_pagina" >
   <h1  >Abonare newsletter <?=SITE_NAME?></h1> 
  </div>
                 
             
	<span class="content_general">         
Bine ati venit pe pagina de abonare la newsletterul <?=SITE_NAME?>.
<br> Pentru noi, este foarte important sa fim mereu in legatura cu dvs. De aceea, trimitem periodic mesaje informative cu noutati aparute pe site, oferte speciale, promotii.

<br>

Va invitam deci sa ne lasati numele si adresa dvs. de e-mail pentru a fi la curent cu toate noutatile site-ului oferite de <?=SITE_NAME?>.

<br>
 
</span>
                <br>
                <br>
              
               <? if(count($error)>0) { ?>
                <div class="error">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?> 
              
                
                 <? if ($_GET[ok]<>1) {?>
                <form name="sform" action="#" method="post">
             <table width="100%" border="0" cellspacing="5" cellpadding="0" class="content">
                    <tr>
                      <td width="22%" align="right">Nume: </td>
                      <td width="78%" align="left"><input name="nl_nume" type="text" class="input_style1" value="<?=$nume?>" size="60"></td>
                    </tr>
                    <tr>
                      <td align="right">Email:</td>
                      <td align="left"><input name="nl_email" type="text" class="input_style1" value="<?=$email?>" size="60"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left">&nbsp;&nbsp;&nbsp;
                      
                      
                     
        <input type="hidden" name="s_newslet" value="1" />                               
   <div class="buton_style1" style=" float:left;margin-top:10px;">
    <button type="submit" class="positive"  >
    Ma abonez
      </button>
    </div> 
                      
                      </td>
                    </tr>
                  </table> 
                  <br>
                  <br>
                <br>
              
                </form>
                <? } else {?>
                <span class="home_cat_art"><?=$_GET[msg]?></span>
                <? }?>
                
                
                <?
                if ( $_GET['s']<>'') {
                
                $succes = 0;
                $rs = mysql_query("SELECT * FROM erad_newsletter WHERE activ = '1'");
                while($r = mysql_fetch_array($rs)) {
                    $id = $r['id_user'];
                    if(md5($id . 'bulshit_key_asdasdsa') == $s) {
                        mysql_query("UPDATE erad_newsletter SET activ = '0' WHERE id_user = '".$id."'");
                        $succes = 1;
                        break;
                    }
                }
                
                if($succes == 1) {
                    echo 'Ati fost dezabonat. Nu veti mai primi newsletter de pe acest site.';
                } else if($succes == 0) {
                    echo 'Nu sunteti in lista celor care primesc newsletter de pe acest site.';
                }
                }
                
                ?>
                
<span class="content_general">    
 
In cazul in care nu veti mai dori pe viitor sa primiti mesaje informative de la noi, aveti oricand la dispozitie optiunea de dezabonare.
<br>

<br>
 <div class="link orange">
    <a href="<?=SITE_URL?>unsubscribe.php">
      Doresc dezabonare de la newsletter
    </a>
  </div>
</span>
                
         
                     
             
        </div>
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