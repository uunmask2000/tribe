<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/base.js"></script>
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
    <?php include("../include/top.php"); 
		include_once("../SQL/dbtools.inc.php");
		$link = create_connection(); ?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>

	<!--<form action="sys_proc.php?mode=inser_state" method="post">-->
	
		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">新增控制箱</th>
				</tr>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
				<tr>
					<td>錨點位置</td>
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



	<select id="list" name="tribe" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">請選擇部落</option>
						
	<?php
		//執行 SQL 命令
                                         
		$sql2 = "SELECT *  FROM  tribe where township_id='$B1'  ";
		$result2 = execute_sql($database_name, $sql2, $link);
	while ($row2 = mysql_fetch_assoc($result2))
	{
		$A11 = $row2['tribe_id'] ;
		$B11 =  $_GET['tribe'] ;
         	?>
	<option value="<?=$A11;?>" <?php if($A11==$B11){echo 'selected';}else{};	?> ><?php   echo $row2['tribe_name'] ;?></option>
		<?php

	}
	?>

	</select>
					</td>
				</tr>
					</form>
<?php    
//echo $B.'-'.$B1.'-'.$B11 ;
			$string =  $B.'-'.$B1.'-'.$B11 ;
			?>
				
				<form action="anchor_proc.php?mode=insert_anchor" method="post">
					<input type="hidden" name="string" value="<?=$string?>">
			
				<tr>
					<td>錨點名稱</td>
					<td><input type="text" name="tribe_ass_name"  value="" ></td>
				</tr>
				<tr>
					<td>東經</td>
					<td><input type="text" name="tribe_ass_x"  value="" ></td>
				</tr>
				<tr>
					<td>北緯</td>
					<td><input type="text" name="tribe_ass_y"  value="" ></td>
				</tr>
				<tr>
					<td>類型</td>
					<td>
						<select id="list" name="type">
							<option value="1">AP</option>
							<option value="2">主控箱</option>
							<option value="3">分控箱</option>
						</select>
					</td>
				</tr>
		<tr>
		<td>備註</td>
		<td>		

		<textarea rows="4" cols="50" name="assets_address_note">
		</textarea>

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
	</div>	

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>
		
</div>

</body>
</html>
