 

 <? include('menu_sub.php'); ?> 

<?
$id_user=$_GET['id_user'];

$Usr = new UserManagement($DBF['erad_users']);

$vldb=$Usr->get01($_GET["id_user"]);

$vldb["r_password"]=$vldb["password"];

$vl=$Usr->DbToForm($vldb);


if(isset($_POST[s_sign_up])) {
	$vl = array();
	$vl = $_POST;

if($vl[adr_fact]==1)  $vl[adresa_livrare]=$vl[adresa_facturare]; 
	if($vl[adr_fact]==2)  $vl[adresa_livrare]=$vl[adresa_livrare]; 

	$vldb = $Usr->FormToDb($vl);
	
	#verificari
	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
		$ins = $Usr->update($vldb,$id_user );
	
		if($ins) {
			echo js_redirect('main.php?'.$_SESSION[url]);
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
	}
	
}
 


$users = mysql_query_assoc("SELECT * FROM erad_users where id_user='".$_GET["id_user"]."' ORDER BY denumire");

 
?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
  
  </tr>
</table>


<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
 <tr>
  <td height="30" align="left" valign="middle" bgcolor="#f8f8f8">
  
  		  
 
		
 

 <form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>&id_user=<?=$id_user?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );"> 

            <input type="hidden" name="tip_persoana"   value="<?=$users[0][tip_persoana]?>" />
<fieldset class="">
    <legend class="titlu"><b>Date</b></legend>   
			  <div align="center" class="content">
                <table border="0" cellpadding="0" cellspacing="0" width="280">
                  <tbody>
                    <tr>
                      <td valign="top">
					  <table align="center" border="0" cellpadding="3" cellspacing="0" width="500">
                          <tbody>
                          
                            <tr>
                              <td height="44" colspan="2" align="center" valign="middle">
           <b> 
		   <? if ($users[0][tip_persoana]=='1') echo "PERSOANA FIZICA"; else echo "PERSOANA JURIDICA"; ?>
		   </b>                              </td>
                            </tr>
                            <tr>
                              <td width="44%" align="right"><strong>Email</strong></td>
                              <td width="56%" align="left"><input name="email" size="50" type="text" class="input" value="<?=$vl[email]?>" /></td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center">
                              
                              
                              <table cellpadding="0" cellspacing="10" width="500" class="content">
                                <tr>
                                  <td align="right" valign="top"></td>
                                  <td align="left" ></td>
                                </tr>
                                <tr valign="top">
                                  <td height="26" colspan="2" align="left" valign="middle" bgcolor="#efefef" class="sapou"><strong> Date de livrare:</strong> </td>
                                </tr>
                                <tr>
                                  <td><input type="radio" name="client" value="1"  checked="checked"  onclick="hide_x('persj'); show_x('persf');" <?=checked($vl[client],1);?> />
                                      <strong>Persoana fizica</strong></td>
                                  <td align="left"><input type="radio" name="client" value="2"   onclick="show_x('persj'); hide_x('persf');  "  <?=checked($vl[client],2);?> />
                                      <strong>Persoana juridica</strong></td>
                                </tr>
                              </table>
                              
                              
                              <table cellpadding="0" cellspacing="10" width="500" class="content">
<tr valign="top">
  <td colspan="2" align="left"><strong>Date personale de contact</strong></td>
  </tr>
<tr valign="top">
  <td width="124" align="left">Nume si prenume*:</td>
  <td width="344" align="left" ><input name="nume_user" size="40" type="text" class="input" value="<?=$vl[nume_user]?>" /> </td>
</tr>
     
    <tr valign="top">
      <td align="left">Telefon*:</td>
      <td align="left" ><input name="telefon" size="40" type="text" class="input" value="<?=$vl[telefon]?>" /></td>
    </tr>
   </table>
    
    <table id="persf" cellpadding="0" cellspacing="10" width="500" class="content" <? if($vl[client]==2) echo 'style="display:none;"';?> >
    <tr valign="top">
      <td width="124" align="left">CNP*:</td>
      <td align="left" ><input name="cnp" size="40" type="text" class="input" value="<?=$vl[cnp]?>" />
          <strong><br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left">CI*:</td>
      <td align="left" ><input name="ci" size="40" type="text" class="input" value="<?=$vl[ci]?>" />          </td>
    </tr>
  </table>
  
  
   <table id="persj" cellpadding="0" cellspacing="10" width="500" class="content" <? if($vl[client]==1 or  $vl[client]==0) echo 'style="display:none;"';?>>
    <tr valign="top">
      <td width="124" align="left">Companie *:</td>
      <td align="left" ><strong>
        <input name="denumire" size="40" type="text" class="input" value="<?=$vl[denumire]?>" />
        <br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left">CUI *:</td>
      <td align="left" ><input name="cui" size="40" type="text" class="input" value="<?=$vl[cui]?>" />          </td>
    </tr>
    <tr valign="top">
      <td align="left">Nr.inregistrare *:</td>
      <td align="left" ><input name="reg_comert" size="40" type="text" class="input" value="<?=$vl[reg_comert]?>" /></td>
    </tr>
    <tr valign="top">
      <td align="left">Banca *:</td>
      <td align="left" ><input name="banca" size="40" type="text" class="input" value="<?=$vl[banca]?>" />      </td>
    </tr>
    <tr valign="top">
      <td align="left">Cont bancar *:</td>
      <td align="left" ><input name="cont" size="40" type="text" class="input" value="<?=$vl[cont]?>" />      </td>
    </tr>
    <tr valign="top">
      <td align="left">&nbsp;</td>
      <td align="left" >&nbsp;</td>
    </tr>
  </table>
  
  
  <table   cellpadding="0" cellspacing="10" width="500" class="content">
    <tr valign="top">
      <td align="left">Localitate*:</td>
      <td align="left" ><input name="localitate" size="40" type="text" class="input" value="<?=$vl[localitate]?>" />
          <strong><br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left">Judet*:</td>
      <td align="left" ><?
$judete = mysql_query_assoc("SELECT * FROM erad_judete ORDER BY judet");
?>
          <select name="id_judet"  class="input">
            <option value=""> - </option>
            <? for($i = 0; $i < count($judete); $i++) { ?>
            <option value="<?=$judete[$i][id_judet]?>" <?=selected($vl[id_judet], $judete[$i][id_judet])?>>
            <?=$judete[$i][judet]?>
            </option>
            <? } ?>
          </select>
          <br>
          </strong> </td>
    </tr>
   
    <tr>
      <td align="left"><strong>Adresa facturare*:</strong><br /></td>
      <td align="left" valign="top"  >
      <textarea name="adresa_facturare" rows="5" cols="37" style="height:60px;" class="input"><?=$vl[adresa_facturare]?></textarea>
         <br /></td>
    </tr>
  
  <tr align="left">
    <td></td>
  </tr>
  <tr>
    <td>Cod postal</td>
    <td align="left"><input name="cod_postal" size="40" type="text" class="input" value="<?=$vl[cod_postal]?>" /></td>
  </tr>
  <tr>
    <td><strong>Adresa de livrare*:</strong></td>
    <td align="left">
    <input   type="radio" name="adr_fact" value="1" <?=checked($vl[adr_fact], 1)?> onClick="hide_x('adf'); " checked >
    (aceeasi cu cea de facturare) 

    <input   type="radio" name="adr_fact" value="2" <?=checked($vl[adr_fact], 2)?> onClick="show_x('adf');  " > (alta adresa )      </td>
  </tr>

  <tr align="right">
    <td height="15" colspan="2"></td>
  </tr>
  </table>
  
  
  <table id="adf" cellpadding="0" cellspacing="10" width="500" class="content" <? if($vl[adr_fact]==1   or $vl[adr_fact]==0) echo 'style="display:none;"';?>>
   <tr>
     <td align="left" width="124">Adresa de livrare*:<br />
       Str, nr, bl , ap, zona      </td>
     <td align="left" valign="top"  ><textarea name="adresa_livrare" rows="5" cols="37" style="height:60px;" class="input"><?=$vl[adresa_livrare]?></textarea>     </td>
   </tr> 
   
  <tr align="right">
    <td align="center">&nbsp;</td>
    <td align="center"> ( Adaugati si un reper pentru curier ex: cladirea Vodafone)</td>
   </tr>
 </table>
 
    
                              
                              
                              </td>
                            </tr>
                        </tbody>
                        </table>


					 
            
<p align="center"><input type="submit" name="s_sign_up" value="Salveaza" class="but" /></p>
					  </td>
                    </tr>
                  </tbody>
                </table>
              </div>
			  </fieldset>
          </form>
 
  </td>
  </tr>
</table>
