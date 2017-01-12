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

		$sql_alert_ap_date  = "SELECT * FROM `alert_ap_date_filter` WHERE alert_ap_date_time_ok = '0000-00-00 00:00:00'";
		$result_alert_ap_date  = execute_sql($database_name, $sql_alert_ap_date, $link);
		while ($row_alert_ap_date  = mysql_fetch_assoc($result_alert_ap_date))
		{  

	
				$A  =$row_alert_ap_date['alert_ap_date_outageid']; 	
				$B  =$row_alert_ap_date['alert_ap_date_svclosteventid']; 	
				$c  =$row_alert_ap_date['alert_ap_date_filter_id']; 
				$sql_1  = "SELECT * FROM alert_ap_date WHERE alert_ap_date_outageid = '$A' AND alert_ap_date_svclosteventid = '$B'";
				$result_1 = execute_sql($database_name, $sql_1, $link);
				while ($row_1  = mysql_fetch_assoc($result_1))
				{ 
						//echo $sql_1 ;
						//echo '<br>';
					
					$B1  =$row_1['alert_ap_date_time_ok']; 			
					$sql = "UPDATE  alert_ap_date_filter SET alert_ap_date_time_ok='$B1'    WHERE alert_ap_date_filter_id = '$c ' ";
					execute_sql($database_name, $sql, $link);
					echo  $sql;
					echo '<br>';
						
				}		
		}
		// mysql_close($link);
		
		
	
?>