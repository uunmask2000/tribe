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
			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<td width="200"><a class="add" href="insert_city.php" targer="_self" class="" >新增縣市</a></td>

				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<td align="right">
					每頁顯示
					<select id="list" name="view_num" onchange="this.form.submit();">
						 <option value="10" <?php if($_POST['view_num']==10){echo 'selected'; }?> >10</option>
					         <option value="20" <?php if($_POST['view_num']==20){echo 'selected'; }?>>20</option>
					          <option value="30" <?php if($_POST['view_num']==30){echo 'selected'; }?>>30</option>
					</select>
					</td>
                </form>
				
				</tr>
			</table>

			<form action="?do=sort" method="post">
			<table cellpadding="5" cellspacing="0" class="asset">
				<tr>
					<th><input type="submit" value="更改排序"></th>
					<th width="80%">縣市</th>
					<th>編輯</th>
					<th>刪除</th>
				</tr>

				<tr>
<?php
			if($_GET['do']=='sort')
			{
				$sort = $_POST['sort'];
				$sort_id = $_POST['sort_id'];
				for($i=0;$i<count($sort);$i++)
				 	{
				 	$sql = " UPDATE  city_array SET 	city_sort='$sort[$i]'  WHERE  id ='$sort_id[$i]' ";
					execute_sql($database_name, $sql, $link);
					// echo $sql;
				 	}
			//exit();
?>
				<script>alert('修改排序OK');document.location.href="mng_city.php";</script>
<?php
			}

			if($_GET['do']=='left')
			{
				//$_POST['page']= $_GET['page']-1;
				$_GET['page'] = $_POST['page']-1;
				$_POST['page']=  $_GET['page'];
				
				$_POST['view_num']= $_GET['view_num'];
				$records_per_page= $_POST['view_num'];

			}else if($_GET['do']=='right')
			{
				//$_POST['page']= $_GET['page']+1;
				$_GET['page'] = $_POST['page']+1;
				$_POST['page']=  $_GET['page'];
				
				$_POST['view_num']= $_GET['view_num'];
				$records_per_page= $_POST['view_num'];
			}else if($_GET['do']=='change')
			{
				 $_GET['page'] = $_POST['page'];
				 $_POST['page']=  $_GET['page'];
				$_POST['view_num']= $_GET['view_num'];
				$records_per_page= $_POST['view_num'];
			}
				//指定每頁顯示幾筆記錄
				if(empty($_POST['view_num']))
				{
				$records_per_page = 10;
				$_POST['view_num']= 10;
				}
				else{
						$records_per_page= $_POST['view_num'];
					}

				//取得要顯示第幾頁的記錄
				//if (isset($_GET["page"]))
				//{
				//$page = $_GET["page"];

					if (isset($_POST['page']))
					{
					$page = $_POST['page'];
					}
					else{
						$page = 1;
						$_POST['page']=$page ;
					}

				$sql = "SELECT *  FROM  city_array ORDER BY city_sort ASC ";
				$result = execute_sql($database_name, $sql, $link);

				//取得欄位數
				$total_fields = mysql_num_fields($result);
				//取得記錄數
				$total_records = mysql_num_rows($result);
				//計算總頁數
				$total_pages = ceil($total_records / $records_per_page);
				//計算本頁第一筆記錄的序號
				$started_redcord = $records_per_page * ($page - 1);
				//將記錄指標移至本頁第一筆記錄的序號
				mysql_data_seek($result, $started_redcord);
			$j = 1;
				//while ($row = mysql_fetch_assoc($result))
			while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page     )
				{

						?>

				<tr>
					<td> <input type="number" name="sort[]"  value="<?php echo $row['city_sort'];?>" class="num"></td>
					     <input type="hidden" name="sort_id[]"  value="<?php echo $row['id'];?>">
					<td><?php echo $row['city_name'];?></td>
					<td><a href="fix_city.php?id=<?php echo $row['id'];?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
					<td>
					<a href="javascript:if(confirm('确实要删除吗?'))location='mng_city_proc.php?mode=dell_city&id=<?php echo $row['id'];?>'"><img src="../images/icon_del.png" width="16" height="16" align="absmiddle"></a>
					</td>
				</tr>
						<?php
				 $j++;
				}

				?>
				</tr>
				
			</table>
			</form>

			<div id="page">

				<?php
					if ($page > 1)
					{
						//echo "<a href='?page=". ($page - 1) . "'>上一頁</a> ";
				?>
				<input type="button" value="上一頁" onClick="document.form.action='<?php echo $_SERVER['PHP_SELF'];?>?do=left&view_num=<?php  echo $_POST['view_num']; ?>';document.form.submit()"/>

				<?php
					}
				?>
				<form style="display:inline-block;" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?do=change&view_num=<?php  echo $_POST['view_num']; ?>">
					<select name="page" size="1" onchange="this.form.submit();"> 
					<?php
					for ($ii = 1; $ii <= $total_pages; $ii++)
					{
						if ($ii == $page)
						{
						echo '<option Selected value='.$ii.'>'.$ii.'&nbsp</option>';
						}
						else
						{
						echo '<option value='.$ii.'>'.$ii.'&nbsp</option>'; 
						}
					}
					?>
					</select>
				</form>

				<!--
				<?php //echo $_POST['page'] ;?>
				<font size="2">page</font>
				-->

				<?php

				if ($page < $total_pages)
				{
				//echo "<a href='?page=". ($page + 1) . "'>下一頁</a> ";
				?>
				<input type="button" value="下一頁" onClick="document.form.action='<?php echo $_SERVER['PHP_SELF'];?>?do=right&view_num=<?php  echo $_POST['view_num']; ?>';document.form.submit()"/>
				<?php
				}
				?>
			</div>
            <div style="clear:both;"></div>
		</div>	
	</div>	

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>

</body>
</html>
