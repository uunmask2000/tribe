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
	  <?php include("../include/top.php"); 
		include_once("../SQL/dbtools.inc.php");
		$link = create_connection(); ?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">
		<?php
		    if($_GET['mode']=='del_grouter')
					{
			             $id= $_GET['id'];
							$sql = "DELETE FROM   ass_4Ggrouter    WHERE ass_4Ggrouter_id ='$id' " ;
							$result = execute_sql($database_name, $sql, $link);
								?>
							<script>alert('刪除成功！');window.location.href = 'view_4grouter.php';</script>
								<?php
					}
		?>

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>
		
		<div class="tab_container">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<td width="200"><a class="add" href="insert_4grouter.php" targer="_self" >新增資產</a></td>
				<td align="right">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					位置
					<select id="list" name="city" onchange="this.form.submit();">
					<option value=""selected >all</option>
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
						<option value="" selected disabled="disabled">地區</option>
						
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



	<select id="list" name="tribe" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">部落</option>
						
	<?php
		//執行 SQL 命令
                                         
		$sql2 = "SELECT *  FROM  tribe where township_id='$B1'  and  city_id='$B'  ";
		$result2 = execute_sql($database_name, $sql2, $link);
	while ($row2 = mysql_fetch_assoc($result2))
	{
		$A11 = $row2['tribe_id'] ;
		$B11 =  $_POST['tribe'] ;
         	?>
	<option value="<?=$A11;?>" <?php if($A11==$B11){echo 'selected';}else{};	?> ><?php   echo $row2['tribe_name'] ;?></option>
		<?php

	}
	?>

	</select>
						<select id="list" name="assets_address" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">錨點</option>
						
					<?php
						//執行 SQL 命令

						$sql3 = "SELECT *  FROM  assets_address where tribe_ass_own='$B11' and  town_ass_own='$B1'  and   city_ass_own='$B'   ";
						$result3 = execute_sql($database_name, $sql3, $link);
					while ($row3 = mysql_fetch_assoc($result3))
					{
						$A111 = $row3['ass_address_id'] ;
						$B111 =  $_POST['assets_address'] ;
							?>
					<option value="<?=$A111;?>" <?php if($A111==$B111){echo 'selected';}else{};	?> ><?php   echo $row3['tribe_ass_name'] ;?></option>
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
			
<?php       //    echo       $string =  $B.'-'.$B1.'-'.$B11.'-'.$B111.'-'.$_POST['view_num'];        ?>
			<table cellpadding="5" cellspacing="0" class="asset">
				<tr>
					<th>縣市</th>
					<th>地區</th>
					<th>部落</th>
					<th>控制箱</th>
					<th>資產名稱</th>
					<th>編輯</th>
					<th>刪除</th>
				</tr>

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
				//  echo       $string =  $B.'-'.$B1.'-'.$B11.'-'.$B111.'-'.$_POST['view_num'];  10;
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
					$tribe= $_POST['tribe'] ;
					$assets_address= $_POST['assets_address'] ;

//echo   $city.'-'.$town.'-'.$tribe	;
/*

`ass_4Ggrouter_city`, `ass_4Ggrouter_twon`, `ass_4Ggrouter_tribe`, `ass_4Ggrouter_address`

*/
			if($city>0 ){
                      $sql4 = "SELECT * FROM `ass_4Ggrouter` WHERE `ass_4Ggrouter_city`='$city'  ";
			
							if($town>0 )
						{
								   $sql4 = "SELECT * FROM `ass_4Ggrouter`   where  ass_4Ggrouter_city='$city' and ass_4Ggrouter_twon='$town' ";
								
															if($tribe>0 )
										{
																   $sql4 = "SELECT * FROM `ass_4Ggrouter`   where  ass_4Ggrouter_city='$city' and ass_4Ggrouter_twon='$town'  and ass_4Ggrouter_tribe='$tribe' ";
															
												if($assets_address>0 )
															{
																	
													  $sql4 = "SELECT * FROM `ass_4Ggrouter`   where  ass_4Ggrouter_city='$city' and  ass_4Ggrouter_twon='$town'  and ass_4Ggrouter_tribe='$tribe' and ass_4Ggrouter_address='$assets_address' ";
															
															}

										}
								
						}
			
			}else
			{
			$sql4 = "SELECT * FROM `ass_4Ggrouter`  ";
			
			}

echo  $sql4;
				







						//$sql4 = "SELECT * FROM `ass_4Ggrouter` ";
						$result4= execute_sql($database_name, $sql4, $link);


				
  //取得記錄數
      $total_records = mysql_num_rows($result4);
			
      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
			
      //計算本頁第一筆記錄的序號
      $started_redcord = $records_per_page * ($page - 1);
			
      //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result4, $started_redcord);
		  
 //顯示記錄
      $j = 1;


					while ($row4 = mysql_fetch_assoc($result4)  and $j <= $records_per_page)
					{
						//echo $row4['ass_4Ggrouter_id']; echo 'AAAAAAAAAAAAA';
						
						$ass_4Ggrouter_id =$row4['ass_4Ggrouter_id'];
						$ass_4Ggrouter_city =$row4['ass_4Ggrouter_city'];
						$ass_4Ggrouter_twon =$row4['ass_4Ggrouter_twon'];
						$ass_4Ggrouter_tribe =$row4['ass_4Ggrouter_tribe'];
						$ass_4Ggrouter_address =$row4['ass_4Ggrouter_address'];
						$ass_4Gname =$row4['ass_4Gname'];
						$j++;
						?>
				<tr>
			
					
					<td>
						<?php
						
						$sql0 = "SELECT *  FROM  city_array	  where  	id=' $ass_4Ggrouter_city'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['city_name'];
					
					}

					
						
						
						
						
						//$ass_4Ggrouter_city;?>
					</td>
					<td>
						<?php
						
							$sql0 = "SELECT *  FROM  city_township  where  	township_id=' $ass_4Ggrouter_twon'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['township_name'];
					
					}

						
						
						//$ass_4Ggrouter_twon;?>
					</td>
					<td>
						<?php
							$sql0 = "SELECT *  FROM  tribe where  	tribe_id=' $ass_4Ggrouter_tribe'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['tribe_name'];
					
					}

						//$ass_4Ggrouter_tribe;
						?>
					</td>
					<td>
						<?php
							$sql0 = "SELECT *  FROM  assets_address where  	ass_address_id=' $ass_4Ggrouter_address'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['tribe_ass_name'];
					
					}
						
						//$ass_4Ggrouter_address;
						
						?>
					</td>
					
					<td><?=	$ass_4Gname;?></td>
					<td><a href="fix_4grouter.php?id=<?=$ass_4Ggrouter_id;?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
					<td>
					<a href="javascript:if(confirm('确实要删除吗?'))location='?mode=del_grouter&id=<?=$ass_4Ggrouter_id;?>'"><img src="../images/icon_del.png" width="16" height="16" align="absmiddle"></a>
					</td>
				</tr>
				
				
				
				
				
				
						<?php
						
						
					
					}
				
				
				
				
				?>

				

			
			</table>
				
					  <div id="page">

					<?php
//$_POST['city'] ;
						if ($page > 1)
						{
							//echo "<a href='?page=". ($page - 1) . "'>上一頁</a> ";
					?>
					<input type="button" value="上一頁" onClick="document.form.action='<?php echo $_SERVER['PHP_SELF'];?>?do=left&view_num=<?php  echo $_POST['view_num']; ?>';document.form.submit()"/>

					<?php
						}
					?>
					<form style="display:inline-block;" name="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>?do=change&view_num=<?php  echo $_POST['view_num']; ?>">
                    <input type="hidden" name="city" value="<?=$_POST['city'] ;?>">
						<input type="hidden" name="town" value="<?=$_POST['town'] ;?>">
						<input type="hidden" name="tribe" value="<?=$_POST['tribe'] ;?>">
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
