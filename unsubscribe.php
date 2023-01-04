<? include('settings/s_settings.php');
 $title=SITE_NAME." - Dezabonare Newsletter";
$keywords=SITE_NAME." - Dezabonare Newsletter";
$description=SITE_NAME." - Dezabonare Newsletter";


  $email=trim($_POST[vmail]); 
 
if (trim($email)<>'') {

$is= mysql_query_assoc("select * from erad_newsletter where nl_email LIKE '".$email."' "); 

if (count($is)>0) {
 mysql_query("delete from erad_newsletter   where nl_email LIKE '".$email."' "); 
$msg='Nu veti mai primi newsletter de la '.SITE_NAME;

} else {

$msg='Adresa de email nu exista in baza noastra de date!<br /> Va rugam sa verificati daca ati scris corect adresa de email.';

}


 
 }
 
$title=SITE_NAME ." &raquo; Dezabonare newsletter";
$keywords=KEYWORDS_GENERAL;
$description=DESCRIPTION_GENERAL;

include "head_data.php";
?>


<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">

  <div id="nav">
		<a href="<?=SITE_URL?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span> 
		<a href="#" class="nav_link blue">Dezabonare newsletter</a>
 </div>   
    
<div id="col_left">
	<? include "banner_left.php";?>
</div>

 
<div id="main">

  <div   id="centru"   >

  


            
         
             <form action="<?=SITE_URL?>unsubscribe.php" method="post" >
             <br>
<br>
<br>

                
                <div id="titlu_pricipal_pagina">Dezabonare de la newsletter <?=SITE_NAME?></div>
           <br>
<br>

            <br />
          <span class ="content"> Nu dorim sa trimitem mesaje celor care nu sunt interesati de continutul si noutatile site-lui nostru.

<br>
<br>

Daca nu doriti sa mai primiti mesaje din partea noastra sau adresa dvs. de e-mail a ajuns din gresala in baza noastra de date, va invitam sa folositi optiunea dezabonare introducand adresa dvs de e-mail in campul de mai jos.
<br>
 <br>


Va multumim si ne cerem scuze pentru eventualele neplaceri.

  
</span>  
  
<br>
<br>

  <? if(strlen($msg)>0) { ?>
                <div class="error">
                   
                  <?=$msg?>
                    
                </div>
           <? } else { ?> 

             <table width="100%" border="0" cellspacing="5" cellpadding="0" class="content">
              <tr>
                <td width="22%" align="right">Email: </td>
                <td width="78%" align="left">
                
                <input name="vmail" type="text" class="input_style1" size="60" >
                
                
                </td>
              </tr>
              <tr>
                <td align="right"></td>
                <td align="left" valign="top">
                
                </td>
              </tr>
              <tr>
                <td align="right">

               
                </td>
                <td align="left" valign="top">
                
                  <div class="buton_style1" style=" float:left; margin-left:10px;">

		    <button type="submit"   >
		   Dezabonare
		      </button>
		    </div> 
                
                
                
                </td>
              </tr>
              <tr>
                <td height="60" colspan="2" align="center" style="color:#FF0000; font-size:14px;">
                
                </td>
                </tr>
            </table>
            <? } ?> 
          </form>
         
         
             
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