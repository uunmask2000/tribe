<html>
<head>
	<meta charset="utf-8">
	<title>無線AP網管系統</title>
	<link href="../include/reset.css" rel="stylesheet" type="text/css" />
	<link href="../include/style.css" rel="stylesheet" type="text/css" />
	
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
	<!---------------------->
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
	<!-----<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>---->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="./jquery/jquery.ui.datepicker-zh-TW.js"></script>
	
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
		</div>
		
		
		
		
		<?php
		$mode = $_GET['mode'];
		switch ($mode) {
		case "case_A":
		?>
		<form action="?mode=case_A" method="POST">
			<select id="list" name="label" onchange="this.form.submit();">
<option value="NO" selected disabled="disabled">請選擇期別</option>	
<?php
///echo '1231465';
$sql_prj = "SELECT Project_name,Project_number FROM Project ";
$result_prj = execute_sql($database_name2, $sql_prj, $link2);
while ($row_prj = mysql_fetch_assoc($result_prj))
{
echo $row_prj['Project_name'] ;
?>
<option value="<?=$row_prj['Project_number'] ;?>" <?php if($_POST['label']==$row_prj['Project_number']){echo 'selected'; }?>><?=$row_prj['Project_name'] ;?></option>
<?php
}
/*
<option value="2" <?php if($_POST['label']==2){echo 'selected'; }?>>2期</option>
<option value="3" <?php if($_POST['label']==3){echo 'selected'; }?>>3期</option>	
*/

?>

					
</select>


			<select  name="tribe" size="1"   onchange="this.form.submit();">
				<option value="" disabled selected>請選擇部落</option>
				<?php
				  $key = $_POST['label'];
					$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'  ORDER BY `tribe`.`tribe_name` ASC";
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
					<?php
					/*
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
					*/			
					?>
			<select name="realm" size="1" onchange="this.form.submit();" > 
			<option  disabled selected>請選擇單位</option>
			<option value="all" <?php if($_POST['realm']=='all'){echo 'selected'; }?> ><?php  echo  '全部'; echo '</option>';	?>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
		</select>
			<input type="hidden" name="mode" value="<?=$mode ;?>">			
				
				
				<input type="submit" value="檢視報表">
				</form>
		
		

		<div class="report">

		<?php
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			
			
			
			$sql_ap="SELECT *,GROUP_CONCAT(ass_ap_ip)  FROM `ass_ap` WHERE ass_ap_tribe='$tribe_A' ";
			$result_ap= execute_sql($database_name2, $sql_ap, $link2);
			while ($row_ap= mysql_fetch_assoc($result_ap)  )
			{
				$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
				$string2 = $ass_ap_ip;
				$ass_ap_ip_A = str_replace (",","','",$ass_ap_ip);
				
			}
			
			///
			
			
			///
			
			
			///$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			/*
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
			*/
			
			
		   if(empty($label_A))
			{
				echo '未選擇期別'; 
				$msger = 1;
			}
			if(empty($tribe_A))
			{
				echo '未選擇部落'; 
				$msger = 1;
			}
			/*
			if(empty($ass_ap_ip_A)) 
			{
				echo '未選擇設備'; 
				$msger = 1;
			}
			*/
			if(empty($realm_A))
			{
				echo '未選擇單位';
				//exit();
				$msger = 1;
			}
			
			if($msger == 1)
			{
				
			}else{
				$yest =date("Y-m-d", strtotime('-2 day'));
				$sql_do="SELECT MAX(radacctid) FROM `radacct` WHERE `acctstarttime` LIKE '%$yest%'";
				$result_do = execute_sql($database_name, $sql_do, $link);
				while ($row_do= mysql_fetch_assoc($result_do) )
					{
						$MAXid = $row_do['MAX(radacctid)']  ;
					}
				//echo $MAXid;
				
				//exit();
			
			  //
			if($realm_A=="all")
			{
				//echo 'A1';
				$yesterday =date("Y/m/d", strtotime('-1 day'));
						$realm_A_type = '愛部落  ';
						for($row_hr=0;$row_hr<24 ;$row_hr++)
						{
							$sql_string = date("Y-m-d H", strtotime("$yesterday +$row_hr hours" ) );
							$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%' and radacctid > '$MAXid'  ";
							//echo $sql;
							$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
							//echo $sql;
							//echo '<br>';
							//echo $row['acctstarttime'];
							//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
							$array_A1[$row_hr][0]= $sql_string.'時';
							$array_A1[$row_hr][1]= $acctinputoctets;
							$array_A1[$row_hr][2]= $acctoutputoctets;
							}
						}
						//
						$realm_A_type = '愛台灣  ';
						for($row_hr=0;$row_hr<24 ;$row_hr++)
						{
						$sql_string = date("Y-m-d H", strtotime("$yesterday +$row_hr hours" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%' and radacctid > '$MAXid'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
						while ($row= mysql_fetch_assoc($result) )
						{	
						//echo $sql;
						//echo '<br>';
						//echo $row['acctstarttime'];
						//echo '<br>';
							$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
						$array_A2[$row_hr][0]= $sql_string.'時';
						$array_A2[$row_hr][1]= $acctinputoctets;
						$array_A2[$row_hr][2]= $acctoutputoctets;
						}
						}

						?>
						<div id="case_A" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						<script type="text/javascript">
						$(function () {
						$('#case_A').highcharts({
						chart: {
						type: 'areaspline'
						},
						title: {
						text: '<?=$tribe_name .$ass_ap_name;?>'
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
						for($time_A=0;$time_A < count($array_A1);$time_A++)
						{
						echo "'".$array_A1[$time_A][0]."',";
						}

						?>


						]
						},

						yAxis: {
								title: {
								text: '流量(MB)'
								}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
						name: '愛部落上傳',
						data: [
						<?php
						for($time_A=0;$time_A < count($array_A1);$time_A++)
						{
						echo $array_A1[$time_A][1].',';
						}
						?>

						]
						}, {
						name: '愛部落下載',
						data: [<?php
						for($time_A=0;$time_A < count($array_A1);$time_A++)
						{
						echo $array_A1[$time_A][2].',';
						}
						?>]
						}, {
						name: '愛台灣上傳',
						data: [<?php
						for($time_A=0;$time_A < count($array_A2);$time_A++)
						{
						echo $array_A2[$time_A][1].',';
						}
						?>]
						}, {
						name: '愛台灣下載',
						data: [<?php
						for($time_A=0;$time_A < count($array_A2);$time_A++)
						{
						echo $array_A2[$time_A][2].',';
						}
						?>]
						}
						
						]
						});
						});
						</script>
			<?php	
				//exit();
			}else{
				//echo 'A2';
				//exit();
				//echo $ass_ap_ip_A;
				$yesterday =date("Y/m/d", strtotime('-1 day'));
				if($realm_A =='itw' )
				{
					$realm_A_type = '愛台灣  ';
					for($row_hr=0;$row_hr<24 ;$row_hr++)
					{
						$sql_string = date("Y-m-d H", strtotime("$yesterday +$row_hr hours" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%' and radacctid > '$MAXid' ";
						//echo  $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
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
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%' and radacctid > '$MAXid' ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
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
						text: '流量(MB)'
						}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
						name: '<?=$realm_A_type;?>上傳',
						data: [
						<?php
						for($time_A=0;$time_A < count($array_A);$time_A++)
						{
						echo $array_A[$time_A][1].',';
						}
						?>

						]
						}, {
						name: '<?=$realm_A_type;?>下載',
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
	
<select id="list" name="label" onchange="this.form.submit();">
<option value="NO" selected disabled="disabled">請選擇期別</option>	
<?php
///echo '1231465';
$sql_prj = "SELECT Project_name,Project_number FROM Project ";
$result_prj = execute_sql($database_name2, $sql_prj, $link2);
while ($row_prj = mysql_fetch_assoc($result_prj))
{
echo $row_prj['Project_name'] ;
?>
<option value="<?=$row_prj['Project_number'] ;?>" <?php if($_POST['label']==$row_prj['Project_number']){echo 'selected'; }?>><?=$row_prj['Project_name'] ;?></option>
<?php
}
/*
<option value="2" <?php if($_POST['label']==2){echo 'selected'; }?>>2期</option>
<option value="3" <?php if($_POST['label']==3){echo 'selected'; }?>>3期</option>	
*/

?>

					
</select>


	<select  name="tribe" size="1"   onchange="this.form.submit();">
		<option value="" disabled selected>請選擇部落</option>
		<?php
		  $key = $_POST['label'];
			$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'  ORDER BY `tribe`.`tribe_name` ASC";
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
	<?php
		/*


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

		*/	
	?>
		
	  <select name="realm" size="1" onchange="this.form.submit();" > 
			<option  disabled selected>請選擇單位</option>
			<option value="all" <?php if($_POST['realm']=='all'){echo 'selected'; }?> ><?php  echo  '全部'; echo '</option>';	?>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
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
			/*
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			
			$sql_name="SELECT * FROM ass_ap WHERE ass_ap_ip='$ass_ap_ip_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $ass_ap_tribe= $row_name['ass_ap_tribe'];
				  $ass_ap_name= $row_name['ass_ap_name'];
			}
			*/
			$sql_ap="SELECT *,GROUP_CONCAT(ass_ap_ip)  FROM `ass_ap` WHERE ass_ap_tribe='$tribe_A' ";
			$result_ap= execute_sql($database_name2, $sql_ap, $link2);
			while ($row_ap= mysql_fetch_assoc($result_ap)  )
			{
			$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
			$string2 = $ass_ap_ip;
			$ass_ap_ip_A = str_replace (",","','",$ass_ap_ip);

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
			
			
		   if(empty($label_A))
			{
				echo '未選擇期別';
				$msger = 1;
			}
			if(empty($tribe_A))
			{
				echo '未選擇部落';
				$msger = 1;
			}
			if(empty($ass_ap_ip_A))
			{
				//echo '未選擇設備'; 
				//$msger = 1;
			}
			if(empty($realm_A))
			{
				echo '未選擇單位'; 
				$msger = 1;
			}
			
			
			if($msger ==1)
			{
				
			}else{
						$yest =date("Y-m-d", strtotime('-14 day'));
						$sql_do="SELECT MAX(radacctid) FROM `radacct` WHERE `acctstarttime` LIKE '%$yest%'";
						$result_do = execute_sql($database_name, $sql_do, $link);
						while ($row_do= mysql_fetch_assoc($result_do) )
						{
						$MAXid = $row_do['MAX(radacctid)']  ;
						}
		
			if($realm_A =="all")
			{
				//echo 'A1';
				$yesterday =date("Y/m/d", strtotime('-7 day'));
						for($row_hr=0;$row_hr<7 ;$row_hr++)
						{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%' and radacctid > '$MAXid' ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
						while ($row= mysql_fetch_assoc($result) )
						{	
							//echo $sql;
							//echo '<br>';
							//echo $row['acctstarttime'];
							//echo '<br>';
							$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
							$array_B1[$row_hr][0]= $sql_string.'日';
							$array_B1[$row_hr][1]= $acctinputoctets;
							$array_B1[$row_hr][2]= $acctoutputoctets;
						}
						}
						
						for($row_hr=0;$row_hr<7 ;$row_hr++)
						{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%' and radacctid > '$MAXid'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
						while ($row= mysql_fetch_assoc($result) )
						{	
							//echo $sql;
							//echo '<br>';
							//echo $row['acctstarttime'];
							//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
							$array_B2[$row_hr][0]= $sql_string.'日';
							$array_B2[$row_hr][1]= $acctinputoctets;
							$array_B2[$row_hr][2]= $acctoutputoctets;
						}
						}
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
							for($time_A=0;$time_A < count($array_B1);$time_A++)
							{
								echo "'".$array_B1[$time_A][0]."',";
							}
							
							?>
							
								
							]
						},
						
						yAxis: {
							title: {
								text: '流量(MB)'
							}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
						series: [
						{
							name: '愛部落上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_B1);$time_A++)
									{
									echo $array_B1[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '愛部落下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_B1);$time_A++)
									{
									echo $array_B1[$time_A][2].',';
									}
								  ?>]
						},
						{
							name: '愛台灣上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_B2);$time_A++)
									{
									echo $array_B2[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '愛台灣下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_B2);$time_A++)
									{
									echo $array_B2[$time_A][2].',';
									}
								  ?>]
						},
						]
						
					});
				});
		</script>
				
				
				
				
				
				
				
				
				
				<?php
				
				
				//exit();
			}else{
				//echo 'A2';
				//exit();
				
				$yesterday =date("Y/m/d", strtotime('-7 day'));
				//echo $yesterday;
				if($realm_A =='itw' )
				{
					$realm_A_type = '愛台灣  ';
					for($row_hr=0;$row_hr<7 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%' and radacctid > '$MAXid' ";
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
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
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%' and radacctid > '$MAXid'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
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
								text: '流量(MB)'
							}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
							name: '<?=$realm_A_type ;?>上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_B);$time_A++)
									{
									echo $array_B[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '<?=$realm_A_type ;?>下載',
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
		
		}
		
		
		
		
		
		
		
		
		
		
		//echo "Your favorite color is blue!";
        break;
    case "case_C":
          ?>
		<form action="?mode=case_C" method="POST">
		<input type="hidden" name="mode" value="<?=$mode ;?>">
		
<select id="list" name="label" onchange="this.form.submit();">
<option value="NO" selected disabled="disabled">請選擇期別</option>	
<?php
///echo '1231465';
$sql_prj = "SELECT Project_name,Project_number FROM Project ";
$result_prj = execute_sql($database_name2, $sql_prj, $link2);
while ($row_prj = mysql_fetch_assoc($result_prj))
{
echo $row_prj['Project_name'] ;
?>
<option value="<?=$row_prj['Project_number'] ;?>" <?php if($_POST['label']==$row_prj['Project_number']){echo 'selected'; }?>><?=$row_prj['Project_name'] ;?></option>
<?php
}
/*
<option value="2" <?php if($_POST['label']==2){echo 'selected'; }?>>2期</option>
<option value="3" <?php if($_POST['label']==3){echo 'selected'; }?>>3期</option>	
*/

?>

					
</select>


	<select  name="tribe" size="1"   onchange="this.form.submit();">
		<option value="" disabled selected>請選擇部落</option>
		<?php
		  $key = $_POST['label'];
			$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'  ORDER BY `tribe`.`tribe_name` ASC";
			$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
			while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				
				?>
				<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_POST['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
				<?php
			  
			}
				
		?>
	</select>
		<?php
		/*
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
		*/
		?>
		<select name="realm" size="1" onchange="this.form.submit();" > 
			<option  disabled selected>請選擇單位</option>
			<option value="all" <?php if($_POST['realm']=='all'){echo 'selected'; }?> ><?php  echo  '全部'; echo '</option>';	?>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
		</select>
		
		
		<input type="submit" value="檢視報表">
		</form>
		<?php
			
			
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			/*
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			
			$sql_name="SELECT * FROM ass_ap WHERE ass_ap_ip='$ass_ap_ip_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $ass_ap_tribe= $row_name['ass_ap_tribe'];
				  $ass_ap_name= $row_name['ass_ap_name'];
			}
			*/
			$sql_ap="SELECT *,GROUP_CONCAT(ass_ap_ip)  FROM `ass_ap` WHERE ass_ap_tribe='$tribe_A' ";
			$result_ap= execute_sql($database_name2, $sql_ap, $link2);
			while ($row_ap= mysql_fetch_assoc($result_ap)  )
			{
			$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
			$string2 = $ass_ap_ip;
			$ass_ap_ip_A = str_replace (",","','",$ass_ap_ip);

			}


			
			//echo $sql_name; 
			//tribe_name
			$sql_name1="SELECT * FROM  tribe WHERE tribe_id='$ass_ap_tribe' ";
			$result_name1= execute_sql($database_name2, $sql_name1, $link2);
			while ($row_name1= mysql_fetch_assoc($result_name1)  )
			{
			
			      $tribe_name= $row_name1['tribe_name'];
				 
			}
			
			
		   if(empty($label_A))
			{
				echo '未選擇期別';
				$msger = 1;
			}
			if(empty($tribe_A))
			{
				echo '未選擇部落';
				$msger = 1;
			}
			if(empty($ass_ap_ip_A))
			{
				//echo '未選擇設備';
				//$msger = 1;
			}
			if(empty($realm_A))
			{
				echo '未選擇單位';  
				$msger = 1;
			}
			
			if($msger ==1)
			{
				
			}else{


			
			if($realm_A =="all")
			{
				
				$yesterday =date("Y/m/d", strtotime('-1 month'));	
						$yd =date("Y-m", strtotime('-1 month'));					
						$sql_Mm="SELECT MAX(radacctid),MIN(radacctid) FROM radacct  where  realm<>'itw'  and acctstarttime like '%$yd%' ";
						//echo $sql_Mm;
						$result_Mm = execute_sql($database_name, $sql_Mm, $link);					
						while ($row_Mm= mysql_fetch_assoc($result_Mm) )
						{
						//$MAX_ID = $row_Mm['MAX(radacctid)'];
						$MIX_ID = $row_Mm['MIN(radacctid)'];
						//and radacctid >='$MIX_ID' and radacctid <='$MAX_ID'
						}	

						//exit();
				
				for($row_hr=0;$row_hr<30 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%' and radacctid >='$MIX_ID'   ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
									$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
								$array_C1[$row_hr][0]= $sql_string.'日';
								$array_C1[$row_hr][1]= round($acctinputoctets);
								$array_C1[$row_hr][2]= round($acctoutputoctets);
							}
					}	

				for($row_hr=0;$row_hr<30 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%' and radacctid >='$MIX_ID'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
							$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
								$array_C2[$row_hr][0]= $sql_string.'日';
								$array_C2[$row_hr][1]= round($acctinputoctets);
								$array_C2[$row_hr][2]= round($acctoutputoctets);
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
							for($time_A=0;$time_A < count($array_C1);$time_A++)
							{
								echo "'".$array_C1[$time_A][0]."',";
							}
							
							?>
							
								
							]
						},
						
						yAxis: {
							title: {
								text: '流量(MB)'
							}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
						series: [
						{
							name: '愛部落上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_C1);$time_A++)
									{
									echo $array_C1[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '愛部落下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_C1);$time_A++)
									{
									echo $array_C1[$time_A][2].',';
									}
								  ?>]
						},{
							name: '愛台灣上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_C2);$time_A++)
									{
									echo $array_C2[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '愛台灣下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_C2);$time_A++)
									{
									echo $array_C2[$time_A][2].',';
									}
								  ?>]
						}
						
						]
					});
				});
		</script>
			 <?php				
			
			}
			else{
				
				
				
				$yesterday =date("Y/m/d", strtotime('-1 month'));
				//echo $yesterday;
					$yd =date("Y-m", strtotime('-1 month'));					
					$sql_Mm="SELECT MAX(radacctid),MIN(radacctid) FROM radacct  where  realm<>'itw'  and acctstarttime like '%$yd%' ";
					//echo $sql_Mm;
					$result_Mm = execute_sql($database_name, $sql_Mm, $link);					
					while ($row_Mm= mysql_fetch_assoc($result_Mm) )
					{
					//$MAX_ID = $row_Mm['MAX(radacctid)'];
					$MIX_ID = $row_Mm['MIN(radacctid)'];
					//and radacctid >='$MIX_ID' and radacctid <='$MAX_ID'
					}	
				if($realm_A =='itw' )
				{
					$realm_A_type = '愛台灣  ';
					for($row_hr=0;$row_hr<30 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%' and radacctid >='$MIX_ID'   ";
						//echo $sql ;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
								$array_C[$row_hr][0]= $sql_string.'日';
								$array_C[$row_hr][1]= round($acctinputoctets);
								$array_C[$row_hr][2]= round($acctoutputoctets);
							}
					}
				}else{
					$realm_A_type = '愛部落  ';
					for($row_hr=0;$row_hr<30 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%' and radacctid >='$MIX_ID'   ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
								$array_C[$row_hr][0]= $sql_string.'日';
								$array_C[$row_hr][1]= round($acctinputoctets);
								$array_C[$row_hr][2]= round($acctoutputoctets);
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
								text: '流量(MB)'
							}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
							name: '<?=$realm_A_type;?>上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_C);$time_A++)
									{
									echo $array_C[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '<?=$realm_A_type;?>下載',
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
		
		}
		
		
		
		
		
		
		//echo "Your favorite color is green!";
        break;
	case "case_D":
	 ?>
		<form action="?mode=case_D" method="POST">
		<input type="hidden" name="mode" value="<?=$mode ;?>">
		
<select id="list" name="label" onchange="this.form.submit();">
<option value="NO" selected disabled="disabled">請選擇期別</option>	
<?php
///echo '1231465';
$sql_prj = "SELECT Project_name,Project_number FROM Project ";
$result_prj = execute_sql($database_name2, $sql_prj, $link2);
while ($row_prj = mysql_fetch_assoc($result_prj))
{
echo $row_prj['Project_name'] ;
?>
<option value="<?=$row_prj['Project_number'] ;?>" <?php if($_POST['label']==$row_prj['Project_number']){echo 'selected'; }?>><?=$row_prj['Project_name'] ;?></option>
<?php
}
/*
<option value="2" <?php if($_POST['label']==2){echo 'selected'; }?>>2期</option>
<option value="3" <?php if($_POST['label']==3){echo 'selected'; }?>>3期</option>	
*/

?>

					
</select>


	<select  name="tribe" size="1"   onchange="this.form.submit();">
		<option value="" disabled selected>請選擇部落</option>
		<?php
		  $key = $_POST['label'];
			$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'  ORDER BY `tribe`.`tribe_name` ASC";
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
	<?php
	/*
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
		
		<br>
		開始日期<br>
		<input type="date" name="start_date" value="<?=$_POST['start_date'];?>">

		結束日期 <br>
		<input type="date" name="end_date" min="1911-01-01" value="<?=$_POST['end_date'];?>">

		<br>
		
		*/
		?>
		
				
				<input id="start_date" type="text"  name="start_date" value="<?=$_POST['start_date'];?>" placeholder="開始日期"/>
				<input id="end_date" type="text"  name="end_date" value="<?=$_POST['end_date'];?>" placeholder="結束日期"/>
				<script language="JavaScript"> 
				$('#start_date').datepicker({
				dateFormat: 'yy-mm-dd'
				});
				$('#end_date').datepicker({
				dateFormat: 'yy-mm-dd'
				});
				</script>
					
					
		 <select name="realm" size="1" onchange="this.form.submit();" > 
			<option  disabled selected>請選擇單位</option>
			<option value="all" <?php if($_POST['realm']=='all'){echo 'selected'; }?> ><?php  echo  '全部'; echo '</option>';	?>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
		</select>
		
		<input type="submit" value="檢視報表">
		</form>
		<?php
			
			$realm_A = $_POST['realm'];
			$label_A =  $_POST['label'];
			$tribe_A =  $_POST['tribe'];
			//$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			/////
			$start_date =  $_POST['start_date'];
			$start_time =  $_POST['start_time'];
			$end_date =  $_POST['end_date'];
			$end_time =  $_POST['end_time'];
			
			/*
			$ass_ap_ip_A =  $_POST['ass_ap_ip'];
			$sql_name="SELECT * FROM ass_ap WHERE ass_ap_ip='$ass_ap_ip_A' ";
			$result_name= execute_sql($database_name2, $sql_name, $link2);
			while ($row_name= mysql_fetch_assoc($result_name)  )
			{
			
			      $ass_ap_tribe= $row_name['ass_ap_tribe'];
				  $ass_ap_name= $row_name['ass_ap_name'];
			}
			*/
			$sql_ap="SELECT *,GROUP_CONCAT(ass_ap_ip)  FROM `ass_ap` WHERE ass_ap_tribe='$tribe_A' ";
			$result_ap= execute_sql($database_name2, $sql_ap, $link2);
			while ($row_ap= mysql_fetch_assoc($result_ap)  )
			{
			$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
			$string2 = $ass_ap_ip;
			$ass_ap_ip_A = str_replace (",","','",$ass_ap_ip);

			}


			
			//echo $sql_name; 
			//tribe_name
			/*
			$sql_name1="SELECT * FROM  tribe WHERE tribe_id='$tribe_A' ";
			$result_name1= execute_sql($database_name2, $sql_name1, $link2);
			while ($row_name1= mysql_fetch_assoc($result_name1)  )
			{
			
			      $tribe_name= $row_name1['tribe_name'];
				 
			}
			echo $sql_name1;
			*/
			
			
		   if(empty($label_A))
			{
				echo '未選擇期別';
				$msger = 1;
				//exit();
			}
			if(empty($tribe_A))
			{
				echo '未選擇部落';
				$msger = 1;
				//exit();
			}
			if(empty($ass_ap_ip_A))
			{
				//echo '未選擇設備';
				//$msger = 1;
				//exit();
			}else 	if(empty($start_date))
			{
				echo '未選擇開始日期';
				$msger = 1;
				//exit();
			}else if(empty($end_date))
			{
				echo '未選擇結束日期';
				$msger = 1;
				//exit();
			}
			
			if(empty($realm_A))
			{
				echo '未選擇單位';
				$msger = 1;
				//exit();
			}
			
		if($msger ==1)
		{
			
		}else{	
			if($realm_A =='all')
			{
				//echo 'A1';
						//$datepicker1 = $start_date.' '.$start_time ;
						//$datepicker2 =  $end_date.' '.$end_time ;
						$datepicker1 = $start_date;
						$datepicker2 =  $end_date;
						$datepicker_1=strtotime($datepicker1);
						$datepicker_2=strtotime($datepicker2);
						
						$yd =date("Y-m", strtotime("$datepicker1"));
						$sql_Mm="SELECT MAX(radacctid),MIN(radacctid) FROM radacct  where  realm<>'itw'  and acctstarttime like '%$yd%' ";
						$result_Mm = execute_sql($database_name, $sql_Mm, $link);					
						while ($row_Mm= mysql_fetch_assoc($result_Mm) )
						{
						// $MAX_ID = $row_Mm['MAX(radacctid)'];
						 $MIX_ID = $row_Mm['MIN(radacctid)'];
						 //and radacctid >='$MIX_ID' and radacctid <='$MAX_ID'
						}								
						

						//exit();
						$day_count =  $datepicker_2  -  $datepicker_1 ;	
						$days_row =  round((($day_count)/3600)/24) ;
						
						///$yesterday = substr($datepicker1, 0, -6); 			
						//echo $yesterday;		
						if($days_row >40)
						{
						echo '搜尋日期不能超過40天,目前搜尋日期區間為'.$days_row.'天';
						exit();
						}			
							
							for($row_hr=0;$row_hr<=$days_row  ;$row_hr++)
							{
							$sql_string = date("Y-m-d", strtotime("$datepicker1 +$row_hr days" ) );
							$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%' and radacctid >='$MIX_ID'";
							//echo $sql;
							$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
							//echo $sql;
							//echo '<br>';
							//echo $row['acctstarttime'];
							//echo '<br>';
					$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
					$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
							$array_D1[$row_hr][0]= $sql_string.'日';
							$array_D1[$row_hr][1]= $acctinputoctets;
							$array_D1[$row_hr][2]= $acctoutputoctets;
							}
							}
							
							for($row_hr=0;$row_hr<=$days_row  ;$row_hr++)
							{
							$sql_string = date("Y-m-d", strtotime("$datepicker1 +$row_hr days" ) );
							$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%' and radacctid >='$MIX_ID' ";
							//echo $sql;
							$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
							//echo $sql;
							//echo '<br>';
							//echo $row['acctstarttime'];
							//echo '<br>';
								$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
								$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
							$array_D2[$row_hr][0]= $sql_string.'日';
							$array_D2[$row_hr][1]= $acctinputoctets;
							$array_D2[$row_hr][2]= $acctoutputoctets;
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
							for($time_A=0;$time_A < count($array_D1);$time_A++)
							{
								echo "'".$array_D1[$time_A][0]."',";
							}
							
							?>
							
								
							]
						},
						
						yAxis: {
							title: {
								text: '流量(MB)'
							}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
							name: '愛部落上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_D1);$time_A++)
									{
									echo $array_D1[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '愛部落下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_D1);$time_A++)
									{
									echo $array_D1[$time_A][2].',';
									}
								  ?>]
						},{
							name: '愛台灣上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_D2);$time_A++)
									{
									echo $array_D2[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '愛台灣下載',
							data: [<?php
								  for($time_A=0;$time_A < count($array_D2);$time_A++)
									{
									echo $array_D2[$time_A][2].',';
									}
								  ?>]
						}]
					});
				});
		</script>
		<?php
				
				
				
				exit();
			}else{
				
			//$datepicker1 = $start_date.' '.$start_time ;
			//$datepicker2 =  $end_date.' '.$end_time ;
	$datepicker1 = $start_date;
					$datepicker2 =  $end_date;
					$datepicker_1=strtotime($datepicker1);
					$datepicker_2=strtotime($datepicker2);
			// echo $datepicker1;

			$day_count =  $datepicker_2  -  $datepicker_1 ;	
			$days_row =  round((($day_count)/3600)/24) ;
			//echo  $days_row;
			//$yesterday = substr($datepicker1, 0, -6); 			
						
			if($days_row >40)
			{
			echo '搜尋日期不能超過40天,目前搜尋日期區間為'.$days_row.'天';
			exit();
			}			
			
			//exit();
						$yd =date("Y-m", strtotime("$datepicker1"));
						$sql_Mm="SELECT MAX(radacctid),MIN(radacctid) FROM radacct  where  realm<>'itw'  and acctstarttime like '%$yd%' ";
						$result_Mm = execute_sql($database_name, $sql_Mm, $link);					
						while ($row_Mm= mysql_fetch_assoc($result_Mm) )
						{
						//$MAX_ID = $row_Mm['MAX(radacctid)'];
						$MIX_ID = $row_Mm['MIN(radacctid)'];
						//and radacctid >='$MIX_ID' and radacctid <='$MAX_ID'
						}	
			
			//$yesterday =date("Y/m/d", strtotime('-1 month'));
				//echo $yesterday;
				if($realm_A =='itw' )
				{
					$realm_A_type = '愛台灣  ';
					for($row_hr=0;$row_hr<=$days_row  ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$datepicker1 +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm='itw' and acctstarttime like '%$sql_string%' and radacctid >='$MIX_ID'  ";
						//echo $sql ;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
							$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
								$array_D[$row_hr][0]= $sql_string.'日';
								$array_D[$row_hr][1]= $acctinputoctets;
								$array_D[$row_hr][2]= $acctoutputoctets;
							}
					}
				}else{
					$realm_A_type = '愛部落  ';
					for($row_hr=0;$row_hr<=$days_row  ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$datepicker1 +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and realm<>'itw' and acctstarttime like '%$sql_string%' and radacctid >='$MIX_ID' ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
							while ($row= mysql_fetch_assoc($result) )
							{	
								//echo $sql;
								//echo '<br>';
								//echo $row['acctstarttime'];
								//echo '<br>';
							$acctinputoctets= ceil(($row['SUM(acctinputoctets)'] /(1024*1000)));
$acctoutputoctets=ceil(($row['SUM(acctoutputoctets)'] /(1024*1000)));
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
								text: '流量(MB)'
							}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
							name: '<?=$realm_A_type;?>上傳',
							data: [
							      <?php
								  for($time_A=0;$time_A < count($array_D);$time_A++)
									{
									echo $array_D[$time_A][1].',';
									}
								  ?>
							
							]
						}, {
							name: '<?=$realm_A_type;?>下載',
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
	$tribe_name = $_GET['tribe_name']; 
	$realm= $_GET['realm'];
	if($realm=='愛台灣')
	{
		$string =  "realm='itw'";
	}else if($realm=='愛部落')
	{
		$string =  "realm<>'itw'";
	}else{
		$string1 = 0;
	}
	
	//$ass_ap_name= $_GET['apname'];
	//$tribe_name= $_GET['tribe_name'];
	//$ass_ap_ip_A =  $_GET['ip'];
	if($string1 == '0')
	{
		//echo 'A1';
					$tribe_A = $_GET['tribe_sid'];
					$sql_ap="SELECT *,GROUP_CONCAT(ass_ap_ip)  FROM `ass_ap` WHERE ass_ap_tribe='$tribe_A' ";
					$result_ap= execute_sql($database_name2, $sql_ap, $link2);
					while ($row_ap= mysql_fetch_assoc($result_ap)  )
					{
						$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
						$string2 = $ass_ap_ip;
						$ass_ap_ip_A = str_replace (",","','",$ass_ap_ip);

					}	
					$yesterday =date("Y/m/d", strtotime('-1 month'));
					$realm_A_type = $realm;
					for($row_hr=0;$row_hr<30 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A')  and acctstarttime like '%$sql_string%'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
						while ($row= mysql_fetch_assoc($result) )
						{	
						//echo $sql;
						//echo '<br>';
						//echo $row['acctstarttime'];
						//echo '<br>';
						$acctinputoctets= round(($row['SUM(acctinputoctets)'] /(1024*1000)));
						$acctoutputoctets=round(($row['SUM(acctoutputoctets)'] /(1024*1000)));
						$array_E[$row_hr][0]= $sql_string.'日';
						$array_E[$row_hr][1]= $acctinputoctets;
						$array_E[$row_hr][2]= $acctoutputoctets;
						}

					}

		
	}else{
		//echo 'A2';
	
					$tribe_A = $_GET['tribe_sid'];
					$sql_ap="SELECT *,GROUP_CONCAT(ass_ap_ip)  FROM `ass_ap` WHERE ass_ap_tribe='$tribe_A' ";
					$result_ap= execute_sql($database_name2, $sql_ap, $link2);
					while ($row_ap= mysql_fetch_assoc($result_ap)  )
					{
						$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
						$string2 = $ass_ap_ip;
						$ass_ap_ip_A = str_replace (",","','",$ass_ap_ip);

					}	
					$yesterday =date("Y/m/d", strtotime('-1 month'));
					$realm_A_type = $realm;
					for($row_hr=0;$row_hr<30 ;$row_hr++)
					{
						$sql_string = date("Y-m-d", strtotime("$yesterday +$row_hr days" ) );
						$sql="SELECT *,SUM(acctinputoctets),SUM(acctoutputoctets) FROM `radacct` WHERE  `nasipaddress` IN ('$ass_ap_ip_A') and $string and acctstarttime like '%$sql_string%'  ";
						//echo $sql;
						$result = execute_sql($database_name, $sql, $link);					
						while ($row= mysql_fetch_assoc($result) )
						{	
						//echo $sql;
						//echo '<br>';
						//echo $row['acctstarttime'];
						//echo '<br>';
						$acctinputoctets= round(($row['SUM(acctinputoctets)'] /(1024*1000)));
						$acctoutputoctets=round(($row['SUM(acctoutputoctets)'] /(1024*1000)));
						$array_E[$row_hr][0]= $sql_string.'日';
						$array_E[$row_hr][1]= $acctinputoctets;
						$array_E[$row_hr][2]= $acctoutputoctets;
						}

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
								text: '<?=$tribe_name ;?>'
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
								text: '流量(MB)'
							}, 
								labels:{
									formatter:function()
									{
										if(this.value!=0) 
										{
											return ""+this.value+"";
										}	
											/*
											if(this.value <=100) { 
											return "第一等级("+this.value+")";
											}else if(this.value >100 && this.value <=200) { 
											return "第二等级("+this.value+")"; 
											}else { 
											return "第三等级("+this.value+")";
											}
											*/
									}									
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
        //echo "沒有功能!";
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