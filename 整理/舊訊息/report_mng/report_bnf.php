<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
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

		<div id="alert">
		<?php include("../alert/alert2.php");?>
		</div>

		<?php include("../include/report_nav.php"); ?>

		<div class="report_bar">
			<a class="print" href="?" ><img src="../images/print.png" width="24"></a>
			<a class="excel" href="?" ><img src="../images/excel.png" width="24"></a>

			<div class="search">
				查詢部落：
				<select id="list" name="city" onchange="this.form.submit();">
						<option value="" selected="" disabled="disabled">縣市</option>
					<option value="1">-</option>
				</select>

				<select id="list" name="town" onchange="this.form.submit();">
					<option value="" selected="" disabled="disabled">地區</option>
					<option value="1">-</option>
				</select>
				
				<select id="list" name="town" onchange="this.form.submit();">
					<option value="" selected="" disabled="disabled">部落</option>
					<option value="1">-</option>
				</select>
				
				<select id="list" name="town" onchange="this.form.submit();">
					<option value="" selected="" disabled="disabled">-</option>
					<option value="" selected="" >I Tribe</option>
					<option value="" selected="" >I Taiwan</option>
				</select>　
				查詢年份：
				<select id="list" name="city" onchange="this.form.submit();">
					<option value="" selected="">2016</option>
					<option value="1">-</option>
				</select> 
				月份：
				<select id="list" name="city" onchange="this.form.submit();">
					<option value="" selected="">1</option>
					<option value="1">-</option>
				</select>

				<input class="btn_search" type="button" value="檢視報表" />
			</div>
			<div class="c"></div>
		</div>
		<div class="report">
			<table cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr><th colspan="9">服務效益統計表</th></tr>
				</thead>

				<tbody>
					<tr>
						<th>縣市</th>
						<th>部落</th>
						<th>熱點數量</th>
						<th>使用人次</th>
						<th>使用人數</th>
						<th>總分鐘數</th>
						<th>總流量(GB)</th>
						<th>下行流量(GB)</th>
						<th>上行流量(GB)</th>
					</tr>
					<tr>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>4</td>
						<td>5</td>
						<td>6</td>
						<td>7</td>
						<td>8</td>
						<td>9</td>
					</tr>

				</tbody>

				<tfoot>
					<tr>
						<th colspan="2">合計</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
					</tr>
				</tfoot>
			</table>
		</div>

	</div>
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>

</body>
</html>
