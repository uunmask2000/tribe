<!DOCTYPE html>
<html>
	<head>
		<title>無線AP網管系統</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="execl_95/jquery.table2excel.js"></script>
	</head>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	display:none;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>



	<body>
<body>

<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		
		
		?>

	<!----<button onclick="myFunction()">Click me</button>-->
		<table class="table2excel" data-tableName="Test Table 1">
<?php

		  $sql_tribe="SELECT * FROM `tribe` WHERE `tribe_label` = '2' ORDER BY `city_id`,`township_id`,`tribe_name` ASC ";
		  // $sql_tribe="SELECT * FROM  tribe ORDER BY `tribe`.`tribe_id` ASC ";
		  $result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
		 while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				$tribe_id = $row_tribe['tribe_id']
			
					
					
					
					?>
					<tr>
					<th><?=$row_tribe['tribe_name'];?></th>
					</tr>
					
					<tr>
					<th>縣市</th>
					<th>地區</th>
					<th>設備名稱</th>
					<th>期別</th>
					<th>SN</th>
					<th>IP</th>
					<th>MAC</th>
					<th>P/N</th>									
					</tr>
					<tr><th>Router</th></tr>
					<?php
						$sql_ass_grouter="SELECT * FROM  ass_grouter where ass_grouter_tribe='$tribe_id' ";
						$result_ass_grouter= execute_sql($database_name2, $sql_ass_grouter, $link2);
						 while ($row_ass_grouter= mysql_fetch_assoc($result_ass_grouter)  )
							{
										
								
								?>
								<tr>
								<th><?php
								////
											$key = $row_ass_grouter['ass_grouter_city'];
											$sql_0 = "SELECT city_name FROM city_array  where id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['city_name'];
											}
											?></th>
								<th><?php 
										$key =  $row_ass_grouter['ass_grouter_twon'];
										$sql_0 = "SELECT township_name	 FROM city_township  where township_id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['township_name'];
											}
										
										
										?></th>
								<th><?=$row_ass_grouter['ass_name'];?></th>
								<th><?=$row_ass_grouter['ass_grouter_label'];?></th>
								<th><?=$row_ass_grouter['ass_sn'];?></th>
								<th><?=$row_ass_grouter['ass_ip'];?></th>
								<th><?=$row_ass_grouter['ass_mac'];?></th>
								<th><?=$row_ass_grouter['ass_pn'];?></th>
																
								</tr>
								<?php
								
							}
					?>
					<tr><th>4G_Router</th></tr>
					<?php
						$sql_ass_grouter="SELECT * FROM  ass_4Ggrouter where ass_4Ggrouter_tribe='$tribe_id' ";
						$result_ass_grouter= execute_sql($database_name2, $sql_ass_grouter, $link2);
						 while ($row_ass_grouter= mysql_fetch_assoc($result_ass_grouter)  )
							{
										
								
								?>
								<tr>
								<th><?php
								      
									  $key = $row_ass_grouter['ass_4Ggrouter_city'];
											$sql_0 = "SELECT city_name FROM city_array  where id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['city_name'];
											}
									  
									  
									  
									  ?></th>
								<th><?php 
								
										
										
										$key =  $row_ass_grouter['ass_4Ggrouter_twon'];
										$sql_0 = "SELECT township_name	 FROM city_township  where township_id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['township_name'];
											}
										
										
										?></th>
								<th><?=$row_ass_grouter['ass_4Gname'];?></th>
								<th><?=$row_ass_grouter['ass_4Ggrouter_label'];?></th>
								<th><?=$row_ass_grouter['ass_4Gsn'];?></th>
								<th><?=$row_ass_grouter['ass_4Gip'];?></th>
								<th><?=$row_ass_grouter['ass_4Gmac'];?></th>
								<th><?=$row_ass_grouter['ass_4Gpn'];?></th>
																
								</tr>
								<?php
								
							}
					?>
					<tr><th>PDU</th></tr>
					<?php
						$sql_ass_grouter="SELECT * FROM  ass_pdu where ass_pdu_tribe='$tribe_id' ";
						$result_ass_grouter= execute_sql($database_name2, $sql_ass_grouter, $link2);
						 while ($row_ass_grouter= mysql_fetch_assoc($result_ass_grouter)  )
							{
										
								
								?>
								<tr>
								<th><?php
								
								$key = $row_ass_grouter['ass_pdu_city'];
											$sql_0 = "SELECT city_name FROM city_array  where id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['city_name'];
											}
								
											
											
											?></th>
								<th><?php 
								
									$key =  $row_ass_grouter['ass_pdu_twon'];
										$sql_0 = "SELECT township_name	 FROM city_township  where township_id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['township_name'];
											}
										
								
								?></th>
								<th><?=$row_ass_grouter['ass_pdu_name'];?></th>
								<th><?=$row_ass_grouter['ass_pdu_label'];?></th>
								<th><?=$row_ass_grouter['ass_pdu_sn'];?></th>
								<th><?=$row_ass_grouter['ass_pdu_ip'];?></th>
								<th><?=$row_ass_grouter['ass_pdu_mac'];?></th>
								<th><?=$row_ass_grouter['ass_pdu_pn'];?></th>
																
								</tr>
								<?php
								
							}
					
?>
					<tr><th>PoE_S/W</th></tr>
					<?php
						$sql_ass_grouter="SELECT * FROM  ass_poesw where ass_poesw_tribe='$tribe_id' ";
						$result_ass_grouter= execute_sql($database_name2, $sql_ass_grouter, $link2);
						 while ($row_ass_grouter= mysql_fetch_assoc($result_ass_grouter)  )
							{
										
								
								?>
								<tr>
								<th><?php
									$key = $row_ass_grouter['ass_poesw_city'];
											$sql_0 = "SELECT city_name FROM city_array  where id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['city_name'];
											}
								
								
								?></th>
								<th><?php
								
								$key = $row_ass_grouter['ass_poesw_twon'];
										$sql_0 = "SELECT township_name	 FROM city_township  where township_id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['township_name'];
											}
								
								?></th>
								<th><?=$row_ass_grouter['ass_poesw_name'];?></th>
								<th><?=$row_ass_grouter['ass_poesw_label'];?></th>
								<th><?=$row_ass_grouter['ass_poesw_sn'];?></th>
								<th><?=$row_ass_grouter['ass_poesw_ip'];?></th>
								<th><?=$row_ass_grouter['ass_poesw_mac'];?></th>
								<th><?=$row_ass_grouter['ass_poesw_pn'];?></th>
																
								</tr>
								<?php
								
							}

?>
					<tr><th>AP</th></tr>
					<?php
						$sql_ass_grouter="SELECT * FROM  ass_ap where ass_ap_tribe='$tribe_id' ";
						$result_ass_grouter= execute_sql($database_name2, $sql_ass_grouter, $link2);
						 while ($row_ass_grouter= mysql_fetch_assoc($result_ass_grouter)  )
							{
										
								
								?>
								<tr>
								<th><?php
								$key = $row_ass_grouter['ass_ap_city'];
											$sql_0 = "SELECT city_name FROM city_array  where id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['city_name'];
											}
								
								
								
								?></th>
								<th><?php
								
									$key = $row_ass_grouter['ass_ap_twon'];
										$sql_0 = "SELECT township_name	 FROM city_township  where township_id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['township_name'];
											}
								
								
								?></th>
								<th><?=$row_ass_grouter['ass_ap_name'];?></th>
								<th><?=$row_ass_grouter['ass_ap_label'];?></th>
								<th><?=$row_ass_grouter['ass_ap_sn'];?></th>
								<th><?=$row_ass_grouter['ass_ap_ip'];?></th>
								<th><?=$row_ass_grouter['ass_ap_mac'];?></th>
								<th><?=$row_ass_grouter['ass_ap_pn'];?></th>
																
								</tr>
								<?php
								
							}

?>
					<tr><th>其他</th></tr>
					<?php
						$sql_ass_grouter="SELECT * FROM  ass_other where ass_other_tribe='$tribe_id' ";
						$result_ass_grouter= execute_sql($database_name2, $sql_ass_grouter, $link2);
						 while ($row_ass_grouter= mysql_fetch_assoc($result_ass_grouter)  )
							{
										
								
								?>
								<tr>
								<th><?php
								$key = $row_ass_grouter['ass_other_city'];
											$sql_0 = "SELECT city_name FROM city_array  where id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['city_name'];
											}
								
								
								//$row_ass_grouter['ass_other_twon'];?></th>
								<th><?php
								
								$key = $row_ass_grouter['ass_other_twon'];
										$sql_0 = "SELECT township_name	 FROM city_township  where township_id = '$key' "	;
											$result_0 = execute_sql($database_name2, $sql_0, $link2);
											//echo $sql_0 ;
											while ($row_0= mysql_fetch_assoc($result_0)  )
											{
												echo $row_0['township_name'];
											}
								
								
								//$row_ass_grouter['ass_other_twon'];?></th>
								<th><?=$row_ass_grouter['ass_other_name'];?></th>
								<th><?=$row_ass_grouter['ass_other_label'];?></th>
								<th><?=$row_ass_grouter['ass_other_sn'];?></th>
								<th><?=$row_ass_grouter['ass_other_ip'];?></th>
								<th><?=$row_ass_grouter['ass_other_mac'];?></th>
								<th><?=$row_ass_grouter['ass_other_pn'];?></th>
																
								</tr>
								<?php
								
							}


						
			
			}	
				
	?>		
				
	</table>

		<script>
	/*
		function myFunction() {
			$(function() {
				$(".table2excel").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "<?=$day;?>部落資產總表",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			});
			}
			*/
			
			$(function() 
			{
				$(".table2excel").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "<?=$day;?>第二期部落資產總表",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
				window.close();
			}
			);
			
			
			
		</script>
	</body>
</html>
