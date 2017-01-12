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
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<td width="200"><a class="add" href="insert_tribe.php" targer="_self" >新增部落</a></td>
				<td align="right">
					位置 
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
							$B1 =  $_POST['town'] ;
                                                    ?>
							<option value="<?=$A1;?>" <?php if($A1==$B1){echo 'selected';}else{};	?> ><?php   echo $row1['township_name'] ;?></option>

							<?php

						}


					?>

					</select>


					每頁顯示
					<select id="list" name="view_num" onchange="this.form.submit();">
						 <option value="10" <?php if($_POST['view_num']==10){echo 'selected'; }?> >10</option>
					         <option value="20" <?php if($_POST['view_num']==20){echo 'selected'; }?>>20</option>
					          <option value="30" <?php if($_POST['view_num']==30){echo 'selected'; }?>>30</option>
					</select>
				</td>
				</tr>
			</table>
 			</form>

			<table cellpadding="5" cellspacing="0" class="asset">
				<tr>
					<th width="10%">縣市</th>
					<th width="10%">地區</th>
					<th width="60%">部落</th>
					<th>編輯</th>
					<th>刪除</th>
				</tr>

				<tr>

				<tr>
               <?php


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




					$city = $_POST['city'] ;

				 	$town = $_POST['town'] ;
                                 		if($city>0){
                                           $sql2 = "SELECT *  FROM  tribe  where  city_id='$city'  ORDER BY city_id ASC ";
											
				                  if($town>0 ){
						$sql2 = "SELECT *  FROM  tribe  where  city_id='$city' and township_id ='$town' ORDER BY city_id ASC ";
									  
							}
                                                 }else{

$sql2 = "SELECT *  FROM  tribe  ORDER BY city_id ASC ";
				
                               }


					
					$result2 = execute_sql($database_name, $sql2, $link);


  $total_fields = mysql_num_fields($result2);
                         
                  //取得記錄數
                  $total_records = mysql_num_rows($result2);
                         
                  //計算總頁數
                  $total_pages = ceil($total_records / $records_per_page);
                         
                  //計算本頁第一筆記錄的序號
                  $started_redcord = $records_per_page * ($page - 1);
                         
                  //將記錄指標移至本頁第一筆記錄的序號
                  mysql_data_seek($result2, $started_redcord);


 		$j = 1;




					if (mysql_num_rows($result2) == 0)
					{
						
					}else
					{
						while ($row2 = mysql_fetch_assoc($result2)and $j <= $records_per_page)
						{
                                                      // echo $row2['tribe_name'];
?>
				<td>

					<?php

						$key=$row2['city_id'];
						$sql22 = "SELECT *  FROM  city_array  where id='$key' ";
						$result22 = execute_sql($database_name, $sql22, $link);
						while ($row22 = mysql_fetch_assoc($result22))
						{
						     echo $row22['city_name'];
						}
					?>
				
				</td>
				<td>
					<?php
						$key2=$row2['township_id'];
						$sql23 = "SELECT *  FROM  city_township  where township_id='$key2' ";
						$result23 = execute_sql($database_name, $sql23, $link);
						while ($row23 = mysql_fetch_assoc($result23))
						{
						     echo $row23['township_name'];
						}


					?>


				</td>
				<td><?=$row2['tribe_name'];?></td>
			<td><a href="fix_tribe.php?id=<?=$row2['tribe_id'];?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
			<td>
			<a href="javascript:if(confirm('确实要删除吗?'))location='mng_tribe_proc.php?mode=del_tribe&id=<?=$row2['tribe_id'];?>'"><img src="../images/icon_del.png" width="16" height="16" align="absmiddle"></a>
		       </td>
				</tr>

<?php
						$j++;	
						}
					}


		?>
				

				</tr>
			</table>
		<div style="clear:both;"></div>
		
		
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
<input type="hidden" name="city" value="<?=$_POST['city'] ;?>">
<input type="hidden" name="town" value="<?=$_POST['town'] ;?>">
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
