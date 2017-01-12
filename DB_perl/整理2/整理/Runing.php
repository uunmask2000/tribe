<?php
/*
include("dbtools.inc.php");
date_default_timezone_set('Asia/Taipei');
//建立資料連接
$link = create_connection();
$NOWWW    = $date('Y-m-d');

$sql = "INSERT INTO TEST_Table(TIME) VALUES('$NOWWW ')";
execute_sql($database_name , $sql, $link);
echo 	 $sql ;
    //釋放記憶體並關閉資料連接
    mysql_free_result($result);
   // mysql_close($link);

echo $AAAA;
*/
?>
123
<?php
require_once("dbtools.inc.php");
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