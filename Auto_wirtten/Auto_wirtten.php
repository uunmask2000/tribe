		<?php 
		///include("../include/top.php"); 
		include_once("../SQL/dbtools.inc.php");
		$link = create_connection(); 
		?>
		
		
		
		
		
		
		
		
<?php
//執行 SQL 命令
$sql = "SELECT *  FROM  alert_ap_date_filter where  Processing_status ='已結案'  ";
$result = execute_sql($database_name, $sql, $link);
while ($row = mysql_fetch_assoc($result))
{
	echo $row['alert_ap_date_filter_id'];
	echo '<br>';
	$key = $row['alert_ap_date_filter_id'];
	$alert_written_time = $row['alert_written_time'];
	//首回復
	$Processing_time_A =  $row['alert_written_time'];
	$note_A =  $row['note_A'];
	$Processor_A =  $row['Processor_A'];
	//note_A
	//Processor_A
	
	$sql_query  = "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' and  Equipment_Repair_type='11'";
$result_query  = execute_sql($database_name, $sql_query, $link);
$total_row2 = mysql_num_rows($result_query);  // 取得結果筆數 
if($total_row2 > 0)
{
	///echo '1!!!';
}else{
	//echo '2!!!';
$sql = "INSERT INTO 
Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) 
VALUES ('$key','$alert_written_time','11','網管偵測','網管偵測', '設備服務中斷' )";
execute_sql($database_name, $sql, $link);	
}
/*	

*/



$sql_query  = "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' and  Equipment_Repair_type='12'";
$result_query  = execute_sql($database_name, $sql_query, $link);
$total_row2 = mysql_num_rows($result_query);  // 取得結果筆數 
if($total_row2 > 0)
{
	///echo '1!!!';
}else{
	//echo '2!!!';
$sql = "INSERT INTO 
Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) 
VALUES ('$key','$Processing_time_A','12','$Processor_A','$Processor_A', '$note_A' )";
execute_sql($database_name, $sql, $link);
}

}
?>