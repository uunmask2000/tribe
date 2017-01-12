<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

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

		<div id="alert">
		<?php include("../alert/alert2.php"); ?>
		</div>

	<?php include("../include/nav.php"); ?>
	
		<div class="tab_container">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<table cellpadding="0" cellspacing="0" class="bar">

				<tr>
				<td width="200"><a class="add" href="insert_anchor.php" targer="_self" >新增錨點</a></td>
				<td align="right">
					
					<label>位置</label>
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
                                         
		$sql2 = "SELECT *  FROM  tribe where township_id='$B1'  ";
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
					<th>錨點名稱 tribe_ass_name</th>
                   		        <th>東經 tribe_ass_x</th>
					    <th>北緯 tribe_ass_y</th>
					    <th>類型 type</th>
					<th>編輯</th>
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

/*
					if($city>0){
                            
						$sql3 = "SELECT *  FROM  assets_address  where  city_ass_own='$city'  ORDER BY ass_address_id ASC ";
											
				                  if($town>0 ){
						$sql3 = "SELECT *  FROM  assets_address  where  city_ass_own='$city' and town_ass_own ='$town' ORDER BY ass_address_id ASC ";
								      if($tribe>0 ){
						$sql3 = "SELECT *  FROM  assets_address  where  city_ass_own='$city' and town_ass_own ='$town' and tribe_ass_own ='$tribe' ORDER BY ass_address_id ASC ";
									  
							}	  
							}
                                                 }else{

	$sql3 = "SELECT *  FROM assets_address   ORDER BY ass_address_id ASC  ";
				
                               }
*/
//echo   $city.'-'.$town.'-'.$tribe	;

if($city>0){

//echo 'A';
	$sql3 = "SELECT *  FROM  assets_address  where  city_ass_own='$city'  ORDER BY ass_address_id ASC ";
	$town="";
	$tribe="";
	if($town>0)
			{

				//echo 'A1';	
		$sql3 = "SELECT *  FROM  assets_address  where  city_ass_own='$city' and town_ass_own ='$town' ORDER BY ass_address_id ASC ";
		$tribe="";
				if($tribe>0)
			{

				//echo 'A11';	
						$sql3 = "SELECT *  FROM  assets_address  where  city_ass_own='$city' and town_ass_own ='$town' and tribe_ass_own ='$tribe' ORDER BY ass_address_id ASC ";
				}	
	
	
			}
	
}else
{


$sql3 = "SELECT *  FROM assets_address   ORDER BY ass_address_id ASC  ";
}




											
					//echo $sql ;



						$result3 = execute_sql($database_name, $sql3, $link);
						while ($row3 = mysql_fetch_assoc($result3))
						{
							
					           $ass_address_id = $row3['ass_address_id'];
							
							  $city_ass_own = $row3['city_ass_own'];
							  $town_ass_own = $row3['town_ass_own'];
							  $tribe_ass_own = $row3['tribe_ass_own'];
							
							  $tribe_ass_name = $row3['tribe_ass_name'];
							  $tribe_ass_x = $row3['tribe_ass_x'];
							  $tribe_ass_y = $row3['tribe_ass_y'];
							 	$type = $row3['type'];
							 
							
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
						<td><?= $type ;?></td>
					<td><a href="fix_anchor.php?id=<?=$ass_address_id;?>"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a></td>
					<td>
					<a href="javascript:if(confirm('确实要删除吗?'))location='?'"><img src="../images/icon_del.png" width="16" height="16" align="absmiddle"></a>
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
