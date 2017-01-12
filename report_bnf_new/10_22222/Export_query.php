<html>
<head>
	<meta charset="utf-8">
	<title>無線AP網管系統</title>
	<link href="../include/style.css" rel="stylesheet" type="text/css" />
	<link href="../include/reset.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../include/tablesort_style.css" />
	<!--------dataTablesw套件---------->
	<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
	<!---CDN
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
	-->
	<script type="text/javascript" src="../dataTables/1.10.12/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../dataTables/1.10.12/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
</head>
<body>

<div id="wrap">
<!-------------------------------------- TOP -->
	<div id="header">
	<?php
	include("../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php");?>

		<h1 class="report">服務效益分析總表</h1>
		<div class="report_nav">
			<a href="/report_bnf_new/report_all.php">年報表分析</a>
			<a href="/report_bnf_new/Export_query.php" target="_blank">匯出服務效益分析總表</a>
		</div>

<?php
require_once("dbtools.inc.php");
$link = create_connection();
$link2 = create_connection2();


?>

		<div class="report_bar">
			<form action="" method="get">
			<select name="realm">
			<option  disabled selected>請選擇單位</option>
			<option value="itw" <?php if($_GET['realm']=='itw'){echo 'selected'; }?> >愛台灣</option>
			<option value="<>itw" <?php if($_GET['realm']=='<>itw'){echo 'selected'; }?> >愛部落</option>
			</select>		
			<select  name="year" size="1" >
			<option  disabled selected>請選擇年份</option>

			<?php
			$dat_y = date("Y")+2;
			for($y=2016 ; $y<=$dat_y  ; $y++)
			{
			?>
			<option value="<?=$y;?>" <?php if($_GET['year']==$y){echo 'selected'; }?> ><?=$y;?>年</option>
			<?php
			}
			?>
			</select>
			<select  name="month" size="1" >
			<option  disabled selected>請選擇月份</option>

			<?php
			$month = array('01','02','03','04','05','06','07','08','09','10','11','12');

			for($ii=0;$ii<12;$ii++)
			{
			?>
			<option value="<?=$month[$ii];?>" <?php if($_GET['month']==$month[$ii]){echo 'selected'; }?> ><?=$month[$ii];?>月</option>
			<?php
			}

			?>
			</select>
			<select  name="tribe_label" size="1" >
			<option  disabled selected>請選擇期標</option>
			<option value="2" <?php if($_GET['tribe_label']=='2'){echo 'selected'; }?> >第2期</option>
			<option value="3" <?php if($_GET['tribe_label']=='3'){echo 'selected'; }?> >第3期</option>

			</select>

			<input type="submit" value="查詢">
			</form>
		</div>

		<div class="report">
<?php
//realm='itw'
//realm <>itw
/*
echo $_GET['realm'];
echo '<br>';
echo $_GET['year'];
echo '<br>';
echo $_GET['month'];
echo '<br>';

		echo '<script>';
		echo "alert('報表條件未設定正確'); window.history.back();";
		echo '</script>';


*/
?>
<?php
$year = $_GET['year'];
$months = $_GET['month'];
$tribe_label  = $_GET['tribe_label'];

if( $_GET['realm']!=NULL)
{
	//echo '報表條件設定';
	//echo  $year ;
	//echo  $months;
	if(empty($year))
	{
		echo '<script>';
		echo "alert('報表條件未設定正確'); window.history.back();";
		echo '</script>';
        exit();
	}else 	if(empty($months))
	{
		echo '<script>';
		echo "alert('報表條件未設定正確'); window.history.back();";
		echo '</script>';
        exit();
	}else 	if(empty($tribe_label))
	{
		echo '<script>';
		echo "alert('報表條件未設定正確'); window.history.back();";
		echo '</script>';
        exit();
	}
	
	$day =	 $year.'-'.$months ;
	
	if($_GET['realm']=='itw')
	{
		$realm_txt   = "realm='itw'";
		
	}else if($_GET['realm']=='<>itw')
	{
		$realm_txt   = "realm='<>itw'";
		
	}
	?>
	<button onclick="myFunction()">匯出EXECL</button>
		<table class="table2excel" data-tableName="Test Table 1">
		<tr>	<th><?=$year;?>年<?=$months;?>月</th> 	</tr>
					<tr>
						<th>縣市</th>
						<th>地區</th>
						<th>部落</th>
						<th>期標</th>
							<th>總使用人次</th>
							<th>總使用人數</th>
							<th>總使用時間(分)</th>
							<th>總流量(MB)</th>
							<th>總上行流量(MB)</th>
							<th>總下行流量(MB)</th>
							<th> 設備妥善率</th>
							<!---計算--->
							<th>平均使用人次使用時間(分)</th>
							<th>平均使用人次使用流量(MB)</th>
							<th>平均使用人數使用時間(分)</th>
							<th>平均使用人數使用流量(MB)</th>
					</tr>
<?php

		  //$sql_tribe="SELECT * FROM  tribe where tribe_label =2 ";
		 // echo  $tribe_label ;
		  $sql_tribe="SELECT * FROM `tribe` where tribe_label <>0  and  tribe_label='$tribe_label'  ORDER BY `city_id`,`township_id`,`tribe_name` ASC ";
		  
		  $result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
		 while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				$tribe_id = $row_tribe['tribe_id'];
				
				
					  ?>
					  
							
							<?php
							$sql_ap="SELECT GROUP_CONCAT(ass_ap_ip)   FROM  ass_ap  where  	ass_ap_tribe='$tribe_id'  ";
							$result_ap= execute_sql($database_name2, $sql_ap, $link2);
						
							while ($row_ap= mysql_fetch_assoc($result_ap)  )
							{
								$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];	
								$ass_ap_ip = str_replace (",","','",$ass_ap_ip);
								//echo	$ass_ap_ip;	
								//echo '<br>';
							
							
											$sql_sum="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where nasipaddress IN ('$ass_ap_ip') and $realm_txt  and acctstarttime like '%$day%'";
											$result_sum = execute_sql($database_name, $sql_sum, $link);
											
											
											$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip') and $realm_txt  and acctstarttime like '%$day%' ";
											$result1 = execute_sql($database_name, $sql1, $link);
											$number1 = mysql_num_rows($result1);
											///
											$sql2="SELECT username   FROM radacct where  nasipaddress IN ('$ass_ap_ip') and $realm_txt  and acctstarttime like '%$day%' GROUP BY username ";
											$result2 = execute_sql($database_name, $sql2, $link);
											$number2 = mysql_num_rows($result2);
											
											//echo $sql_sum;
											//echo '<br>';
							
											?>
													<tr> 
													<?php
														while ($row_sum= mysql_fetch_assoc($result_sum) )
														{

															$acctsessiontime=$row_sum['SUM(acctsessiontime)']/(60);
															$acctinputoctets=$row_sum['SUM(acctinputoctets)']/(1000*1024);
															$acctoutputoctets=$row_sum['SUM(acctoutputoctets)']/(1000*1024);

															$acctsessiontime=  number_format($acctsessiontime);
															$acctinputoctets=  number_format($acctinputoctets,2);
															$acctoutputoctets= number_format($acctoutputoctets,2);
															?>
															<td>
															<?php
															//city_array
															$id1 =$row_tribe['city_id'];
															$sql_city_array="SELECT city_name FROM city_array WHERE id ='$id1' ";
															$result_city_array= execute_sql($database_name2, $sql_city_array, $link2);
															while ($row_city_array= mysql_fetch_assoc($result_city_array)  )
															{
															   echo $row_city_array['city_name'];
															}
															
															?>
															</td>
															<td>
															<?php
															//city_township
															$id2 =$row_tribe['township_id'];
															$sql_township="SELECT township_name FROM city_township WHERE township_id ='$id2' ";
															$result_township= execute_sql($database_name2, $sql_township, $link2);
															while ($row_township= mysql_fetch_assoc($result_township)  )
															{
															   echo $row_township['township_name'];
															}
															
															?>
															</td>
															<td><?=$row_tribe['tribe_name'];?></td>
															<td><?=$row_tribe['tribe_label'];?></td>
															<td><?=$number1;?></td>
															<td><?=$number2;?></td>

															<td><?=$acctsessiontime;?></td>
															<td><?=$acctinputoctets+$acctoutputoctets;?></td>
															<td><?=$acctinputoctets;?></td>
															<td><?=$acctoutputoctets;?></td>
															<td>100</td>
															<!------->
															<td><?=number_format($acctsessiontime/$number1,2);?></td>
															<td><?=number_format(($acctinputoctets+$acctoutputoctets)/$number1,2);?></td>
															<td><?=number_format($acctsessiontime/$number2,2);?></td>
															<td><?=number_format(($acctinputoctets+$acctoutputoctets)/$number2,2);?></td>
															<?php
														}
														?>
													</tr>
											<?php	
											}	
																		
							?>
							
							
							
					  
					  
					  <?php
								
		    }




?>
		</table>
		
		

		<script>
	
		function myFunction() {
			$(function() {
				$(".table2excel").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "<?=$day;?>部落服務效益月報表",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			});
			}
			
			/*
			$(function() {
				$(".table2excel").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "<?=$day;?>愛台灣服務效益月報表",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
				window.close();
			}
			);
		*/	
		</script>
	
	
	
	
	
	
	
	<?php
	
	//echo  $day;
}else
{

echo "報表條件未設定正確";
	
}




?>
		<?php
			/*
			$years = date("Y"); //用date()函式取得目前年份格式0000
			$months = date("m"); //用date()函式取得目前月份格式00
			$days = date("d"); //用date()函式取得目前日期格式00
			$day = date("Y-m",mktime(0,0,0,$months-1,$days,$years));
			//echo $day;
			//echo '<br>';
			*/
		?>


		</div>
	</div>
	
	
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>
