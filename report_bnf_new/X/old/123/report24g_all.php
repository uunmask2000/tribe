<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<!--匯出excel-->
<script src="./js/excellentexport.js"></script>
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
	<?php include("../include/top.php");?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php");?>

		<?php include("../include/report_nav.php"); ?>

		<div class="report_bar">
			<div class="search">
			
			
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
				<tr>
					<th colspan="6">iTribe 2.4G 服務效益總表</th> 
				</tr>
				<tr>
					<th>月份</th>
					<th>使用人數</th>
					<th>總分鐘數</th>
					<th>總流量數(GB)</th>
					<th>下行流量(GB)</th>
					<th>上行流量(GB)</th>
				</tr>
				</thead>
				<tbody>
				<?php
				require_once("dbtools.inc.php");
					$link = create_connection();
					$moon = array('00','01','02','03','04','05','06','07','08','09','10','11','12',);
					$today_year = date("Y"); 
					for($x=1;$x<=12;$x++)
					{
						$sql= "SELECT SUM(`of_clients`),SUM(`tx`),SUM(`rx`),SUM(`busy`) FROM Client_Number_Vs_Air_Time WHERE `timestamp` LIKE '$moon[$x]/%' and `timestamp` LIKE '%$today_year%' ";
						
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
					<td><?=$today_year ;?>/<?=$moon[$x];?></td>
					<td><?=$of_clients;?></td>
					<td><?=$busy;?></td>
					<td><?=$sum_rx_tx ;?></td>
					<td><?=$rx;?></td>
					<td><?=$tx;?></td>
				</tr>
				<?php
					$a[$x] = $of_clients;
					$b[$x] = $busy;
					$c[$x] = $tx;
					$d[$x] = $rx;
					$e[$x] = $sum_rx_tx;
							}
					}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th>合計</th>
						<th> <?php echo array_sum($a) ;?></th>
						<th><?php echo array_sum($b) ;?></th>
						<th><?php echo array_sum($e) ;?></th>
						<th><?php echo array_sum($d) ;?></th>
						<th><?php echo array_sum($c) ;?></th>
					</tr>
				</tfoot>
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
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>

</body>
</html>
