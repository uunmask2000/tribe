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
		<?php
		    if($_GET['mode']=='del_grouter')
					{
						/*
			             $id= $_GET['id'];
							$sql = "DELETE FROM   ass_grouter    WHERE ass_grouter_id ='$id' " ;
							$result = execute_sql($database_name, $sql, $link);
								?>
							<script>alert('刪除成功！');window.location.href = 'view_fw.php';</script>
								<?php
						*/
						
						$id= $_GET['id'];
			            
						 $sql= " SELECT ass_change_own_router  FROM ass_change_router WHERE ass_change_own_router='$id' ";
							$result= execute_sql($database_name, $sql, $link);
							//取得記錄數
							$num = mysql_num_rows($result);
							 if( $num>0  )
							{
								?><script>alert('have anyone date on assect ,will come back !?'); window.history.back();</script><?php
								
							}else
							{
								//exit();
							$sql = "DELETE FROM   	ass_grouter    WHERE ass_grouter_id ='$id' " ;
							$result = execute_sql($database_name, $sql, $link);
								
e

?>
							<script>alert('刪除成功！');window.location.href = 'view_fw.php';</script>
								<?php
								
								
							}		
								
								
					}
		?>

		<?php include("../alert/alert2.php"); ?>

		<?php// include("../include/asset_nav.php"); ?>
		
		<div class="tabs">
			
			資產分類︰
			<a href="../device_defend/view_fw.php"
			<?php if (preg_match("/fw/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>F/W</a>
			<a href="../device_defend/view_4grouter.php"
			<?php if (preg_match("/4grouter/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>4G Router</a>
            		<a href="../device_defend/view_pdu.php"
			<?php if (preg_match("/pdu/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>PDU</a>
            		<a href="../device_defend/view_poesw.php"
			<?php if (preg_match("/poesw/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>POE SW</a>
			<a href="../device_defend/view_ap.php"
			<?php if (preg_match("/ap/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>AP</a>
			
		</div>
		
		<div class="tab_container">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
			
				<td align="right">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
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



	<select id="list" name="tribe" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">請選擇部落</option>
						
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
						<option value="" selected disabled="disabled">請選擇錨點</option>
						
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
					<!----目前寫死--->
					<select id="list" name="ass_grouter_label" onchange="this.form.submit();">
							
							<?php
							if(empty($B111))
							{
								echo '<option value="" selected disabled="disabled">請選擇設備來源</option>' ;
								
							}else{
								echo '<option value="" selected disabled="disabled">請選擇設備來源</option>' ;
								?>
								<option value="2" <?php if($_POST['ass_grouter_label']==2){echo 'selected'; }?>>2期</option>
								<option value="3" <?php if($_POST['ass_grouter_label']==3){echo 'selected'; }?>>3期</option>
								<?php
							}
							
							
							?>
							
					</select>
					
				
				</td>
				</tr>
			</table>
			</form>
			
<?php         //  echo       $string =  $B.'-'.$B1.'-'.$B11.'-'.$B111.'-'.$_POST['view_num'];        ?>
			<table id="show_date" class="asset">
			      <thead>
				<tr>
					<th>縣市</th>
					<th>地區</th>
					<th>部落</th>
					<th>控制箱</th>
					<th>資產名稱</th>
					<th>觀看歷史紀錄</th>
					<th>更新紀錄</th>
				</tr>
   </thead>
 <tbody>
				<?php


					$city = $_POST['city'] ;
				 	$town = $_POST['town'] ;
					$tribe= $_POST['tribe'] ;
					$assets_address= $_POST['assets_address'] ;
					$ass_grouter_label=$_POST['ass_grouter_label'];

//echo   $city.'-'.$town.'-'.$tribe	;
/*

`ass_4Ggrouter_city`, `ass_4Ggrouter_twon`, `ass_4Ggrouter_tribe`, `ass_4Ggrouter_address`

*/
			if($city>0 ){
                      $sql4 = "SELECT * FROM `ass_grouter` WHERE `ass_grouter_city`='$city'  ";
			
							if($town>0 )
						{
								   $sql4 = "SELECT * FROM `ass_grouter`   where  ass_grouter_city='$city' and ass_grouter_twon='$town' ";
								
															if($tribe>0 )
										{
																   $sql4 = "SELECT * FROM `ass_grouter`   where  ass_grouter_city='$city' and ass_grouter_twon='$town'  and ass_grouter_tribe='$tribe' ";
															
												if($assets_address>0 )
															{
																	
													  $sql4 = "SELECT * FROM `ass_grouter`   where  ass_grouter_city='$city' and  ass_grouter_twon='$town'  and ass_grouter_tribe='$tribe' and ass_grouter_address='$assets_address' ";
															
															
															if($ass_grouter_label>0 )
	{
	$sql4 = "SELECT * FROM `ass_grouter`   where  ass_grouter_city='$city' and  ass_grouter_twon='$town'  and ass_grouter_tribe='$tribe' and ass_grouter_address='$assets_address' and ass_grouter_label ='$ass_grouter_label' ";

	}

															
															}

										}
								
						}
			
			}else
			{
			$sql4 = "SELECT * FROM `ass_grouter`  ";
			
			}

//echo  $sql4;
				







						//$sql4 = "SELECT * FROM `ass_grouter` ";
						$result4= execute_sql($database_name, $sql4, $link);


	
					while ($row4 = mysql_fetch_assoc($result4) )
					{
						$ass_grouter_id =$row4['ass_grouter_id'];
						$ass_grouter_city =$row4['ass_grouter_city'];
						$ass_grouter_twon =$row4['ass_grouter_twon'];
						$ass_grouter_tribe =$row4['ass_grouter_tribe'];
						$ass_grouter_address =$row4['ass_grouter_address'];
						$ass_name =$row4['ass_name'];
						
					
						?>
				<tr>
			
					
					<td>
						<?php
						
						$sql0 = "SELECT *  FROM  city_array	  where  	id=' $ass_grouter_city'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['city_name'];
					
					}

					
						
						
						
						
						//$ass_4Ggrouter_city;?>
					</td>
					<td>
						<?php
						
							$sql0 = "SELECT *  FROM  city_township  where  	township_id=' $ass_grouter_twon'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['township_name'];
					
					}

						
						
						//$ass_4Ggrouter_twon;?>
					</td>
					<td>
						<?php
							$sql0 = "SELECT *  FROM  tribe where  	tribe_id=' $ass_grouter_tribe'  ";
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
							$sql0 = "SELECT *  FROM  assets_address where  	ass_address_id=' $ass_grouter_address'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['tribe_ass_name'];
					
					}
						
						//$ass_4Ggrouter_address;
						
						?>
					</td>
					
					<td><?=	$ass_name;?></td>
					<script language="JavaScript" type="text/JavaScript">
					function MM_openBrWindow(theURL,winName,features) { //v2.0
					  window.open(theURL,winName,features);
					}
					</script>
					
					<td><a href="#" title="開新視窗" onclick="MM_openBrWindow('show_router.php?ip=<?=$row4['ass_ip'];?>','test','width=700,height=300')" onKeypress="MM_openBrWindow('show_router.php?ip=<?=$row4['ass_ip'];?>','test','width=700,height=300')"><img src="../images/icon_edit.png" width="16" height="16" align="absmiddle"></a>
					<td>
					<?php
					
					//$ass_grouter_id 
					$sql_number = "SELECT *  FROM  ass_change_router where  	ass_change_own_router=' $ass_grouter_id'  ";
					$result_number= execute_sql($database_name, $sql_number, $link);
					$rowcount=mysql_num_rows($result_number);
					echo $rowcount ;
					
					?>
					</td>
				</tr>
				
				
				
				
				
				
						<?php
						
						
					
					}
				
				
				
				
				?>

			  </tbody>
  </table>
 	  <script language="JavaScript">
    $(document).ready(function(){ 
      var opt={ "oLanguage":{"sProcessing":"處理中...",
                            "sLengthMenu":"顯示 _MENU_ 項結果",
                            "sZeroRecords":"沒有匹配結果",
                            "sInfo":"顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                            "sInfoEmpty":"顯示第 0 至 0 項結果，共 0 項",
                            "sInfoFiltered":"(從 _MAX_ 項結果過濾)",
                            "sSearch":"搜索:",
                            "oPaginate":{"sFirst":"首頁",
                                         "sPrevious":"上頁",
                                         "sNext":"下頁",
                                         "sLast":"尾頁"},
							 
		            },
				 dom: 'Bfrtip',	 buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
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
