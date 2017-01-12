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
<script src="js/jquery.tablesorter.pager.js"></script>
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
		//include("../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		
		<?php //include("../alert/alert2.php");?>

		<?php //include("../include/report_nav.php"); ?>

		<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		?>
		
		<div class="report_bar">
			<div class="search">
			<form action="" method="GET">
					<select name="realm" size="1" > 
							<option  disabled >請選擇</option>
					<option value="itr" <?php if($_GET['realm']=='itr'){echo 'selected'; }?> ><?php  echo  'itr'; echo '</option>';	?>
					<option value="itw" <?php if($_GET['realm']=='itw'){echo 'selected'; }?> ><?php  echo  'itw'; echo '</option>';	?>
					</select>					
				
			

				<select  name="year" size="1" >
					<option  disabled >請選擇</option>
									
					<?php
					    $dat_y = date("Y")+2;
					 for($y=2016 ; $y<=$dat_y  ; $y++)
                        {
							 ?>
							 <option value="<?=$y;?>" <?php if($_GET['year']==$y){echo 'selected'; }?> ><?=$y;?></option>
							 <?php
						}
					?>
				</select>
				
				
				
				<select  name="month" size="1" >
					<option  disabled >請選擇</option>
									
					<?php
					   	$month = array('01','02','03','04','05','06','07','08','09','10','11','12');
					
					for($ii=0;$ii<12;$ii++)
					{
						 ?>
							 <option value="<?=$month[$ii];?>" <?php if($_GET['month']==$month[$ii]){echo 'selected'; }?> ><?=$month[$ii];?></option>
							 <?php
					}
					
					?>
				</select>
				
				
				
				
				<input type="button" onclick="this.form.submit();" value="Submit">
			
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
		if(empty($realm ))
		{
			
		echo  '請選擇';	
			
			
		}else{
			
			?>

		<div class="report">
		<div id="div_print"><style>table td { padding:5px;} table th { padding:5px; border:#000 1px solid;}</style>
		

			<table class="tablesorter" id="table1">
				<thead>
					<tr>
					<th colspan="12" class="table_tt">
						<?php
						
						if($realm=='itw')
						{
						echo 'itw';	
							
						}else
						{
							echo 'itr';	
							}
						
						
						?>
						
						務效益總表</th> 
					</tr>
					<tr>
						<th width="60">日期</th>
						<th>使用人次</th>
						<th>使用人數</th>
						<th> 地區</th>
					　	<th>使用時間(時)</th>
					    <th>總流量(GB)</th>
						<th>上行流量(GB)</th>
						<th>下行流量(GB)</th>
						
					</tr>
				</thead>
				
				<tbody>
					
					<?php
					$year = $_GET['year'];
					$month = $_GET['month'];
					
						$sql2_3="SELECT * FROM city_array ORDER BY id ASC  ";
						$result2_3 = execute_sql($database_name2, $sql2_3, $link2);
						 $j = 0;
						
						 $count2 = mysql_num_rows($result2_3);
						
						while ($row2_3= mysql_fetch_assoc($result2_3)  )
							{
									
							    
							    
							    ///echo $row2_3['id'];
							    // echo '<br>';
							     $key_id = $row2_3['id'];
								 $array[$key_id]['key_id'] =  $row2_3['id'];
								 
								 
								 
							 $sql2_2="SELECT * FROM `ass_ap`  where ass_ap_city='$key_id'  ";
							$result2_2 = execute_sql($database_name2, $sql2_2, $link2);
							
							
							while ($row2_2= mysql_fetch_assoc($result2_2)  and $j < $count2)
								{
									//echo $row2_2['ass_ap_city'];
									//echo $row2_2['ass_ap_ip'];
									//echo '<br>';
									//SELECT * FROM ass_ap WHERE ass_ap_ip IN ('172.21.10.101','172.21.10.102'); 
									$ass_ap_ip  =  $row2_2['ass_ap_ip'];
								
									$sql="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where nasipaddress IN ('$ass_ap_ip') and acctstarttime like '%$year-$month%' ";
									$result = execute_sql($database_name, $sql, $link);
									//echo $sql;
									//
									$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip') and realm<>'itw' and acctstarttime like '%$year-$month%'";
									$result1 = execute_sql($database_name, $sql1, $link);
									$number1 = mysql_num_rows($result1);
									  ///
									  $sql2="SELECT username   FROM radacct where  nasipaddress IN ('$ass_ap_ip')  and realm<>'itw'  and acctstarttime like '%$year-$month%'  GROUP BY username ";
									  $result2 = execute_sql($database_name, $sql2, $link);
									  $number2 = mysql_num_rows($result2);
									
									//
									
									while ($row= mysql_fetch_assoc($result) )
									{
										
										$acctsessiontime=$row['SUM(acctsessiontime)']/(60*60);
										$acctinputoctets=$row['SUM(acctinputoctets)']/(1000*1024*1024);
										$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1000*1024*1024);
										   
										   $acctsessiontime=  number_format($acctsessiontime,2);
                                           $acctinputoctets=  number_format($acctinputoctets,2);
                                           $acctoutputoctets= number_format($acctoutputoctets,2);
                                         
										//$acctstartdelay=$row['SUM(acctstartdelay)'];
										//$acctstopdelay=$row['SUM(acctstopdelay)'];
											//echo $j ;
											//echo '<br>';
											//$acctsessiontime [$j] = $acctsessiontime ;
											
											
											$array[$j]['number1'] =  $number1 ;
											$array[$j]['number2'] =  $number2 ;
											$array[$j]['acctsessiontime'] =  $acctsessiontime ;
											$array[$j]['acctinputoctets'] =  $acctinputoctets ;
											$array[$j]['acctoutputoctets'] =  $acctoutputoctets ;
											
											
									
										
										 $j++;
										
									}
									
									
									
									
									
									//echo  $sql;
								    //echo '<br>';
								
								}
							
							
									echo '<tr>';	
									$arrat_id =$row2_3['id'];
										?>
										<td><?=$year.'-'.$month;?></td>
										<td> <?php 
													if($array[$arrat_id]['number1'] ==NULL)
													{
														echo '0';
													}else
													{
														echo $array[$arrat_id]['number1']; 
														}
													
													
													  ?>                              </td>
										<td>  <?php  
										if($array[$arrat_id]['number2'] ==NULL)
													{
														echo '0';
													}else
													{ echo $array[$arrat_id]['number2']; }  ?>                             </td>
									     <td> <?php 
									     
									     
													$key =  $array[$arrat_id]['key_id'];
															
												 $sql_key="SELECT city_name FROM city_array  where id='$key'  ";
												$result_key = execute_sql($database_name2, $sql_key, $link2);
												
												
												while ($row_key= mysql_fetch_assoc($result_key) )
													{
														
														echo $row_key['city_name'];
														
														}			
															
															
															
															
														 ?>                </td>
										
										
										<td>  <?php   if($array[$arrat_id]['acctsessiontime'] ==NULL)
													{
														echo '0';
													}else
													{ echo $array[$arrat_id]['acctsessiontime'];  } ?>                             </td>
										<td>   <?php   echo $array[$arrat_id]['acctinputoctets']+$array[$arrat_id]['acctoutputoctets'];   ?>                            </td>
										<td>   <?php   if($array[$arrat_id]['acctinputoctets'] ==NULL)
													{
														echo '0';
													}else
													{  echo $array[$arrat_id]['acctinputoctets'];  } ?>                            </td>
										<td>   <?php    if($array[$arrat_id]['acctoutputoctets'] ==NULL)
													{
														echo '0';
													}else
													{ echo $array[$arrat_id]['acctoutputoctets'];  } ?>                            </td>
										
										
										
										
										
										
										
										
										<?php	
										
									
							
							
							}
					
					
					
					
										
										
					  ?>
				
				</tbody>
			
			</table>
		</div>

			<div class="pager">
				<img src="../images/first.png" height="20" width="20" class="first"/>
				<img src="../images/prev.png" height="20" width="20" class="prev"/>
				<span class="pagedisplay"></span>
				<img src="../images/next.png" height="20" width="20"  class="next"/>
				<img src="../images/last.png" height="20" width="20" class="last"/>
				<select class="pagesize" title="Select page size">
					<option value="2">2</option>
					<option selected="selected"  value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option  value="40">40</option>
				</select>
				<select class="gotoPage" title="Select page number"></select>
			</div>
		</div>
		
		
		
		<?php
			
				}
		
		
		
		
				?>
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php// include("../include/bottom.php"); ?>
	</div>

</body>
</html>
