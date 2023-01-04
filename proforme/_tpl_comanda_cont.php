 


<table width="100%" height="238" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="238" align="left" valign="top" class="content" > 
  

  <div style="width:100%; float:left; border-bottom:1px solid #999999; margin-bottom:20px; " class="content">
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
     
      <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#cccccc" align="left" class="content">
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
          <td width="20" align="left" bgcolor="#ffffff"><b>{crt}.</b></td>
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
          <tr>
          <td colspan="6" align="left" bgcolor="#ffffff"><strong>Comentarii furnizor:</strong> {comentarii_furnizor}</td>
        </tr>
    </table>
    
  <div style="width:100%; float:left; border-bottom:1px solid #999999; margin-bottom:20px; " class="small_text">
<br />
<br />
<br />
</div>    </td>
  </tr>
</table>
 