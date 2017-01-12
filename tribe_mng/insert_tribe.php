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

		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">新增部落</th>
				</tr>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<tr>
					<td>位置</td>
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
							$B =  $_GET['city'] ;
                                                    ?>
			<option value="<?=$A;?>" <?php if($A==$B){echo 'selected';}else{};	?> ><?php   echo $row['city_name'] ;?></option>

							<?php

						}
					?>
					
						
					</select>
							<select id="list" name="town" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">請選擇地區</option>
						
					<?php
					//執行 SQL 命令
                                         
					$sql1 = "SELECT *  FROM  city_township where township_city='$B'  ";
					$result1 = execute_sql($database_name, $sql1, $link);
					while ($row1 = mysql_fetch_assoc($result1))
						{
							$A1 = $row1['township_id'] ;
							$B1 =  $_GET['town'] ;
                                                    ?>
							<option value="<?=$A1;?>" <?php if($A1==$B1){echo 'selected';}else{};	?> ><?php   echo $row1['township_name'] ;?></option>

							<?php

						}


					?>

					</select>
					</td>
				</tr>
					</form>
				<form action="mng_tribe_proc.php?mode=insert_tribe" method="POST">	
					<tr>
						<td>選擇期標</td>
						<td>
						<select id="tribe_label" name="tribe_label">
						 <option value="2" selected >二期</option>
						 <option value="3">三期</option>
						
						</select>
						</td>
					</tr>
					
				
				
				 
					 <input type="hidden" name="city"  value="<?=$B;?>" >
					 <input type="hidden" name="town"  value="<?=$B1;?>" >
					 
					 <input type="hidden" name="ckeck_key"  value="check" >
				<tr>
					<td>部落名稱</td>
					<td><input type="text" name="tribe_name"  value="" ></td>
				</tr>

				<tr>
					<td>部落中心座標(X)</td>
					<td><input type="text" name="tribe_x"  value="" ></td>
				</tr>

				<tr>
					<td>部落中心座標(Y)</td>
					<td><input type="text" name="tribe_y"  value="" ></td>
				</tr>

				<tr>
					<td>地圖尺寸(預設16)</td>
					<td><input type="number" name="tribe_o"  value="16" ></td>
				</tr>
				
				<!-----部落聯絡資訊------->
				<tr>
					<td>部落聯絡人</td>
					<td><input type="text" name="tribe_member"  value="" ></td>
				</tr>				
				<tr>
					<td>部落聯絡電話</td>
					<td><input type="text" name="tribe_phone"  value="" ></td>
				</tr>
				
				
				<tr>
					<td>部落聯絡備註</td>
					<td><input type="text" name="tribe_note"  value="" ></td>
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
