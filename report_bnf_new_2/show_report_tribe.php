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
		
		<h1 class="report">服務效益分析總表</h1>
		
		<div class="report_nav">
			<a href="/report_bnf_new_2/show_report_all.php">年報表</a>
			<a href="/report_bnf_new_2/show_report_tribe.php"
			<?php if (preg_match("/show_report_tribe/i", $_SERVER['PHP_SELF'])) {echo 'style="background: #126389"'; } ?>
			>月報表</a>
		</div>

	<?php
	require_once("dbtools.inc.php");
	$link = create_connection();
	$link2 = create_connection2();

	?>

		<div class="report_bar">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
		<select name="A"  onchange="this.form.submit();">
		<option value=" " selected  >請選擇期別</option> 

		<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
		
		<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>			
		
		</select>
		
		<select  name="city_key" size="1"   onchange="this.form.submit();">
		<option value="0" selected  >請選擇縣市</option>
		<?php
			$sql_1="SELECT * FROM city_array ";
			$result_1= execute_sql($database_name2, $sql_1, $link2);
			while ($row_1= mysql_fetch_assoc($result_1)  )
			{
					?>
					<option value="<?=$row_1['id'];?>"  <?php if($_POST['city_key']==$row_1['id']){  echo 'selected';  }?> ><?=$row_1['city_name'];?></option>
					<?php
			}
		?>	
		</select>
		
		<select  name="tribe" size="1"   onchange="this.form.submit();">
					<option  disabled selected>請選擇部落</option>
					<?php
					$key = $_POST['A'];
					$city_key = $_POST['city_key'];
						if ($city_key!='0')
						{
							$sql_tribe="SELECT * FROM tribe  where tribe_label='$key' and city_id='$city_key' ORDER BY `tribe`.`tribe_name` ASC";
						}else{
							$sql_tribe="SELECT * FROM tribe  where tribe_label='$key' ORDER BY `tribe`.`tribe_name` ASC";
						}
					
					//$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'";
					$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
					while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
					{
					?>
					<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_POST['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
					<?php
					}
					
					?>
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
				

				<select name="realm" size="1" > 
				<option  disabled selected>請選擇服務</option>
				<option value="all" <?php if($_POST['realm']=='all'){echo 'selected'; }?> ><?php  echo  '全部'; echo '</option>';	?>
				<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
				<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
				</select>

		<input type='submit' value='檢視報表' onclick="showloading()">
		</form>	
		</div>
	
		<div class="report">
	<?php
	if($_GET['mode']=='query')
	{
		
		// Period   tribe  year realm
		 $Period =$_POST['A'] ;
		 $tribe_sid =$_POST['tribe'] ;
		 $year =$_POST['year'] ;
		 $month =$_POST['month'] ;
		 $realm =$_POST['realm'] ;
		 
					if($Period==NULL or $Period==' ' )
					{
					$msger = 1 ;
					?>
					<script>
					alert("請選擇期別!");history.back();
					</script>			
					<?php
					//exit();


					}	

					if($tribe_sid==NULL or $tribe_sid==' ' )
					{

					$msger = 1 ;

					}	

					if($year==NULL or $year==' ' )
					{

					$msger = 1 ;

					}
					if($month==NULL or $month==' ' )
					{

					$msger = 1 ;

					}


					if($realm==NULL or $realm==' ' )
					{

					$msger = 1 ;

					}
					
		if($msger =='1')
		{
			//echo  '有條件未選擇';
		}else{
			
				//echo  '有條件成立';
			?>
			<table id="show_date" class="display" cellspacing="0" width="100%">
						<thead>
						<tr>
						<th>期別</th>
						<th>縣市</th>
						<th>部落</th>
						<!--
						<th>熱點名稱</th>
						---->
						<th>月份</th>
						<th>服務</th>
						<th>使用人次</th>
						<th>使用人數</th>
					　	<th>使用時間(分)</th>
						<th>總流量(MB)</th>
						<th>上行流量(MB)</th>
						<th>下行流量(MB)</th>
					<!--	<th> 設備妥善率</th> -->
						</tr>
						</thead>

						<tbody>
						<!----
						<td>期別</td>
						<td>部落</td>
						<td>熱點名稱</td>
						<td>月份</td>
						<td>單位</td>
						<td>使用人次</td>
						<td>使用人數</td>
						<td>使用時間(時)</td>
						<td>總流量(MB)</td>
						<td>上行流量(MB)</td>
						<td>下行流量(MB)</td>
						<td> 設備妥善率</td>
						---->
						<?php
						if($realm =='all')
						{
							?>
				<!---
				<tr>
				<td>期別</td>
				<td>部落</td>
				<td>熱點名稱</td>
				<td>月份</td>
				<td>單位</td>
				<td>使用人次</td>
				<td>使用人數</td>
				<td>使用時間(時)</td>
				<td>總流量(MB)</td>
				<td>上行流量(MB)</td>
				<td>下行流量(MB)</td>
				<td> 設備妥善率</td>
				<tr>
				--->
				<?php
				//$year	 $month	
							$Time_interval = $year.'-'.$month; 
							$sql2="SELECT * FROM 	monthly_report_itr_total WHERE tribe_sid='$tribe_sid' and Time_interval='$Time_interval'";
							//echo $sql2;
							$result2 = execute_sql($database_name, $sql2, $link);
							while ($row = mysql_fetch_assoc($result2) )
							{
							$Period = $row['Period'];
							$County = $row['County'];
							$area = $row['area'];
							$tribe = $row['tribe'];
							$aroused_general_interest = $row['aroused_general_interest'];
							$Device_IP = $row['Device_IP'];

							$Use_of_people = $row['Use_of_people'];
							$Number_of_users = $row['Number_of_users'];

							$Total_usage_time = $row['Total_usage_time'];
							$Upload_traffic = $row['Upload_traffic'];
							$Download_traffic = $row['Download_traffic'];
							//
								//$filter_number =$row['filter_number']; //1個設備  200 , 分母為 1/ 200
								//$Denominator =200;
								$filter_number =$row['filter_number'];
								$device_number =$row['device_number'];
								//1個設備  200 , 分母為 1/ 200
								$Denominator  = $device_number*200;
							//
							$Upload_traffic =($row['Upload_traffic']/(1024*1000));
							$Download_traffic =($row['Download_traffic']/(1024*1000));				
							$SUM_2  = ceil(($row['Upload_traffic']/(1024*1000))+($row['Download_traffic']/(1024*1000)) );
							$Total_usage_time=  ceil($Total_usage_time);
							$Upload_traffic=  ceil($Upload_traffic);
							$Download_traffic= ceil($Download_traffic);
									$i = 0;
									$array_1[$i][0]=$row['Period'];
									$array_1[$i][1]=$row['tribe'];
									$array_1[$i][2]=$row['Time_interval'];
									$array_1[$i][3]=$row['Use_of_people'];
									$array_1[$i][4]=$row['Number_of_users'];
									$array_1[$i][5]=ceil($row['Total_usage_time']/60);
									$array_1[$i][6]=$SUM_2 ;
									$array_1[$i][7]=$Upload_traffic ;
									$array_1[$i][8]=$Download_traffic ;
									$array_1[$i][9]=$row['County'];
							
									/*
									?>
									<tr>
									<td><?=$Period ;?></td>
									<td><?=$tribe ;?></td>
									<td><?=$aroused_general_interest ;?></td>
									<td><?=$Time_interval ;?></td>
									<td>愛部落</td>
									<td><?=$Use_of_people ;?></td>
									<td><?=$Number_of_users ;?></td>
									<td><?=$Total_usage_time ;?></td>
									<td><?=$SUM_2 ;?></td>
									<td><?=$Upload_traffic ;?></td>
									<td><?=$Download_traffic ;?></td>
									<td><?php
									$AAA =  ceil($filter_number / $Denominator) ;

									echo  100 - $AAA ;
									?>	</td>
									</tr>
									<?php
									*/
							}	
				
				
				
							$sql3="SELECT * FROM 	monthly_report_itw_total WHERE tribe_sid='$tribe_sid' and Time_interval='$Time_interval'";
							$result3 = execute_sql($database_name, $sql3, $link);
							while ($row1 = mysql_fetch_assoc($result3) )
							{
							$Period = $row1['Period'];
							$County = $row1['County'];
							$area = $row1['area'];
							$tribe = $row1['tribe'];
							$aroused_general_interest = $row1['aroused_general_interest'];
							$Device_IP = $row1['Device_IP'];

							$Use_of_people = $row1['Use_of_people'];
							$Number_of_users = $row1['Number_of_users'];

							$Total_usage_time = $row1['Total_usage_time'];
							$Upload_traffic = $row1['Upload_traffic'];
							$Download_traffic = $row1['Download_traffic'];
							//
								//$filter_number =$row1['filter_number']; //1個設備  200 , 分母為 1/ 200
								//$Denominator =200;
									$filter_number =$row1['filter_number'];
									$device_number =$row1['device_number'];
									//1個設備  200 , 分母為 1/ 200
									$Denominator  = $device_number*200;
							//
							$Upload_traffic =($row1['Upload_traffic']/(1024*1000));
							$Download_traffic =($row1['Download_traffic']/(1024*1000));				
							$SUM_2  = ceil(($row1['Upload_traffic']/(1024*1000))+($row1['Download_traffic']/(1024*1000)) );
							$Total_usage_time=  ceil($Total_usage_time);
							$Upload_traffic=  ceil($Upload_traffic);
							$Download_traffic= ceil($Download_traffic);
										$i =0;
										$array_2[$i][0]=$Period ;
										$array_2[$i][1]=$tribe ;
										$array_2[$i][2]=$Time_interval;
										$array_2[$i][3]=$row1['Use_of_people'];
										$array_2[$i][4]=$row1['Number_of_users'];
										$array_2[$i][5]=ceil($row1['Total_usage_time']/60);
										$array_2[$i][6]=$SUM_2 ;
										$array_2[$i][7]=$Upload_traffic ;
										$array_2[$i][8]=$Download_traffic ;
										$array_2[$i][9]=$County ;
							
										/*
												?>
												<tr>
												<td><?=$Period ;?></td>
												<td><?=$tribe ;?></td>
												<td><?=$aroused_general_interest ;?></td>
												<td><?=$Time_interval ;?></td>
												<td>愛台灣</td>
												<td><?=$Use_of_people ;?></td>
												<td><?=$Number_of_users ;?></td>
												<td><?=$Total_usage_time ;?></td>
												<td><?=$SUM_2 ;?></td>
												<td><?=$Upload_traffic ;?></td>
												<td><?=$Download_traffic ;?></td>
												<td><?php
												$AAA =  ceil($filter_number / $Denominator) ;

												echo  100 - $AAA ;
												?>	</td>
												</tr>
												<?php
										*/
							}
										for ($ii=0 ;$ii<count($array_2);$ii++ )
										{
										?>
										<tr>
										<td><?=$array_2[$ii][0];?></td>
										<td><?=$array_2[$ii][9];?></td>
										<td><?=$array_2[$ii][1];?></td>
										<td><?=$array_2[$ii][2];?></td>
										<td>愛部落/愛台灣</td>
										<td><?php echo ($array_2[$ii][3]+$array_1[$ii][3]) ; ?></td>
										<td><?php echo ($array_2[$ii][4]+$array_1[$ii][4]) ; ?></td>
										<td><?php echo ($array_2[$ii][5]+$array_1[$ii][5]) ; ?></td>
										<td><?php echo ($array_2[$ii][6]+$array_1[$ii][6]) ; ?></td>
										<td><?php echo ($array_2[$ii][7]+$array_1[$ii][7]) ; ?></td>
										<td><?php echo ($array_2[$ii][8]+$array_1[$ii][8]) ; ?></td>
										</tr>
										<?php
										}
							
				
				
				?>
				
				


							
							
							<?php
							
							
							
							
							
							
						}else if($realm =='itr')
						{
							//$year	 $month	
							$Time_interval = $year.'-'.$month; 
							$sql2="SELECT * FROM 	monthly_report_itr_total WHERE tribe_sid='$tribe_sid' and Time_interval='$Time_interval'";
							//echo $sql2;
							$result2 = execute_sql($database_name, $sql2, $link);
							while ($row = mysql_fetch_assoc($result2) )
							{
							$Period = $row['Period'];
							$County = $row['County'];
							$area = $row['area'];
							$tribe = $row['tribe'];
							$aroused_general_interest = $row['aroused_general_interest'];
							$Device_IP = $row['Device_IP'];

							$Use_of_people = $row['Use_of_people'];
							$Number_of_users = $row['Number_of_users'];

							$Total_usage_time = $row['Total_usage_time'];
							$Upload_traffic = $row['Upload_traffic'];
							$Download_traffic = $row['Download_traffic'];
							//
									//$filter_number =$row['filter_number']; //1個設備  200 , 分母為 1/ 200
									//$Denominator =200;
									$filter_number =$row['filter_number'];
									$device_number =$row['device_number'];
									//1個設備  200 , 分母為 1/ 200
									$Denominator  = $device_number*200;
							//
							$Upload_traffic =($row['Upload_traffic']/(1024*1000));
							$Download_traffic =($row['Download_traffic']/(1024*1000));				
							$SUM_2  = ceil(($row['Upload_traffic']/(1024*1000))+($row['Download_traffic']/(1024*1000)) );
							$Total_usage_time=  ceil($Total_usage_time);
							$Upload_traffic=  ceil($Upload_traffic);
							$Download_traffic= ceil($Download_traffic);
							?>
							<tr>
							<td><?=$Period ;?></td>
							<td><?=$County ;?></td>
							<td><?=$tribe ;?></td>
								<!--<td><?//=$aroused_general_interest ;?></td>-->
							<td><?=$Time_interval ;?></td>
							<td>愛部落</td>
							<td><?=$Use_of_people ;?></td>
							<td><?=$Number_of_users ;?></td>
							<td><?=$Total_usage_time ;?></td>
							<td><?=$SUM_2 ;?></td>
							<td><?=$Upload_traffic ;?></td>
							<td><?=$Download_traffic ;?></td>
							<?php
							/*
							<td>
							$AAA =  ceil($filter_number / $Denominator) ;

							echo  100 - $AAA ;
							
							</td>
							*/
							?>
							</tr>
							<?php
							
							}	
							
							
						}else if($realm =='itw')
						{
							
							//$year	 $month	
							$Time_interval = $year.'-'.$month; 
							$sql2="SELECT * FROM 	monthly_report_itw_total WHERE tribe_sid='$tribe_sid' and Time_interval='$Time_interval'";
							//echo $sql2;
							$result2 = execute_sql($database_name, $sql2, $link);
							while ($row = mysql_fetch_assoc($result2) )
							{
							$Period = $row['Period'];
							$County = $row['County'];
							$area = $row['area'];
							$tribe = $row['tribe'];
							$aroused_general_interest = $row['aroused_general_interest'];
							$Device_IP = $row['Device_IP'];

							$Use_of_people = $row['Use_of_people'];
							$Number_of_users = $row['Number_of_users'];

							$Total_usage_time = $row['Total_usage_time'];
							$Upload_traffic = $row['Upload_traffic'];
							$Download_traffic = $row['Download_traffic'];
							//
								//$filter_number =$row['filter_number']; //1個設備  200 , 分母為 1/ 200
								//$Denominator =200;
								$filter_number =$row['filter_number'];
								$device_number =$row['device_number'];
								//1個設備  200 , 分母為 1/ 200
								$Denominator  = $device_number*200;
							//
							$Upload_traffic =($row['Upload_traffic']/(1024*1000));
							$Download_traffic =($row['Download_traffic']/(1024*1000));				
							$SUM_2  = number_format(($row['Upload_traffic']/(1024*1000))+($row['Download_traffic']/(1024*1000)) );
							$Total_usage_time=  number_format($Total_usage_time);
							$Upload_traffic=  number_format($Upload_traffic);
							$Download_traffic= number_format($Download_traffic);
							?>
							<tr>
							<td><?=$Period ;?></td>
							<td><?=$County ;?></td>
							<td><?=$tribe ;?></td>
							<!--<td><?//=$aroused_general_interest ;?></td>-->
							<td><?=$Time_interval ;?></td>
							<td>愛台灣</td>
							<td><?=$Use_of_people ;?></td>
							<td><?=$Number_of_users ;?></td>
							<td><?=$Total_usage_time ;?></td>
							<td><?=$SUM_2 ;?></td>
							<td><?=$Upload_traffic ;?></td>
							<td><?=$Download_traffic ;?></td>
							<?php
							/*
							<td>
							$AAA =  ceil($filter_number / $Denominator) ;

							echo  100 - $AAA ;
							
							</td>
							*/
							?>	
							</tr>
							<?php
							
							}	
							
						}
						
						
						
						
						?>
						</tbody>
						</table>	
			
			
			<?php	
				
				
				
		}		
					
					
					
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
				
				"bFilter": false, //开关，是否启用客户端过滤器
				"bPaginate": false, //开关，是否显示分页器
				"bInfo": true, //开关，是否显示表格的一些信息，允许或者禁止表信息的显示，默认为 true，显示信息。
			 dom: 'Bfrtip',	 buttons: 
			 [
				{ extend: 'excelHtml5', text: '匯出服務效益分析月報表' ,title: '<?= date("Y-m-d");?>:服務效益分析月報表' },
				{ extend: 'print', text: '列印 <style>td,th {border:#000 1px solid;}</style>',title: '<?= date("Y-m-d");?> <?=$filename;?> 服務效益分析月報表' },	
				//'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>
</html>