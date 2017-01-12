<?php



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



?>