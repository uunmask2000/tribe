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
	<?php
	include("../include/top.php");
	include_once("../SQL/dbtools.inc.php");
	$link = create_connection();
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>


	<form action="anchor_proc.php?mode=fix_anchor" method="post">
			<?php
                                    $id= $_GET['id'];
				$sql = "SELECT *  FROM assets_address where ass_address_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
				       $tribe_ass_name = $row['tribe_ass_name'];
					$tribe_ass_x = $row['tribe_ass_x'];
					$tribe_ass_y = $row['tribe_ass_y'];
					$type = $row['type'];
					$A1 = $type;
					
				$base_ico = $row['base_ico'];
				$assets_address_note = $row['assets_address_note'];
				
				}

			?>
	

		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">修改控制箱</th>
				</tr>

				<tr>
					<td align="right">圖片上傳：<img src="<?php echo	$base_ico ;?>"></td>
					<td>
			<p id="img_area"></p>
			<input type="file" value="sdgsdg" id="file"/>
							<input type="hidden" name="old_base"  value="<?php echo 	$base_ico;?>" >
		</td>
				</tr>

				<tr>
					<td>錨點名稱</td>
					<td><input type="text" name="tribe_ass_name"  value="<?=$tribe_ass_name;?>" ></td>
				</tr>

				<tr>
					<td>東經</td>
					<td><input type="text" name="tribe_ass_x"  value="<?=$tribe_ass_x;?>" ></td>
				</tr>
				<tr>
					<td>北緯</td>
					<td><input type="text" name="tribe_ass_y"  value="<?=$tribe_ass_y;?>" ></td>
				</tr>
				<tr>
					<td>類型</td>
					<td>
						<select id="list" name="type">
							<option value="1"   <?php if($A1==1){echo 'selected';}else{};	?>>AP</option>
							<option value="2"   <?php if($A1==2){echo 'selected';}else{};	?>>主控箱</option>
							<option value="3"  <?php if($A1==3){echo 'selected';}else{};	?>>分控箱</option>
						</select>
					</td>
				</tr>
				
				<tr>
		<td>備註</td>
		<td>		

		<textarea rows="4" cols="50" name="assets_address_note"><?=$assets_address_note;?>
		</textarea>

		</td>
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
