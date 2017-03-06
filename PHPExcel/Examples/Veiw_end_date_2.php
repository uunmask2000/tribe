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

//$sql  =  "SELECT * FROM alert_ap_date_filter where Processing_status='已結案' and alert_written_time like '%$bdaymonth%' ";
$sql  =  "SELECT alert_ap_date_filter_id	,
				Period_AP	,
				alert_ap_date_tribe	,
				alert_ap_date_ap_name,
				alert_ap_date_ap_ip	,
				alert_written_time,
				alert_ap_date_time_ok,
				calling_bar_id ,
				Equipment_Repair_type  ,
				Equipment_Repair_time ,
				Equipment_Repair_engineer ,
				Equipment_Repair_operator ,
				Equipment_Repair_remark,
				TIIS_Called_repair_category,
				TIIS_Maintenance_arrival_time,
				TIIS_Processing_end_time,
				TIIS_CAG_recommendations,
				TIIS_process_result,
				TIIS_current_state,
				TIIS_Contact_person,
				TIIS_Day_call,
				TIIS_Reaction_problem,
				TIIS_Maintenance_staff,
				TIIS_Notes
			FROM alert_ap_date_filter AS A
			INNER JOIN Equipment_Repair AS B
			ON A.alert_ap_date_filter_id=B.Equipment_Repair_number
			where  A.Processing_status ='已結案' and A.alert_written_time like '%$bdaymonth%' 
			ORDER BY  B.Equipment_Repair_number asc
			";


$result  = execute_sql($database_name, $sql, $link);
while ($row  = mysql_fetch_assoc($result))
{
		$Arrray[$i][1]=$row['alert_ap_date_filter_id'];
		$Arrray[$i][2]=$row['Period_AP'];
		$Arrray[$i][3]=$row['alert_ap_date_tribe'];
		$Arrray[$i][4]=$row['alert_ap_date_ap_name'];
		$Arrray[$i][5]=$row['alert_ap_date_ap_ip'];
		$Arrray[$i][6]=$row['alert_written_time'];
		$Arrray[$i][7]=$row['alert_ap_date_time_ok'];
		$Arrray[$i][8]=$row['calling_bar_id'];
		//$Arrray[$i][9]=$row['Processing_status'];
		//處理結果
		$x = $row['Equipment_Repair_type'];
		switch ($x)
		{
		case '11':
		$Arrray[$i][9]='已發信';
		 // echo "Number 1";
		  break;
		case '12':
		 // echo "Number 2";
		$Arrray[$i][9]='首回覆';
		  break;
			case '00':
			// echo "Number 3";
			$Arrray[$i][9]='已派工';
			break;
			case '01':
			// echo "Number 3";
			$Arrray[$i][9]='已到達';
			break;
			case '02':
			// echo "Number 3";
			$Arrray[$i][9]='處理中';
			break;
			case '03':
			// echo "Number 3";
			$Arrray[$i][9]='已結案';
			break;
		default:
			$Arrray[$i][9]='沒有資料';
		 // echo "沒有資料";
		}
		
		
		
		///東宜
		$Arrray[$i][10]=$row['TIIS_Called_repair_category'];
		if(empty($row['TIIS_Processing_end_time']))
		{
			$Arrray[$i][11]=$row['Equipment_Repair_time'];
		}else{
			$Arrray[$i][11]=$row['TIIS_Maintenance_arrival_time'];
		}
		
		$Arrray[$i][12]=$row['TIIS_Processing_end_time'];
		$Arrray[$i][13]=$row['TIIS_CAG_recommendations'];
		
		if(empty($row['TIIS_process_result']))
		{
			$Arrray[$i][14]=$row['Equipment_Repair_remark'];
		}else{
			$Arrray[$i][14]=$row['TIIS_process_result'];
		}
		
		$Arrray[$i][15]=$row['TIIS_current_state'];
		$Arrray[$i][16]=$row['TIIS_Contact_person'];
		$Arrray[$i][17]=$row['TIIS_Day_call'];
		$Arrray[$i][18]=$row['TIIS_Reaction_problem'];
		
		if(empty($row['TIIS_Maintenance_staff']))
		{
			$Arrray[$i][19]=$row['Equipment_Repair_engineer'];
		}else{
			$Arrray[$i][19]=$row['TIIS_Maintenance_staff'];
		}
		
		
		
		$Arrray[$i][20]=$row['TIIS_Notes'];
		$Arrray[$i][21]=$row['Equipment_Repair_operator'];
	
	$i++;
}
///
$sql1  =  "SELECT *
			FROM alert_ap_date_filter AS A
			where  A.Processing_status ='已結案' and A.alert_written_time like '%$bdaymonth%' and TIIS_date=1 
			";


$result1  = execute_sql($database_name, $sql1, $link);
while ($row1  = mysql_fetch_assoc($result1))
{
		$Arrray[$i][1]=$row1['alert_ap_date_filter_id'];
		$Arrray[$i][2]=$row1['Period_AP'];
		$Arrray[$i][3]=$row1['alert_ap_date_tribe'];
		$Arrray[$i][4]=$row1['alert_ap_date_ap_name'];
		$Arrray[$i][5]=$row1['alert_ap_date_ap_ip'];
		$Arrray[$i][6]=$row1['alert_written_time'];
		$Arrray[$i][7]=$row1['alert_ap_date_time_ok'];
		$Arrray[$i][8]=$row1['calling_bar_id'];
		$Arrray[$i][9]=$row1['Processing_status'];
		///東宜
		$Arrray[$i][10]=$row1['TIIS_Called_repair_category'];
		$Arrray[$i][11]=$row1['TIIS_Maintenance_arrival_time'];
		$Arrray[$i][12]=$row1['TIIS_Processing_end_time'];
		$Arrray[$i][13]=$row1['TIIS_CAG_recommendations'];
		$Arrray[$i][14]=$row1['TIIS_process_result'];
		$Arrray[$i][15]=$row1['TIIS_current_state'];
		$Arrray[$i][16]=$row1['TIIS_Contact_person'];
		$Arrray[$i][17]=$row1['TIIS_Day_call'];
		$Arrray[$i][18]=$row1['TIIS_Reaction_problem'];
		$Arrray[$i][19]=$row1['TIIS_Maintenance_staff'];
		$Arrray[$i][20]=$row1['TIIS_Notes'];
		$Arrray[$i][21]='空白';
	$i++;	
}

//echo $sql1  ;
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
