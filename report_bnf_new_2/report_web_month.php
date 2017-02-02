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
	<div>
	
				<form action="" method="GET">
				<select name="label" onchange="this.form.submit();">
				<option value=" " selected disabled >請選擇期別</option> 
				<option value="2" <?php if($_GET['label']=='2'){echo 'selected';}else{};?> >第二期</option>
				<option value="3" <?php if($_GET['label']=='3'){echo 'selected';}else{};?> >第三期</option>
				</select>

				<select  name="tribe" size="1"   onchange="this.form.submit();">
				<option value="" disabled selected>請選擇部落</option>
				<?php
				$key = $_GET['label'];
				$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'  ORDER BY `tribe`.`tribe_name` ASC";
				$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
				while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
				{
					?>
				<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_GET['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
				<?php
				}
				?>
				</select>
				
				<select  name="year" size="1" onchange="this.form.submit();">
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

				<input type="submit" value="檢視報表">
				</form>
	</div>
	
	<?php
	$label = $_GET['label'];
	$year = $_GET['year'];
	$tribe = $_GET['tribe'];
	$month =  array(
						"0"=> "01",
						"1"=> "02",
						"2"=> "03",
						"3"=> "04",
						"4"=> "05",
						"5"=> "06",
						"6"=> "07",
						"7"=> "08",
						"8"=> "09",
						"9"=> "10",
						"10"=> "11",
						"11"=> "12",
					);
             $Z = 0 ;  
			foreach ($month as &$value) 
			{
				// echo $value = $value ;
				$text_time = $year.'-'.$value;
				$sql="SELECT * FROM monthly_report_itr_total WHERE Time_interval LIKE '%$text_time%' AND tribe_sid='$tribe' AND Period ='$label'  ";
				$result = execute_sql($database_name, $sql, $link);					
				while ($row= mysql_fetch_assoc($result) )
				{
					
					$array_itr[$Z][0] = $text_time ;					
					$array_itr[$Z][1] =ceil(($row['Upload_traffic'] /(1024*1000)));
					$array_itr[$Z][2] =ceil(($row['Download_traffic'] /(1024*1000)));
				}	
				
				
				$text_time = $year.'-'.$value;
				$sql="SELECT * FROM monthly_report_itw_total WHERE Time_interval LIKE '%$text_time%' AND tribe_sid='$tribe' AND Period ='$label'  ";
				$result = execute_sql($database_name, $sql, $link);		
				//echo 		$sql;
				//echo '<br>';		
				while ($row= mysql_fetch_assoc($result) )
				{
					
					$array_itw[$Z][0] = $text_time ;
					$array_itw[$Z][1] =ceil(($row['Upload_traffic'] /(1024*1000)));
					$array_itw[$Z][2] =ceil(($row['Download_traffic'] /(1024*1000)));
				}	
				
				
				
			 $Z++;
			}
	$array_D[0] = $array_itr[0]+ $array_itw[0];
	$array_D[1] = $array_itr[1]+ $array_itw[1];
	$array_D[2] = $array_itr[2]+ $array_itw[2];
	$array_D[3] = $array_itr[3]+ $array_itw[3];
	$array_D[4] = $array_itr[4]+ $array_itw[4];
	$array_D[5] = $array_itr[5]+ $array_itw[5];
	$array_D[6] = $array_itr[6]+ $array_itw[6];
	$array_D[7] = $array_itr[7]+ $array_itw[7];
	$array_D[8] = $array_itr[8]+ $array_itw[8];
	$array_D[9] = $array_itr[9]+ $array_itw[9];
	$array_D[10] = $array_itr[10]+ $array_itw[10];
	$array_D[11] = $array_itr[11]+ $array_itw[11];

if(empty($array_D))	
{
	echo 'NULL';
}
elseif(empty($year))	
{
	echo '條件未設置完畢';
}
else{

?>
	
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	
	<?php
	
}
	?>



	<script type="text/javascript">
				$(function () {
					$('#container').highcharts({
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
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>