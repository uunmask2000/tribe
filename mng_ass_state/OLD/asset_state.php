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

	<?php
		if($_GET['mode'] == 'del_state')
		{
			$id = $_GET['id'];
			$sql = "DELETE FROM ass_state_setting WHERE ass_state_id ='$id' " ;
			$result = execute_sql($database_name, $sql, $link);
			echo"<script>alert('del state OK');window.location.href = 'asset_state.php';</script>";					
		}
	?>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/nav.php"); ?>
	
		<div class="tab_container">

			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<td width="200"><a class="add" href="insert_state.php" targer="_self" >新增資產狀態</a></td>
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
					<th width="80%">資產狀態</th>
					<th>編輯</th>
					<th>刪除</th>
				</tr>

				<tr>

				<?php
				$sql2 = "SELECT *  FROM  ass_state_setting";
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row2 = mysql_fetch_assoc($result2))
				{
				?>
				<?php /* <td><?=$row2['id'];?></td> */?>
<tr>
					<td><?=$row2['ass_state_name'];?></td>
					
					<td><a href="fix_state.php?id=<?=$row2['ass_state_id'];?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
					<td>
					<a href="javascript:if(confirm('确实要删除吗?'))location='?mode=del_state&id=<?=$row2['ass_state_id'];?>'"><img src="../images/icon_del.png" width="16" height="16" align="absmiddle"></a>
				</td>
	</tr>
				<?php
				}
				?>	
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
