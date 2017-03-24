<?php

//reporter db
//radacct table
  function create_connection()
  {
     //$link = mysql_connect("172.20.0.12", "reporter", "8825252qE","radius")
     $link = mysql_connect("localhost", "root", "0932969495","Copy_date")
	 or die("無法建立資料連接<br><br>" . mysql_error());
	  
    mysql_query("SET NAMES utf8");
			   	
    return $link;
  }
	
  function execute_sql($database, $sql, $link)
  {
    $db_selected = mysql_select_db($database, $link)
      or die("開啟資料庫失敗<br><br>" . mysql_error($link));
						 
    $result = mysql_query($sql, $link);
		
    return $result;
  }
	//$database_name = 'radius';
	$database_name = 'Copy_date';
?>


<?php
  function create_connection2()
  {
    $link2 = mysql_connect("127.0.0.1", "root", "0932969495","AP_data")
      or die("無法建立資料連接2<br><br>" . mysql_error());
	  
    mysql_query("SET NAMES utf8");
			   	
    return $link2;
  }
	
  function execute_sql2($database, $sql, $link)
  {
    $db_selected2 = mysql_select_db($database, $link)
      or die("開啟資料庫失敗<br><br>" . mysql_error($link));
						 
    $result2 = mysql_query($sql, $link);
		
    return $result2;
  }
$database_name2 = 'AP_data';
$link = create_connection();
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

$sql_a = "SELECT * FROM `tribe` ORDER BY `tribe_network_segment` ASC "; //limit 2只搜尋2個部落
$result_sum2 = execute_sql2($database_name2, $sql_a, $link2);
while ($row_sum2 = mysql_fetch_array($result_sum2))
{
	$B =  $row_sum2['tribe_network_segment'];
	$C =  $row_sum2['tribe_name'];
	$D =  $row_sum2['tribe_flow'];
	//echo $B.'<br>' ;
	$sql_sum = "SELECT SUM(acctinputoctets), SUM(acctoutputoctets)  FROM `radacct` WHERE `nasipaddress` LIKE '".$B."%' and acctstarttime BETWEEN '$a_time_sater1' AND '$a_time_sater2' " ;
    //echo $sql_sum.'<br>' ;
	$result_sum = execute_sql($database_name, $sql_sum, $link);
//echo $sql_sum  ;
//exit();
while ($row_sum = mysql_fetch_array($result_sum))
{
	 $A2  = $row_sum['SUM(acctoutputoctets)'];
	 $A2 = ceil($A2/1024000);
	if($A2 < $D)
	{
		//echo $D ;
			$mail_title1 = "愛部落" ;
			$mail_title2 = $C.'網路流量-緊急告警' ;
			$mail->From = 'itribe2016@gamil.com';
			$mail->FromName = $mail_title1;
			$mail->Subject = $mail_title2;
			$mail->Body = '網段 : '.$B.'0/24  <br>  流量為 : '.$A2.'(MB) < '.$D.'(MB)<br>此為系統自動寄出，請勿回覆。' ;
			$mail->IsHTML(true);
			$mail->AddAttachment("", "");		
//$mail->AddAddress('uunmask2000@gmail.com','康康');				//收件者信箱

					//$mail->AddAddress('seanchen@tiis.com.tw','seanchen');
					//$mail->AddAddress('frankchang@tiis.com.tw','Frank');
					//$mail->AddAddress('danielwu@tiis.com.tw','Daniel');
				//	$mail->AddAddress('yashon@tecom.com.tw','Yashon');
					//$mail->AddAddress('heaven@fareastone.com.tw','Heaven');
					//$mail->AddAddress('chhsfang@fareastone.com.tw','Chhsfang');				
					//$mail->AddAddress('danielwu@tiis.com.tw','danielwu');				//總PM收件者信箱
					//danielwu@tiis.com.tw
					$addressCC = "noming@zhan-yang.com.tw";
					$mail->AddBCC($addressCC, 'meme');	
				
		if(!$mail->Send())
		{
		echo "<p align=center>傳送Error1: ".$errorx=$mail->ErrorInfo."</p>";
		}else
		{	

		echo "<p align=center><b>傳送成功。</b></p>";
		}		
	
	}else
	{
		
	}
	
}
}
//exit();


?>