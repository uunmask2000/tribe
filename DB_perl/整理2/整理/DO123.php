
<?php
/*
  function create_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	$link = @mysql_connect("localhost","root","0932969495","TEST_DB") or die("無法建立連接");
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
  $database_name = "TEST_DB";   /// 之後 SQL 語法帶入參數 
  

  
$AAAA = 123;
  */
  
  
?>

<?php
 function create_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	$link = @mysql_connect("localhost","root","0932969495","TEST_DB") or die("無法建立連接");
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
  $database_name = "TEST_DB";   /// 之後 SQL 語法帶入參數 


date_default_timezone_set('Asia/Taipei');
//建立資料連接
$link = create_connection();
$NOWWW    = date("Y-m-d H:i:s");
		$sql = "INSERT INTO TEST_Table(TIME) VALUES('$NOWWW ')";
		execute_sql($database_name , $sql, $link);
		//釋放記憶體並關閉資料連接
		mysql_free_result($result);
	 // mysql_close($link);
//echo $NOWWW;

?>