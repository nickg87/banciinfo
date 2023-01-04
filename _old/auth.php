<?
include('settings/s_settings.php');

 
?>
<?  $title=SITE_NAME ." - Autentificare";
include "head_data.php"?>



<body  style="margin:0;"> 
 

<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
       <div id="LEFT" class="left" >
                
            <? $tip=3;?>
           <? include "box_intrebari.php";?>
            <? include "banner_left.php";?>
       
        </div>
        
         
        
        
        
        <div id="CENTRU" class="centru">
                <div id="nav"   class="nav">
                        <a href="<?=SITE_URL?>" class="nav">Home</a> &raquo;
                        <a href="#" class="nav"> <?=$title?></a>  
           		</div>    

<br>
<br>
 
            <h1 class="titlu_mare" > Autentificare in contul dvs.  </h1> 
          
<br>
<br>
    


	        
	  <? if(!$Login->check_login()) { ?>

 <? if($_err_login) { ?>
                <div class="error">
                   
                   Adresa de email sau parola gresite
                    
                </div>
            <? } ?> 

	<form name="sform" action="" method="post"    >
 <div   >
<table width="500" border="0" align="left" cellpadding="0" cellspacing="10" class="content_cont"  >
                 
                  <tr>
                    <td width="130" align="left">Adresa de email:</td>
                    <td align="left" ><input name="username" size="50" type="text" class="input" value="<?=$vl[email]?>"    /></td>
                  </tr>
                  <tr>
                    <td align="left" >Parola:</td>
                    <td align="left" >
				    <input id="password" name="password" size="26" type="password" class="input"   />
				   &nbsp;&nbsp;&nbsp; -  <a href="<?=SITE_URL?>pages.php?link=recuperare" class="link"> Ai uitat parola?</a></td>
                  </tr>
                            <tr>
                              <td align="right" >&nbsp;</td>
                              <td align="left" >  
                             <input type="hidden" name="s_login" value="1" /> 
                             
                              
  
        
         <div   class="buttons" style=" float:left; margin-left:10px; ">
    <button type="submit" class="positive"  >
      <img src="images/icons/tick.png" alt=""/> 
      Autentificare
      </button>
    </div> 
        
                                                         </td>
                            </tr>
            
            </table>
</div>
 </form>

<div style="width:100%; float:left;" class="content_cont">
<br>
Bine ati venit in pagina de autentificare in <?=SITE_NAME?>. Pentru a intra in contul dvs, introduceti adresa de e-mail si parola in campurile de mai sus.

<br><br>

In cazul in care ati uitat parola, folositi linkul <a href="<?=SITE_URL?>pages.php?link=recuperare" class="content_cont"><strong>Am uitat parola</strong></a>; introduceti adresa de e-mail pe care ati folosit-o pentru crearea contului pe magazinul nostru virtual si veti primi in cel mai scurt timp datele de autentificare.

<br>

Daca nu mai stiti care este adresa de e-mail pe cate ati folosit-o pentru crearea contului, va rugam sa contactati administratorii site-lui prin:
<br>
<br>

- e-mail, la adresa: <strong><?=$hf[0][emails];?></strong>
<br>

- telefonic, la:  <strong><?=$hf[0][telefoane];?></strong>
</div>

<? } else { ?>

<div    class="content_cont">

         <br>
             
         Autentificare efectuata cu succes. Bine ai venit <strong><?=$_SESSION[user][nume_user];?></strong>. 
       
        <br>
        <br>
        
        Poti merge in magazinul virtual pentru a continua cumparaturile sau poti merge in pagina de detalii cont unde poti sa-ti modifici parola de acces, 
        datele de facturare si livrare sau poti consulta istoricul si statusul comenzilor efectuate.
        
        <br>
        <br>
        <br>
 

        
  <div class="buttons"  style="float:left; margin-right:20px;" >
    <a href="<?=SITE_URL?>" >
        <img src="images/icons/basket_add.png" alt=""/> 
      Mergi in magazin 
    </a>
  </div>
        
      
      
  
    <div class="buttons" style="float:left; margin-right:20px;">
    <a href="<?=SITE_URL?>cont_edit.php" >
        <img src="images/icons/user_edit.png" alt=""/> 
     Date cont, istoric comenzi
    </a>
  </div>
           
      
 
  <div class="buttons" style="float:left; ">
    <a href="<?=SITE_URL?>index.html?logout=1" >
        <img src="images/icons/key.png" alt=""/> 
     Logout
    </a>
  </div>
  
   </div>     
 
<? } ?>



	 
	 
         
         
         
          
        </div> 
        
    
         
      
   </div>     
  
    
     <? include "foot.php";?>
    
     

</div>


</body>
</html>
