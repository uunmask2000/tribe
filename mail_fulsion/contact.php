<?php

include_once('mail/PHPMailer/PHPMailerAutoload.php');
include_once('mail/PHPMailer/mail_send.php');
//include_once('mail/PHPMailer/mail_send_gmail.php');
//mail_send_gmail.php
//$mail->From = $email;

//$mail->FromName =  $name;
$mail_title1 = "展暘" ;
$mail_title2 = "聯絡我們<回信>" ;
$mail->From = 'itribe2016@gamil.com';
$mail->FromName = $mail_title1;
$mail->Subject = $mail_title1;
$mail->Body = '內容';


$attach = '全部.xlsx';

$mail->IsHTML(true);
$mail->AddAttachment("", "");
$mail->AddAddress('uunmask2000@gmail.com','康康');				//收件者信箱
//$mail->AddBCC("service@zhan-yang.com.tw","展暘");
//$mail->AddBCC("service@autolong.com.tw", "東乾企業有限公司CC");
//$mail->AddAttachment($file_name); // 設定附件檔檔名
$mail->AddAttachment($attach, $attach); 


if(!$mail->Send())
{
		echo "<p align=center>傳送Error1: ".$errorx=$mail->ErrorInfo."</p>";
}else
	{	

	echo "<p align=center><b>傳送成功。</b></p>";
	}
//
//header('Location:feedback.php');



?>