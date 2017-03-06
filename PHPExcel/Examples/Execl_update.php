<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../../include/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
<!-------------------------------------- TOP -->
	<div id="header">
	<?php
	include("../../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

	<div class="tabs">
		<a href="../../programer_See/show_AP_date_form.php">AP中斷維修紀錄表</a>
		<a href="Execl_update.php" class="nav_linked">匯入</a>
		<a href="Veiw_end_date_2.php">匯出</a>
	</div>

	<div class="report_bar">
	<form method="post" action="Execl_update_proc.php?mode=update" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576">
		<input type="file" name="myfile" size="50"><br><br>
		<input type="submit" value="上傳">
		<input type="reset" value="重新設定">
	</form>
	</div>

	</div>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>