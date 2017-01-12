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
		if($_GET['mode'] == 'del_user')
			{
			$id = $_GET['id'];
			$sql = "DELETE FROM web_user WHERE user_id ='$id' " ;
			$result = execute_sql($database_name, $sql, $link);
			echo"<script>alert('刪除使用者成功');window.location.href = 'user.php';</script>";					
			}
	?>
	
		<div class="tab_container">
			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<?php
				 if(($_SESSION['user_lv'])==1)
				{
					?>
					<td width="200"><a class="add" href="insert_user.php" targer="_self" >新增使用者</a></td>
					<?php
				}
				?>
				
				
				<td align="right">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					每頁顯示
					<select id="list" name="view_num" onchange="this.form.submit();">
						 <option value="10" <?php if($_POST['view_num']==10){echo 'selected'; }?> >10</option>
					         <option value="20" <?php if($_POST['view_num']==20){echo 'selected'; }?>>20</option>
					          <option value="30" <?php if($_POST['view_num']==30){echo 'selected'; }?>>30</option>
							</select>
						</form>
				</td>
				</tr>
			</table>
			
			<table cellpadding="5" cellspacing="0" class="asset">
				<tr>
					<th>使用者</th>
					<th>帳號</th>
					<th>E-maill</th>
					<th>使用層級</th>
					<th>編輯</th>
					<?php
				 if(($_SESSION['user_lv'])==1)
				{
					?>
					<th>刪除</th>
					<?php
				}
				?>
					
				</tr>
				<?php
				$sql2 = "SELECT *  FROM  web_user";
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row2 = mysql_fetch_assoc($result2))
				{
				?>
				<tr>
				<?php /* <td><?=$row2['id'];?></td> */?>

					<td><?=$row2['user_name'];?></td>
					<td><?=$row2['user_acc'];?></td>
					<td><?=$row2['user_maill'];?></td>
					<td><?=$row2['user_lv'];?></td>
					
					<?php
					if($_SESSION['user_lv']==1)
					{
						?>
						<td>
							<a href="fix_user.php?id=<?=$row2['user_id'];?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a>
						</td>
						<?php
					}else if($row2['user_id']==$_SESSION['user_id'])
					{
						?>
						<td>
							<a href="fix_user.php?id=<?=$row2['user_id'];?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a>
						</td>
						<?php
						
					}else{
						echo '<td></td>' ;
					}
					
					?>
					
					
					<?php
					 if(($_SESSION['user_lv'])==1)
					{
						?>
					<td>
						<a href="javascript:if(confirm('确实要删除吗?'))location='?mode=del_user&id=<?=$row2['user_id'];?>'"><img src="../images/icon_del.png" width="16" height="16" align="absmiddle"></a>
					</td>
						<?php
					}
					?>
				
				<tr>
				<?php
				}
				?>				
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
