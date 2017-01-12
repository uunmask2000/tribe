<?php  //寄出mail
function send_mail($mail_info)
{	
	$headers = 'From: ' . $mail_info['from_mail'] . "\r\n";    //mail
	if($mail_info['bcc_mail_must']==1)
		$headers .= 'Bcc: ' . $mail_info['bcc_mail'] . "\r\n";
	if($mail_info['cc_mail_must']==1)
		$headers .= 'cc: ' . $mail_info['cc_mail'] . "\r\n";
	//$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$title = '=?utf-8?b?'.base64_encode($mail_info['to_subject']).'?=';
	$title = '=?utf-8?b?'.base64_encode($mail_info['form_name']).'?='; //11.10 姓名變成.base64_encode編碼

	//$title = iconv('UTF-8', 'Big5', $title); //標題轉成big5以使郵件用戶端顯示正常
	return mail($mail_info['to_mail'], $title, $mail_info['mail_html'], $headers);  //mail發送成功true  ,  失敗false
}
?>
