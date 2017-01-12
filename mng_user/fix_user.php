<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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

		<?php include("../include/nav.php"); ?>

			<?php
                $id =$_GET['id'];
				$sql2 = "SELECT *  FROM  web_user where user_id='$id'  ";
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row2 = mysql_fetch_assoc($result2))
				{

					$user_name = $row2['user_name'];
					$user_id = $row2['user_id'];
					$user_mail = $row2['user_maill'];
					$user_pwd = $row2['user_pwd'];
					$user_lv = $row2['user_lv'];
					$user_photo = $row2['user_photo'];

				}

			?>
		<form action="sys_proc.php?mode=fix_user" method="post">

   		 <input type="hidden" name="user_id" value="<?=$user_id ;?>" >
		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				

				<tr>
					<th colspan="2">修改使用者</th>
				</tr>

				<tr>
					<td>圖片上傳</td>
					<td>
					<img width="150" src="<?php echo	$user_photo ;?>">
					<p id="img_area"></p>
					<input type="file" value="sdgsdg" id="file"/>
					<input type="hidden" name="old_base"  value="<?php echo 	$user_photo ;?>" >
				</td>

				</tr>

				<tr>
					<td>使用者名稱</td>
					<td><input type="text" name="user_name"  value="<?=$user_name;?>" ></td>
				</tr>
				
				<tr>
					<td>E-maill</td>
					<td><input type="email" name="user_mail" value="<?=$user_mail;?>" ></td>
				</tr>
				<tr>
				<td>修改密碼</td>
				<td>
				
	<input type="password" name="user_pwd" placeholder="(至少8個,至少一個英文大小寫及一個數字 )">
	<input type="hidden" name="old_pwd" value="<?=$user_pwd;?>" >
				</td>
				</tr>

				<tr>
					<td>使用層級</td>
					<td>
						<select name="user_lv">
						　<option value="1"  <?php if($user_lv==1){echo 'selected';} ?>     >最高使用者</option>
						　<option value="2"  <?php if($user_lv==2){echo 'selected';} ?>     >網管人員</option>
						　<option value="3"  <?php if($user_lv==3){echo 'selected';} ?>     >專管人員</option>
						　<option value="4"  <?php if($user_lv==4){echo 'selected';} ?>     >原民會</option>
						</select>
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
		</form>	
	</div>	

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>
		
</div>

</body>
</html>
