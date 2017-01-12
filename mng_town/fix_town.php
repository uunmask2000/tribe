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
		
        <form action="mng_town_proc.php?mode=fix_mng_town" method="POST">
			<?php
                                    $id= $_GET['id'];
				$sql = "SELECT *  FROM  city_township where township_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
				    $township_name = $row['township_name'];
					///
					$Mayor = $row['Mayor'];
					$Mayor_phone = $row['Mayor_phone'];
					$Contact_person = $row['Contact_person'];
					$Contact_person_phone = $row['Contact_person_phone'];
					$address = $row['address'];
					$area_note = $row['area_note'];
				}

			?>
	
		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">修改地區</th>
				</tr>

				<tr>
					<td>地區</td>
					<td><input type="text" name="township_name"  value="<?=$township_name ;?>" ></td>
				</tr>
				
							<tr>
							<td>鄉長</td>
							<td><input type="text" name="Mayor"  value="<?=$Mayor ;?>" ></td>
							</tr>

							<tr>
							<td>鄉長電話</td>
							<td><input type="text" name="Mayor_phone"  value="<?=$Mayor_phone ;?>" ></td>
							</tr>

							<tr>
							<td>連絡人</td>
							<td><input type="text" name="Contact_person"  value="<?=$Contact_person ;?>" ></td>
							</tr>

							<tr>
							<td>連絡人電話</td>
							<td><input type="text" name="Contact_person_phone"  value="<?=$Contact_person_phone ;?>" ></td>
							</tr>

							<tr>
							<td>地址</td>
							<td><input type="text" name="address"  value="<?=$address ;?>" ></td>
							</tr>

							<tr>
							<td>備註</td>
							<td><input type="text" name="area_note"  value="<?=$area_note ;?>" ></td>
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
