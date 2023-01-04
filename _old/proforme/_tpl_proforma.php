<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 


<style type="text/css">
@import "<?=SITE_URL?>style/style.css";
</style>
</head>


<body style="background-color:#FFFFFF">
 


<table width="890" height="238" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="53" height="238" align="center" valign="top"></td>
    <td width="776" align="left" valign="top" class="content_large" ><p style="font-size:16px;"><strong>Proforma: Nr {id_proforma}</strong></p>
  <div style="width:300px; float:left;">
  <strong>Furnizor: {firma_denumire}</strong><br />
      Sediul social: {firma_sediu}<br />
      R.C.: {firma_ro}<br />
      C.F.: {firma_cui} <br />
      <br />
      Cont lei: {firma_cont}<br />
      Banca: {firma_banca}<br />
</div>

  <div style="width:200px; float:left;">
      <strong>Cumparator: {nume}</strong><br />
      CUI / CNP: {cui} {cnp}<br />
      RC / CI: {rc} {ci}<br />
      Judet: {judet}<br />
      Localitate: {localitate}<br />
      Adresa: {adresa_facturare}<br />
      Cod Postal: {cod_postal}<br /><br />
      </div>
      <strong>Data: {data}<br />
      Cota TVA: 24</strong><br />
  <br />
      <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#cccccc" align="center">
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
          <td colspan="6" align="left" bgcolor="#ffffff"><strong>Comenarii client: </strong>{comentarii}</td>
        </tr>
        <tr>
          <td colspan="6" align="left" bgcolor="#ffffff"><strong>Comentarii furnizor:</strong> {comentarii_furnizor}</td>
        </tr>
    </table></td>
    <td width="61" align="center" valign="top">&nbsp;</td>
  </tr>
</table>
 
</body>
</html>
