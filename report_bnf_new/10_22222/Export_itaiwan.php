<!DOCTYPE html>
<html>
	<head>
		<title>無線AP網管系統</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="execl_95/jquery.table2excel.js"></script>
	</head>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	display:none;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>



	<body>
<body>

<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		
		
		$years = date("Y"); //用date()函式取得目前年份格式0000
		$months = date("m"); //用date()函式取得目前月份格式00
		$days = date("d"); //用date()函式取得目前日期格式00
		$day = date("Y-m",mktime(0,0,0,$months-1,$days,$years));
		
		//echo $day;
		//echo '<br>';
		
		?>

	<!---<button onclick="myFunction()">Click me</button>-->
		<table class="table2excel" data-tableName="Test Table 1">
		<tr>	<th><?=date("Y");?>年<?=date("m")-1;?>月</th> 	</tr>
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
							<th>設備妥善率</th>
							<!---計算--->
							<th>平均使用人次使用時間(分)</th>
							<th>平均使用人次使用流量(MB)</th>
							<th>平均使用人數使用時間(分)</th>
							<th>平均使用人數使用流量(MB)</th>
					</tr>
<?php

		 //$sql_tribe="SELECT * FROM  tribe where tribe_label =2 ";
		  $sql_tribe="SELECT * FROM `tribe` where tribe_label <>0 ORDER BY `city_id`,`township_id`,`tribe_name` ASC";
		  
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
							
							
											$sql_sum="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where nasipaddress IN ('$ass_ap_ip') and realm='itw'  and acctstarttime like '%$day%'";
											$result_sum = execute_sql($database_name, $sql_sum, $link);
											
											
											$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip') and realm='itw' and acctstarttime like '%$day%' ";
											$result1 = execute_sql($database_name, $sql1, $link);
											$number1 = mysql_num_rows($result1);
											///
											$sql2="SELECT username   FROM radacct where  nasipaddress IN ('$ass_ap_ip') and realm='itw' and acctstarttime like '%$day%' GROUP BY username ";
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
		/*
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
			*/	
			
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
		
		</script>
	</body>
</html>
