<? include('settings/s_settings.php');
 
  $_SESSION[comanda_total]= $_SESSION[cart_total]+$taxa=$_GET[taxa];
 $_SESSION[taxa_transport]=$taxa;
 
 ?>
 
 <?=$_SESSION[comanda_total]?>