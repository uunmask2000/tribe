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


			<form action="anchor_proc.php?mode=up_photo" method="post">
			<?php
                            $id= $_GET['id'];
                            $photo_type= $_GET['photo_type'];
				if($photo_type=='2')
				{

						$sql = "SELECT base_ico2  FROM assets_address where ass_address_id='$id' ";
						$result = execute_sql($database_name, $sql, $link);
						while ($row = mysql_fetch_assoc($result))
						{			
						       
							$base_ico = $row['base_ico2'];
						}
				}else if($photo_type=='3')
				{

					$sql = "SELECT base_ico3  FROM assets_address where ass_address_id='$id' ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					       
						$base_ico = $row['base_ico3'];
					}
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

				
				</tr>
					 <input type="hidden" name="ckeck_key"  value="check" >
					 <input type="hidden" name="uid"  value="<?=$id;?>" >
					 <input type="hidden" name="photo_type"  value="<?=$photo_type;?>" >

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
