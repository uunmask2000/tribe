<?php
date_default_timezone_set('Asia/Taipei');

 function create_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	$link = @mysql_connect("localhost","root","0932969495","AP_data") or die("無法建立連接");
    //$link = @mysql_connect("localhost","mooncat0301","12345678","counter") or die("無法建立連接");  	
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
  $database_name = "AP_data";   /// 之後 SQL 語法帶入參數 


function create_ps_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	//$link = @mysql_connect("localhost","root","0932969495","AP_data") or die("無法建立連接");
	$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
	
    //$link = @mysql_connect("localhost","mooncat0301","12345678","counter") or die("無法建立連接");  	
    //mysql_query("SET NAMES utf8");
    return $conn;
  }




	$link = create_connection();
	$conn= create_ps_connection();
	
	require_once(__DIR__.'/../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
	//require_once(__DIR__.'/../mail_fulsion/mail/PHPMailer/mail_send.php');
	require_once(__DIR__.'/../mail_fulsion/mail/PHPMailer/mail_send_gmail.php');
?>


<?php
			///檢查真正沒有大於三十分鐘的
				$sql_d  = "DELETE FROM alert_ap_date_filter WHERE TIMEDIFF(alert_ap_date_time_ok,alert_ap_date_time_dead)<'00:30:00' ";
				$result_d  = execute_sql($database_name, $sql_d, $link);
				execute_sql($database_name, $sql_d, $link);
				///檢查真正沒有大於三十分鐘的 	
				sleep(1);	
		
		//$sql_alert_ap_date  = "SELECT * FROM alert_ap_date_filter where mail_type=0  ";
		$sql_alert_ap_date  = "SELECT *,TIMEDIFF(NOW(),alert_ap_date_time_dead) FROM alert_ap_date_filter WHERE  mail_type=0 and TIMEDIFF(NOW(),alert_ap_date_time_dead)>'00:30:00'  ";
		$result_alert_ap_date  = execute_sql($database_name, $sql_alert_ap_date, $link);
		while ($row_alert_ap_date  = mysql_fetch_assoc($result_alert_ap_date))
		{  
					
			
				$alert_written_time	 = date("Y-m-d H:i:s");
					
					$alert_ap_date_filter_id = $row_alert_ap_date['alert_ap_date_filter_id'];
					$mail_type = $row_alert_ap_date['mail_type'];

					if($mail_type==0)
					{
					$mail_title1 = "愛部落" ;
					$mail_title2 = ''.$row_alert_ap_date['alert_ap_date_tribe'].'緊急告警' ;
					$mail->From = 'itribe2016@gamil.com';
					$mail->FromName = $mail_title1;
					$mail->Subject = $mail_title2;
					$mail->Body = $row_alert_ap_date['alert_ap_date_city'].$row_alert_ap_date['alert_ap_date_township'].$row_alert_ap_date['alert_ap_date_tribe'].$row_alert_ap_date['alert_ap_date_ap_name'].'服務中斷<br>此信件為系統自動發信，請勿回信';
					$mail->IsHTML(true);
					$mail->AddAttachment("", "");
					//$mail->AddAddress('uunmask2000@gmail.com','康康');				//收件者信箱
					$mail->AddAddress('seanchen@tiis.com.tw','seanchen');
					$mail->AddAddress('frankchang@tiis.com.tw','Frank');
					$mail->AddAddress('danielwu@tiis.com.tw','Daniel');
					$mail->AddAddress('yashon@tecom.com.tw','Yashon');
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
					$sql = "UPDATE  alert_ap_date_filter SET mail_type='1' , alert_written_time='$alert_written_time'  WHERE alert_ap_date_filter_id='$alert_ap_date_filter_id' ";
					execute_sql($database_name, $sql, $link);
					sleep(1);
						echo		 $sql  ;			

					}

		}
	 //mysql_close($link);
	// pg_close($conn);
?>