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

		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">新增地區</th>
				</tr>
				<tr>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<td>縣市</td> 
										
<td>
					<select id="list" name="city" onchange="this.form.submit();">
					<option value=""selected >全部</option>
					<?php
					//執行 SQL 命令
					$sql = "SELECT *  FROM  city_array ORDER BY city_sort ASC  ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
						{
							$A = $row['id'] ;
							$B =  $_POST['city'] ;
                                                    ?>
						<option value="<?=$A;?>" <?php if($A==$B){	 echo 'selected';}else{};	?> ><?php   echo $row['city_name'] ;?></option>

							<?php

						}
					?>
					
						
					</select>
	</td> 
			</form>
				</tr>
				<form action="mng_town_proc.php?mode=inser_mng_town" method="post">
					 <input type="hidden" name="city"  value="<?=$B;?>" >
					<input type="hidden" name="ckeck_key"  value="check" >
				<tr>
					<td>地區</td>
					<td><input type="text" name="township_name"  value="" ></td>
				</tr>
				
				
						<tr>
						<td>鄉長</td>
						<td><input type="text" name="Mayor"  value="" ></td>
						</tr>

						<tr>
						<td>鄉長電話</td>
						<td><input type="text" name="Mayor_phone"  value="" ></td>
						</tr>

						<tr>
						<td>連絡人</td>
						<td><input type="text" name="Contact_person"  value="" ></td>
						</tr>

						<tr>
						<td>連絡人電話</td>
						<td><input type="text" name="Contact_person_phone"  value="" ></td>
						</tr>

						<tr>
						<td>地址</td>
						<td><input type="text" name="address"  value="" ></td>
						</tr>

						<tr>
						<td>備註</td>
						<td><input type="text" name="area_note"  value="" ></td>
						</tr>
				
				
				
				
				<tr>
					<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="儲存">
						<input class="edit_btn" type="button" onClick="history.back()" value="回上頁">
					</td>
				</tr>
				</form>	
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
