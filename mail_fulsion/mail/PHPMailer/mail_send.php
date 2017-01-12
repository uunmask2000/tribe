<?php
   $mail= new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = false;
	 $mail->CharSet = "utf-8";
	 $mail->SMTPSecure = "TLS";						//SMTP驗證方式 SSL/TLS
		//$mail->SMTPSecure = "ssl";						//SMTP驗證方式 SSL/TLS
		/*
		$mail->SMTPSecure = "TLS";	
		$mail->Host = "mail.zhan-yang.com.tw"; //這裡填入SMTP主機位置  
		$mail->Port = 25; //設定SMTP埠位，預設為25埠。						//SMTP主機的埠號(Gmail為465)。
		$mail->CharSet = "utf-8";	
		$mail->Username = "uunmask2000@zhan-yang.com.tw"; //設定驗證帳號，就是「PChome的會員帳號」。
		$mail->Password = "jim55jay"; //設定驗證密碼，就是「PChome的會員密碼」。
		*/
  //itribe2016@gamil.com
 //DS8FZHQ6









?>