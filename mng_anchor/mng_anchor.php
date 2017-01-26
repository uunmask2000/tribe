<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />

<!--------dataTablesw套件---------->
		<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
		  <!---CDN
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		 -->
		<script type="text/javascript" src="../dataTables/1.10.12/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
		<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

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




				</td>
				</tr>
				</table>
				</form>

<?php    //echo $B.'-'.$B1.'-'.$B11.'-'.$_POST['view_num']; ?>
			<table id="show_date" class="asset">
			 <thead>
				<tr>
					<th width="40">縣市</th>
					<th width="60">地區</th>
					<th>部落</th>
					<th>控制箱</th>
                   	<th>東經</th>
					<th>北緯</th>
					<th width="60">類型</th>
					<th width="30">編輯</th>
					<th width="30">圖2</th>
					<th width="30">圖3</th>
					<th width="30">刪除</th>
				</tr>
			 </thead>	

			  <tbody>
					<?php


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
 

						while ($row3 = mysql_fetch_assoc($result3)  )
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
						<td><?php
						if($type==1){echo 'AP';}else if($type==2){echo '主控箱';}else{echo '分控箱';}
						
						
						//= $type ;
						
						?></td>
					<td><a href="fix_anchor.php?id=<?=$ass_address_id;?>"><img src="../images/icon_edit.png" class="adm_icon" align="absmiddle"></a></td>
<td><a href="fix_pohto.php?photo_type=2&id=<?=$ass_address_id;?>"><img src="../images/icon_image.png" class="adm_icon" align="absmiddle"></a></td>
<td><a href="fix_pohto.php?photo_type=3&id=<?=$ass_address_id;?>"><img src="../images/icon_image.png" class="adm_icon" align="absmiddle"></a></td>
					<td>
					<a href="javascript:if(confirm('確定要刪除嗎?'))location='anchor_proc.php?mode=del_anchor&id=<?=$ass_address_id;?>'"><img src="../images/icon_del.png" class="adm_icon" align="absmiddle"></a>
					</td>
				</tr>
					
						<?php
						
						
						
						
						}
					
					
					?>

				
				
				
			  </tbody>
			</table>
	<script language="JavaScript">
    $(document).ready(function(){ 
      var opt={"oLanguage":{"sProcessing":"處理中...",
                            "sLengthMenu":"顯示 _MENU_ 項結果",
                            "sZeroRecords":"沒有匹配結果",
                            "sInfo":"顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                            "sInfoEmpty":"顯示第 0 至 0 項結果，共 0 項",
                            "sInfoFiltered":"(從 _MAX_ 項結果過濾)",
                            "sSearch":"搜索:",
                            "oPaginate":{"sFirst":"首頁",
                                         "sPrevious":"上頁",
                                         "sNext":"下頁",
                                         "sLast":"尾頁"}
		            }
	       };
      $("#show_date").dataTable(opt);
      });
  </script>
		
		
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
