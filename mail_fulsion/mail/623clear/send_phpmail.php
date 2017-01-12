<?php  //寄出mail

function send_phpmail($mail_info)
{	
//081122 更改自 泓璋-元和雅台南 寄出mail 程式


//宣告一個PHPMailer物件
$mail = new PHPMailer();
//設定使用SMTP發送
$mail->IsMail();
//寄件人Email
$mail->From = $mail_info['from_mail'];
//寄件人名稱
$mail->FromName = $mail_info['form_name'];


//收件人Email
	//設定收件人的另一種格式("Email")
	//設定收件人的另一種格式("Email","收件人名稱")
        $s1=explode(",",$mail_info['to_mail']);
        $s2=explode(",",$mail_info['to_name']);
        for($i=0;$i<count($s1);$i++)
        {
	    if((trim($mail_info['to_name']))=='')
	    {$mail->AddAddress($s1[$i]);}
	    else
	    {$mail->AddAddress($s1[$i],$s2[$i]);}
        }


//設定副本
	
        $s1=explode(",",$mail_info['cc_mail_must']);
        for($i=0;$i<count($s1);$i++)
        {$mail->AddCC($s1[$i]);}
        
//設定密件副本
        $s1=explode(",",$mail_info['bcc_mail_must']);
        for($i=0;$i<count($s1);$i++)
        {$mail->AddCC($s1[$i]);}
		
//設定信件字元編碼
	$mail->CharSet="utf-8";
	//設定信件編碼，大部分郵件工具都支援此編碼方式
	$mail->Encoding = "base64";
	//設置郵件格式為HTML
	$mail->IsHTML(true);
	//每50自斷行
	$mail->WordWrap = 50;
//郵件標題
	$mail->Subject=$mail_info['to_subject'];
	//郵件內容
	$mail->Body =$mail_info['mail_html'];;
//寄送郵件
	if(!$mail->Send())
		return false;
	else
		return true;
}
?>