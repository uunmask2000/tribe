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
	<!-----------LOADING套件------------->
	<link href="../blockUI/load.css" rel="stylesheet" type="text/css" />
	<script>
	function showloading(){
	document.getElementById('loading').style.display = 'block';
	}
	function init(){
	document.getElementById("loading").style.display = "none";
	}
	if(window.attachEvent)
	{window.attachEvent('onload', init);}
	else
	{window.addEventListener('load', init, false);}
	</script>
</head>
<body onload="init()" >

<div class="loadingdiv" id="loading">
<img class="loading" src="../blockUI/ajax-loader.gif" alt="">
</div>

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
		
		<h1 class="report">服務效益月總報表</h1>
	
		<div class="report_bar">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
		<select name="A">
		<option value=" " selected  >請選擇期別</option> 

		<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
		
		<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>			
		
		</select>
		
		
		
			
			<select  name="year" size="1" >
			<option  disabled selected>請選擇年份</option>
			<?php
			$dat_y = date("Y")+2;
			for($y=2016 ; $y<=$dat_y  ; $y++)
			{
			?>
			<option value="<?=$y;?>" <?php if($_POST['year']==$y){echo 'selected'; }?> ><?=$y;?>年</option>
			<?php
			}

			?>
			</select>


			<select  name="month" size="1" >
			<option  disabled selected>請選擇月份</option>

			<option value="01" <?php if($_POST['month']=='01'){echo 'selected'; }?>>01月</option>
			<option value="02" <?php if($_POST['month']=='02'){echo 'selected'; }?>>02月</option>
			<option value="03" <?php if($_POST['month']=='03'){echo 'selected'; }?>>03月</option>
			<option value="04" <?php if($_POST['month']=='04'){echo 'selected'; }?>>04月</option>
			<option value="05" <?php if($_POST['month']=='05'){echo 'selected'; }?>>05月</option>
			<option value="06" <?php if($_POST['month']=='06'){echo 'selected'; }?>>06月</option>
			<option value="07" <?php if($_POST['month']=='07'){echo 'selected'; }?>>07月</option>
			<option value="08" <?php if($_POST['month']=='08'){echo 'selected'; }?>>08月</option>
			<option value="09" <?php if($_POST['month']=='09'){echo 'selected'; }?>>09月</option>
			<option value="10" <?php if($_POST['month']=='10'){echo 'selected'; }?>>10月</option>
			<option value="11" <?php if($_POST['month']=='11'){echo 'selected'; }?>>11月</option>
			<option value="12" <?php if($_POST['month']=='12'){echo 'selected'; }?>>12月</option>

			</select>
					

		<input type='submit' value='檢視報表' onclick="showloading()">
		</form>	
		</div>
	
		<div class="report">

	<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		//$day =date("Y-m", strtotime('-1 month'));
	if($_GET['mode']=='query')
	{
		$Period =$_POST['A'] ;
		$year =$_POST['year'] ;
		$month =$_POST['month'] ;
		$day = $year.'-'.$month;
		//$day = '2016-11';
		if($Period==NULL or $Period==' ' )
		{
			?>
			<script>
			  alert("請選擇期別!");history.back();
			</script>			
			<?php
			exit();
			
		}
		
		if($year==NULL or $year==' ' )
		{
			?>
			<script>
			  alert("請選擇年份!");history.back();
			</script>			
			<?php
			exit();
			
		}
		
		if($month==NULL or $month==' ' )
		{
			?>
			<script>
			  alert("請選擇月份!");history.back();
			</script>			
			<?php
			exit();
			
		}
		
		
		?>

		<table class="table2excel"  id="table2excel">
		  <thead style="display:none" >
					<tr>
					<th>年/月</th>
						<th>期別</th>
						<th>縣市</th>
						<th>地區</th>
						<th>部落</th>
							<th>總使用人次</th>
							<th>總使用人數</th>
							<th>總使用時間(分)</th>
							<th>總流量(MB)</th>
							<th>總上行流量(MB)</th>
							<th>總下行流量(MB)</th>
							
							
							<!---計算
							<th>設備妥善率</th>
							<th>平均使用人次使用時間(分)</th>
							<th>平均使用人次使用流量(MB)</th>
							<th>平均使用人數使用時間(分)</th>
							<th>平均使用人數使用流量(MB)</th>
							--->
					</tr>
		  </thead>	
		  
		  <tbody style="display:none">
		  <?php
				$sql_sum="SELECT * FROM `monthly_report_itw_total` WHERE    Period ='$Period'  and `Time_interval` ='$day'  ORDER BY tribe desc ";
				$result_sum = execute_sql($database_name, $sql_sum, $link);
				$jj=0;
				while ($row_sum= mysql_fetch_assoc($result_sum) )
				{						
				$Period =$row_sum['Period'];
				$County =$row_sum['County'];
				$area =$row_sum['area'];
				$tribe =$row_sum['tribe'];

				//
				$filter_number =$row_sum['filter_number'];
				$device_number =$row_sum['device_number'];
				//1個設備  200 , 分母為 1/ 200
				$Denominator  = $device_number*200;
				//

				$Use_of_people_itw =$row_sum['Use_of_people'];
				$Number_of_users_itw =$row_sum['Number_of_users'];
				$Total_usage_time_itw = $row_sum['Total_usage_time'];
				$Upload_traffic_itw =  $row_sum['Upload_traffic'];
				$Download_traffic_itw = $row_sum['Download_traffic'];	
				
				$array1[$jj][0] =$Period ;
				$array1[$jj][1] =$County ;
				$array1[$jj][2] =$area ;
				$array1[$jj][3] =$tribe ;
				$array1[$jj][4] =$Use_of_people_itw ;
				$array1[$jj][5] =$Number_of_users_itw ;
				$array1[$jj][6] =$Total_usage_time_itw ;
				$array1[$jj][7] =$Upload_traffic_itw ;
				$array1[$jj][8] =$Download_traffic_itw ;
				$array1[$jj][9] =ceil($filter_number / $Denominator) ;
			
				$jj++;
				}
				
				
				$sql_sum="SELECT * FROM `monthly_report_itr_total` WHERE    Period ='$Period'  and `Time_interval` ='$day'   ORDER BY tribe desc          ";
				$result_sum = execute_sql($database_name, $sql_sum, $link);
				$jjj=0;
				while ($row_sum= mysql_fetch_assoc($result_sum) )
				{						
				$Period =$row_sum['Period'];
				$County =$row_sum['County'];
				$area =$row_sum['area'];
				$tribe =$row_sum['tribe'];

				//
				$filter_number =$row_sum['filter_number'];
				$device_number =$row_sum['device_number'];
				//1個設備  200 , 分母為 1/ 200
				$Denominator  = $device_number*200;
				//

				$Use_of_people_itr =$row_sum['Use_of_people'];
				$Number_of_users_itr =$row_sum['Number_of_users'];
				$Total_usage_time_itr = $row_sum['Total_usage_time'];
				$Upload_traffic_itr =  $row_sum['Upload_traffic'];
				$Download_traffic_itr = $row_sum['Download_traffic'];	
			
					$array2[$jjj][0] =$Period ;
					$array2[$jjj][1] =$County ;
					$array2[$jjj][2] =$area ;
					$array2[$jjj][3] =$tribe ;
					$array2[$jjj][4] =$Use_of_people_itr ;
					$array2[$jjj][5] =$Number_of_users_itr ;
					$array2[$jjj][6] =$Total_usage_time_itr ;
					$array2[$jjj][7] =$Upload_traffic_itr ;
					$array2[$jjj][8] =$Download_traffic_itr ;
				$array2[$jjj][9] =ceil($filter_number / $Denominator) ;
				
				$jjj++;
			}
			for($ii=0;$ii < $jjj ;$ii++)
			{

							?>
							<tr>
							<td><?=$day  ; ?></td>
							<td><?=$array2[$ii][0] ; ?></td>
							<td><?=$array2[$ii][1] ; ?></td>
							<td><?=$array2[$ii][2] ; ?></td>
							<td><?=$array2[$ii][3] ; ?></td>
							<td><?=$array2[$ii][4]+$array1[$ii][4]; ; ?></td>
							<td><?=$array2[$ii][5]+$array1[$ii][5]; ; ?></td>
							
							<td><?= number_format(($array2[$ii][6]+$array1[$ii][6])/60); ?></td>
							<td><?php 
								$SUM_2  = ($array2[$ii][7]+$array1[$ii][7]+$array2[$ii][8]+$array1[$ii][8])/(1024*1000) ;
								echo ceil($SUM_2) ;
							           ?></td>
							<td><?php
							$Upload_traffic=($array2[$ii][7]+$array1[$ii][7])/(1024*1000) ; 
							echo ceil($Upload_traffic) ;
							?></td>
							<td><?php
							$Download_traffic =($array2[$ii][8]+$array1[$ii][8])/(1024*1000) ;
							echo ceil($Download_traffic) ;
							 ?></td>
							
							<?php
							//<td>
							//$AAA = ($array2[$ii][9]+$array1[$ii][9])/2 ;
							//echo  100 - $AAA ;
							//</td>	
							?>								
												
							</tr>
							<?php
			}

						/*
							?>
							<tr>
							<td><?=$Period ; ?></td>
							<td><?=$County ; ?></td>
							<td><?=$area ; ?></td>
							<td><?=$tribe ; ?></td>
							<td><?=$Use_of_people ; ?></td>
							<td><?=$Number_of_users ; ?></td>
							<td><?=$Total_usage_time ; ?></td>
							<td><?=$SUM_2 ; ?></td>
							<td><?=$Upload_traffic ; ?></td>
							<td><?=$Download_traffic ; ?></td>
							<td>
							<?php
							$AAA =  ceil($filter_number / $Denominator) ;
							
							echo  100 - $AAA ;
							?>								
							</td>						
							</tr>
							<?php
                        */




					
		  
		  ?>
		  
		</tbody>
		</table>
		
		

		<?php
		//echo $sql_sum;
		
		//print_r($array1);
		//echo '<br>';
		//print_r($array2);

	}	
		
	
	?>
	
		</div>
	</div>
<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
<script language="JavaScript">
$(document).ready(function(){ 
  var opt={ "oLanguage":{"sProcessing":"處理中...",
						"sLengthMenu":"顯示 _MENU_ 項結果",
						"sZeroRecords":"沒有匹配結果",
						"sInfo":"顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
						"sInfoEmpty":"顯示第 0 至 0 項結果，共 0 項",
						"sInfoFiltered":"(從 _MAX_ 項結果過濾)",
						"sSearch":"搜索:",
						"oPaginate":{"sFirst":"首頁",
									 "sPrevious":"上頁",
									 "sNext":"下頁",
									 "sLast":"尾頁"},
						 
				},
				//lengthMenu: [
				//[ 10, 25, 50, -1 ],
				//[ '10 筆', '25 筆', '50 筆', '全部' ]
				//],
					"pageLength":" 50",
					"bFilter": false, //开关，是否启用客户端过滤器
					"bPaginate": false, //开关，是否显示分页器
					"bInfo": false, //开关，是否显示表格的一些信息，允许或者禁止表信息的显示，默认为 true，显示信息。
			 dom: 'Bfrtip',	 buttons: 
			 [
				{ extend: 'excelHtml5', text: '匯出服務效益月總報表' ,title: '<?= date("Y-m-d");?>服務效益月總報表' },
				//{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>服務效益分析年報表' },	
				//'pageLength',				
			],
	   };
  $("#table2excel").dataTable(opt);
  });
</script>
</html>