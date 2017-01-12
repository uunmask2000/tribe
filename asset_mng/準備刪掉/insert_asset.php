<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php include("../include/top.php"); ?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>
		
		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">新增資產</th>
				</tr>

				<tr>
					<td>資產位置</td>
					<td>
						<select id="" name="" onchange="this.form.submit();">
							<option value="">縣市</option>
						</select>
						<select id="" name="" onchange="this.form.submit();">
							<option value="">地區</option>
						</select>
						<select id="" name="" onchange="this.form.submit();">
							<option value="">部落</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>控制箱</td>
					<td>
						<select id="" name="" onchange="this.form.submit();">
							<option value="">控制箱</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>資產類型</td>
					<td>
						<select id="" name="" onchange="this.form.submit();">
							<option value="">F/W</option>
							<option value="">4G Router</option>
							<option value="">PDU</option>
							<option value="">POE SW</option>
							<option value="">AP</option>
							<option value="">其他</option>
						</select>
					</td>
				</tr>

				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="name"  value="" ></td>
				</tr>

				<tr>
					<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="儲存">
						<input class="edit_btn" type="button" onClick="history.back()" value="回上頁">
					</td>
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
