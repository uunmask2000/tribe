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
		include("../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		
		<?php include("../alert/alert2.php");?>
        
		<div class="report_nav">
			<h1>使用者資訊查詢報表</h1>
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
				
				
				<select  name="ass_ap_ip" size="1" >
					<option  disabled selected>請選擇設備</option>
									
					<?php
					    $sql332=" SELECT id,city_name FROM `city_array`  ";
						$result332= execute_sql($database_name2, $sql332, $link2);
						while ($row332= mysql_fetch_assoc($result332)  )
									{
										$ass_ap_tribe = $row332['id'];
										//$row332['city_name'];
										
										echo '<optgroup label="'.$row332['city_name'].'">';
											  $sql333="SELECT * FROM `ass_ap` WHERE ass_ap_tribe='$ass_ap_tribe' ";
											  $result333= execute_sql($database_name2, $sql333, $link2);
											  while ($row333= mysql_fetch_assoc($result333)  )
													{
															  
														?>
													 <option value="<?=$row333['ass_ap_ip'];?>"  <?php if($_GET['ass_ap_ip']==$row333['ass_ap_ip']){  echo 'selected';  }?> ><?=$row333['ass_ap_name'];?></option>
													 <?php
												 }
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
							 <option value="<?=$y;?>" <?php if($_GET['year']==$y){echo 'selected'; }?> ><?=$y;?>年</option>
							 <?php
						}
					?>
				</select>
				
				
				
				<select  name="month" size="1" >
					<option  disabled selected>請選擇月份</option>
									
					<?php
					   	$month = array('01','02','03','04','05','06','07','08','09','10','11','12');
					 if($_GET['year']!=NULL)
					 {
						for($ii=0;$ii<12;$ii++)
						{
							 ?>
								 <option value="<?=$month[$ii];?>" <?php if($_GET['month']==$month[$ii]){echo 'selected'; }?> ><?=$month[$ii];?>月</option>
								 <?php
						}
					}
					?>
				</select>
				
				
					<select  name="day" size="1" >
					<option  disabled selected>請選擇日</option>
									
					<?php
					 if($_GET['month']!=NULL)
					 {
							
							for($iii=1;$iii<32;$iii++)
							{
								 ?>
									 <option value="<?=$iii;?>" <?php if($_GET['day']==$iii){echo 'selected'; }?> ><?=$iii;?>日</option>
									 <?php
							}
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
		if(empty($realm ))
		{
			
		echo  '<div style="text-align:center;padding:50px 0;">尚未選取項目</div>';	
			
			
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
						echo 'iTaiwan';	
							
						}else
						{
							echo 'iTribe';	
							}
						
						
						?>
						
						熱點服務效益明細表</th> 
					</tr>
					<tr>
						<th width="60">日期</th>
						<th> 地區</th>
						<th> 部落</th>
						<th> 設備名稱</th>
						<th> 使用者帳戶</th>
						<th> 配發IP</th>
						<th> 使用開始時間</th>
						<th> 使用結束時間</th>
						
						
						
					</tr>
				</thead>
				
				<tbody>
					
					<?php
					//$realm = $_GET['realm'];
					$year = $_GET['year'];
					$month = $_GET['month'];
					$day = $_GET['day'];
					$ass_ap_ip = $_GET['ass_ap_ip'];
					
					
					if($realm=='itw')
					{
						$key_string = "realm='itw'";
						
						}else{
							$key_string = "realm<>'itw'";
							
							}
							
					if($ass_ap_ip==NULL)
					{
						//$ass_ap_ip_string = "  ";
						
						}else{
							
							$ass_ap_ip_string = "nasipaddress IN ('$ass_ap_ip')  and ";
							//$ass_ap_ip_string = "nasipaddress IN ('172.21.2.111')  and ";
							}		
							
					
					if($day<9 and $day>0  )
					{
						$day = '0'.$day;
						
						}else{
							$day = $day;
							
							}
					
					
					
					
						
						if($day>0)
							{
								$time_string = $year.'-'.$month.'-'.$day;
							}else if($month>0)
							{
								$time_string = $year.'-'.$month;	
							}else {
								
								
								$time_string = $year;	
								}
					
					
					if($realm !=NULL and $year !=NULL  and $ass_ap_ip!=NULL )
					{
						
						//echo 'A';
						$sql="SELECT * FROM radacct  where $ass_ap_ip_string $key_string  and acctstarttime like '%$time_string%' ";
						//$sql="SELECT * FROM radacct  where nasipaddress ='172.21.10.103' and  $key_string and 	acctstarttime	 like '%2016-08-01%'  ";
					}else
					{
						  ?><script>alert('報表條件未設定正確'); window.history.back();</script><?php
						
					}
					//echo $sql;
					$result = execute_sql($database_name, $sql, $link);
					
										
					
					while ($row= mysql_fetch_assoc($result) )
									{
										
									//echo 	 $row['radacctid'];
									//echo '<br>';
										echo '<tr>';
										echo  '<td>'.$time_string.'</td>';
										
										if($ass_ap_ip==NULL)
										{
										echo  '<td>'.$row['nasipaddress'].'</td>';
										echo  '<td>'.$row['nasipaddress'].'</td>';
										echo  '<td>'.$row['nasipaddress'].'</td>';
										
										  
										  
										 
						
						
						
						
									}else{
							                 /*
										echo  '<td>'.$ass_ap_ip.'</td>';
										echo  '<td>'.$ass_ap_ip.'</td>';
										echo  '<td>'.$ass_ap_ip.'</td>';
										*/
										 $sql000="SELECT ass_ap_name,tribe_name,township_name,city_name,ass_ap_ip FROM (SELECT * FROM ass_ap) AS  ass_ap
										INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_ap.ass_ap_tribe=tribe.tribe_id
										INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
										INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
										where  ass_ap_ip='$ass_ap_ip'	";
										  $result000= execute_sql($database_name2, $sql000, $link2);
										  while ($row000= mysql_fetch_assoc($result000)  )
												{
													echo  '<td>'.$row000['city_name'].'</td>';
													echo  '<td>'.$row000['tribe_name'].'</td>';
													echo  '<td>'.$row000['ass_ap_name'].'</td>';
													
													
												}
										
										
										
										
										
										
											}	
										
										
										
										echo  '<td>'.$row['username'].'</td>';
										echo  '<td>'.$row['framedipaddress'].'</td>';
										echo  '<td>'.$row['acctstarttime'].'</td>';
										echo  '<td>'.$row['acctstoptime'].'</td>';
										
										echo '</tr>';
										
								
										
										
										
										
										
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
	<?php include("../include/bottom.php"); ?>
	</div>

</body>
</html>
