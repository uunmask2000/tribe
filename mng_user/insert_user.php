<html>
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
	include_once("../SQL/dbtools.inc.php");
	$link = create_connection();
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

	<?php include("../include/nav.php"); ?>

	<form action="sys_proc.php?mode=inser_user" method="post">
		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">新增使用者</th>
				</tr>
				<tr>
					<td>使用者名稱</td>
					<td><input type="text" name="user_name"></td>
				</tr>
				<tr>
					<td>帳號</td>
					<td><input type="text" name="user_acc"></td>
				</tr>
				<tr>
					<td>E-maill</td>
					<td><input type="email" name="user_maill"></td>
				</tr>
				<tr>
				<td>請輸入您的密碼：</td>
				<td><input type="password" name="user_pwd" placeholder="(至少8個,至少一個英文大小寫及一個數字 )"></td>
				</tr>

				<tr>
					<td>使用層級</td>
					<td>
						<select name="user_lv">
						　<option value="1">最高使用者</option>
						　<option value="2">網管人員</option>
						　<option value="3">專管人員</option>
						　<option value="4" selected>原民會</option>
						</select>
					</td>
				</tr>
				
				<tr>
						<td>是否為工程師</td>
						<td>
						<input type="radio" name="user_engineer_radio" value="0" checked> 否<br>
						<input type="radio" name="user_engineer_radio" value="1"> 是<br>
						</td>
				</tr>
				
				<tr>
					<td colspan="2" align="center">
		<input class="edit_btn" type="submit" value="儲存">

		<input class="edit_btn" type="button" onClick="history.back()" value="回上頁">
					</td>
				</tr>
			</table>
		</div>	
	</form>
	</div>	

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>
		
</div>

</body>
</html>
