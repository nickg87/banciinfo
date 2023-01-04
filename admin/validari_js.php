



<script type="text/javascript">
<!--

function validate_form_<?=$form_name?> ( )
{
   var textstring = '';
    valid = true;
<? foreach($vld_fileds as $field => $index) {?>

    if ( document.<?=$form_name?>["<?=$index?>"].value == "" )
    {
       textstring +='- <?=$vld_ms[$index]?>'+ '\n';
        valid = false;
    }
<? }?>
  
  if (!valid)  alert ( "Nu ati completat: \n" +textstring );
    return valid;
}

//-->
</script>
 

<? //////////////////// end form validation ?>