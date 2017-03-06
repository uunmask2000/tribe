<?php 
///include("../include/top.php"); 
include_once("../SQL/dbtools.inc.php");
$link = create_connection(); 
?>
<?php
$checkbox_ok  = $_POST['checkbox_ok'] ;  // 繼承前面勾選值
$checkbox_ok = explode(",", $checkbox_ok);

$array_count = count($checkbox_ok);
//print_r($checkbox_ok);

//echo $array_count;
//exit();
?>

<?php

echo $Processing_time_A   = $_POST['time_A'] ;
	echo '<br>';
echo  $time_A = $_POST['time_A'] ;  
	echo '<br>';
echo  $item_wrong_text_A = $_POST['item_wrong_text_A'] ;  
	echo '<br>';
echo  $time_B = $_POST['time_B'] ; 
	echo '<br>';  
echo  $accendant_B = $_POST['accendant_B'] ;  
	echo '<br>';
echo  $item_wrong_text_B = $_POST['item_wrong_text_B'] ;  
	echo '<br>';

echo  $time_C = $_POST['time_C'] ;  
	echo '<br>';
echo  $accendant_C = $_POST['accendant_C'] ;  
	echo '<br>';
echo  $item_wrong_text_C = $_POST['item_wrong_text_C'] ;  
	echo '<br>';
	
echo  $time_D = $_POST['time_D'] ; 
	echo '<br>';  
echo  $accendant_D = $_POST['accendant_D'] ;  
	echo '<br>';
echo  $item_wrong_text_D = $_POST['item_wrong_text_D'] ;  
	echo '<br>';
echo  $time_E = $_POST['time_E'] ;  
	echo '<br>';
echo  $accendant_E = $_POST['accendant_E'] ; 
	echo '<br>';  
echo  $item_wrong_text_E = $_POST['item_wrong_text_E'] ; 
	echo '<br>';  
echo $iA  ='設備服務中斷';
echo '<br>';  
echo $iB  ='網管監控';
echo '<br>';  
$name2 = 'anita';
$sess_anme = '韓同寶';
//exit();
  for($i = 0 ; $i < $array_count ; $i++)
  {
	$key =  $checkbox_ok[$i];   
	  
		$re_time  = $_POST['time_A'];
		$re_time =date( "Y-m-d", strtotime( "$re_time " ) );
		$re_time  = str_replace ("-","",$re_time);
		$re_time  = preg_replace('/\s(?=)/', '', $re_time);  // 刪除 -  : 等
		$sql_query  = "SELECT * FROM alert_ap_date_filter WHERE calling_bar_id LIKE '%$re_time%'";
		$result_query  = execute_sql($database_name, $sql_query, $link);
		$total_row = mysql_num_rows($result_query);  // 取得結果筆數 
		$total_row = ( $total_row +1 ) ;
		$re_time_1 = $re_time ;
		$re_time  =   $re_time.str_pad($total_row,3,'0',STR_PAD_LEFT) ;
		$calling_bar_id = $re_time;   // 手動填寫
		
		$sql_query  = "SELECT * FROM alert_ap_date_filter WHERE calling_bar_id='$calling_bar_id' ";
		$result_query  = execute_sql($database_name, $sql_query, $link);
		$total_row2 = mysql_num_rows($result_query);  // 取得結果筆數 
		//echo $total_row2;
		if($total_row2>0)
		{
		$sql_query  = "SELECT * FROM alert_ap_date_filter WHERE calling_bar_id LIKE '%$re_time_1%'  ORDER BY calling_bar_id desc LIMIT 1 ";
		//echo  $sql_query ;
		$result_query  = execute_sql($database_name, $sql_query, $link);
		while ($row_KID   = mysql_fetch_assoc($result_query))
		{
		///echo   $row_KID['calling_bar_id'];
		$calling_bar_id = $row_KID['calling_bar_id']+1 ;
		}
		}else{
		$calling_bar_id = $calling_bar_id ;
		}
	//echo $calling_bar_id ;
	//exit();

	
///發信時間	
$sql_query_1  = "SELECT * FROM `alert_ap_date_filter` WHERE alert_ap_date_filter_id='$key'  ";
$result_query_1  = execute_sql($database_name, $sql_query_1, $link);	
while ($row_KID_1  = mysql_fetch_assoc($result_query_1))
{
$time =$row_KID_1['alert_written_time'];
}				

//$calling_bar_id = '20171111111';   //需要寫程式判斷
//$time  = '2017-02-21 04:57:02';

	

$sql = "UPDATE  alert_ap_date_filter SET Processing_status='已結案' ,Processing_time_A='$Processing_time_A',note_A='$item_wrong_text_A',calling_bar_id='$calling_bar_id',calling_bar_id_check='$calling_bar_id',Processor_A='$name2' WHERE alert_ap_date_filter_id='$key' ";
execute_sql($database_name, $sql, $link); 
//已發信
$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time','11','$iB','$iB', '$iA ' )";
execute_sql($database_name, $sql, $link);	 
//首回覆
$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time_A','12','$name2','$name2', '$item_wrong_text_A' )";
execute_sql($database_name, $sql, $link);
//已派工
$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time_B','00','$accendant_B','$sess_anme', '$item_wrong_text_B' )";
execute_sql($database_name, $sql, $link);
//已到達
//$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time_C','01','$accendant_C','$sess_anme', '$item_wrong_text_C' )";
//execute_sql($database_name, $sql, $link);
//處理中
$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time_D','02','$accendant_D','$sess_anme', '$item_wrong_text_D' )";
execute_sql($database_name, $sql, $link);
//結案
$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time_E','03','$accendant_E','$sess_anme', '$item_wrong_text_E' )";
execute_sql($database_name, $sql, $link);
	  
  }
?>
<script>
window.location = 'Auto_wirtten_key_in.php';
</script>
<?php

