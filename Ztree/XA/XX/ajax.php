<?php
include("../SQL/dbtools_ps.php"); 
include_once("../SQL/dbtools.inc.php");
$link = create_connection();
session_start();
$sql_text ="SELECT a.id, b.login_log_id
			FROM `Browsing history` as a, `login_log` as b 
			limit 10;
		
            ";
$result_text = execute_sql($database_name, $sql_text, $link);
$num_rows = mysql_num_rows($result_text);
echo "$num_rows Rows\n";

//先設定時區
date_default_timezone_set("Asia/Taipei");

//取得現在時間，用字串的形式
$_SESSION['time']  = date("Y-m-d H:i:s");
echo  $_SESSION['time'] 
?>	