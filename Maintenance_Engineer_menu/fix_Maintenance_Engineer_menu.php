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


<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();

?>

<?php
 $key = $_GET['key'];

 if(is_numeric($key))
 {
	  //echo 'ok';
	  

				$sql2 = "SELECT * FROM  Maintenance_Engineer_menu WHERE Maintenance_Engineer_menu_id='$key'  ";
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row2 = mysql_fetch_assoc($result2))
				{

					
					$Maintenance_Engineer_menu_id = $row2['Maintenance_Engineer_menu_id'];
					$Maintenance_Engineer_menu_name = $row2['Maintenance_Engineer_menu_name'];
				
				}
	  
	  ?>
	<div class="tab_container">

		<form action="proc_Maintenance_Engineer_menu.php?mode=fix" method="POST">
		<table cellpadding="5" cellspacing="0" class="edit">
		<tr><th colspan="2">修改工程師</th></tr>
		<tr>
			<td>工程師名稱</td>
			<td>
			<input type="text" name="Maintenance_Engineer_menu_name" value="<?=$Maintenance_Engineer_menu_name ;?>" >
			<input type="hidden" name="Maintenance_Engineer_menu_id" value="<?=$Maintenance_Engineer_menu_id ;?>" >
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
	  
	  <?php
	 
 }else{
	// echo 'NO';
		echo"<script>alert('錯誤參數');window.location.href = 'veiw_alert_contacts_setting.php';</script>";
 }
 
 

?>

	</div>
	</div>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>
		
</div>

</body>
</html>
