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
<table>
<?php
		date_default_timezone_set("Asia/Taipei");
		$time_zonw_ymd = date("Y-m-d");
		//$yd =date("Y-m", strtotime('-1 month'));	

$time_string = '2016-11' ;
	$sql_0 = "SELECT *  FROM tribe
			 INNER JOIN city_township ON city_township.township_id = tribe.city_id
			 INNER JOIN city_array ON  city_array.id = tribe.township_id
			 ORDER BY city_array.city_sort";
	$result_0= execute_sql($database_name, $sql_0, $link);
	while ($row_0 = mysql_fetch_array($result_0))
	{
		 $tribe_id = $row_0['tribe_id'];
				$sql_ap = "SELECT GROUP_CONCAT(ass_ap_ip)  FROM `ass_ap` WHERE `ass_ap_tribe`='$tribe_id' ";
				$result_ap = execute_sql($database_name, $sql_ap, $link);			
				while($row_ap = mysql_fetch_array($result_ap))
				{
				$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
				$ass_ap_ip = str_replace (",","','",$ass_ap_ip);
					//echo $ass_ap_ip;
					//echo '<br>';
							$sql_sum = "SELECT SUM(acctinputoctets),SUM(acctoutputoctets) FROM radacct  where nasipaddress IN ('$ass_ap_ip') and  realm<>'0'  and acctstarttime like '%$time_string%' ";
							$result_sum = execute_sql2($database_name2, $sql_sum, $link2);
							while ($row_sum = mysql_fetch_array($result_sum))
							{
								echo '<tr>';
							$acctinputoctets=$row_sum['SUM(acctinputoctets)'];   //紀錄上行
							$acctoutputoctets=$row_sum['SUM(acctoutputoctets)'];   //紀錄下載
									echo '<td>';
									echo $row_0['tribe_id']; 
									echo '</td>';
									echo '<td>';
									echo $acctinputoctets; 
									echo '</td>';
									echo '<td>';
									echo $acctoutputoctets; 
									echo '</td>';
									echo '<td>';
									echo $sql_sum; 
									echo '</td>';
								echo '<tr>';
							}	
				}	
	
	}



?>
</table>
