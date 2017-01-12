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
					<option value="itr" <?php if($_GET['realm']=='itr'){echo 'selected'; }?> ><?php  echo  'itr'; echo '</option>';	?>
					<option value="itw" <?php if($_GET['realm']=='itw'){echo 'selected'; }?> ><?php  echo  'itw'; echo '</option>';	?>
					</select>					
				
			<select name="tribe" size="1" > 
					<optgroup label="所有">
					<option value="all" <?php if($_GET['tribe']=='all'){echo 'selected'; }?>>列出所有</option>
						<?php
						$sql2="SELECT city_name,id FROM city_array ORDER BY `city_array`.`city_sort` ASC   ";
						$result2 = execute_sql($database_name2, $sql2, $link2);
						$number2 = mysql_num_rows($result2);

						while ($row2= mysql_fetch_assoc($result2) )
							{
							
							$id  = $row2['id'];
							echo '<optgroup label="'.$row2['city_name'].'">';
							
							
									$sql22="SELECT * FROM tribe  where 	city_id='$id'  ORDER BY city_id ASC   ";
									$result22 = execute_sql($database_name2, $sql22, $link2);
									$number22 = mysql_num_rows($result22);

									while ($row22= mysql_fetch_assoc($result22) )
										{
											
										?>
										
										<option value="<?=$row22['tribe_id'];?>" <?php if($_GET['tribe']==$row22['tribe_id']){echo 'selected'; }?> ><?=$row22['tribe_name'];?>
								
										<?php	
								
										}
							
										
						
							
							
							
							}
						
						
						
						
 
			echo '</option>';	
 
 
						?>
				</select>

				<select  name="year" size="1" >
					<option value=""   <?php if($_GET['year']=='all'){echo 'selected'; }?>>全部</option>
									
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

		<div class="report">
		<div id="div_print"><style>table td { padding:5px;} table th { padding:5px; border:#000 1px solid;}</style>
		

			<table class="tablesorter" id="table1">
				<thead>
					<tr>
					<th colspan="12" class="table_tt">
						<?php
						$realm = $_GET['realm'];
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
						<th colspan="4">設備位置</th>
					　	<th>使用時間(時)</th>
					    <th>總流量(GB)</th>
						<th>上行流量(GB)</th>
						<th>下行流量(GB)</th>
						<th>設備妥善率（%）</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
					
				$tribe = $_GET['tribe'];
				$like_text=$_GET['year'];
				if($tribe =='all')
				{
				$sql223="SELECT * FROM ass_ap  ";	
				}else
				{
					
				$sql223="SELECT * FROM ass_ap  where 	ass_ap_tribe='$tribe'  ";	
				}
			
			
			
			$result223 = execute_sql($database_name2, $sql223, $link2);
			$number223 = mysql_num_rows($result223);

			while ($row223= mysql_fetch_assoc($result223) )
			{
				$nasipaddress =$row223['ass_ap_ip']  ;
				
				
				if($realm=='itw')
				{
								
					$sql= "SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay) FROM radacct where realm='itw' and nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%' ";	
					$result = execute_sql($database_name, $sql, $link);
					//
					$sql1="SELECT radacctid FROM radacct where realm='itw' and  nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%'  ";
					$result1 = execute_sql($database_name, $sql1, $link);
					$number = mysql_num_rows($result1);
					  ///
					  $sql2="SELECT username   FROM radacct where realm='itw' and  nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%'   GROUP BY username ";
					  $result2 = execute_sql($database_name, $sql2, $link);
					  $number2 = mysql_num_rows($result2);
				  //echo $sql;
					
				}else
					{
						
								
					$sql= "SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay) FROM radacct where realm<>'itw' and nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%' ";	
					$result = execute_sql($database_name, $sql, $link);
					//
					$sql1="SELECT radacctid FROM radacct where realm<>'itw' and  nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%'  ";
					$result1 = execute_sql($database_name, $sql1, $link);
					$number = mysql_num_rows($result1);
					  ///
					  $sql2="SELECT username   FROM radacct where realm<>'itw' and  nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%'   GROUP BY username ";
					  $result2 = execute_sql($database_name, $sql2, $link);
					  $number2 = mysql_num_rows($result2);	
						
					}
				
				
				  
				  while ($row = mysql_fetch_assoc($result) )
							{
								$acctsessiontime=$row['SUM(acctsessiontime)']/(60*60);
								$acctinputoctets=$row['SUM(acctinputoctets)']/(1000*1024*1024);
								$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1000*1024*1024);

								//$acctstartdelay=$row['SUM(acctstartdelay)'];
								//$acctstopdelay=$row['SUM(acctstopdelay)'];
								
								
								$acctsessiontime=  number_format($acctsessiontime,2);
								$acctinputoctets=  number_format($acctinputoctets,2);
								$acctoutputoctets= number_format($acctoutputoctets,2);
								?>
					<tr>
						<td>
						<?php
						
						if($like_text==NULL)
						{
							echo '全部';
						}else
						{
							
							  echo $like_text;
							}
						
						
						
						
						//echo $_GET['year'];
						
						
						?>
						
						
						
						</td>
						<td><?=$number;?></td>
						<td><?=$number2;?></td>
						<?php


							$key =   $nasipaddress;
							$SQL = "SELECT ass_ap_name,tribe_name,township_name,city_name FROM (SELECT * FROM ass_ap) AS  ass_ap
										INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_ap.ass_ap_tribe=tribe.tribe_id
										INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
										INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id
										where   ass_ap_ip = '$key' ";
						    $RUS = execute_sql2($database_name2, $SQL, $link2); 
						    $number_RUS = mysql_num_rows($RUS);
						    
						    if($number_RUS >0 )
						    {
							while($row_RUS = mysql_fetch_assoc($RUS))
								{
									
								echo '<td>'.$row_RUS['city_name'].'</td> <td>'.$row_RUS['township_name'].'</td><td>'.$row_RUS['tribe_name'].'</td><td>'.$row_RUS['ass_ap_name'].'</td>';
								
								}
							}else{ echo  '<td colspan="4">'.$nasipaddress.'</td>';   }
						    //echo  $row_zone['nasipaddress'];
							//$nasipaddress;

							?>
						<td><?=$acctsessiontime;?></td>
						<td><?php echo $integrated_num = $acctinputoctets + $acctoutputoctets;   ?></td>
						<td><?=$acctinputoctets;?></td>
						<td><?=$acctoutputoctets;?></td>
						<td>100</td>
					</tr>
								<?php
							}
				
				
				
				
				
				
			}?>	
				
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
				?>
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php// include("../include/bottom.php"); ?>
	</div>

</body>
</html>
