 <? include('menu_sub.php'); ?> 
<?

$empty = '<br><font color=red style="font-size: 9px;">empty field</font>';

if(isset($_POST['s_send'])) {
	$subject = quotes(trim($_POST['subject']));
	$message = nl2br(quotes(trim($_POST['content'])));
	
	$error = array();
	
	if(strlen($subject) < 1) {
		$error['subject'] = $empty;
	}
	if(strlen($message) < 1) {
		$error['message'] = $empty;
	}

	if(empty($error)) {
		
		$uploaded = 0;
		$has_attachment = 0;
		$att_file = '';
		$att_type = '';
		if(strlen($_FILES['att_file']['name']) > 0) {
			if($_FILES['att_file']['size'] < 10000000) {
				if(is_uploaded_file($_FILES['att_file']['tmp_name'])) {
					if(move_uploaded_file($_FILES['att_file']['tmp_name'], NEWSLLETTER_ATTACHMENTS_DIR.$_FILES['att_file']['name'])) {
						$att_file = $_FILES['att_file']['name'];
						$att_type = $_FILES['att_file']['type'];
						$uploaded = 1;
						$has_attachment = 1;
					}
				} else {
					$error['att_file'] = 'Attachment File upload failed.';
				}
			} else {
				$error['att_file'] = 'Attachment File too large.';
			}
		}



		if(empty($error)) {
			$nu = mysql_query_assoc("SELECT * FROM erad_newsletter WHERE activ = '1'");
			$sent_nr = 0;
			if($has_attachment == 1 && $uploaded == 1) {
				//with attachment
				for($i=0; $i< count($nu); $i++) {
					$link_unsubscribe = '<a href="' . SITE_URL . 'unsubscribe.php?s=' . md5($nu[$i]['id_user'] . 'bulshit_key_asdasdsa') . '" target="_blank">aici</a>.<br><br>';
					$message_add_on = '<br><br><hr size=1>Ati primit acest mesaj ca urmare a faptului ca v-ati abonat la Newsletterul '.SITE_NAME.' ; in cazul in care doriti sa nu mai primiti aceste mesaje, click ' . $link_unsubscribe;

					$msg = new Email($nu[$i]['nl_email'], artmp_EMAIL_NEWSLETTER, $subject);
					$msg -> Cc = '';
					$msg -> Bcc = '';
					  SITE_DIR.'style/style.css';
					//$message = '<style>'.file_get_contents(SITE_DIR.'style/style.css').'</style>'.$message;
					//$message = '<html><head><LINK href="'.SITE_URL.'style/style.css" rel="stylesheet" type="text/css"></head><body>'.$message.'</body></html>';
					$msg -> SetHtmlContent($message.$message_add_on);
					$msg -> Attach(NEWSLLETTER_ATTACHMENTS_DIR.$att_file, $att_type);
					
					//
					if($msg -> Send())
						$sent_nr++;
					unset($msg);
				}
			} else {
				//without attachment
				for($i=0; $i< count($nu); $i++) {
					$link_unsubscribe = '<a href="' . SITE_URL . 'newsletter.php?s=' . md5($nu[$i]['id_user'] . 'bulshit_key_asdasdsa') . '" target="_blank">aici</a>.<br><br>';
					$message_add_on = '<br><br><hr size=1>Ati primit acest mesaj ca urmare a faptului ca v-ati abonat la Newsletterul '.SITE_NAME.'; in cazul in care doriti sa nu mai primiti aceste mesaje, click ' . $link_unsubscribe;

					//$message = '<style>'.file_get_contents(SITE_DIR.'style/style.css').'</style>'.$message;
					$message = '<html><head><style>'.file_get_contents(SITE_DIR.'style/style.css').'</style></head><body class=content>'.$message.'</body></html>';
		
					if(send_mail($nu[$i]['nl_email'], $subject, $message.$message_add_on, SITE_NAME, PROFORMA_SENDER_EMAIL))
						$sent_nr++;
				}
			}
			
			if($sent_nr > 0) {
			
				 
				
				$msg = 'Newsletter sent.';
			} else {
				$msg = 'Newsletter not sent.';
			}
				
			echo js_redirect($scr.'?section='.$section.'&msg='.$msg);
		}
		
	}
}

?>




<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
   
  </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>
<br />

<fieldset class="" style="width:930px;">
    <legend class="titlu"><b>Trimite Newsletter</b></legend>  

<form action="<?=$scr?>?section=<?=$section?>" method="post" enctype="multipart/form-data">
<table width="930" cellpadding="5" cellspacing="1"bgcolor="#efefef">
 
 <tr>
  <td align="right" width="10%" bgcolor="#ffffff">Subject:<?=$error['subject']?></td>
  <td width="90%" bgcolor="#ffffff"><input type="text" name="subject" size="70" maxlength="255" value="<?=$subject?>"></td>
 </tr>
 <tr>
  <td align="center" bgcolor="#ffffff" colspan="2">Dupa ce apasati "Trimite", asteptati mesajul de confirmare.<br>
  &nbsp; </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff">Message:<?=$error['message']?></td>
  <td bgcolor="#ffffff"><textarea name="content" style="width: 100%;" rows="20"><?=$message?></textarea></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_send" value="Trimite" class="but">   </td>
 </tr>
</table>
</form>
</fieldset>