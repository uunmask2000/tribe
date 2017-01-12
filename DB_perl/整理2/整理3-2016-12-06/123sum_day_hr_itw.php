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
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<table>
	 <tr>
		<th> 期別  </th>
        <th> 縣市  </th>
		<th> 地區  </th>
		<th> 部落  </th>
		<th> 時間  </th>
		<th> 上行  </th>
		<th> 下載  </th>
		<th> 縣市id  </th>
		<th> 地區id  </th>
		<th> 部落id  </th>
		<th> 所有id  </th>

	</tr>
<?php
//$time_zonw_ymd = date("Y-m-d",strtotime("-1 day"));
		//$yd =date("Y-m", strtotime('-1 month'));	
$time_zonw_ymd = '2016-12-02';
		
		$sql_Mm="SELECT MAX(radacctid),MIN(radacctid) FROM radacct  where  realm<>'itw'  and acctstarttime like '%$time_zonw_ymd%' ";
		//echo $sql_Mm;
		$result_Mm = execute_sql($database_name, $sql_Mm, $link);					
		while ($row_Mm= mysql_fetch_assoc($result_Mm) )
		{
		//$MAX_ID = $row_Mm['MAX(radacctid)'];
		$MIX_ID = $row_Mm['MIN(radacctid)'];
		//and radacctid >='$MIX_ID' and radacctid <='$MAX_ID'
		}	

   $time_zone = array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23');
$sql_t = "SELECT * FROM `tribe` ";
$result_t= execute_sql($database_name, $sql_t, $link);
while ($row_t = mysql_fetch_array($result_t))
{

	for($t=0 ; $t <24 ;$t++)
	{
		
	
	
	   ?>
				<tr>
				<td>
                <?php
				$Period = $row_t['tribe_label']; 
				
				echo $Period;
				?>
				</td> 
				<td> 
				<?php
				$city_id	=$row_t['city_id']; 
				$sql_0 = "SELECT * FROM `city_array` where id='$city_id' ";
				$result_0= execute_sql($database_name, $sql_0, $link);
				while ($row_0 = mysql_fetch_array($result_0))
				{
                   $city_name = $row_0['city_name'];
				   echo $city_name;
				}
				?> 

				</td>
				<td> 
				<?php
				$township_id	=$row_t['township_id']; 
				$sql_0 = "SELECT * FROM `city_township` where township_id  ='$township_id' ";
				$result_0= execute_sql($database_name, $sql_0, $link);
				while ($row_0 = mysql_fetch_array($result_0))
				{
					$township_name = $row_0['township_name'];
					  echo $township_name;
				}
				
				?> 				
				
				</td>
				<td>
				<?php
					$tribe_name	=$row_t['tribe_name']; 
					 echo $tribe_name;
				?>  
				
				</td>
				<td>
				<?php
				//$time_zonw_ymd = date('Y-m-d');
				//$time_zonw_ymd = "2016-11-23";
				$time_string = $time_zonw_ymd.' '.$time_zone[$t];
				//$time_string =  date('Y-m-d H');
				echo $time_string;
				?>  </td>
				<?php
				//AP GUlp
				$tribe_id = $row_t['tribe_id'] ;
				$sql_ap = "SELECT GROUP_CONCAT(ass_ap_ip)  FROM `ass_ap` WHERE `ass_ap_tribe`='$tribe_id' ";
				$result_ap = execute_sql($database_name, $sql_ap, $link);			
				while($row_ap = mysql_fetch_array($result_ap))
				{
					$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
					$ass_ap_ip = str_replace (",","','",$ass_ap_ip);
				}	
				$sql_sum = "SELECT SUM(acctinputoctets),SUM(acctoutputoctets) FROM radacct  where nasipaddress IN ('$ass_ap_ip') and  realm<>'0'  and acctstarttime like '%$time_string%' and radacctid >='$MIX_ID' ";
				$result_sum = execute_sql2($database_name2, $sql_sum, $link2);
				//echo  $sql_sum;
				//echo '<br>';
				while ($row_sum = mysql_fetch_array($result_sum))
				{
				$acctinputoctets=$row_sum['SUM(acctinputoctets)'];   //紀錄上行
				$acctoutputoctets=$row_sum['SUM(acctoutputoctets)'];   //紀錄下載
				?>
				<td><?php  echo $acctinputoctets ;?>  </td>
				<td><?php  echo $acctoutputoctets ;?>  </td>
				<?php
				}
				?>
				
				<td> <?=$city_id; ?>  </td>
				<td> <?=$township_id; ?>  </td>
				<td> <?=$tribe_id; ?>  </td>
				<td> 
				<?php
				$setting_id = $city_id.'-'.$township_id.'-'.$tribe_id;
				echo  $setting_id;
				
				?> </td>
				<?php
			$sq3l = " SELECT * FROM sum_day_hr_itw where setting_id='$setting_id' and time_zone_h='$time_string'  ";
			$result31 =  execute_sql2($database_name2, $sq3l, $link2);
			$number31 = mysql_num_rows($result31);	
			if($number31==0)
			{
		$sql2 = "INSERT INTO sum_day_hr_itw(`Period`, `County`, `area`, `tribe`, `time_zone_h`, `Upload_traffic`, `Download_traffic`, `county_sid`, `area_sid`, `tribe_sid`, `setting_id`) VALUES ('$Period', '$city_name', '$township_name', '$tribe_name', '$time_string', '$acctinputoctets', '$acctoutputoctets', '$city_id', '$township_id', '$tribe_id', '$setting_id')";
		execute_sql($database_name2, $sql2, $link2);
		}else{
			$sum_day_hr_itw_id = mysql_result($result31, 0, "sum_day_hr_itw_id");
			$sql3 = " UPDATE sum_day_hr_itw SET Upload_traffic='$acctinputoctets' , Download_traffic='$acctoutputoctets' WHERE setting_id='$setting_id' and time_zone_h='$time_string' and sum_day_hr_itw_id='$sum_day_hr_itw_id'";
			execute_sql($database_name2, $sql3, $link2);
			//echo $sql3 ;
			//echo '<br>';	
			}
	/*
			$sq3l = " SELECT * FROM sum_day_hr_itw where setting_id='$setting_id' and time_zone_h='$time_string'  ";
	$result31 =  execute_sql2($database_name2, $sq3l, $link2);
	$number31 = mysql_num_rows($result31);	
	if($number31==0)
	{
	$sql2 = "INSERT INTO sum_day_hr_itw(`Period`, `County`, `area`, `tribe`, `time_zone_h`, `Upload_traffic`, `Download_traffic`, `county_sid`, `area_sid`, `tribe_sid`, `setting_id`) VALUES ('$Period', '$city_name', '$township_name', '$tribe_name', '$time_string', '$acctinputoctets', '$acctoutputoctets', '$city_id', '$township_id', '$tribe_id', '$setting_id')";
	execute_sql($database_name2, $sql2, $link2);
	}else{
		$sum_day_hr_itw_id = mysql_result($result31, 0, "sum_day_hr_itw_id");
		$sql3 = " UPDATE sum_day_hr_itw SET Upload_traffic='$acctinputoctets' , Download_traffic='$acctoutputoctets' WHERE setting_id='$setting_id' and time_zone_h='$time_string' and sum_day_hr_itw_id='$sum_day_hr_itr_id'";
		execute_sql($database_name2, $sql3, $link2);
		//echo $sql3 ;
		//echo '<br>';		
		}
				*/
				?>
				</tr>	
	   <?php		
	}		
}



?>


</table>

