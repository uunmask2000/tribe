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

			<?php
				$id =$_GET['id'];
				$sql2 = "SELECT *  FROM  ass_state_setting where ass_state_id='$id'  ";
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row2 = mysql_fetch_assoc($result2))
				{

					$name = $row2['ass_state_name'];
					$ass_state_id = $row2['ass_state_id'];
                                      
				}

			?>
	<form action="sys_proc.php?mode=fix_state" method="post">
	<input type="hidden" name="ass_state_id" value="<?=$ass_state_id ;?>" >

		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">修改名稱</th>
				</tr>
				

				<tr>
					<td>資產狀態</td>
					<td><input type="text" name="name"  value="<?=$name ;?>" ></td>
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
