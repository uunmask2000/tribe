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
$mon = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
for($iii = 0 ; $iii < 12 ; $iii++)
{
//$month_row =date("Y/m/d", strtotime('-1 month'));
//$month_row = '2016-09';
//$month_row =date("Y-m", strtotime('-3 month'));
$month_row = date("Y").'-'.$mon[$iii];

$sql_tribe = "SELECT * FROM `tribe` ";
$result_tribe = execute_sql($database_name, $sql_tribe, $link);
while ($row_tribe = mysql_fetch_array($result_tribe))
{
			$city_id  = $row_tribe['city_id'];
			$township_id =$row_tribe['township_id'];
			$tribe_id =$row_tribe['tribe_id'];
			$tribe_label=$row_tribe['tribe_label'];  //期別
			$tribe_name=$row_tribe['tribe_name']; //部落
			
			//
			$sql_0 = "SELECT `city_name` FROM `city_array` WHERE  `id`='$city_id  ' ";
			$result_0 = execute_sql($database_name, $sql_0, $link);
			while($row_0 = mysql_fetch_array($result_0))
			{
			     $city_name = $row_0['city_name']; //城市
			
			}
			$sql_1= "SELECT `township_name` FROM `city_township` WHERE `township_id`='$township_id' ";
			$result_1 = execute_sql($database_name, $sql_1, $link);
			while($row_1 = mysql_fetch_array($result_1))
			{
			     $township_name = $row_1['township_name'];  //地區
			
			}
			//
			$sql_ap = "SELECT * FROM `ass_ap` WHERE `ass_ap_tribe`='$tribe_id' ";
			$result_ap = execute_sql($database_name, $sql_ap, $link);
			while($row_ap = mysql_fetch_array($result_ap))
			{	
					$ass_ap_id = $row_ap['ass_ap_id'];
					$ass_ap_name = $row_ap['ass_ap_name'];  //設備名稱
					$ass_ap_ip = $row_ap['ass_ap_ip'];	   //設備IP
					
					
					$stting_setting = $city_id .'-'.$township_id .'-'.$tribe_id .'-'.$ass_ap_id ;    //紀錄
					////
					$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip')  and  realm='itw'  and acctstarttime like '%$month_row%'";
					$result1 = execute_sql2($database_name2, $sql1, $link2);
					$number1 = mysql_num_rows($result1); //紀錄使用人次
				//echo $number1;
				//echo '<br>';
					///
					$sql2="SELECT callingstationid   FROM radacct where  nasipaddress IN ('$ass_ap_ip')   and  realm='itw'  and acctstarttime like '%$month_row%'  GROUP BY callingstationid ";
					$result2 = execute_sql2($database_name2, $sql2, $link2);
					$number2 = mysql_num_rows($result2); //紀錄使用人數
				//echo $number2;
				//echo '<br>';
						//
					$sql_sum = "SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets) FROM radacct  where nasipaddress IN ('$ass_ap_ip') and  realm='itw'  and acctstarttime like '%$month_row%' ";
					$result_sum = execute_sql2($database_name2, $sql_sum, $link2);
					//echo  $sql_sum;
					//echo '<br>';
					while ($row_sum = mysql_fetch_array($result_sum))
					{
							$acctsessiontime= $row_sum['SUM(acctsessiontime)'];  //紀錄總使用時間
							$acctinputoctets=$row_sum['SUM(acctinputoctets)'];   //紀錄上行
							$acctoutputoctets=$row_sum['SUM(acctoutputoctets)'];   //紀錄下載
						
						//SUM(acctstartdelay)
						//SUM(acctstopdelay)
						
								if($acctsessiontime==NULL)
								{
								$acctsessiontime = 0;
								}else{
								$acctsessiontime = $acctsessiontime;
								}

								if($acctinputoctets==NULL)
								{
								$acctinputoctets = 0;
								}else{
								$acctinputoctets = $acctinputoctets;
								}


								if($acctoutputoctets==NULL)
								{
								$acctoutputoctets = 0;
								}else{
								$acctoutputoctets = $acctoutputoctets;
								}
//斷線次數
//$sql_tfilter = "SELECT * FROM `alert_ap_date_filter` WHERE `alert_ap_date_ap_ip` ='$ass_ap_ip' and alert_ap_date_time_dead like'%$month_row%'";
//$result_filter = execute_sql($database_name, $sql_tfilter, $link);
//$num_rows = mysql_num_rows($result_filter);	
$sql_00 = "SELECT * FROM `alert_ap_date_filter` WHERE `alert_ap_date_ap_ip` ='$ass_ap_ip' and alert_ap_date_time_dead like'%$month_row%' ";
$result_00 = execute_sql($database_name, $sql_00, $link);
$num_rows= mysql_num_rows($result_00); 
						
						$sq3l = " SELECT * FROM monthly_report_itw where setting='$stting_setting' and Time_interval='$month_row'  ";
						$result31 =  execute_sql2($database_name2, $sq3l, $link2);
						$number31 = mysql_num_rows($result31);	
						if($number31==0)
						{
		//$sql2 = "INSERT INTO `monthly_report_itw`(`Period`, `County`, `area`, `tribe`, `aroused_general_interest`, `Device_IP`, `Use_of_people`, `Number_of_users`, `Total_usage_time`, `Upload_traffic`, `Download_traffic`, `setting`, `Time_interval`,county_sid,area_sid,tribe_sid) VALUES ('$tribe_label','$city_name','$township_name','$tribe_name','$ass_ap_name','$ass_ap_ip','$number1','$number2','$acctsessiontime','$acctinputoctets','$acctoutputoctets','$stting_setting','$month_row','$city_id','$township_id','$tribe_id')";
		//execute_sql($database_name2, $sql2, $link2);
			$sql2 = "INSERT INTO `monthly_report_itw`(`Period`, `County`, `area`, `tribe`, `aroused_general_interest`, `Device_IP`, `Use_of_people`, `Number_of_users`, `Total_usage_time`, `Upload_traffic`, `Download_traffic`, `setting`, `Time_interval`,county_sid,area_sid,tribe_sid,filter_number) VALUES ('$tribe_label','$city_name','$township_name','$tribe_name','$ass_ap_name','$ass_ap_ip','$number1','$number2','$acctsessiontime','$acctinputoctets','$acctoutputoctets','$stting_setting','$month_row','$city_id','$township_id','$tribe_id','$num_rows')";
			execute_sql($database_name2, $sql2, $link2);
			//echo $sql2;
			//echo '<br>';
						}else{
							//UPDATE
							
				while ($row = mysql_fetch_array($result31))
{							
$id = $row['monthly_report_itw_id'];

//UPDATE
$sql3 = "UPDATE `monthly_report_itw` SET Use_of_people ='$number1',Number_of_users ='$number2',Total_usage_time ='$acctsessiontime',Upload_traffic ='$acctinputoctets',Download_traffic ='$acctoutputoctets',filter_number ='$num_rows' where monthly_report_itw_id ='$id '  ";
execute_sql($database_name2, $sql3, $link2);	
//echo $sql3;
//echo '<br>';
}				
						}
							
					//echo  $sql2;
					}
					
					
					
			}	

}
}
 //mysql_close($link);
// mysql_close($link2);

?>


