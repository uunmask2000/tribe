<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<!--表格-->
<link rel="stylesheet" type="text/css" href="../include/tablesort_style.css" />
<script src="js/jquery-latest.min.js"></script>
<script src="js/jquery.tablesorter.js"></script>
<script src="js/jquery.tablesorter.widgets.js"></script>
<script src="js/table_sort.js"></script>

<!--匯出excel-->
<script src="../js/excellentexport.js"></script>
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

		<div class="report_nav">
			<h1>部落熱點服務效益明細表</h1><br>
			<a href="/report_bnf_new/report_all_2.php">部落熱點服務效益明細表</a>
			
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
				
				<?php
				/*
				
				
				
				
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
				*/
				?>
			
			
			<select  name="tribe" size="1"   onchange="this.form.submit();">
					<option  disabled selected>請選擇部落</option>
					<?php
					   
					  $sql446="SELECT * FROM tribe  ";
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
			<div class="tool">
				<a name="b_print" class="ipt" href="" onClick="printdiv('div_print');">
				<img src="../images/print.png" width="24">
				</a>
				<a download="execl<?=date("Ymd");?>.csv" href="" onclick="return ExcellentExport.csv(this, 'table1');">
				<img src="../images/excel.png" width="24">
				</a>
			</div>
			<div class="c"></div>
		</div>
		
		<?php
					$realm = $_GET['realm'];
		
					$year = $_GET['year'];					
					$city_array = $_GET['city_array'];
					$city_township= $_GET['city_township'];
					$tribe= $_GET['tribe'];
					//$realm = $_GET['realm'];
		
						if($realm=='itw')
						{
							$key_string = "realm='itw'";
							
							}else{
								$key_string = "realm<>'itw'";
								
								}
		
		
		
		if(empty($realm))
		{ echo  '<div style="text-align:center;padding:50px 0;">尚未選取項目</div>'; }
		else{
			
			
			
			?>

		<div class="report">
						<div id="div_print"><style>table td { padding:5px;} table th { padding:5px; border:#000 1px solid;}</style>
		

			<table class="tablesorter" id="table1">
				<thead>
					<tr>
					<th colspan="12" class="table_tt">
						<?php

						if($realm=='itw')
						{ echo '愛台灣';	}
						else
						{ echo '愛部落';}
						?>-熱點服務效益明細表</th> 
					</tr>
					<tr>
						<th width="60">日期</th>
						<th>使用人次</th>
						<th>使用人數</th>
					　	<th>使用時間(分)</th>
					    <th>總流量(MB)</th>
						<th>上行流量(MB)</th>
						<th>下行流量(MB)</th>
						<th>設備妥善率（%）</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php
					
					
					//echo 	 $string ;
					$month = array('01','02','03','04','05','06','07','08','09','10','11','12');

					for($ii=0;$ii<12;$ii++)
					{
						echo '<tr>';
                         
                        
					     
							 $sql001="SELECT * FROM ass_ap where ass_ap_tribe='$tribe'    ";					   
						  
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

								$acctsessiontime=$row['SUM(acctsessiontime)']/(60);
								$acctinputoctets=$row['SUM(acctinputoctets)']/(1000*1024);
								$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1000*1024);
								$acctsessiontime=  number_format($acctsessiontime,2);
								$acctinputoctets=  number_format($acctinputoctets,2);
								$acctoutputoctets= number_format($acctoutputoctets,2);
								$summ_1[$ii] = $number1;
								$summ_2[$ii] =  $number2;
								$summ_3[$ii] =  $acctsessiontime;
								$summ_4[$ii] = $acctinputoctets + $acctoutputoctets; 
								$summ_5[$ii] = $acctinputoctets ;
								$summ_6[$ii] = $acctinputoctets ;
								$summ_7[$ii] = "100"; 
								
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
					          $sumA= array_sum($summ_1);
					          $sumB= array_sum($summ_2);
					          $sumC= array_sum($summ_3);
					          $sumD= array_sum($summ_4);
					          $sumE= array_sum($summ_5);
					          $sumF= array_sum($summ_6);
					          $sumG= array_sum($summ_7);
					          //$sumH= array_sum($summ_8);
					
								echo '<tr>';
								echo  '<td>'.'總和'.'</td>';
									echo  '<td>'. $sumA.'</td>';
										echo  '<td>'. $sumB.'</td>';
											echo  '<td>'. $sumC.'</td>';
												echo  '<td>'. $sumD.'</td>';
													echo  '<td>'. $sumE.'</td>';
														echo  '<td>'. $sumF.'</td>';
														echo  '<td>'. $sumG.'</td>';
								echo '</tr>';
					
			//echo  $summ_1[7];
				
					
					
					
					
					
					
					?>
				</tbody>
			
			</table>
					<table>
							<tr>
								<td>
									每人使用分鐘數
								</td>
								<td>
									<?php   echo      number_format($sumC/$sumB,2);           ?>
								</td>
							</tr>
							<tr>
								<td>
									每人使用流量(MB)
								</td>
								<td>
									<?php        echo      number_format($sumD/$sumB,2);              ?>
								</td>
							</tr>
							<tr>
								<td>
									每人次使用分鐘數
								</td>
								<td>
									<?php      echo  number_format($sumC/$sumA,2);                 ?>
								</td>
							</tr>
							<tr>
								<td>
									每人次使用流量(MB)
								</td>
								<td>
									<?php    echo  number_format($sumD/$sumA,2);                ?>
								</td>
							</tr>
					
					</table>
			
			
			
			
		</div>

		</div>
		
		
		
		<?php
				}
		?>
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</body>
</html>
