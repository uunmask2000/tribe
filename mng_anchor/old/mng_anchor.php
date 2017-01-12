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

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>
	
		<div class="tab_container">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<table cellpadding="0" cellspacing="0" class="bar">

				<tr>
				<td width="200"><a class="add" href="insert_anchor.php" targer="_self" >新增控制箱</a></td>
				<td align="right">
					
					<label>位置</label>
						<select id="list" name="city" onchange="this.form.submit();">
					<option value="0"selected >全部</option>
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
						<option value="0" selected disabled="disabled">請選擇地區</option>
						
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
						<option value="0" selected disabled="disabled">請選擇部落</option>
						
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


					
					<label>每頁顯示</label> 
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

<?php    //echo $B.'-'.$B1.'-'.$B11.'-'.$_POST['view_num']; ?>
			<table cellpadding="5" cellspacing="0" class="asset">
				<tr>
					<th>縣市</th>
					<th>地區</th>
					<th>部落</th>
					<th>控制箱名稱 </th>
                   		        <th>東經 </th>
					    <th>北緯 </th>
					    <th>類型 </th>
					<th>編輯</th>
					<th>編輯圖片2</th>
					<th>編輯圖片3</th>
					<th>刪除</th>
				</tr>

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
					$tribe= $_POST['tribe'] ;


//echo   $city.'-'.$town.'-'.$tribe	;


if($city>0){
                         $list=" city_ass_own='$city' "; 
						$sql3 = "SELECT *  FROM assets_address where $list  ORDER BY ass_address_id ASC  ";
					if($town>0)
							{
										 $list2=" town_ass_own ='$town' "; 
									$sql3 = "SELECT *  FROM assets_address where $list   and  $list2   ORDER BY ass_address_id ASC  ";
      								if($tribe>0){
                        									 $list3=" tribe_ass_own ='$tribe' "; 
															$sql3 = "SELECT *  FROM assets_address where $list   and $list2 and $list3 ORDER BY ass_address_id ASC  ";
               											  }

					
					       }
	

                 }else{

				$sql3 = "SELECT *  FROM assets_address   ORDER BY ass_address_id ASC  ";

    }




						$result3 = execute_sql($database_name, $sql3, $link);
  //取得記錄數
      $total_records = mysql_num_rows($result3);
			
      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
			
      //計算本頁第一筆記錄的序號
      $started_redcord = $records_per_page * ($page - 1);
			
      //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result3, $started_redcord);
		  
 //顯示記錄
      $j = 1;

						while ($row3 = mysql_fetch_assoc($result3) and $j <= $records_per_page  )
						{
							
					           $ass_address_id = $row3['ass_address_id'];
							
							  $city_ass_own = $row3['city_ass_own'];
							  $town_ass_own = $row3['town_ass_own'];
							  $tribe_ass_own = $row3['tribe_ass_own'];
							
							  $tribe_ass_name = $row3['tribe_ass_name'];
							  $tribe_ass_x = $row3['tribe_ass_x'];
							  $tribe_ass_y = $row3['tribe_ass_y'];
							 	$type = $row3['type'];
							 
							  $j++;
						   ?>
					
					<tr>
					
					<td>
						<?php
						$sql0 = "SELECT *  FROM  city_array	  where  	id=' $city_ass_own'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['city_name'];
					
					}

						
						?>
						
					</td>
						
					<td>
						<?php
						$sql0 = "SELECT *  FROM  city_township  where  	township_id=' $town_ass_own'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['township_name'];
					
					}

						
						?>
						
						</td>
						
					<td>
						
					<?php
						$sql0 = "SELECT *  FROM  tribe where  	tribe_id=' $tribe_ass_own'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['tribe_name'];
					
					}

						
						?>
						
						</td>
					
						
					<td><?= $tribe_ass_name; ?></td>
				     <td><?= $tribe_ass_x ;?></td>
						<td><?= $tribe_ass_y ;?></td>
						<td><?php
						if($type==1){echo 'AP';}else if($type==2){echo '主控箱';}else{echo '分控箱';}
						
						
						//= $type ;
						
						?></td>
					<td><a href="fix_anchor.php?id=<?=$ass_address_id;?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
<td><a href="fix_pohto.php?photo_type=2&id=<?=$ass_address_id;?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
<td><a href="fix_pohto.php?photo_type=3&id=<?=$ass_address_id;?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
					<td>
					<a href="javascript:if(confirm('确实要删除吗?'))location='anchor_proc.php?mode=del_anchor&id=<?=$ass_address_id;?>'"><img src="../images/icon_del.png" width="16" height="16" align="absmiddle"></a>
					</td>
				</tr>
					
						<?php
						
						
						
						
						}
					
					
					?>

				
				
				
				</tr>
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
					<form style="display:inline-block;" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?do=change&view_num=<?php  echo $_POST['view_num']; ?>">
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
