
<?php
  function create_connection1()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	$link1 = @mysql_connect("localhost","root","0932969495","csv") or die("無法建立連接");
    //$link = @mysql_connect("localhost","mooncat0301","12345678","counter") or die("無法建立連接");  	
    mysql_query("SET NAMES utf8");
			   	
    return $link1;
  }
	
  function execute_sql1($database, $sql, $link)
  {
    $db_selected = mysql_select_db($database, $link)
      or die("開啟資料庫失敗<br><br>" . mysql_error($link));
						 
    $result = mysql_query($sql, $link);
		
    return $result;
  }
  $database_name = "csv";   /// 之後 SQL 語法帶入參數 
?>
