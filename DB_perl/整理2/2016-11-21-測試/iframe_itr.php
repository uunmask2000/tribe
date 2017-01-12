<?php
  function create_connection()
  {
    $link = mysql_connect("127.0.0.1", "root", "0932969495","AP_data")
      or die("無法建立資料連接<br><br>" . mysql_error());
	  
    mysql_query("SET NAMES utf8");
			   	
    return $link;
  }
	
  function execute_sql($database, $sql, $link)
  {
    $db_selected = mysql_select_db($database, $link)
      or die("開啟資料庫失敗1<br><br>" . mysql_error($link));
						 
    $result = mysql_query($sql, $link);
		
    return $result;
  }
$database_name = 'AP_data';
?>


<?php
  function create_connection2()
  {
    $link2 = mysql_connect("127.0.0.1", "root", "0932969495","Copy_date")
      or die("無法建立資料連接2<br><br>" . mysql_error());
	  
    mysql_query("SET NAMES utf8");
			   	
    return $link2;
  }
	
  function execute_sql2($database, $sql, $link)
  {
    $db_selected2 = mysql_select_db($database, $link)
      or die("開啟資料庫失敗2<br><br>" . mysql_error($link));
						 
    $result2 = mysql_query($sql, $link);
		
    return $result2;
  }
$database_name2 = 'Copy_date';

$link = create_connection();
$link2 = create_connection2();


?>
<?php
 
$sql_t = "SELECT * FROM `tribe` ";
$result_t= execute_sql($database_name, $sql_t, $link);
while ($row_t = mysql_fetch_array($result_t))
{
	?>
	<iframe src="iframe_itr_view.php?tribe_id=<?=$row_t['tribe_id'];?>" width="250px" height="300px" frameborder="0" scrolling="no"></iframe>
	
	<?php


}

?>