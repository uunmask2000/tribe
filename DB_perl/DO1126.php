<?php

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

?>


<?php
//alert_ap_date_outageid in(47669,47671,47679,47708,47710,47718,47771,47773,47843)  and 
				$sql_alert_ap_date  = "SELECT *,TIMEDIFF(alert_ap_date_time_ok,alert_ap_date_time_dead) FROM alert_ap_date where  TIMEDIFF(alert_ap_date_time_ok,alert_ap_date_time_dead) >='00:30:00' or TIMEDIFF(alert_ap_date_time_ok,alert_ap_date_time_dead) is NULL  ";
				$result_alert_ap_date  = execute_sql($database_name, $sql_alert_ap_date, $link);
				while ($row_alert_ap_date  = mysql_fetch_assoc($result_alert_ap_date))
				{  

					$outageid_pg   = $row_alert_ap_date['alert_ap_date_outageid']; 
					$svclosteventid_pg= $row_alert_ap_date['alert_ap_date_svclosteventid']; 
					$city_name     = $row_alert_ap_date['alert_ap_date_city']; 
					$township_name = $row_alert_ap_date['alert_ap_date_township']; 
					$tribe_name = $row_alert_ap_date['alert_ap_date_tribe']; 
					$Period_AP = $row_alert_ap_date['Period_AP'];  
					$ass_ap_name = $row_alert_ap_date['alert_ap_date_ap_name']; 
					$ass_ap_ip = $row_alert_ap_date['alert_ap_date_ap_ip']; 
					$YMD_string = $row_alert_ap_date['alert_ap_date_time_dead']; 
					 $YMD_string_2 = $row_alert_ap_date['alert_ap_date_time_ok']; 
					//echo '<br>';
					$alert_ap_date_setting = $row_alert_ap_date['alert_ap_date_setting']; 
					//echo  $sql_alert_ap_date;
					//echo '<br>';

					$sql = "SELECT * FROM  alert_ap_date_filter WHERE alert_ap_date_outageid ='$outageid_pg' AND alert_ap_date_svclosteventid ='$svclosteventid_pg' ";
					$result = execute_sql($database_name, $sql, $link);
					$number = mysql_num_rows($result);	
						//echo  $sql;
						//echo $number ;
						//echo '<br>';

					if($number==0)
					{
					$sql = "INSERT INTO  alert_ap_date_filter(alert_ap_date_outageid, alert_ap_date_svclosteventid, alert_ap_date_city,alert_ap_date_township,alert_ap_date_tribe,alert_ap_date_ap_name,alert_ap_date_ap_ip,alert_ap_date_time_dead,alert_ap_date_time_ok,alert_ap_date_setting,Period_AP)
					VALUES('$outageid_pg','$svclosteventid_pg','$city_name','$township_name','$tribe_name','$ass_ap_name','$ass_ap_ip','$YMD_string','$YMD_string_2','$alert_ap_date_setting','$Period_AP')";
					execute_sql($database_name, $sql, $link);
					echo  $sql;
				     echo '<br>';
					}else{
					$sql = "UPDATE  alert_ap_date_filter SET alert_ap_date_time_dead='$YMD_string',alert_ap_date_time_ok='$YMD_string_2' WHERE alert_ap_date_outageid='$outageid_pg' and alert_ap_date_svclosteventid ='$svclosteventid_pg'";
					execute_sql($database_name, $sql, $link);
					echo  $sql;
					echo '<br>';
					}	



				}
	// mysql_close($link);
	// pg_close($conn);
//
?>