<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 


 
</head>


<body style="background-color:#FFFFFF; " >
 


<table width="890" height="238" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="53" height="238" align="center" valign="top"></td>
    <td width="776" align="left" valign="top" class="content" ><p ><strong>
    Buna ziua,
    <br />
Comanda dvs. a fost trimisa si inregistrata cu numarul {id_proforma}, va multumim.
<br />

<br />
Va fi necesara interventia unui operator pentru programarea livrarii si confirmarea platii. Veti fi contactat de un consultant vanzari {site_name} pentru a vi se solicita aceste detalii.
<br />

Pentru orice detalii suplimentare sau modificari asupra comenzii, nu ezitati sa ne contactati.

     </strong></p>
  

  <div style="width:800px; float:left; border-bottom:1px solid #999999; margin-bottom:20px; " class="small_text">
<br />
 <strong>Data: {data}<br />
      Cota TVA: 24</strong><br />
  <br />
<strong>     Date comanda:</strong>
     <br />
 <strong>Cumparator: {nume}</strong><br />
      CUI / CNP: {cui} {cnp} |  RC / CI: {rc} {ci}<br />
      Judet: {judet} |    Localitate: {localitate}<br />
      Adresa: {adresa_facturare} |
      Cod Postal: {cod_postal}<br />
      Telefon: {telefon}<br />
      <br />


      </div>
     
      <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#cccccc" align="center" class="content">
        <tr>
          <td colspan="2" align="left" bgcolor="#ffffff"><b>Denumire</b></td>
          <td width="40" align="center" bgcolor="#ffffff">Nr buc</td>
          <td width="33" align="center" bgcolor="#ffffff">U.M</td>
          <td width="80" align="center" bgcolor="#ffffff">Pret unitar</td>
          <td width="135" align="right" bgcolor="#ffffff"><b>Valoare <br />
          (TVA inclus)</b></td>
        </tr>
        <!--CART-->
        <tr>
          <td width="70" align="left" bgcolor="#ffffff"><b>{crt}.</b></td>
          <td width="339" align="left" bgcolor="#ffffff">{produs}</td>
          <td align="center" bgcolor="#ffffff">{cant}</td>
          <td align="center" bgcolor="#ffffff">{um}</td>
          <td align="center" bgcolor="#ffffff">{pret_unitar}</td>
          <td bgcolor="#ffffff" align="right">{pret_total} Lei</td>
        </tr>
        <!--END-CART-->
        <tr>
          <td colspan="5" align="left" bgcolor="#ffffff"><b>Taxe Livrare</b></td>
          <td bgcolor="#ffffff" align="right"><b>{pret_livrare} Lei</b></td>
        </tr>
        <tr>
          <td colspan="5" align="left" bgcolor="#ffffff"><b>TOTAL lei</b></td>
          <td bgcolor="#ffffff" align="right"><b>{total_comanda} Lei</b></td>
        </tr>
        <tr>
          <td colspan="5" align="left" bgcolor="#ffffff">&nbsp;</td>
          <td bgcolor="#ffffff" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" align="left" bgcolor="#ffffff"><strong>Adresa de livrare:</strong> {adresa_livrare}</td>
        </tr>
        <tr>
          <td colspan="6" align="left" bgcolor="#ffffff"><strong>Comentarii client: </strong>{comentarii}</td>
        </tr>
    </table>
    
  <div style="width:800px; float:left; border-bottom:1px solid #999999; margin-bottom:20px; " class="small_text">
<br />
Pentru a accesa contul dvs de pe {site_name} click <a href="{site_url}auth.html">aici</a>.<br />
Acesta este un mesaj automat de confirmare a comenzii. Veti fi contactat in scurt timp de un consultant vanzari {site_name} pentru finalizarea comenzii.

<br />

Toate cele bune,
<br />
Echipa {site_name}
<br />
<a href="{site_url}">{site_url}</a>
<br />
<br />
<br />
</div>
    
    
    </td>
    <td width="61" align="center" valign="top">&nbsp;</td>
  </tr>
</table>
 
</body>
</html>
