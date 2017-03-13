<?php
  function create_connection2()
  {
    $link2 = mysql_connect("127.0.0.1", "root", "0932969495","Copy_date")
      or die("無法建立資料連接2<br><br>" . mysql_error());
	  
    mysql_query("SET NAMES utf8");
			   	
    return $link2;
  }
	
  function execute_sql2($database, $sql, $link)
  {
    $db_selected2 = mysql_select_db($database, $link)
      or die("開啟資料庫失敗2<br><br>" . mysql_error($link));
						 
    $result2 = mysql_query($sql, $link);
		
    return $result2;
  }
$database_name2 = 'Copy_date';
$link2 = create_connection2();

require_once(__DIR__.'/../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
//require_once(__DIR__.'/../mail_fulsion/mail/PHPMailer/mail_send.php');
require_once(__DIR__.'/../mail_fulsion/mail/PHPMailer/mail_send_gmail.php');
?>

<?php
date_default_timezone_set('Asia/Taipei');
 $a_time_sater1	 = date("Y-m-d H", strtotime( "-6 hour" ));
 $a_time_sater2	 = date("Y-m-d H", strtotime( "-0 hour" ));
//exit();
$sql_sum = "SELECT SUM(acctinputoctets), SUM(acctoutputoctets)  FROM `radacct` WHERE `nasipaddress` LIKE '%.50.%' and acctstarttime BETWEEN '$a_time_sater1' AND '$a_time_sater2' " ;
$result_sum = execute_sql2($database_name2, $sql_sum, $link2);
//echo $sql_sum  ;
//exit();
while ($row_sum = mysql_fetch_array($result_sum))
{
	 $A2  = $row_sum['SUM(acctoutputoctets)'];
	
	if($A2 < 5120000)
	{
		//echo 'NULLL';
$mail_title1 = "愛部落" ;
$mail_title2 = '五峰部落網路流量-緊急告警' ;
$mail->From = 'itribe2016@gamil.com';
$mail->FromName = $mail_title1;
$mail->Subject = $mail_title2;
$mail->Body = '五峰部落網路服務流量低於5MB<br>此信件為系統自動發信，請勿回信';
$mail->IsHTML(true);
$mail->AddAttachment("", "");		
//$mail->AddAddress('uunmask2000@gmail.com','康康');				//收件者信箱

					$mail->AddAddress('seanchen@tiis.com.tw','seanchen');
					$mail->AddAddress('frankchang@tiis.com.tw','Frank');
					$mail->AddAddress('danielwu@tiis.com.tw','Daniel');
					$mail->AddAddress('yashon@tecom.com.tw','Yashon');
					$mail->AddAddress('heaven@fareastone.com.tw','Heaven');
					$mail->AddAddress('chhsfang@fareastone.com.tw','Chhsfang');				
					//$mail->AddAddress('danielwu@tiis.com.tw','danielwu');				//總PM收件者信箱
					//danielwu@tiis.com.tw
					$addressCC = "uunmask2000@gmail.com";
					$mail->AddBCC($addressCC, '康康');	
				
		if(!$mail->Send())
		{
		echo "<p align=center>傳送Error1: ".$errorx=$mail->ErrorInfo."</p>";
		}else
		{	

		echo "<p align=center><b>傳送成功。</b></p>";
		}		
	
	}else
	{
		//echo '都大於警戒值';
	}
	
}
?>