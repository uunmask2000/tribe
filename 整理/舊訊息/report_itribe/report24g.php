<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />

<!--表格-->
<link rel="stylesheet" type="text/css" href="../include/tablesort_style.css" />
<script type="text/javascript" src="../js/jquery-latest.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
<script type="text/javascript">
$(function() {
	$("table")
		.tablesorter({widthFixed: true, widgets: ['zebra']})
		.tablesorterPager({container: $("#pager")});
});
</script>
<!--匯出excel-->
<script src="./js/excellentexport.js"></script>
<!--列印-->
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

		<?php include("../include/report_nav.php"); ?>

		<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		?>

		<div class="report_bar">
			<div class="search">
			<form action="" method="post">
				<select name="zone_change" size="1" onchange="this.form.submit();"> 
					<option   value="all" <?php if($_POST['zone_change']=='all'){echo 'selected'; }?>>show_all</option>
					<?php
					$sql_zone = "SELECT zone  FROM `Client_Number_Vs_Air_Time` GROUP BY `zone` ";
					$result_zone = execute_sql($database_name, $sql_zone, $link); 
					while($row_zone = mysql_fetch_assoc($result_zone))
					{
					?>
					<option value="<?=$row_zone['zone'];?>" <?php if($_POST['zone_change']==$row_zone['zone']){echo 'selected'; }?> ><?=$row_zone['zone'];?></option>		
					<?php
					}
					?>
				</select>
			</form>
			</div>
			<div class="tool">
				<a name="b_print" class="ipt" href="#" onClick="printdiv('div_print');">
				<img src="../images/print.png" width="24">
				</a>
				<a download="execl<?=date("Ymd");?>.csv" href="#" onclick="return ExcellentExport.csv(this, 'table1');">
				<img src="../images/excel.png" width="24">
				</a>
			</div>
			<div class="c"></div>
		</div>

		<div class="report">
			<div id="div_print"><style>table td { padding:5px;} table th { padding:5px; border:#000 1px solid;}</style>
				<table class="tablesorter" id="table1">
					<thead>
						<tr><th colspan="8">iTribe_各設備2.4G服務效益總表</th></tr>
						<tr>
							<th>No.</th>
							<th>熱點名稱</th>
							<th>熱點代碼</th>
						　	<th>使用人數</th>
							<th>總分鐘數</th>
							<th>總流量數(GB)</th>
							<th>下行流量(GB)</th>
							<th>上行流量(GB)</th>
						</tr>
					</thead>
				
					<tbody>
<?php
	$zone_change = $_POST['zone_change'];

	if($zone_change==NULL)
	{
		$sql0 = "SELECT zone  FROM `Client_Number_Vs_Air_Time` GROUP BY `zone` ";
	}else if($zone_change=='all')
	{
		$sql0 = "SELECT zone  FROM `Client_Number_Vs_Air_Time` GROUP BY `zone` ";
	}
	else
	{
		$sql0 = "SELECT zone  FROM `Client_Number_Vs_Air_Time`  where zone ='$zone_change'  GROUP BY `zone` ";
	}

	//$sql0 = "SELECT zone  FROM `Client_Number_Vs_Air_Time` GROUP BY `zone` ";

	$result0 = execute_sql($database_name, $sql0, $link); 
	while($row0 = mysql_fetch_assoc($result0))
	{
		$zone = $row0['zone'];

	$sql= "SELECT zone,SUM(`of_clients`),SUM(`tx`),SUM(`rx`),SUM(`busy`) FROM Client_Number_Vs_Air_Time WHERE zone='$zone'  ";		
	$result = execute_sql($database_name, $sql, $link);
	
	while ($row = mysql_fetch_assoc($result) )
				{
					$of_clients=$row['SUM(`of_clients`)'];
					$busy= $row['SUM(`busy`)'];
					$tx = ($row['SUM(`tx`)']/1024);
					$rx = ($row['SUM(`rx`)']/1024);
					$sum_rx_tx = $tx +  $rx ;

					if(empty($of_clients)){$of_clients=0 ; }
					if(empty($busy)){$busy=0 ; }
					if(empty($tx)){$tx=0 ; }
					if(empty($rx)){$rx=0 ; }
					if(empty($sum_rx_tx)){$sum_rx_tx=0 ; }
?>
						<tr>
							<td></td>
							<td></td>
							<td><?=$zone;?></td>
							<td><?=$of_clients;?></td>
							<td><?=$busy;?></td>
							<td><?=$sum_rx_tx;?></td>
							<td><?=$rx;?></td>
							<td><?=$tx;?></td>
						</tr>
<?php		
				}
	}
?>
					</tbody>
				</table>
			</div>

			<div id="pager" class="pager" >
				<form>
					<img src="../images/first.png" height="20" width="20" class="first"/>
					<img src="../images/prev.png" height="20" width="20" class="prev"/>
					<input type="text" class="pagedisplay"  disabled />
					<img src="../images/next.png" height="20" width="20"  class="next"/>
					<img src="../images/last.png" height="20" width="20" class="last"/>
					<select class="pagesize">
						<option value="2">2</option>
						<option selected="selected"  value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option  value="40">40</option>
					</select>
				</form>
			</div>
		</div>
	</div>
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>
