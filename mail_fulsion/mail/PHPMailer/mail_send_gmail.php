<?php
	/*
	$mail= new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = false;
	$mail->CharSet = "utf-8";
	$mail->SMTPSecure = "TLS";						//SMTP驗證方式 SSL/TLS
	//$mail->SMTPSecure = "ssl";						//SMTP驗證方式 SSL/TLS

	$mail->SMTPSecure = "TLS";	
	$mail->Host = "mail.zhan-yang.com.tw"; //這裡填入SMTP主機位置  
	$mail->Port = 25; //設定SMTP埠位，預設為25埠。						//SMTP主機的埠號(Gmail為465)。
	$mail->CharSet = "utf-8";	
	$mail->Username = "uunmask2000@zhan-yang.com.tw"; //設定驗證帳號，就是「PChome的會員帳號」。
	$mail->Password = "jim55jay"; //設定驗證密碼，就是「PChome的會員密碼」。
	*/
	//itribe2016@gamil.com   //itribe2016smtp
	//itribe2016smtp
	//DS8FZHQ6
					//愛部落 - opennms
					//itribe2016@gamil.com
					//DS8FZHQ6
					//愛部落 - 30分鐘寄信
					//itribe2016smtp@gamil.com
					//DS8FZHQ6

 
 $mail= new PHPMailer(); //建立新物件        
$mail->IsSMTP(); //設定使用SMTP方式寄信        
$mail->SMTPAuth = true; //設定SMTP需要驗證        
$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線   
$mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機        
$mail->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。        
$mail->CharSet = "utf-8"; //設定郵件編碼        

$mail->Username = "itribe2016smtp"; //設定驗證帳號        
$mail->Password = "DS8FZHQ6"; //設定驗證密碼  








?>