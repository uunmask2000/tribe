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
//DELETE FROM `alert_ap_date` WHERE `alert_ap_date_time_ok` <>'0000-00-00 00:00:00'
//$sql_d ="DELETE FROM `alert_ap_date` WHERE `alert_ap_date_time_ok` <>'0000-00-00 00:00:00'";
//execute_sql($database_name, $sql_d, $link);
///檢查真正沒有大於三十分鐘的
$sql_d  = "DELETE FROM alert_ap_date_filter WHERE TIMEDIFF(alert_ap_date_time_ok,alert_ap_date_time_dead)<'00:30:00' ";
$result_d  = execute_sql($database_name, $sql_d, $link);
execute_sql($database_name, $sql_d, $link);



?>