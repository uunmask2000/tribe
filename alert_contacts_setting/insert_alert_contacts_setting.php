<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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
	<?php include("../alert/alert2.php"); ?>
	<?php include("../include/nav.php"); ?>
		
	<div class="tab_container">

		<form action="proc_alert_contacts_setting.php?mode=insert" method="POST">
		<table cellpadding="5" cellspacing="0" class="edit">
		<tr><th colspan="2">新增聯絡人</th></tr>
		<tr>
			<td>聯絡人</td>
			<td>
			<input type="text" name="alert_contacts_name">
			</td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td>
			<input type="email" name="alert_contacts_email">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
			<input class="edit_btn" type="submit" value="儲存">
			<input class="edit_btn" type="button" onClick="history.back()" value="回上頁">
			</td>
		</tr>
		</table>
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