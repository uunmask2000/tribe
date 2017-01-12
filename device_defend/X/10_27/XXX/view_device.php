<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-latest.js"></script>
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php include("../include/top.php"); ?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert.php"); ?>

		<div class="tab_container">

			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<td align="left">	
					<select id="list" name="" onchange="this.form.submit();">
						<option value="">縣市</option>
						<option value=""></option>
						<option value=""></option>
					</select>
					<select id="list" name="" onchange="this.form.submit();">
						<option value="">地區</option>
						<option value=""></option>
						<option value=""></option>
					</select>
					<select id="list" name="" onchange="this.form.submit();">
						<option value="">部落</option>
						<option value=""></option>
						<option value=""></option>
					</select>
					<select id="list" name="" onchange="this.form.submit();">
						<option value="">控制箱</option>
						<option value=""></option>
						<option value=""></option>
					</select>
				</td>
				<td align="right">
					每頁顯示 
					<select id="list" name="name10" onchange="this.form.submit();">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
					</select>
				</td>
				</tr>
			</table>

			<table cellpadding="5" cellspacing="0" class="asset">
				<tr>
					<th>縣市</th>
                    <th>地區</th>
                    <th>部落</th>
                    <th>控制箱</th>
					<th>設備名稱</th>
					<th>詳細資料</th>
				</tr>

				<tr>
					<td>1</td>
					<td>2</td>
                    <td>3</td>
                    <td>4</td>
					<td>設備名稱</td>
					<td><a href="device_details.php">查看</a></td>
				</tr>
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
