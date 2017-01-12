


<!-- chart-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- chart-->
<?php
	session_start();
	require_once("dbtools.inc.php");
	$link = create_connection();
	$link2 = create_connection2();
	?>
<input type ="button" onclick="javascript:location.href='?mode=case_A'" value="最近一日統計圖"></input>
<input type ="button" onclick="javascript:location.href='?mode=case_B'" value="最近一周統計圖"></input>
<input type ="button" onclick="javascript:location.href='?mode=case_C'" value="最近三十統計圖"></input>
<input type ="button" onclick="javascript:location.href='?mode=case_D'" value="自訂"></input>
<?php
$mode = $_GET['mode'];

switch ($mode) {
    case "case_A":
        ?>
		<form action="?mode=case_A" method="POST">
		<input type="hidden" name="mode" value="<?=$mode ;?>">
		<select name="realm" size="1" onchange="this.form.submit();" > 
			<option  disabled selected>請選擇單位</option>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
		</select>
	<select name="label" onchange="this.form.submit();">
				  <option value=" " selected disabled >請選擇期別</option> 
				　<option value="2" <?php if($_POST['label']=='2'){echo 'selected';}else{};	?> >第二期</option>
				　<option value="3" <?php if($_POST['label']=='3'){echo 'selected';}else{};	?> >第三期</option>
	</select>

	<select  name="tribe" size="1"   onchange="this.form.submit();">
		<option value="" disabled selected>請選擇部落</option>
		<?php
		  $key = $_POST['label'];
			$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'";
			$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
			while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				$tribe_name =  $row_tribe['tribe_name'];
				?>
				<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_POST['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
				<?php
			  
			}
				
		?>
	</select>
		<select  name="ass_ap_ip" size="1"   onchange="this.form.submit();">
			<option value="" disabled selected>請選擇設備</option>
			<?php
			$key2 = $_POST['tribe'];
			$sql_ap="SELECT * FROM ass_ap WHERE ass_ap_tribe='$key2' ";
			$result_ap= execute_sql($database_name2, $sql_ap, $link2);
			while ($row_ap= mysql_fetch_assoc($result_ap)  )
			{
				$ass_ap_name =  $row_ap['ass_ap_name'];
				?>
				<option value="<?=$row_ap['ass_ap_ip'];?>"  <?php if($_POST['ass_ap_ip']==$row_ap['ass_ap_ip']){  echo 'selected';  }?> ><?=$row_ap['ass_ap_name'];?></option>
				<?php
			}					
			?>
		</select>

		
		
		
		<input type="submit" value="檢視報表">
		</form>
		<?php
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			
			$sql_name="SELECT * FROM tribe WHERE tribe_id='$tribe_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $tribe_name= $row_name['tribe_name'];
			}
			
			if(empty($realm_A))
			{
				echo '未選擇單位';
			}
		   if(empty($label_A))
			{
				echo '未選擇期別';
			}
			if(empty($tribe_A))
			{
				echo '未選擇部落';
			}
			if(empty($ass_ap_ip_A))
			{
				echo '未選擇設備';
			}else{
				
				//echo $ass_ap_ip_A;
				$yesterday =date("Y/m/d", strtotime('-1 day'));
				if($realm_A =='itw' )
				{
					$realm_A_type = '愛台灣  ';
					for($row_hr=0;$row_hr<24 ;$row_hr++)
					{
						$sql_string = date("Y-m-d H", strtotime("$yesterday +$row_hr hours" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%'  ";
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ($row['SUM(acctinputoctets)'] /(1000*1024));
								$acctoutputoctets=($row['SUM(acctoutputoctets)'] /(1000*1024));
								$array_A[$row_hr][0]= $sql_string.'時';
								$array_A[$row_hr][1]= $acctinputoctets;
								$array_A[$row_hr][2]= $acctoutputoctets;
							}
					}
				}else{
					$realm_A_type = '愛部落  ';
					for($row_hr=0;$row_hr<24 ;$row_hr++)
					{
						$sql_string = date("Y-m-d H", strtotime("$yesterday +$row_hr hours" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= round(($row['SUM(acctinputoctets)'] /(1024*1000)), 2);
								$acctoutputoctets=round(($row['SUM(acctoutputoctets)'] /(1024*1000)), 2);
								$array_A[$row_hr][0]= $sql_string.'時';
								$array_A[$row_hr][1]= $acctinputoctets;
								$array_A[$row_hr][2]= $acctoutputoctets;
							}
					}
				}
					
			
			?>
			 <div id="chart_div" style="width: 100%; height: 500px;"></div>
			<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				var data = google.visualization.arrayToDataTable([
				['日期', '上傳流量(MB)', '下載流量(MB)'], 
				<?php
				for($time_A=0;$time_A < count($array_A);$time_A++)
					{
					$acctinputoctets_date = $array_A[$time_A][1];  //上傳
					$acctoutputoctets_date = $array_A[$time_A][2];  //下載
						?>
					['<?=$array_A[$time_A][0];?>',<?=$acctinputoctets_date;?>,<?=$acctoutputoctets_date;?>],	
						<?php
					
						
					}
				?>
				  
				]);

				var options = {
				  title: '<?=$realm_A_type. $tribe_name.':'.$ass_ap_name.' '    ;?>',
				  hAxis: {title: '時間區間',  titleTextStyle: {color: '#333'}},
				  vAxis: {minValue: 0}
				};

				var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			  }
			</script>
			<?php
			
			
			}
		
		//echo count($array_A);
		
		?>
		
		
		
		
		
		<?php
		
		//print_r($array_A);
		
		
		
		
		
		//echo "Your favorite color is red!";
        break;
    case "case_B":
        
		  ?>
		<form action="?mode=case_B" method="POST">
		<input type="hidden" name="mode" value="<?=$mode ;?>">
		<select name="realm" size="1" onchange="this.form.submit();" > 
			<option  disabled selected>請選擇單位</option>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
		</select>
	<select name="label" onchange="this.form.submit();">
				  <option value=" " selected disabled >請選擇期別</option> 
				　<option value="2" <?php if($_POST['label']=='2'){echo 'selected';}else{};	?> >第二期</option>
				　<option value="3" <?php if($_POST['label']=='3'){echo 'selected';}else{};	?> >第三期</option>
	</select>

	<select  name="tribe" size="1"   onchange="this.form.submit();">
		<option value="" disabled selected>請選擇部落</option>
		<?php
		  $key = $_POST['label'];
			$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'";
			$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
			while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				$tribe_name =  $row_tribe['tribe_name'];
				?>
				<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_POST['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
				<?php
			  
			}
				
		?>
	</select>
		<select  name="ass_ap_ip" size="1"   onchange="this.form.submit();">
			<option value="" disabled selected>請選擇設備</option>
			<?php
			$key2 = $_POST['tribe'];
			$sql_ap="SELECT * FROM ass_ap WHERE ass_ap_tribe='$key2' ";
			$result_ap= execute_sql($database_name2, $sql_ap, $link2);
			while ($row_ap= mysql_fetch_assoc($result_ap)  )
			{
				$ass_ap_name =  $row_ap['ass_ap_name'];
				?>
				<option value="<?=$row_ap['ass_ap_ip'];?>"  <?php if($_POST['ass_ap_ip']==$row_ap['ass_ap_ip']){  echo 'selected';  }?> ><?=$row_ap['ass_ap_name'];?></option>
				<?php
			}					
			?>
		</select>

		
		
		
		<input type="submit" value="檢視報表">
		</form>
		<?php
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			
			$sql_name="SELECT * FROM tribe WHERE tribe_id='$tribe_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $tribe_name= $row_name['tribe_name'];
			}
			
			if(empty($realm_A))
			{
				echo '未選擇單位';
			}
		   if(empty($label_A))
			{
				echo '未選擇期別';
			}
			if(empty($tribe_A))
			{
				echo '未選擇部落';
			}
			if(empty($ass_ap_ip_A))
			{
				echo '未選擇設備';
			}else{
				
				
				
				$yesterday =date("Y/m/d", strtotime('-7 day'));
				//echo $yesterday;
				if($realm_A =='itw' )
				{
					$realm_A_type = '愛台灣  ';
					for($row_hr=0;$row_hr<7 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%'  ";
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ($row['SUM(acctinputoctets)'] /(1000*1024));
								$acctoutputoctets=($row['SUM(acctoutputoctets)'] /(1000*1024));
								$array_B[$row_hr][0]= $sql_string.'日';
								$array_B[$row_hr][1]= $acctinputoctets;
								$array_B[$row_hr][2]= $acctoutputoctets;
							}
					}
				}else{
					$realm_A_type = '愛部落  ';
					for($row_hr=0;$row_hr<7 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= round(($row['SUM(acctinputoctets)'] /(1024*1000)), 2);
								$acctoutputoctets=round(($row['SUM(acctoutputoctets)'] /(1024*1000)), 2);
								$array_B[$row_hr][0]= $sql_string.'日';
								$array_B[$row_hr][1]= $acctinputoctets;
								$array_B[$row_hr][2]= $acctoutputoctets;
							}
					}
				}
					
			
			?>
			 <div id="chart_div" style="width: 100%; height: 500px;"></div>
			<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				var data = google.visualization.arrayToDataTable([
				['日期', '上傳流量(MB)', '下載流量(MB)'], 
				<?php
				for($time_A=0;$time_A < count($array_B);$time_A++)
					{
					$acctinputoctets_date = $array_B[$time_A][1];  //上傳
					$acctoutputoctets_date = $array_B[$time_A][2];  //下載
						?>
					['<?=$array_B[$time_A][0];?>',<?=$acctinputoctets_date;?>,<?=$acctoutputoctets_date;?>],	
						<?php
					
						
					}
				?>
				  
				]);

				var options = {
				  title: '<?=$realm_A_type. $tribe_name.':'.$ass_ap_name.' '    ;?>',
				  hAxis: {title: '時間區間',  titleTextStyle: {color: '#333'}},
				  vAxis: {minValue: 0}
				};

				var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			  }
			</script>
			<?php
				
			}
		
		
		
		
		
		
		
		
		
		
		
		
		//echo "Your favorite color is blue!";
        break;
    case "case_C":
          ?>
		<form action="?mode=case_C" method="POST">
		<input type="hidden" name="mode" value="<?=$mode ;?>">
		<select name="realm" size="1" onchange="this.form.submit();" > 
			<option  disabled selected>請選擇單位</option>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
		</select>
	<select name="label" onchange="this.form.submit();">
				  <option value=" " selected disabled >請選擇期別</option> 
				　<option value="2" <?php if($_POST['label']=='2'){echo 'selected';}else{};	?> >第二期</option>
				　<option value="3" <?php if($_POST['label']=='3'){echo 'selected';}else{};	?> >第三期</option>
	</select>

	<select  name="tribe" size="1"   onchange="this.form.submit();">
		<option value="" disabled selected>請選擇部落</option>
		<?php
		  $key = $_POST['label'];
			$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'";
			$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
			while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				
				?>
				<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_POST['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
				<?php
			  
			}
				
		?>
	</select>
		<select  name="ass_ap_ip" size="1"   onchange="this.form.submit();">
			<option value="" disabled selected>請選擇設備</option>
			<?php
			$key2 = $_POST['tribe'];
			$sql_ap="SELECT * FROM ass_ap WHERE ass_ap_tribe='$key2' ";
			$result_ap= execute_sql($database_name2, $sql_ap, $link2);
			while ($row_ap= mysql_fetch_assoc($result_ap)  )
			{
				$ass_ap_name =  $row_ap['ass_ap_name'];
				?>
				<option value="<?=$row_ap['ass_ap_ip'];?>"  <?php if($_POST['ass_ap_ip']==$row_ap['ass_ap_ip']){  echo 'selected';  }?> ><?=$row_ap['ass_ap_name'];?></option>
				<?php
			}					
			?>
		</select>

		
		
		
		<input type="submit" value="檢視報表">
		</form>
		<?php
			
			
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			
			$sql_name="SELECT * FROM tribe WHERE tribe_id='$tribe_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $tribe_name= $row_name['tribe_name'];
			}
			
			if(empty($realm_A))
			{
				echo '未選擇單位';
			}
		   if(empty($label_A))
			{
				echo '未選擇期別';
			}
			if(empty($tribe_A))
			{
				echo '未選擇部落';
			}
			if(empty($ass_ap_ip_A))
			{
				echo '未選擇設備';
			}else{
				
				
				
				$yesterday =date("Y/m/d", strtotime('-1 month'));
				//echo $yesterday;
				if($realm_A =='itw' )
				{
					$realm_A_type = '愛台灣  ';
					for($row_hr=0;$row_hr<30 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%'  ";
						//echo $sql ;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ($row['SUM(acctinputoctets)'] /(1000*1024));
								$acctoutputoctets=($row['SUM(acctoutputoctets)'] /(1000*1024));
								$array_C[$row_hr][0]= $sql_string.'日';
								$array_C[$row_hr][1]= $acctinputoctets;
								$array_C[$row_hr][2]= $acctoutputoctets;
							}
					}
				}else{
					$realm_A_type = '愛部落  ';
					for($row_hr=0;$row_hr<30 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= round(($row['SUM(acctinputoctets)'] /(1024*1000)), 2);
								$acctoutputoctets=round(($row['SUM(acctoutputoctets)'] /(1024*1000)), 2);
								$array_C[$row_hr][0]= $sql_string.'日';
								$array_C[$row_hr][1]= $acctinputoctets;
								$array_C[$row_hr][2]= $acctoutputoctets;
							}
					}
				}
					
			
			?>
			 <div id="chart_div" style="width: 100%; height: 500px;"></div>
			<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				var data = google.visualization.arrayToDataTable([
				['日期', '上傳流量(MB)', '下載流量(MB)'], 
				<?php
				for($time_A=0;$time_A < count($array_C);$time_A++)
					{
					$acctinputoctets_date = $array_C[$time_A][1];  //上傳
					$acctoutputoctets_date = $array_C[$time_A][2];  //下載
						?>
					['<?=$array_C[$time_A][0];?>',<?=$acctinputoctets_date;?>,<?=$acctoutputoctets_date;?>],	
						<?php
					
						
					}
				?>
				  
				]);

				var options = {
				  title: '<?=$realm_A_type. $tribe_name.':'.$ass_ap_name.' '    ;?>',
				  hAxis: {title: '時間區間',  titleTextStyle: {color: '#333'}},
				  vAxis: {minValue: 0}
				};

				var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			  }
			</script>
			<?php
				
			}
		
		
		
		
		
		
		
		
		//echo "Your favorite color is green!";
        break;
	case "case_D":
	  ?>
		<form action="?mode=case_D" method="POST">
		<input type="hidden" name="mode" value="<?=$mode ;?>">
		<select name="realm" size="1" onchange="this.form.submit();" > 
			<option  disabled selected>請選擇單位</option>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
		</select>
	<select name="label" onchange="this.form.submit();">
				  <option value=" " selected disabled >請選擇期別</option> 
				　<option value="2" <?php if($_POST['label']=='2'){echo 'selected';}else{};	?> >第二期</option>
				　<option value="3" <?php if($_POST['label']=='3'){echo 'selected';}else{};	?> >第三期</option>
	</select>

	<select  name="tribe" size="1"   onchange="this.form.submit();">
		<option value="" disabled selected>請選擇部落</option>
		<?php
		  $key = $_POST['label'];
			$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'";
			$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
			while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				$tribe_name =  $row_tribe['tribe_name'];
				?>
				<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_POST['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
				<?php
			  
			}
				
		?>
	</select>
		<select  name="ass_ap_ip" size="1"   onchange="this.form.submit();">
			<option value="" disabled selected>請選擇設備</option>
			<?php
			$key2 = $_POST['tribe'];
			$sql_ap="SELECT * FROM ass_ap WHERE ass_ap_tribe='$key2' ";
			$result_ap= execute_sql($database_name2, $sql_ap, $link2);
			while ($row_ap= mysql_fetch_assoc($result_ap)  )
			{
				$ass_ap_name =  $row_ap['ass_ap_name'];
				?>
				<option value="<?=$row_ap['ass_ap_ip'];?>"  <?php if($_POST['ass_ap_ip']==$row_ap['ass_ap_ip']){  echo 'selected';  }?> ><?=$row_ap['ass_ap_name'];?></option>
				<?php
			}					
			?>
		</select>
			開始日期<br>
			<input type="date" name="start_date" value="<?=$_POST['start_date'];?>">
			開始時間:<br>
				<input type="time" name="start_time" value="<?=$_POST['start_time'];?>">
			結束日期 <br>
			<input type="date" name="end_date" min="1911-01-01" value="<?=$_POST['end_date'];?>">
			結束時間:<br>
				<input type="time" name="end_time" value="<?=$_POST['end_time'];?>">
		 
		
		<input type="submit" value="檢視報表">
		</form>
		<?php
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			/////
			$start_date =  $_POST['start_date'];
			$start_time =  $_POST['start_time'];
			$end_date =  $_POST['end_date'];
			$end_time =  $_POST['end_time'];
			
			if(empty($realm_A))
			{
				echo '未選擇單位';
			}
		   if(empty($label_A))
			{
				echo '未選擇期別';
			}
			if(empty($tribe_A))
			{
				echo '未選擇部落';
			}
			if(empty($ass_ap_ip_A))
			{
				echo '未選擇設備';
			}else 	if(empty($start_date))
			{
				echo '未選擇開始日期';
			}else if(empty($start_time))
			{
				echo '未選擇開始時間';
			}else if(empty($end_date))
			{
				echo '未選擇結束日期';
			}else if(empty($end_time))
			{
				echo '未選擇結束時間';
			}			
			else{
				
			$datepicker1 = $start_date.' '.$start_time ;
			$datepicker2 =  $end_date.' '.$end_time ;

$datepicker_1=strtotime($datepicker1);
$datepicker_2=strtotime($datepicker2);
// echo $datepicker1;

$day_count =  $datepicker_2  -  $datepicker_1 ;	
$days_row =  round((($day_count)/3600)/24) ;
//echo  $days_row;
$yesterday = substr($datepicker1, 0, -6); 			
//echo $yesterday;		
		if($days_row >40)
        {
			echo '搜尋日期不能超過40天,目前搜尋日期區間為'.$days_row.'天';
			exit();
		}			
			
			//exit();
			
			
			//$yesterday =date("Y/m/d", strtotime('-1 month'));
				//echo $yesterday;
				if($realm_A =='itw' )
				{
					$realm_A_type = '愛台灣  ';
					for($row_hr=0;$row_hr<=$days_row  ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%'  ";
						//echo $sql ;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ($row['SUM(acctinputoctets)'] /(1000*1024));
								$acctoutputoctets=($row['SUM(acctoutputoctets)'] /(1000*1024));
								$array_C[$row_hr][0]= $sql_string.'日';
								$array_C[$row_hr][1]= $acctinputoctets;
								$array_C[$row_hr][2]= $acctoutputoctets;
							}
					}
				}else{
					$realm_A_type = '愛部落  ';
					for($row_hr=0;$row_hr<=$days_row  ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= round(($row['SUM(acctinputoctets)'] /(1024*1000)), 2);
								$acctoutputoctets=round(($row['SUM(acctoutputoctets)'] /(1024*1000)), 2);
								$array_C[$row_hr][0]= $sql_string.'日';
								$array_C[$row_hr][1]= $acctinputoctets;
								$array_C[$row_hr][2]= $acctoutputoctets;
							}
					}
				}
					
			
			?>
			 <div id="chart_div" style="width: 100%; height: 500px;"></div>
			<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				var data = google.visualization.arrayToDataTable([
				['日期', '上傳流量(MB)', '下載流量(MB)'], 
				<?php
				for($time_A=0;$time_A < count($array_C);$time_A++)
					{
					$acctinputoctets_date = $array_C[$time_A][1];  //上傳
					$acctoutputoctets_date = $array_C[$time_A][2];  //下載
						?>
					['<?=$array_C[$time_A][0];?>',<?=$acctinputoctets_date;?>,<?=$acctoutputoctets_date;?>],	
						<?php
					
						
					}
				?>
				  
				]);

				var options = {
				  title: '<?=$realm_A_type. $tribe_name.':'.$ass_ap_name.' '    ;?>',
				  hAxis: {title: '時間區間',  titleTextStyle: {color: '#333'}},
				  vAxis: {minValue: 0}
				};

				var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			  }
			</script>
			<?php
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			}
	
	
	
	
	
	
		//echo "Your favorite color is green!";
	break;
    default:
        echo "沒有功能!";
}











?>