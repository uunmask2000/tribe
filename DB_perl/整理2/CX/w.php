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
echo $sql_Mm="SELECT monthly_report_itw_id,aroused_general_interest FROM `monthly_report_itw` WHERE `tribe` LIKE '%天狗%' ORDER BY `aroused_general_interest` ASC";
		$result_Mm = execute_sql($database_name2, $sql_Mm, $link2);					
		while ($row_Mm= mysql_fetch_assoc($result_Mm) )
		{
		
		$monthly_report_itw_id = $row_Mm['monthly_report_itw_id'];
		$aroused_general_interest  = '天狗'.$row_Mm['aroused_general_interest'];
		$sql3 = " UPDATE sum_day_hr_itw SET aroused_general_interest='$aroused_general_interest' WHERE monthly_report_itw_id='$monthly_report_itw_id' ";
		//echo $sql3;
		//echo '<br>';
		execute_sql($database_name2, $sql3, $link2);
		}	


			//$sum_day_hr_itw_id = mysql_result($result31, 0, "sum_day_hr_itw_id");
			//$sql3 = " UPDATE sum_day_hr_itw SET Upload_traffic='$acctinputoctets' , Download_traffic='$acctoutputoctets' WHERE setting_id='$setting_id' and time_zone_h='$time_string' and sum_day_hr_itw_id='$sum_day_hr_itw_id'";
			//execute_sql($database_name2, $sql3, $link2);
			
?>
