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

			<form action="mng_city_proc.php?mode=fix_mng_city" method="POST">
			<?php
                                    $id= $_GET['id'];
				$sql = "SELECT *  FROM  city_array where id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
				   $city_name = $row['city_name'];
				}

			?>
			<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">修改縣市</th>
				</tr>

				<tr>
					<td>縣市</td>
					<td><input type="text" name="city_name"  value="<?=$city_name;?>" ></td>
				</tr>
   					 <input type="hidden" name="ckeck_key"  value="check" >
					 <input type="hidden" name="uid"  value="<?=$id;?>" >
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
