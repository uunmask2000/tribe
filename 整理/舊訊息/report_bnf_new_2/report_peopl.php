<html>
<head>
	<meta charset="utf-8">
	<title>無線AP網管系統</title>
<!--------dataTablesw套件---------->
	<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
	<!---CDN
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
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
</head>
<body>

<div id="wrap">
<!-------------------------------------- TOP -->
	<div id="header">

	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		
		
        
		<div class="report_nav">
			<h1>使用人次統計分析明細表</h1>
		</div>
       
		<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		?>
		
		<div class="report_bar">
			<div class="search">
			<form action="" method="GET">
					<select name="realm" size="1" > 
							<option  disabled selected>請選擇單位</option>
					<option value="itr" <?php if($_GET['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
					<option value="itw" <?php if($_GET['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
					</select>					
				
			

				<select  name="year" size="1" >
					<option  disabled selected>請選擇年份</option>
									
					<?php
					    $dat_y = date("Y")+2;
					 for($y=2016 ; $y<=$dat_y  ; $y++)
                        {
							 ?>
							 <option value="<?=$y;?>" <?php if($_GET['year']==$y){echo 'selected'; }?> ><?=$y;?>年</option>
							 <?php
						}
					?>
				</select>
				
				
				
				<select  name="month" size="1" >
					<option  disabled selected>請選擇月份</option>
									
					<?php
					   	$month = array('01','02','03','04','05','06','07','08','09','10','11','12');
					
					for($ii=0;$ii<12;$ii++)
					{
						 ?>
							 <option value="<?=$month[$ii];?>" <?php if($_GET['month']==$month[$ii]){echo 'selected'; }?> ><?=$month[$ii];?>月</option>
							 <?php
					}
					
					?>
				</select>
				
				
					<select  name="city_array" size="1" onchange="this.form.submit();">
					<option  disabled selected>請選擇縣市</option>
					<?php
					  $sql444="SELECT * FROM city_array ORDER BY id ASC  ";
					  $result444= execute_sql($database_name2, $sql444, $link2);
					  while ($row444= mysql_fetch_assoc($result444)  )
							{
					  				  
								?>
							 <option value="<?=$row444['id'];?>"  <?php if($_GET['city_array']==$row444['id']){  echo 'selected';  }?> ><?=$row444['city_name'];?></option>
							 <?php
						 }					
					?>
					
				</select>
				
				
				<select  name="city_township" size="1"  onchange="this.form.submit();">
					<option  disabled selected>請選擇地區</option>
					<?php
					 $key_city_array = $_GET['city_array'];    
					  $sql445="SELECT * FROM city_township where township_city ='$key_city_array ' ";
					  $result445= execute_sql($database_name2, $sql445, $link2);
					  while ($row445= mysql_fetch_assoc($result445)  )
							{
					  				  
								?>
							 <option value="<?=$row445['township_id'];?>"  <?php if($_GET['city_township']==$row445['township_id']){  echo 'selected';  }?> ><?=$row445['township_name'];?></option>
							 <?php
						 }					
					?>
					
				</select>
				
				
				<select  name="tribe" size="1"   onchange="this.form.submit();">
					<option  disabled selected>請選擇部落</option>
					<?php
					 $key_city_township= $_GET['city_township'];    
					  $sql446="SELECT * FROM tribe where  city_id ='$key_city_array '   and  township_id ='$key_city_township ' ";
					  $result446= execute_sql($database_name2, $sql446, $link2);
					  while ($row446= mysql_fetch_assoc($result446)  )
							{
					  				  
								?>
							 <option value="<?=$row446['tribe_id'];?>"  <?php if($_GET['tribe']==$row446['tribe_id']){  echo 'selected';  }?> ><?=$row446['tribe_name'];?></option>
							 <?php
						 }					
					?>
					
				</select>

				<input type="button" onclick="this.form.submit();" value="檢視報表">
			
			</form>
			</div>

			
			<div class="c"></div>
		</div>
	
		
		<?php
		$realm = $_GET['realm'];
		if(empty($realm ))
		{
			
		echo  '<div style="text-align:center;padding:50px 0;">尚未選取項目</div>';	
			
			
		}else{
			
			?>

	<div class="report">
		<div id="div_print"><style>table td { padding:5px;} table th { padding:5px; border:#000 1px solid;}</style>
			<table class="tablesorter" id="show_date" >
			
				<thead>
					<tr>
					<th colspan="7" class="table_tt">
						<?php
						if($realm=='itw')
						{
						echo '愛台灣';	
						}else
						{
						echo '愛部落';	
						}
						?>
						使用人次統計分析明細表
					</th> 
					</tr>
					<tr>
						<th width="60">日期</th>
						<th>地區</th>
						<th>部落</th>
						<th>期別</th>
						<th>設備名稱</th>
						<th>使用人次</th>
						<th>使用人數</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					$year = $_GET['year'];
					$month = $_GET['month'];
					$city_array = $_GET['city_array'];
					$city_township= $_GET['city_township'];
					$tribe= $_GET['tribe'];
					
					 if($city_array!=NULL)
							{
								
								$sql2_2="SELECT * FROM `ass_ap`  where ass_ap_city='$city_array'  ";
								
								}else{
											
											echo '<script>';
											echo "alert('報表條件未設定正確'); window.history.back();";
											echo '</script>';
											
											}
								
								if($city_township!=NULL)
								{
									
									$sql2_2="SELECT * FROM `ass_ap`  where ass_ap_city='$city_array'  and  ass_ap_twon='$city_township'   ";
									}
						 if($tribe!=NULL)
								{
									
									$sql2_2="SELECT * FROM `ass_ap`  where ass_ap_city='$city_array'  and  ass_ap_twon='$city_township' and ass_ap_tribe='$tribe'   ";
									}
					
						 
							//$sql2_2="SELECT * FROM `ass_ap`  where ass_ap_city='$city_array'  ";
							$result2_2 = execute_sql($database_name2, $sql2_2, $link2);
							while ($row2_2= mysql_fetch_assoc($result2_2) )
								{
									$ass_ap_ip  =  $row2_2['ass_ap_ip'];
									$ass_ap_tribe = $row2_2['ass_ap_tribe'];
									$ass_ap_name = $row2_2['ass_ap_name'];
									
									$sql="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where nasipaddress IN ('$ass_ap_ip') and acctstarttime like '%$year-$month%' ";
									$result = execute_sql($database_name, $sql, $link);
									//echo $sql;
									//
									$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip') and realm<>'itw' and acctstarttime like '%$year-$month%'";
									$result1 = execute_sql($database_name, $sql1, $link);
									$number1 = mysql_num_rows($result1);
									  ///
									  $sql2="SELECT username   FROM radacct where  nasipaddress IN ('$ass_ap_ip')  and realm<>'itw'  and acctstarttime like '%$year-$month%'  GROUP BY username ";
									  $result2 = execute_sql($database_name, $sql2, $link);
									  $number2 = mysql_num_rows($result2);
									  
									
                                           echo '<tr>';	
                                           ?>
                                           	<td><?=$year.'-'.$month;?></td>
											<td><?php
											
											   $key =$city_array ;
											   $sql_key="SELECT city_name FROM city_array  where id='$key'  ";
												$result_key = execute_sql($database_name2, $sql_key, $link2);
												
												
												while ($row_key= mysql_fetch_assoc($result_key) )
													{
														
														echo $row_key['city_name'];
														
														}	
											   
											   ?></td>
											   <td><?php $key2 = $ass_ap_tribe;
													   $sql_key2="SELECT tribe_name,tribe_label FROM tribe  where tribe_id='$key2'  ";
														$result_key2 = execute_sql($database_name2, $sql_key2, $link2);
														
														
														while ($row_key2= mysql_fetch_assoc($result_key2) )
															{
																
																echo $row_key2['tribe_name'];
																$tribe_label = $row_key2['tribe_label'];
																
																}	
											   
											   ?></td>
											<td> <?=$tribe_label;?></td>
											<td> <?=$ass_ap_name;?></td>
											
											<td><?=$number1;?></td>
											<td><?=$number2;?></td>
											
											
                                           
                                           <?php
                                           echo '</tr>';	
                                    
								}
					
					?>
				</tbody>
			</table>
		</div>

		
	</div>
		<?php
				}
		?>
	</div>
	
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
			 dom: 'Bfrtip',	 buttons: 
			 [
				{ extend: 'excelHtml5', text: '匯出使用人次統計分析明細表' ,title: '<?= date("Y-m-d");?>  <?=$tribe_name;?>:使用人次統計分析明細表' },
				{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>熱點服務效益分析明細表' },	
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>


</body>
</html>
