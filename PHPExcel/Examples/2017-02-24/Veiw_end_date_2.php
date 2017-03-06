<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../../include/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
<!-------------------------------------- TOP -->
	<div id="header">
	<?php
	include("../../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

	<div class="tabs">
		<a href="../../programer_See/show_AP_date_form.php">AP中斷維修紀錄表</a>
		<a href="Execl_update.php">匯入</a>
		<a href="Veiw_end_date_2.php" class="nav_linked">匯出</a>
	</div>

	<div class="report_bar">
	<form action="?do=mode" method="POST">
		區間：<input type="month" name="bdaymonth" value="<?=$_POST['bdaymonth'];?>">
		<input type="submit" value="搜尋">
	</form>
	</div>


<?php
if($_GET['do']!='mode')
{
	?>
		
	
	<?php
}else{	
session_start();
 $bdaymonth = $_POST['bdaymonth'];
 $_SESSION["date"] =  $bdaymonth  ;
if(empty($bdaymonth))
{
	?>
<script>
history.back();
</script>
<?php
}


//exit();
include("../../SQL/dbtools.inc.php");
$link = create_connection();
// 11= 已發信 , 12= 首回覆
//00 = 派工 01=處理中 02==到達 03=已結案
$i=2;
//$sql  =  "SELECT * FROM alert_ap_date_filter where Processing_status='已結案'  ";
//$sql  =  "SELECT * FROM alert_ap_date_filter   ";
$sql  =  "SELECT * FROM alert_ap_date_filter where Processing_status='已結案' and alert_written_time like '%$bdaymonth%' ";
$result  = execute_sql($database_name, $sql, $link);
while ($row  = mysql_fetch_assoc($result))
{
   $pk_key =  $row['alert_ap_date_filter_id']; 
   
$Arrray[$i][1]=$row['alert_ap_date_filter_id'];
$Arrray[$i][2]=$row['Period_AP'];
$Arrray[$i][3]=$row['alert_ap_date_tribe'];
$Arrray[$i][4]=$row['alert_ap_date_ap_name'];
$Arrray[$i][5]=$row['alert_ap_date_ap_ip'];
$Arrray[$i][6]=$row['alert_written_time'];
$Arrray[$i][7]=$row['alert_ap_date_time_ok'];
$Arrray[$i][8]=$row['calling_bar_id'];
$Arrray[$i][9]=$row['Processing_status'];
///東宜
$Arrray[$i][10]=$row['TIIS_Called_repair_category'];
$Arrray[$i][11]=$row['TIIS_Maintenance_arrival_time'];
$Arrray[$i][12]=$row['TIIS_Processing_end_time'];
$Arrray[$i][13]=$row['TIIS_CAG_recommendations'];
$Arrray[$i][14]=$row['TIIS_process_result'];
$Arrray[$i][15]=$row['TIIS_current_state'];
$Arrray[$i][16]=$row['TIIS_Contact_person'];
$Arrray[$i][17]=$row['TIIS_Day_call'];
$Arrray[$i][18]=$row['TIIS_Reaction_problem'];
$Arrray[$i][19]=$row['TIIS_Maintenance_staff'];
$Arrray[$i][20]=$row['TIIS_Notes'];

/*
$Arrray[$i][21]=$row['alert_ap_date_filter_id'];
$Arrray[$i][22]=$row['alert_ap_date_filter_id'];
$Arrray[$i][23]=$row['alert_ap_date_filter_id'];
$Arrray[$i][24]=$row['alert_ap_date_filter_id'];
$Arrray[$i][25]=$row['alert_ap_date_filter_id'];
$Arrray[$i][26]=$row['alert_ap_date_filter_id'];
*/
		$sql_0  =  "SELECT * FROM Equipment_Repair where Equipment_Repair_number='$pk_key' and Equipment_Repair_type='11' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$types = array();
		while(($row_0 =  mysql_fetch_assoc($result_0))) {
		$Equipment_Repair_time = $row_0['Equipment_Repair_time']; 
		$Equipment_Repair_engineer = $row_0['Equipment_Repair_engineer']; 
		$Equipment_Repair_operator = $row_0['Equipment_Repair_operator']; 
		$Equipment_Repair_remark = $row_0['Equipment_Repair_remark']; 
		$types[] = '['.$Equipment_Repair_time.','.$Equipment_Repair_engineer.','.$Equipment_Repair_remark.']';
		}
		$Array_text = implode(",", $types);
		$Arrray[$i][21]=  $Array_text ;
		//
		$sql_0  =  "SELECT * FROM Equipment_Repair where Equipment_Repair_number='$pk_key' and Equipment_Repair_type='12' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$types = array();
		while(($row_0 =  mysql_fetch_assoc($result_0))) {
		$Equipment_Repair_time = $row_0['Equipment_Repair_time']; 
		$Equipment_Repair_engineer = $row_0['Equipment_Repair_engineer']; 
		$Equipment_Repair_operator = $row_0['Equipment_Repair_operator']; 
		$Equipment_Repair_remark = $row_0['Equipment_Repair_remark']; 
		$types[] = '['.$Equipment_Repair_time.','.$Equipment_Repair_engineer.','.$Equipment_Repair_remark.']';
		}
		$Array_text = implode(",", $types);
		$Arrray[$i][22]=  $Array_text ;
		//
		$sql_0  =  "SELECT * FROM Equipment_Repair where Equipment_Repair_number='$pk_key' and Equipment_Repair_type='00' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$types = array();
		while(($row_0 =  mysql_fetch_assoc($result_0))) {
		$Equipment_Repair_time = $row_0['Equipment_Repair_time']; 
		$Equipment_Repair_engineer = $row_0['Equipment_Repair_engineer']; 
		$Equipment_Repair_operator = $row_0['Equipment_Repair_operator']; 
		$Equipment_Repair_remark = $row_0['Equipment_Repair_remark']; 
		$types[] = '['.$Equipment_Repair_time.','.$Equipment_Repair_engineer.','.$Equipment_Repair_remark.']';
		}
		$Array_text = implode(",", $types);
		$Arrray[$i][23]=  $Array_text ;
		//
		$sql_0  =  "SELECT * FROM Equipment_Repair where Equipment_Repair_number='$pk_key' and Equipment_Repair_type='01' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$types = array();
		while(($row_0 =  mysql_fetch_assoc($result_0))) {
		$Equipment_Repair_time = $row_0['Equipment_Repair_time']; 
		$Equipment_Repair_engineer = $row_0['Equipment_Repair_engineer']; 
		$Equipment_Repair_operator = $row_0['Equipment_Repair_operator']; 
		$Equipment_Repair_remark = $row_0['Equipment_Repair_remark']; 
		$types[] = '['.$Equipment_Repair_time.','.$Equipment_Repair_engineer.','.$Equipment_Repair_remark.']';
		}
		$Array_text = implode(",", $types);
		$Arrray[$i][24]=  $Array_text ;
		//
		$sql_0  =  "SELECT * FROM Equipment_Repair where Equipment_Repair_number='$pk_key' and Equipment_Repair_type='02' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$types = array();
		while(($row_0 =  mysql_fetch_assoc($result_0))) {
		$Equipment_Repair_time = $row_0['Equipment_Repair_time']; 
		$Equipment_Repair_engineer = $row_0['Equipment_Repair_engineer']; 
		$Equipment_Repair_operator = $row_0['Equipment_Repair_operator']; 
		$Equipment_Repair_remark = $row_0['Equipment_Repair_remark']; 
		$types[] = '['.$Equipment_Repair_time.','.$Equipment_Repair_engineer.','.$Equipment_Repair_remark.']';
		}
		$Array_text = implode(",", $types);
		$Arrray[$i][25]=  $Array_text ;
		//
		$sql_0  =  "SELECT * FROM Equipment_Repair where Equipment_Repair_number='$pk_key' and Equipment_Repair_type='03' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$types = array();
		while(($row_0 =  mysql_fetch_assoc($result_0))) {
		$Equipment_Repair_time = $row_0['Equipment_Repair_time']; 
		$Equipment_Repair_engineer = $row_0['Equipment_Repair_engineer']; 
		$Equipment_Repair_operator = $row_0['Equipment_Repair_operator']; 
		$Equipment_Repair_remark = $row_0['Equipment_Repair_remark']; 
		$types[] = '['.$Equipment_Repair_time.','.$Equipment_Repair_engineer.','.$Equipment_Repair_remark.']';
		}
		$Array_text = implode(",", $types);
		$Arrray[$i][26]=  $Array_text ;

	
	$i++;

	
}
//print_r($Arrray);

//exit();
$_SESSION["Array_total"] =$Arrray ;
?>
<script>
window.location.replace("./EXPOET-download-xlsx.php");
</script>
<?php


}
?>

	</div>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>
