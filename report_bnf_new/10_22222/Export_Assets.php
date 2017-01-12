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
		<tr>
			<th>期別</th>
			<th>縣市</th>
			<th>地區</th>
			<th>部落</th>
			<th>設備類型</th>
			<th>設備名稱</th>
			<th>SN</th>
			<th>IP</th>
			<th>MAC</th>
			<th>P/N</th>									
		</tr>
		
		<?php
		  $sql_tribe="SELECT * FROM tribe WHERE tribe_label=2 ORDER BY `tribe`.`city_id` ASC ,`tribe`.`tribe_name` ASC ";
			$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
			while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				$tribe_id = $row_tribe['tribe_id'];
				$tribe_label = $row_tribe['tribe_label'];
				
						
						//FW
						$sql_FW ="SELECT * FROM `ass_grouter` WHERE `ass_grouter_tribe` = '$tribe_id' ";
						$result_FW= execute_sql($database_name2, $sql_FW, $link2);
						while ($row_FW= mysql_fetch_assoc($result_FW)  )
						{
						echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							
							echo '<td>'.'Router'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_FW['ass_name'].'&nbsp;</td>';
							echo '<td>'.$row_FW['ass_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_FW['ass_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_FW['ass_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_FW['ass_pn'].'&nbsp;</td>'	;
							echo  '</tr>';	
						}
						
						//4G_Router
						$sql_4Gg_Router ="SELECT * FROM `ass_4Ggrouter` WHERE `ass_4Ggrouter_tribe` = '$tribe_id' ";
						$result_4Gg_Router= execute_sql($database_name2, $sql_FW, $link2);
						while ($row_4Gg_Router= mysql_fetch_assoc($result_4Gg_Router)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'4G Router'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_4Gg_Router['ass_4Gname'].'&nbsp;</td>';
							echo '<td>'.$row_4Gg_Router['ass_4Gsn'].'&nbsp;</td>'	;
							echo '<td>'.$row_4Gg_Router['ass_4Gip'].'&nbsp;</td>'	;
							echo '<td>'.$row_4Gg_Router['ass_4Gmac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_4Gg_Router['ass_4Gpn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//AP
						$sql_AP ="SELECT * FROM `ass_ap` WHERE `ass_ap_tribe` = '$tribe_id' ";
						$result_AP= execute_sql($database_name2, $sql_AP, $link2);
						while ($row_AP= mysql_fetch_assoc($result_AP)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'AP'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_AP['ass_ap_name'].'&nbsp;</td>';
							echo '<td>'.$row_AP['ass_ap_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_AP['ass_ap_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_AP['ass_ap_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_AP['ass_ap_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_poesw
						$sql_poesw ="SELECT * FROM `ass_poesw` WHERE `ass_poesw_tribe` = '$tribe_id' ";
						$result_poesw= execute_sql($database_name2, $sql_poesw, $link2);
						while ($row_poesw= mysql_fetch_assoc($result_poesw)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'PoE/SW'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_poesw['ass_poesw_name'].'&nbsp;</td>';
							echo '<td>'.$row_poesw['ass_poesw_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_poesw['ass_poesw_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_poesw['ass_poesw_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_poesw['ass_poesw_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_pdu
						$sql_pdu ="SELECT * FROM `ass_pdu` WHERE `ass_pdu_tribe` = '$tribe_id' ";
						$result_pdu= execute_sql($database_name2, $sql_pdu, $link2);
						while ($row_pdu= mysql_fetch_assoc($result_pdu)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'PDU'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_pdu['ass_pdu_name'].'&nbsp;</td>';
							echo '<td>'.$row_pdu['ass_pdu_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_pdu['ass_pdu_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_pdu['ass_pdu_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_pdu['ass_pdu_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_other
						$sql_other ="SELECT * FROM `ass_other` WHERE `ass_other_tribe` = '$tribe_id' ";
						$result_other= execute_sql($database_name2, $sql_other, $link2);
						while ($row_other= mysql_fetch_assoc($result_other)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'其他'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_other['ass_other_name'].'&nbsp;</td>';
							echo '<td>'.$row_other['ass_other_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_other['ass_other_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_other['ass_other_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_other['ass_other_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						
						
						
					
			
			}

		
		?>
			
             <!---------------- 分隔   ---------------->

		<?php
		  $sql_tribe="SELECT * FROM tribe WHERE tribe_label=3 ORDER BY `tribe`.`city_id` ASC ,`tribe`.`tribe_name` ASC ";
			$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
			while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				$tribe_id = $row_tribe['tribe_id'];
				$tribe_label = $row_tribe['tribe_label'];
				
						
						//FW
						$sql_FW ="SELECT * FROM `ass_grouter` WHERE `ass_grouter_tribe` = '$tribe_id' ";
						$result_FW= execute_sql($database_name2, $sql_FW, $link2);
						while ($row_FW= mysql_fetch_assoc($result_FW)  )
						{
						echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							
							echo '<td>'.'F/W'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_FW['ass_name'].'&nbsp;</td>';
							echo '<td>'.$row_FW['ass_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_FW['ass_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_FW['ass_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_FW['ass_pn'].'&nbsp;</td>'	;
							echo  '</tr>';	
						}
						
						//4Gg_Router
						$sql_4Gg_Router ="SELECT * FROM `ass_4Ggrouter` WHERE `ass_4Ggrouter_tribe` = '$tribe_id' ";
						$result_4Gg_Router= execute_sql($database_name2, $sql_FW, $link2);
						while ($row_4Gg_Router= mysql_fetch_assoc($result_4Gg_Router)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'4Gg_Router'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_4Gg_Router['ass_4Gname'].'&nbsp;</td>';
							echo '<td>'.$row_4Gg_Router['ass_4Gsn'].'&nbsp;</td>'	;
							echo '<td>'.$row_4Gg_Router['ass_4Gip'].'&nbsp;</td>'	;
							echo '<td>'.$row_4Gg_Router['ass_4Gmac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_4Gg_Router['ass_4Gpn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//AP
						$sql_AP ="SELECT * FROM `ass_ap` WHERE `ass_ap_tribe` = '$tribe_id' ";
						$result_AP= execute_sql($database_name2, $sql_AP, $link2);
						while ($row_AP= mysql_fetch_assoc($result_AP)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'AP'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_AP['ass_ap_name'].'&nbsp;</td>';
							echo '<td>'.$row_AP['ass_ap_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_AP['ass_ap_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_AP['ass_ap_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_AP['ass_ap_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_poesw
						$sql_poesw ="SELECT * FROM `ass_poesw` WHERE `ass_poesw_tribe` = '$tribe_id' ";
						$result_poesw= execute_sql($database_name2, $sql_poesw, $link2);
						while ($row_poesw= mysql_fetch_assoc($result_poesw)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'PoE/SW'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_poesw['ass_poesw_name'].'&nbsp;</td>';
							echo '<td>'.$row_poesw['ass_poesw_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_poesw['ass_poesw_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_poesw['ass_poesw_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_poesw['ass_poesw_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_pdu
						$sql_pdu ="SELECT * FROM `ass_pdu` WHERE `ass_pdu_tribe` = '$tribe_id' ";
						$result_pdu= execute_sql($database_name2, $sql_pdu, $link2);
						while ($row_pdu= mysql_fetch_assoc($result_pdu)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'PDU'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_pdu['ass_pdu_name'].'&nbsp;</td>';
							echo '<td>'.$row_pdu['ass_pdu_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_pdu['ass_pdu_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_pdu['ass_pdu_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_pdu['ass_pdu_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_other
						$sql_other ="SELECT * FROM `ass_other` WHERE `ass_other_tribe` = '$tribe_id' ";
						$result_other= execute_sql($database_name2, $sql_other, $link2);
						while ($row_other= mysql_fetch_assoc($result_other)  )
						{
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
							echo '<td>'.'其他'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_other['ass_other_name'].'&nbsp;</td>';
							echo '<td>'.$row_other['ass_other_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_other['ass_other_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_other['ass_other_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_other['ass_other_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
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
					filename: "<?=$day;?>部落資產總表",
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
