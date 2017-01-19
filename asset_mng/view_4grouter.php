<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<!--------dataTablesw套件---------->
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
<!---CDN
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
-->
<script type="text/javascript" src="../dataTables/1.10.12/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../dataTables/1.10.12/dataTables.buttons.min.js"></script>
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
					
							$id= $_GET['id'];
							$sql= " SELECT ass_change_own_4Grouter  FROM ass_change_4Grouter WHERE ass_change_own_4Grouter='$id' ";
							$result= execute_sql($database_name, $sql, $link);
							//取得記錄數
							$num = mysql_num_rows($result);
							 if( $num>0  )
							{
								?><script>alert('have anyone date on assect ,will come back !?'); window.history.back();</script><?php
								
							}else
							{
								//exit();
							$sql = "DELETE FROM   ass_4Ggrouter   WHERE ass_4Ggrouter_id='$id' " ;
							$result = execute_sql($database_name, $sql, $link);
								?>
							<script>alert('刪除成功！');window.location.href = 'view_4grouter.php';</script>
								<?php
								
								
							}
								
								
								
					}
		?>

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>
		
		<div class="tab_container">
			<form action="<?=$_SERVER['PHP_SELF'];?>" method="post" class="period">
				<select name="A" onchange="this.form.submit();">
				  <option value=" " <?php if($_POST['A']==' '){echo 'selected';}else{};	?>  >請選擇期別</option> 
				　<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
				　<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>
			   </select>
			   <select id="list" name="Doube_label_tribe" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">請選擇部落</option>
						<?php
						$keyy= $_POST['A'] ;
						$sql_label_tribe = "SELECT * FROM tribe where tribe_label='$keyy'";
						$result_label_tribe = execute_sql($database_name, $sql_label_tribe, $link);
						while ($row_label_tribe = mysql_fetch_assoc($result_label_tribe))
								{
								?>
								<option value="<?=$row_label_tribe['tribe_id'];?>" <?php if($_POST['Doube_label_tribe']==$row_label_tribe['tribe_id']){echo 'selected';}else{};	?>  ><?=$row_label_tribe['tribe_name'];?></option> 

								<?php	
								}		
								?>
								
			    </select>
			</form>

			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<td width="200"><a class="add" href="insert_4grouter.php" targer="_self" >新增資產</a></td>
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
					<select id="list" name="ass_4Ggrouter_label" onchange="this.form.submit();">
							
							<?php
							if(empty($B111))
							{
								echo '<option value="" selected disabled="disabled">請選擇設備來源</option>' ;
								
							}else{
								echo '<option value="" selected disabled="disabled">請選擇設備來源</option>' ;
								?>
								<option value="2" <?php if($_POST['ass_4Ggrouter_label']==2){echo 'selected'; }?>>2期</option>
								<option value="3" <?php if($_POST['ass_4Ggrouter_label']==3){echo 'selected'; }?>>3期</option>
								<?php
							}
							
							
							?>
							
					</select>
					
					
				
				</td>
				</tr>
			</table>
			</form>

			
<?php       //    echo       $string =  $B.'-'.$B1.'-'.$B11.'-'.$B111.'-'.$_POST['view_num'];        ?>
			<table id="show_date" class="asset">
			<thead>
				<tr>
					<th width="40">縣市</th>
					<th width="40">地區</th>
					<th>部落</th>
					<th>控制箱</th>
					<th width="80">資產名稱</th>
					<th width="40">編輯</th>
					<th width="40">更換</th>
					<th width="40">刪除</th>
					<th>更新紀錄</th>
					<th  style="display: none;">S/N</th>
					<th  style="display: none;">MAC</th>
					<th  style="display: none;">P/N</th>
				</tr>
				</thead>
 <tbody>
				<?php
				$A = $_POST['A'] ;
				$Doube_label_tribe = $_POST['Doube_label_tribe'] ;
if($A>0)
{
	//$sql4 = "SELECT * FROM `ass_4Ggrouter` where ass_4Ggrouter_label='$A ' ";
	
	//echo '未選擇部落';
	

	//exit();
	if($Doube_label_tribe>0 )
						{
					$sql4 = "SELECT * FROM `ass_4Ggrouter` where  ass_4Ggrouter_tribe='$Doube_label_tribe' ";		
						}
}else{
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

		if($ass_4Ggrouter_label > 0)
		{
		$sql4 = "SELECT * FROM `ass_4Ggrouter`   where  ass_4Ggrouter_city='$city' and  ass_4Ggrouter_twon='$town'  and ass_4Ggrouter_tribe='$tribe' and ass_4Ggrouter_address='$assets_address' and ass_4Ggrouter_label ='$ass_4Ggrouter_label' ";

		}


		}

		}

		}

		}else
		{
		$sql4 = "SELECT * FROM `ass_4Ggrouter`  ";

		}
}
//echo  $sql4;
				







						//$sql4 = "SELECT * FROM `ass_4Ggrouter` ";
						$result4= execute_sql($database_name, $sql4, $link);


					while ($row4 = mysql_fetch_assoc($result4) )
					{
						$ass_4Ggrouter_id =$row4['ass_4Ggrouter_id'];
						$ass_4Ggrouter_city =$row4['ass_4Ggrouter_city'];
						$ass_4Ggrouter_twon =$row4['ass_4Ggrouter_twon'];
						$ass_4Ggrouter_tribe =$row4['ass_4Ggrouter_tribe'];
						$ass_4Ggrouter_address =$row4['ass_4Ggrouter_address'];
						$ass_4Gname =$row4['ass_4Gname'];
						$IP =$row4['ass_4Gip'];
						////
						$ass_4Gsn =$row4['ass_4Gsn'];
						$ass_4Gmac =$row4['ass_4Gmac'];
						$ass_4Gpn =$row4['ass_4Gpn'];
						//$j++;
						?>
				<tr>
			
					
					<td>
						<?php
						
						$sql0 = "SELECT *  FROM  city_array	  where  	id=' $ass_4Ggrouter_city'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
							echo  $row0['city_name'];
							$city_name =  $row0['city_name'];
					
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
						$township_name =  $row0['township_name'];
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
							$tribe_name =  $row0['tribe_name'];
					
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
						$tribe_ass_name =  $row0['tribe_ass_name'];
					}
						
						//$ass_4Ggrouter_address;
					$LONG_TXT = $city_name.$township_name.$tribe_name.$tribe_ass_name;
					$LONG_TXT2 = $IP;						
						?>
					</td>
					
					<td><?=	$ass_4Gname;?></td>
					<td><a href="fix_4grouter.php?LONG_TXT=<?=$LONG_TXT ;?>&id=<?=$ass_4Ggrouter_id;?>" target="blank"><img src="../images/icon_edit.png" class="adm_icon" align="absmiddle"></a></td>
					<td><a href="change_4grouter.php?LONG_TXT=<?=$LONG_TXT ;?>&LONG_TXT2=<?=$LONG_TXT2 ;?>&id=<?=$ass_4Ggrouter_id;?>" target="blank"><img src="../images/icon_change.png" class="adm_icon" align="absmiddle"></a></td>
					
					
					<td>
					<a href="javascript:if(confirm('確定要刪除嗎?'))location='?mode=del_grouter&id=<?=$ass_4Ggrouter_id;?>'"><img src="../images/icon_del.png" class="adm_icon" align="absmiddle"></a>
					</td>
					<td>
					<?php
					
					//$ass_grouter_id 
					$sql_number = "SELECT *  FROM  ass_change_4Grouter where  	ass_change_own_4Grouter=' $ass_4Ggrouter_id'  ";
					$result_number= execute_sql($database_name, $sql_number, $link);
					$rowcount=mysql_num_rows($result_number);
					echo $rowcount -1;
					
					?>
					</td>
					
						<td  style="display: none;"><?=	$ass_4Gsn;?></td>
						<td  style="display: none;"><?=	$ass_4Gmac;?></td>
						<td  style="display: none;"><?=	$ass_4Gpn;?></td>
				</tr>
				
				
				
				
				
				
						<?php
						
						
					
					}
				
				
				
				
				?>

				

			 </tbody>
			</table>
				
					
            <div style="clear:both;"></div>
		</div>	
	</div>	
		
			
			

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>

</body>
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
				lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 筆', '25 筆', '50 筆', '全部' ]
				],
		dom: 'Bfrtip',	 buttons: [
				'pageLength',				
			],
	   };
      $("#show_date").dataTable(opt);
      });
</script>
</html>
