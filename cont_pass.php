<? include('settings/s_settings.php');


$Usr = new UserManagement($DBF['erad_users']);



if(isset($_POST[s_sign_up])) {
	$vl = array();
	$vl = $_POST;


	
	#verificari
	$error = array();
	 

	//if (!chk_email($_POST['email'])) $error[]='Email incorect'; 
	 	
	 if(trim($vl[parolanoua])<>'')  { 
			if($vl[parolanoua] != $vl[rparolanoua]) $error[] = 'Parola retiparita este gresita';
			 if(md5($vl[parolaveche])<>$vl[parolavechex])	$error[] = 'Introduceti parola veche';
			  $parola_noua=md5($vl[parolanoua]);
	//605823
	if(empty($error)) $ins= mysql_query ("update erad_users set password='".$parola_noua."' where id_user='".$_SESSION[iduser]."'");
	 	if($ins) echo js_redirect($scr.'?msg_ok=1');
			}
	
	 
	
} else {
$vldb=$Usr->get01($_SESSION[iduser]);
  
$vl=$Usr->DbToForm($vldb);
}


$title=SITE_NAME ." - Modificare  parola";
?>

<? 

include "head_data.php";?>

 


<body  style="margin:0;"> 
 

<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
       <div id="LEFT" class="left" >
                
            <? $tip=3;?>
             <? include "left_cont.php";?>
            <? include "box_intrebari.php";?>
            <? include "banner_left.php";?>
             
          
        </div>
        
         
        
        
        
        <div id="CENTRU" class="centru">
            
 <p class="titlu_mare">Modificare parola</p>
 
<br>
  
		
<? if($_GET[msg_ok] == 1) { ?>  
	<div class="ok">
    Datele dvs. au fost modificate
	</div>
<? }  ?>


<form  name="sform"  action="<?=SITE_URL?>cont_pass.php" method="post" id="login_customer"  >
          
								
 
		    <? if(count($error)>0) { ?>
                <div class="error">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?>
            <table  cellpadding="0" cellspacing="10" width="500" class="content_cont"  >
    <tr align="right">
    <td width="124" align="center">&nbsp;</td>
    <td align="left">
    
                                      <input type="hidden" name="s_sign_up" value="1" />                               
   
    <table width="500" border="0" cellpadding="0" cellspacing="10" class="content_cont"  >
                <tbody>
                  <tr>
                    <td width="163" align="left" >Parola veche:</td>
                    <td width="307" align="left" >
				    <input  name="parolaveche" size="26" type="password" class="input"   /></td>
                  </tr>
                  <tr>
                    <td align="left" >Parola noua:</td>
                   <td align="left" >
					   <input  name="parolanoua" size="26" type="password" class="input"    /></td>
                  </tr>
                  <tr>
                    <td align="left" >Confirma parola noua:</td>
                    <td align="left" >
                    <input   name="rparolanoua" size="26" type="password" class="input"    />
                        <input name="parolavechex" size="26" type="hidden"  value="<?=$vl[password]?>"  />                    </td>
                  </tr>
                            <tr>
                              <td align="right" >&nbsp;</td>
                              <td align="left" >                                                            </td>
                            </tr>
              </tbody>
            </table>
    
    <div class="buttons"  >
    <button type="submit" class="negative"  >
      <img src="images/icons/tick.png" alt=""/> 
      Salveaza
      </button>
    </div>
    
    </td>
   </tr>
 </table>
            
        </form> 
					   
					  
    
         
         
        </div><!-- end center -->
        
      
      
        
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
