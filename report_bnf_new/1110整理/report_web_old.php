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
	<!--google chart
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	chart-->
	<!---highcharts套件-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="../highcharts/exporting.js"></script>
	<!---highcharts套件-->
	
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

		<h1 class="report">網路流量統計</h1>

<?php
	session_start();
	require_once("dbtools.inc.php");
	$link = create_connection();
	$link2 = create_connection2();
	?>
	
		<div class="report_bar">
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
						//$tribe_name =  $row_tribe['tribe_name'];
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
						
						?>
						<option value="<?=$row_ap['ass_ap_ip'];?>"  <?php if($_POST['ass_ap_ip']==$row_ap['ass_ap_ip']){  echo 'selected';  }?> ><?=$row_ap['ass_ap_name'];?></option>
						<?php
					}					
					?>
				</select>

				
				
				
				<input type="submit" value="檢視報表">
				</form>
		
		</div>

		<div class="report">

		<?php
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			
			$sql_name="SELECT * FROM ass_ap WHERE ass_ap_ip='$ass_ap_ip_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $ass_ap_tribe= $row_name['ass_ap_tribe'];
				  $ass_ap_name= $row_name['ass_ap_name'];
			}
			//echo $sql_name; 
			//tribe_name
			$sql_name1="SELECT * FROM  tribe WHERE tribe_id='$ass_ap_tribe' ";
			$result_name1= execute_sql($database_name2, $sql_name1, $link2);
			while ($row_name1= mysql_fetch_assoc($result_name1)  )
			{
			
			      $tribe_name= $row_name1['tribe_name'];
				 
			}
			//echo $sql_name1; 
			
			
			
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
			<?php
			//echo $ass_ap_tribe;
			///echo $ass_ap_name;
			//echo $tribe_name;
			
			
			?>
		<div id="case_A" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<script type="text/javascript">
				$(function () {
					$('#case_A').highcharts({
						chart: {
							type: 'areaspline'
						},
						title: {
							text: '<?=$realm_A_type. $tribe_name .$ass_ap_name;?>'
						},
						legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 15000,
							y: 10000,
							floating: true,
							borderWidth: 1,
							backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
						},
						xAxis: {
							categories: [
							<?php
							for($time_A=0;$time_A < count($array_A);$time_A++)
							{
								echo "'".$array_A[$time_A][0]."',";
							}
							
							?>
							
								
							]
						},
						
						yAxis: {
							title: {
								text: '流量'
							}
						},
						tooltip: {
							shared: true,
							valueSuffix: ' MB'
						},
						credits: {
							enabled: false
						},
						plotOptions: {
							areaspline: {
								fillOpacity: 0.5
							}
						},
						series: [{
							name: '上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_A);$time_A++)
									{
									echo $array_A[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_A);$time_A++)
									{
									echo $array_A[$time_A][2].',';
									}
								  ?>]
						}]
					});
				});
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
				//$tribe_name =  $row_tribe['tribe_name'];
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
				//$ass_ap_name =  $row_ap['ass_ap_name'];
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
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			
			$sql_name="SELECT * FROM ass_ap WHERE ass_ap_ip='$ass_ap_ip_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $ass_ap_tribe= $row_name['ass_ap_tribe'];
				  $ass_ap_name= $row_name['ass_ap_name'];
			}
			//echo $sql_name; 
			//tribe_name
			$sql_name1="SELECT * FROM  tribe WHERE tribe_id='$ass_ap_tribe' ";
			$result_name1= execute_sql($database_name2, $sql_name1, $link2);
			while ($row_name1= mysql_fetch_assoc($result_name1)  )
			{
			
			      $tribe_name= $row_name1['tribe_name'];
				 
			}
			//echo $sql_name1; 
			
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
			<?php
			//print_r($array_B);
			
			?>
			<div id="case_B" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<script type="text/javascript">
				$(function () {
					$('#case_B').highcharts({
						chart: {
							type: 'areaspline'
						},
						title: {
								text: '<?=$realm_A_type. $tribe_name .$ass_ap_name;?>'
						},
						legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 15000,
							y: 10000,
							floating: true,
							borderWidth: 1,
							backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
						},
						xAxis: {
							categories: [
							<?php
							for($time_A=0;$time_A < count($array_B);$time_A++)
							{
								echo "'".$array_B[$time_A][0]."',";
							}
							
							?>
							
								
							]
						},
						
						yAxis: {
							title: {
								text: '流量'
							}
						},
						tooltip: {
							shared: true,
							valueSuffix: ' MB'
						},
						credits: {
							enabled: false
						},
						plotOptions: {
							areaspline: {
								fillOpacity: 0.5
							}
						},
						series: [{
							name: '上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_B);$time_A++)
									{
									echo $array_B[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_B);$time_A++)
									{
									echo $array_B[$time_A][2].',';
									}
								  ?>]
						}]
					});
				});
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
				//$ass_ap_name =  $row_ap['ass_ap_name'];
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
			
			$sql_name="SELECT * FROM ass_ap WHERE ass_ap_ip='$ass_ap_ip_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $ass_ap_tribe= $row_name['ass_ap_tribe'];
				  $ass_ap_name= $row_name['ass_ap_name'];
			}
			//echo $sql_name; 
			//tribe_name
			$sql_name1="SELECT * FROM  tribe WHERE tribe_id='$ass_ap_tribe' ";
			$result_name1= execute_sql($database_name2, $sql_name1, $link2);
			while ($row_name1= mysql_fetch_assoc($result_name1)  )
			{
			
			      $tribe_name= $row_name1['tribe_name'];
				 
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
		<div id="case_C" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<script type="text/javascript">
				$(function () {
					$('#case_C').highcharts({
						chart: {
							type: 'areaspline'
						},
						title: {
								text: '<?=$realm_A_type. $tribe_name .$ass_ap_name;?>'
						},
						legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 15000,
							y: 10000,
							floating: true,
							borderWidth: 1,
							backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
						},
						xAxis: {
							categories: [
							<?php
							for($time_A=0;$time_A < count($array_C);$time_A++)
							{
								echo "'".$array_C[$time_A][0]."',";
							}
							
							?>
							
								
							]
						},
						
						yAxis: {
							title: {
								text: '流量'
							}
						},
						tooltip: {
							shared: true,
							valueSuffix: ' MB'
						},
						credits: {
							enabled: false
						},
						plotOptions: {
							areaspline: {
								fillOpacity: 0.5
							}
						},
						series: [{
							name: '上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_C);$time_A++)
									{
									echo $array_C[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_C);$time_A++)
									{
									echo $array_C[$time_A][2].',';
									}
								  ?>]
						}]
					});
				});
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
				//$tribe_name =  $row_tribe['tribe_name'];
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
				//$ass_ap_name =  $row_ap['ass_ap_name'];
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
			
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			
			$sql_name="SELECT * FROM ass_ap WHERE ass_ap_ip='$ass_ap_ip_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $ass_ap_tribe= $row_name['ass_ap_tribe'];
				  $ass_ap_name= $row_name['ass_ap_name'];
			}
			//echo $sql_name; 
			//tribe_name
			$sql_name1="SELECT * FROM  tribe WHERE tribe_id='$ass_ap_tribe' ";
			$result_name1= execute_sql($database_name2, $sql_name1, $link2);
			while ($row_name1= mysql_fetch_assoc($result_name1)  )
			{
			
			      $tribe_name= $row_name1['tribe_name'];
				 
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
								$array_D[$row_hr][0]= $sql_string.'日';
								$array_D[$row_hr][1]= $acctinputoctets;
								$array_D[$row_hr][2]= $acctoutputoctets;
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
								$array_D[$row_hr][0]= $sql_string.'日';
								$array_D[$row_hr][1]= $acctinputoctets;
								$array_D[$row_hr][2]= $acctoutputoctets;
							}
					}
				}
					
			
			?>
		<div id="case_D" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<script type="text/javascript">
				$(function () {
					$('#case_D').highcharts({
						chart: {
							type: 'areaspline'
						},
						title: {
								text: '<?=$realm_A_type. $tribe_name .$ass_ap_name;?>'
						},
						legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 15000,
							y: 10000,
							floating: true,
							borderWidth: 1,
							backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
						},
						xAxis: {
							categories: [
							<?php
							for($time_A=0;$time_A < count($array_D);$time_A++)
							{
								echo "'".$array_D[$time_A][0]."',";
							}
							
							?>
							
								
							]
						},
						
						yAxis: {
							title: {
								text: '流量'
							}
						},
						tooltip: {
							shared: true,
							valueSuffix: ' MB'
						},
						credits: {
							enabled: false
						},
						plotOptions: {
							areaspline: {
								fillOpacity: 0.5
							}
						},
						series: [{
							name: '上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_D);$time_A++)
									{
									echo $array_D[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_D);$time_A++)
									{
									echo $array_D[$time_A][2].',';
									}
								  ?>]
						}]
					});
				});
		</script>
			<?php
			
			

			}
	
		//echo "Your favorite color is green!";
	break;
	
	
	case "case_E":
	
	//echo 'A';
	/*
	$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
	
	*/
	$ass_ap_name= $_GET['apname'];
	$tribe_name= $_GET['tribe_name'];
	$ass_ap_ip_A =  $_GET['ip'];
	$tribe_A = $_GET['ip'];
	$yesterday =date("Y/m/d", strtotime('-1 month'));
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
								$array_E[$row_hr][0]= $sql_string.'日';
								$array_E[$row_hr][1]= $acctinputoctets;
								$array_E[$row_hr][2]= $acctoutputoctets;
							}
					}
	?>
		<div id="case_E" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<script type="text/javascript">
				$(function () {
					$('#case_E').highcharts({
						chart: {
							type: 'areaspline'
						},
						title: {
								text: '<?=$realm_A_type. $tribe_name .$ass_ap_name;?>'
						},
						legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 15000,
							y: 10000,
							floating: true,
							borderWidth: 1,
							backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
						},
						xAxis: {
							categories: [
							<?php
							for($time_A=0;$time_A < count($array_E);$time_A++)
							{
								echo "'".$array_E[$time_A][0]."',";
							}
							
							?>
							
								
							]
						},
						
						yAxis: {
							title: {
								text: '流量'
							}
						},
						tooltip: {
							shared: true,
							valueSuffix: ' MB'
						},
						credits: {
							enabled: false
						},
						plotOptions: {
							areaspline: {
								fillOpacity: 0.5
							}
						},
						series: [{
							name: '上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_E);$time_A++)
									{
									echo $array_E[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_E);$time_A++)
									{
									echo $array_E[$time_A][2].',';
									}
								  ?>]
						}]
					});
				});
		</script>
			<?php
	break;
	
    default:
        echo "沒有功能!";
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
</html>