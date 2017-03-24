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
			<a href="/report_bnf_new_2/show_report_all.php"
			<?php if (preg_match("/report_all/i", $_SERVER['PHP_SELF'])) {echo 'style="background: #126389"'; } ?>
			>年報表</a>
			<a href="/report_bnf_new_2/show_report_tribe.php">月報表</a>
		</div>

	<?php
	require_once("dbtools.inc.php");
	$link = create_connection();
	$link2 = create_connection2();
	?>

		<div class="report_bar">

		<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
		
		
	<select id="list" name="A" onchange="this.form.submit();">
<option value="NO" selected disabled="disabled">請選擇期別</option>	
<?php
///echo '1231465';
$sql_prj = "SELECT Project_name,Project_number FROM Project ";
$result_prj = execute_sql($database_name2, $sql_prj, $link2);
while ($row_prj = mysql_fetch_assoc($result_prj))
{
echo $row_prj['Project_name'] ;
?>
<option value="<?=$row_prj['Project_number'] ;?>" <?php if($_POST['A']==$row_prj['Project_number']){echo 'selected'; }?>><?=$row_prj['Project_name'] ;?></option>
<?php
}
/*
<option value="2" <?php if($_POST['A']==2){echo 'selected'; }?>>2期</option>
<option value="3" <?php if($_POST['A']==3){echo 'selected'; }?>>3期</option>	
*/

?>

					
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
							$sql_tribe="SELECT * FROM tribe  where tribe_label='$key' and city_id='$city_key' ORDER BY `tribe`.`tribe_name` ASC ";
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
		$month =array("01","02","03","04","05","06","07","08","09","10","11","12");
		// Period   tribe  year realm
		 $Period =$_POST['A'] ;
		 $tribe =$_POST['tribe'] ;
		 $year =$_POST['year'] ;
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
		
		
		if($tribe==NULL or $tribe==' ' )
		{
			
			$msger = 1 ;
			
		}
		
		
		if($year==NULL or $year==' ' )
		{
			
			$msger = 1 ;
			
		}
		
		
		if($realm==NULL or $realm==' ' )
		{
			
			$msger = 1 ;
			
		}
		
		
		if($msger ==1)
		{
			///echo  '有條件未選擇';
		}else{
			
			?>
			
						<table id="show_date" class="display" cellspacing="0" width="100%">
						<thead>
						<tr>
						<th>期別</th>
						<th>縣市</th>
						<th>部落</th>
						<th>月份</th>
						<th>服務</th>
						<th>使用人次</th>
						<th>使用人數</th>
						　	<th>使用時間(分)</th>
						<th>總流量(MB)</th>
						<th>上行流量(MB)</th>
						<th>下行流量(MB)</th>
						<!---
						<th> 設備妥善率</th>
						--->
						</tr>
						</thead>

						<tbody>
						<?php
						if($realm =='all')
						{
								for ($i=0 ;$i<12;$i++ )
								{
									$Time_interval = $year.'-'.$month[$i]; 
									$sql2="SELECT * FROM monthly_report_itr_total WHERE tribe_sid='$tribe' and Time_interval='$Time_interval'";
									$result2 = execute_sql($database_name, $sql2, $link);
									while ($row = mysql_fetch_assoc($result2) )
									{


									$filter_number =$row['filter_number'];
									$device_number =$row['device_number'];
									//1個設備  200 , 分母為 1/ 200
									$Denominator  = $device_number*200;
									//
									$Upload_traffic =($row['Upload_traffic']/(1024*1000));
									$Download_traffic =($row['Download_traffic']/(1024*1000));				
									$SUM_2  = ceil($Upload_traffic) +ceil($Download_traffic) ;
									$Total_usage_time=  ceil($Total_usage_time);
									$Upload_traffic=  ceil($Upload_traffic);
									$Download_traffic= ceil($Download_traffic);

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
											<td><?=$row['Period'];?></td>
											<td><?=$row['tribe'];?></td>
											<td><?=$row['Time_interval'];?></td>
											<td>愛部落</td>
											<td><?=$row['Use_of_people'];?></td>
											<td><?=$row['Number_of_users'];?></td>
											<td><?=ceil($row['Total_usage_time']/60);?></td>
											<td><?=$SUM_2 ;?></td>
											<td><?=$Upload_traffic;?></td>
											<td><?=$Download_traffic;?></td>
											<?php
										*/	
									/*
									<td>
									$AAA =  ceil($filter_number / $Denominator) ;
									echo  100 - $AAA ;
									</td>
									*/
									?>					
									<?php
									}
									

								}

										for ($i=0 ;$i<12;$i++ )
										{
										$Time_interval = $year.'-'.$month[$i]; 
										$sql2="SELECT * FROM monthly_report_itw_total WHERE tribe_sid='$tribe' and Time_interval='$Time_interval'";
										$result2 = execute_sql($database_name, $sql2, $link);
										while ($row = mysql_fetch_assoc($result2) )
										{

										$filter_number =$row['filter_number'];
										$device_number =$row['device_number'];
										//1個設備  200 , 分母為 1/ 200
										$Denominator  = $device_number*200;
										//
										$Upload_traffic =($row['Upload_traffic']/(1024*1000));
										$Download_traffic =($row['Download_traffic']/(1024*1000));				
										$SUM_2  = ceil($Upload_traffic) +ceil($Download_traffic) ;
										$Total_usage_time=  ceil($Total_usage_time);
										$Upload_traffic=  ceil($Upload_traffic);
										$Download_traffic= ceil($Download_traffic);
										
									$array_2[$i][0]=$row['Period'];
									$array_2[$i][1]=$row['tribe'];
									$array_2[$i][2]=$row['Time_interval'];
									$array_2[$i][3]=$row['Use_of_people'];
									$array_2[$i][4]=$row['Number_of_users'];
									$array_2[$i][5]=ceil($row['Total_usage_time']/60);
									$array_2[$i][6]=$SUM_2 ;
									$array_2[$i][7]=$Upload_traffic ;
									$array_2[$i][8]=$Download_traffic ;
									$array_2[$i][9]=$row['County'];
											 /*
												?>
												<tr>
												<td><?=$row['Period'];?></td>
												<td><?=$row['tribe'];?></td>
												<td><?=$row['Time_interval'];?></td>
												<td>愛台灣</td>
												<td><?=$row['Use_of_people'];?></td>
												<td><?=$row['Number_of_users'];?></td>
												<td><?=ceil($row['Total_usage_time']/60);?></td>
												<td><?=$SUM_2 ;?></td>
												<td><?=$Upload_traffic;?></td>
												<td><?=$Download_traffic;?></td>
												<?php
											*/
										/*
										<td>
										$AAA =  ceil($filter_number / $Denominator) ;
										echo  100 - $AAA ;
										</td>
										*/
										?>					
										<?php


										}	
									}
								/*
								?>
								<tr>
								<td><?=$array_2[$i][0];?></td>
								<td><?=$array_2[$i][1];?></td>
								<td><?=$array_2[$i][2];?></td>
								<td>全部</td>
								<td><?=$array_2[$i][3]+$array_1[3];?></td>
								<td><?=$array_2[$i][4]+$array_1[4];?></td>
								<td><?=$array_2[$i][5]+$array_1[5];?></td>
								<td><?=$array_2[$i][6]+$array_1[6];?></td>
								<td><?=$array_2[$i][7]+$array_1[7];?></td>
								<td><?=$array_2[$i][8]+$array_1[8];?></td>
								</tr>
								<?php
								*/
								//print_r($array_1);
								//echo '<br>';
								//print_r($array_2);
									for ($ii=0 ;$ii<count($array_1);$ii++ )
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
										<td><?php echo ($array_2[$ii][6]+$array_1[$ii][6]) ;  ?></td>
										<td><?php echo ($array_2[$ii][7]+$array_1[$ii][7]) ; ?></td>
										<td><?php echo ($array_2[$ii][8]+$array_1[$ii][8]) ; ?></td>
										</tr>
										<?php
									}
	//print_r($array_2);
	//echo 	$array_2[8][5];	
	//echo 	$array_2[9][5];						
						}else if($realm =='itr'){

						//Period   tribe  year realm

						for ($i=0 ;$i<12;$i++ )
						{
						$Time_interval = $year.'-'.$month[$i]; 
						$sql2="SELECT * FROM monthly_report_itr_total WHERE tribe_sid='$tribe' and Time_interval='$Time_interval'";
						$result2 = execute_sql($database_name, $sql2, $link);
						while ($row = mysql_fetch_assoc($result2) )
						{


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
						$County =$row['County'];

						?>
						<tr>
						<td><?=$row['Period'];?></td>
						<td><?=$row['County'];?></td>
						<td><?=$row['tribe'];?></td>
						<td><?=$row['Time_interval'];?></td>
						<td>愛部落</td>
						<td><?=$row['Use_of_people'];?></td>
						<td><?=$row['Number_of_users'];?></td>
						<td><?=ceil($row['Total_usage_time']/60);?></td>
						<td><?=$SUM_2 ;?></td>
						<td><?=$Upload_traffic;?></td>
						<td><?=$Download_traffic;?></td>				

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



						}else if($realm =='itw')
						{
						for ($i=0 ;$i<12;$i++ )
						{
						$Time_interval = $year.'-'.$month[$i]; 
						$sql2="SELECT * FROM monthly_report_itw_total WHERE tribe_sid='$tribe' and Time_interval='$Time_interval'";
						$result2 = execute_sql($database_name, $sql2, $link);
						while ($row = mysql_fetch_assoc($result2) )
						{

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
						$County =$row['County'];
						?>
						<tr>
						<td><?=$row['Period'];?></td>
						<td><?=$row['County'];?></td>
						<td><?=$row['tribe'];?></td>
						<td><?=$row['Time_interval'];?></td>
						<td>愛台灣</td>
						<td><?=$row['Use_of_people'];?></td>
						<td><?=$row['Number_of_users'];?></td>
						<td><?=ceil($row['Total_usage_time']/60);?></td>
						<td><?=$SUM_2 ;?></td>
						<td><?=$Upload_traffic;?></td>
						<td><?=$Download_traffic;?></td>			

						
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

						}	

						?>
		 </tbody>
		</table>
			<?php
		}
		?>

		<?php
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
				{ extend: 'excelHtml5', text: '匯出服務效益分析總表' ,title: '<?= date("Y-m-d");?><?=$filename;?>  <?=$tribe_name;?>:服務效益分析年報表' },
				{ extend: 'print', text: '列印 <style>td,th {border:#000 1px solid;}</style>',title: '<?= date("Y-m-d");?> <?=$filename;?> 服務效益分析年報表' },	
				//'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>
</html>
