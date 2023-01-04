<? include('settings/s_settings.php');


$Usr = new UserManagement($DBF['erad_users']);
$p[] = " fac.id_user = '".$_SESSION[iduser]."' ";

$Cmd = new ComenziManagement($DBF[erad_comenzi]);
   $where =implode(' AND ', $p);
   $order =' order by id_comanda desc';
//$where = "fac.id_status = '".$_SESSION[c_id_status]."' AND MONTH(data_comanda) = '".$_SESSION[c_month]."' AND YEAR(data_comanda) = '".$_SESSION[c_year]."'";
$cmd = $Cmd->getCmd($where, $order);


$tt=0;
foreach($cmd as $cc) $tt+=($cc['total_comanda']-$cc['pret_livrare']);

$nr_comenzi=count($cmd);


$title=SITE_NAME ." - Date cont | Istoric comenzi";
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
            
 <p class="titlu_mare">Comenzile mele</p>
 
<br>
  
		
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc" class="content">
 
 <tr>
  <td bgcolor="#efefef" colspan="10" height="30" align="left">
<span class="sapou"><strong>  Nr comenzi: <?=$nr_comenzi?></strong>&nbsp;&nbsp; | Total comenzi: <strong><?=$tt?> Lei </strong></span>    </td>
 </tr>
 <tr>
  <td bgcolor="#EFEFEF"    >ID</td>
  <td bgcolor="#EFEFEF"    > 
  Data   </td>
  
  <td bgcolor="#EFEFEF"    >Mod. plata</td>
  <td bgcolor="#EFEFEF"    >

 Status  </td>
  <td bgcolor="#EFEFEF"    >
  
Total  [lei]  </td>
  
  <td bgcolor="#EFEFEF"    >Optiuni</td>
 </tr>
  <?  
 
for($i=0; $i<$nr_comenzi; $i++) { 
 
	 
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="38"><?=$cmd[$i]['id_comanda']?></td>
  <td> <?=show_date_ro($cmd[$i]['data_comanda'])?></td>
  
  <td><?=$cmd[$i]['mod_plata']?></td>
  <td><?=$cmd[$i]['status']?></td>
  <td><strong><?=$cmd[$i]['total_comanda']?></strong></td>
  
  <td width="30" align="center" nowrap>
  		<a href="<?=SITE_URL?>cont_detalii_comanda.php?id_comanda=<?=$cmd[$i]['id_comanda']?>" title="Detalii comanda"><img src="images/icons/zoom_in.png" border="0"   style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? }   ?>
</table>				   
					  
    
         
         
      </div><!-- end center -->
        
      
      
        
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
