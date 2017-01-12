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
			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<td width="200"><a class="add" href="insert_asset.php" targer="_self" >新增資產</a></td>
				<td align="right">
					位置
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
					<th>資產名稱</th>
					<th>編輯</th>
					<th>刪除</th>
				</tr>

				<tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><a href="fix_asset.php?"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
					<td>
					<a href="javascript:if(confirm('确实要删除吗?'))location='?'"><img src="../images/icon_del.png" width="16" height="16" align="absmiddle"></a>
					</td>
				</tr>

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
