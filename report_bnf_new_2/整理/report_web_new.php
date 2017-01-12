<!---highcharts套件-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="../highcharts/exporting.js"></script>
<!---highcharts套件-->
<!---------------------->
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
<!-----<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>---->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-zh-TW.js"></script>
<?php
session_start();
require_once("dbtools.inc.php");
$link = create_connection();
$link2 = create_connection2();
?>

		<div class="report_bar">
		<input type ="button" onclick="javascript:location.href='?mode=case_A'" value="最近一日統計圖"></input>
		<input type ="button" onclick="javascript:location.href='?mode=case_B'" value="最近一周統計圖"></input>
		<input type ="button" onclick="javascript:location.href='?mode=case_C'" value="最近三十統計圖"></input>
		<input type ="button" onclick="javascript:location.href='?mode=case_D'" value="自訂"></input>
		<div>
<?php
$mode = $_GET['mode'];
	switch ($mode) 
		{
		case "case_A":
					?>
					<form action="?mode=case_A" method="POST">
					<select name="label" onchange="this.form.submit();">
					<option value=" " selected disabled >請選擇期別</option> 
					　<option value="2" <?php if($_POST['label']=='2'){echo 'selected';}else{};	?> >第二期</option>
					　<option value="3" <?php if($_POST['label']=='3'){echo 'selected';}else{};	?> >第三期</option>
					</select>

					<select  name="tribe" size="1"   onchange="this.form.submit();">
					<option value="" disabled selected>請選擇部落</option>
					<?php
					$key = $_POST['label'];
					$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'";
					$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
					while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
					{
					//$tribe_name =  $row_tribe['tribe_name'];
					?>
					<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_POST['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
					<?php

					}

					?>
					</select>
					<select name="realm" size="1" onchange="this.form.submit();" > 
					<option  disabled selected>請選擇單位</option>
					<option value="all" <?php if($_POST['realm']=='all'){echo 'selected'; }?> ><?php  echo  '全部'; echo '</option>';	?>
					<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
					<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
					</select>
					<input type="hidden" name="mode" value="<?=$mode ;?>">			


					<input type="submit" value="檢視報表">
					</form>
		
					<?php
					//$_POST['label']
					//$_POST['tribe']
					//$_POST['realm']
					$realm_A = $_POST['realm'];
					$label_A =  $_POST['label'];
					$tribe_A =  $_POST['tribe'];
					if(empty($label_A))
					{
					echo '未選擇期別'; 
					$msger = 1;
					}
					if(empty($tribe_A))
					{
					echo '未選擇部落'; 
					$msger = 1;
					}
					if(empty($realm_A))
					{
					echo '未選擇單位';
					//exit();
					$msger = 1;
					}
					if($msger == 1)
					{

					}else{
						 $yesterday =date("Y-m-d", strtotime('-1 day'));
								if($realm_A=="all")
								{
										$sql_1 = "SELECT tribe,time_zone_h,Upload_traffic,Download_traffic FROM `sum_day_hr_itr` WHERE tribe_sid='$tribe_A' and time_zone_h LIKE '%$yesterday%' ORDER BY time_zone_h ASC   ";
										$result_1 = execute_sql($database_name, $sql_1, $link);
										$num_1 = mysql_num_rows($result_1);							

										while ($row_A1= mysql_fetch_assoc($result_1) )
										{	
									/*
										for($ii=0 ; $ii < 24 ;$ii++)
										{						        
										$array_A1[$ii][0]= $row_A1 [$ii];
										$array_A1[$ii][1]= $row_A1 [$ii];
										$array_A1[$ii][2]= $row_A1 [$ii];
										$array_A1[$ii][3]= $row_A1 [$ii];
										}
*/
$array_A1[$row_A1 ['tribe']] = $row_A1;
$array_A1[$row_A1 ['time_zone_h']] = $row_A1;
$array_A1[$row_A1 ['Upload_traffic']] = $row_A1;
$array_A1[$row_A1 ['Download_traffic']] = $row_A1;										
										}
							
/*							
while ($row_A= mysql_fetch_assoc($result_1) )
{							        
$array_A1[$row_A ['tribe']] = $row_A;
$array_A1[$row_A ['time_zone_h']] = $row_A;
$array_A1[$row_A ['Upload_traffic']] = $row_A;
$array_A1[$row_A ['Download_traffic']] = $row_A;

}
*/
							///
								$sql_2 = "SELECT tribe,time_zone_h,Upload_traffic,Download_traffic FROM `sum_day_hr_itw` WHERE tribe_sid='$tribe_A' and time_zone_h LIKE '%$yesterday%' ORDER BY time_zone_h ASC   ";
								$result_2 = execute_sql($database_name, $sql_2, $link);		
echo 	$sql_2;							
								$num_2 = mysql_num_rows($result_2);	
								while ($row_A2= mysql_fetch_assoc($result_2) )
								{	
										for($iii=0 ; $iii < 24 ;$iii++)
										{						        
										$array_A2[$iii][0]= $row_A2 ['tribe'][$iii];
										$array_A2[$iii][1]= $row_A2 ['time_zone_h'][$iii];
										$array_A2[$iii][2]= $row_A2 ['Upload_traffic'][$iii];
										$array_A2[$iii][3]= $row_A2 ['Download_traffic'][$iii];
										}		
								}
							print_r($array_A1);
							print_r($array_A2);
								
									
								
								}else if($realm_A=="itr")
								{
									
								}else if($realm_A=="itw")
								{
									
								}

					
					}
				
					
					

		break;
		
		///
		case "case_B":


		break;
		///
		case "case_C":


		break;
		////
		case "case_D":


		break;
		///
		case "case_E":


		break;
		
		

		default:
		//echo "沒有功能!";

		}

?>

