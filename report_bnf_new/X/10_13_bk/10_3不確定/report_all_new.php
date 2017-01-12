<html>
<head>
	<meta charset="utf-8">
	<title>無線AP網管系統</title>
	<link href="../include/style.css" rel="stylesheet" type="text/css" />
	<link href="../include/reset.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../include/tablesort_style.css" />
	<!------>
	<script src="excellentexport.js"></script>

	<!-- jQuery -->
	<script src="js/jquery-latest.min.js"></script>

	<!-- Tablesorter: required <link rel="stylesheet" href="css/theme.blue.css"> -->
	<script src="js/jquery.tablesorter.js"></script>
	<script src="js/jquery.tablesorter.widgets.js"></script>

	<!-- Tablesorter: optional <link rel="stylesheet" href="addons/pager/jquery.tablesorter.pager.css">-->
	<script src="addons/pager/jquery.tablesorter.pager.js"></script>
	<script src="addons/pager/page.js"></script>
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
			<a href="/report_bnf_new/report_list.php">每月報表分析</a>
		</div>

		<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		?>
		
		<div class="report_bar">
			<div class="search">
			<form action="" method="GET">
				<select name="realm" size="1" > 
					<option  disabled selected>請選擇單位</option>
					<option value="itr" <?php if($_GET['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
					<option value="itw" <?php if($_GET['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
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
				<select  name="city_array" size="1" onchange="this.form.submit();">
					<option  disabled selected>請選擇縣市</option>
					<?php
					  $sql444="SELECT * FROM city_array ORDER BY id ASC  ";
					  $result444= execute_sql($database_name2, $sql444, $link2);
					  while ($row444= mysql_fetch_assoc($result444)  )
							{
					  				  
								?>
							 <option value="<?=$row444['id'];?>"  <?php if($_GET['city_array']==$row444['id']){  echo 'selected';  }?> ><?=$row444['city_name'];?></option>
							 <?php
						 }					
					?>
				</select>
				<select  name="city_township" size="1"  onchange="this.form.submit();">
					<option  disabled selected>請選擇地區</option>
					<?php
					 $key_city_array = $_GET['city_array'];    
					  $sql445="SELECT * FROM city_township where township_city ='$key_city_array ' ";
					  $result445= execute_sql($database_name2, $sql445, $link2);
					  while ($row445= mysql_fetch_assoc($result445)  )
							{
					  				  
								?>
							 <option value="<?=$row445['township_id'];?>"  <?php if($_GET['city_township']==$row445['township_id']){  echo 'selected';  }?> ><?=$row445['township_name'];?></option>
							 <?php
						 }					
					?>
				</select>
				<select  name="tribe" size="1"   onchange="this.form.submit();">
					<option  disabled selected>請選擇部落</option>
					<?php
					 $key_city_township= $_GET['city_township'];    
					  $sql446="SELECT * FROM tribe where  city_id ='$key_city_array '   and  township_id ='$key_city_township ' ";
					  $result446= execute_sql($database_name2, $sql446, $link2);
					  while ($row446= mysql_fetch_assoc($result446)  )
							{
					  				  
								?>
							 <option value="<?=$row446['tribe_id'];?>"  <?php if($_GET['tribe']==$row446['tribe_id']){  echo 'selected';  }?> ><?=$row446['tribe_name'];?></option>
							 <?php
						 }					
					?>
				</select>
			<input type="button" onclick="this.form.submit();" value="檢視報表">
			</form>
			</div>

			<!---列印/匯出工具列---->
			<div class="tool">
				<a name="b_print" class="ipt" href="" onClick="printdiv('div_print');">
				<img src="../images/print.png" width="24">
				</a>
				<!--
				<a download="服務效益總表(年報表)<?=date("Ymd");?>.xls" href="" onclick="return ExcellentExport.excel(this, 'datatable', 'Sheet Name Here');">
				<img src="../images/excel.png" width="24">
				</a>
				--->
				
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
				<script src="execl_95/jquery.table2excel.js"></script>
				
				<!--<button onclick="myFunction()">Click me</button>-->
				<a href="#" onclick="myFunction()"><img src="../images/excel.png" width="24"></a>
				<script>
					function myFunction() {
						$(function() {
							$(".tablesorter").table2excel({
								exclude: ".noExl",
								name: "Excel Document Name",
								filename: "服務效益總表(年報表)<?=date("Ymd");?>",
								fileext: ".xls",
								exclude_img: true,
								exclude_links: true,
								exclude_inputs: true
							});
						});
						}
					</script>
				
				
				<!---------------------->
			</div>
			<div class="c"></div>
		</div>
		<!---列印---->
		<script language="javascript">
			function printdiv(printpage)
			{
			var headstr = "<html><head><title></title></head><body>";
			var footstr = "</body>";
			var newstr = document.all.item(printpage).innerHTML;
			var oldstr = document.body.innerHTML;
			document.body.innerHTML = headstr+newstr+footstr;
			window.print();
			document.body.innerHTML = oldstr;
			return false;
			}
		</script>
	<?php
		$realm = $_GET['realm'];
		if(empty($realm ))
		{ 
			echo  '<div style="text-align:center;padding:50px 0;">尚未選取項目</div>'; 
		}
		else{
	?>
	
	
	

			<div class="report">
				<div id="div_print"><style>table td { padding:5px;} table th { padding:5px; border:#000 1px solid;}</style>
				<table class="tablesorter" id="datatable"  >
					<thead>
						<tr>
							<th colspan="9" class="table_tt">
								<?php
								if($realm=='itw')
								{ echo '愛台灣';	}
								else
								{ echo '愛部落';}
								?>
								服務效益總表
							</th> 
						</tr>
						<tr>
							<th width="60">日期</th>
							<th>使用人次</th>
							<th>使用人數</th>
						　	<th>使用時間(時)</th>
							<th>總流量(GB)</th>
							<th>上行流量(GB)</th>
							<th>下行流量(GB)</th>
							<th>設備妥善率（%）</th>
						</tr>
					</thead>
					
					<tbody>
					<?php
					$realm = $_GET['realm'];
						if($realm=='itw')
					{
						$key_string = "realm='itw'";
						}else{
							$key_string = "realm<>'itw'";
											}
											$year = $_GET['year'];

								$city_array = $_GET['city_array'];
								$city_township= $_GET['city_township'];
								$tribe= $_GET['tribe'];
								
									  if(empty($city_array))
									{
										if(empty($year))
										{
											$year=date("Y");
										}else
										{
											$year = $year;
										}
										$month = array('01','02','03','04','05','06','07','08','09','10','11','12');
										
								for($ii=0;$ii<12;$ii++)
								{
									echo '<tr>';

								$sql="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where  $key_string and  acctstarttime like '%$year-$month[$ii]%' ";
								$result = execute_sql($database_name, $sql, $link);
								//echo $sql;
								//
								$sql1="SELECT radacctid FROM radacct where $key_string and acctstarttime like '%$year-$month[$ii]%'";
								$result1 = execute_sql($database_name, $sql1, $link);
								$number1 = mysql_num_rows($result1);
								  ///
								  $sql2="SELECT username   FROM radacct where $key_string and acctstarttime like '%$year-$month[$ii]%'  GROUP BY username ";
								  $result2 = execute_sql($database_name, $sql2, $link);
								  $number2 = mysql_num_rows($result2);
								//
								//echo  $sql1;
								//echo '<br>11';
								while ($row = mysql_fetch_assoc($result) )
										{

											$acctsessiontime=$row['SUM(acctsessiontime)']/(60*60);
											$acctinputoctets=$row['SUM(acctinputoctets)']/(1000*1024*1024);
											$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1000*1024*1024);
											$acctsessiontime=  number_format($acctsessiontime,2);
											$acctinputoctets=  number_format($acctinputoctets,2);
											$acctoutputoctets= number_format($acctoutputoctets,2);
											?>
											<td><?=$year.'-'.$month[$ii];?></td>
											<td><?=$number1;?></td>
											<td><?=$number2;?></td>
											
												<td><?=$acctsessiontime;?></td>
												<td><?php echo $integrated_num = $acctinputoctets + $acctoutputoctets;   ?></td>
												<td><?=$acctinputoctets;?></td>
												<td><?=$acctoutputoctets;?></td>
												<td>100</td>
											<?php	
											}
									echo '</tr>';
								}
		}else
		{
							$month = array('01','02','03','04','05','06','07','08','09','10','11','12');

							for($ii=0;$ii<12;$ii++)
							{
								echo '<tr>';
								 if($tribe!=NULL)
								 {
									 $sql001="SELECT * FROM ass_ap where ass_ap_city='$city_array '  and ass_ap_twon='$city_township' and ass_ap_tribe='$tribe'    ";
								  }else if($city_township!=NULL)
								  {
									   $sql001="SELECT * FROM ass_ap where ass_ap_city='$city_array '  and ass_ap_twon='$city_township'   ";
									}else if($city_array!=NULL)
									{
										 $sql001="SELECT * FROM ass_ap where ass_ap_city='$city_array '     ";
									}
								 
								 //echo  $sql001;
								// echo '<br>';
								  
								  $result001= execute_sql($database_name2, $sql001, $link2);
									while ($row001 = mysql_fetch_assoc($result001) )
									{
										$string = $row001['ass_ap_ip'];
										//echo $string;
									}
							$sql="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where   $key_string  and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%' ";
							$result = execute_sql($database_name, $sql, $link);
							//echo $sql;
							//echo '<br>';
							//
							$sql1="SELECT radacctid FROM radacct where $key_stringand nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'";
							$result1 = execute_sql($database_name, $sql1, $link);
							$number1 = mysql_num_rows($result1);
							  ///
							  $sql2="SELECT username   FROM radacct where $key_string and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'  GROUP BY username ";
							  $result2 = execute_sql($database_name, $sql2, $link);
							  $number2 = mysql_num_rows($result2);
							//
							//echo  $sql1;
							//echo '<br>11';
							while ($row = mysql_fetch_assoc($result) )
									{
										$acctsessiontime=$row['SUM(acctsessiontime)']/(60*60);
										$acctinputoctets=$row['SUM(acctinputoctets)']/(1000*1024*1024);
										$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1000*1024*1024);
										$acctsessiontime=  number_format($acctsessiontime,2);
										$acctinputoctets=  number_format($acctinputoctets,2);
										$acctoutputoctets= number_format($acctoutputoctets,2);
										?>
										<td><?=$year.'-'.$month[$ii];?></td>
										<td><?=$number1;?></td>
										<td><?=$number2;?></td>
										
											<td><?=$acctsessiontime;?></td>
											<td><?php echo $integrated_num = $acctinputoctets + $acctoutputoctets;   ?></td>
											<td><?=$acctinputoctets;?></td>
											<td><?=$acctoutputoctets;?></td>
											<td>100</td>
										<?php	
										}
								echo '</tr>';
							}
		}
?>
					</tbody>
				</table>
				</div>
			</div>

			<div class="pager">
				<img src="addons/pager/icons/first.png" class="first" alt="First" />
				<img src="addons/pager/icons/prev.png" class="prev" alt="Prev" />
				<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
				<img src="addons/pager/icons/next.png" class="next" alt="Next" />
				<img src="addons/pager/icons/last.png" class="last" alt="Last" />
				<select class="pagesize" title="Select page size">
					<option value="12">12</option>
					<option value="all">列出全部</option>
				</select>
				<select class="gotoPage" title="Select page number"></select>
			</div>
			<?php
			}
			?>
	</div>
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>
