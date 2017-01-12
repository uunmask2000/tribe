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

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
		<?php include("../include/top.php"); 
		?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">
		
		<?php include("../alert/alert2.php"); ?>

		
	<div class="defend">

<?php

//echo $_GET['ip'];
     $ip = $_GET['ip'];
	include_once("../SQL/dbtools.inc.php");
	$link = create_connection();
	echo '<H1>';
	$sql_router = "SELECT *  FROM  ass_grouter where ass_ip='$ip '  ";
	$result_router = execute_sql($database_name, $sql_router, $link);
	while ($row_router = mysql_fetch_assoc($result_router))
	{
		$ass_grouter_city =  $row_router['ass_grouter_city'];
		$ass_grouter_twon =  $row_router['ass_grouter_twon'];
		$ass_grouter_tribe =  $row_router['ass_grouter_tribe'];
		$ass_ip =  $row_router['ass_ip'];
		$ass_name =  $row_router['ass_name'];
		$ass_grouter_id =  $row_router['ass_grouter_id'];
		//echo $ass_name ;
		echo '<a href="http://'.$ass_ip.'">'.$ass_name.'</a>';
	}
	echo '</H1>';
	echo '<H2>';
	$sql_query = "SELECT *  FROM  city_array where id='$ass_grouter_city '  ";
	$result_query = execute_sql($database_name, $sql_query, $link);
	while ($row_query = mysql_fetch_assoc($result_query))
	{
		echo $row_query['city_name'];
		$city_name_row = $row_query['city_name'];
	}
	
	$sql_query = "SELECT *  FROM  city_township where township_id='$ass_grouter_twon '  ";
	$result_query = execute_sql($database_name, $sql_query, $link);
	while ($row_query = mysql_fetch_assoc($result_query))
	{
		echo $row_query['township_name'];
		$township_name_row = $row_query['township_name'];
	}
	
	$sql_query = "SELECT *  FROM  tribe where tribe_id='$ass_grouter_tribe '  ";
	$result_query = execute_sql($database_name, $sql_query, $link);
	while ($row_query = mysql_fetch_assoc($result_query))
	{
		echo $row_query['tribe_name'];
		$tribe_name_row = $row_query['tribe_name'];
	}
	//echo $ass_ip ;
	echo '</H2>';
	//echo '<br>';
	
	
		?>
			<table  id="show_old_date">
			<thead>
			<tr><th colspan="7" style="background:#efe125;">更換履歷</th></tr>
			<tr>
			<th>時間</th>
			<th>資產名稱</th>
			<th>S/N</th>
			<th>MAC</th>
			<th>P/N</th>
			<th>理由</th>
			<th>期別</th>
			</tr>
			</thead>
			<tbody>
			<?php 
			/*
			for($ii=0 ; $ii <200 ;$ii++)
			{
				?>
				<tr>
				<td>斷電時間1<?=$ii ;?></td>
				<td>復電時間2<?=$ii ;?></td>
				<td>斷電時間3<?=$ii ;?></td>
				<td>復電時間4<?=$ii ;?></td>
				<td>斷電時間5<?=$ii ;?></td>
				<td>復電時間6<?=$ii ;?></td>
				<td>斷電時間7<?=$ii ;?></td>
				</tr>
				<?php
			}
			*/
				$sql_change = "SELECT *  FROM  ass_change_router where ass_change_own_router='$ass_grouter_id' ORDER BY ass_change_time_router asc  ";
				$result_change = execute_sql($database_name, $sql_change, $link);
				while ($row_change = mysql_fetch_assoc($result_change))
				{
						?>
						<tr>
						<td><?=$row_change['ass_change_time_router'] ;?></td>
						<td><?=$row_change['ass_change_name_router'] ;?></td>
						<td><?=$row_change['ass_change_sn_router'] ;?></td>
						<td><?=$row_change['ass_change_mac_router'] ;?></td>
						<td><?=$row_change['ass_change_pn_router'] ;?></td>
						<td><?=$row_change['ass_change_note_router'] ;?></td>
						<td><?=$row_change['ass_change_label_router'] ;?></td>
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
      $("#show_old_date").dataTable(opt);
      });
  </script>
	
	
	<?php
	
//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
	include("../SQL/dbtools_ps_2.php");
	$conn= create_ps_connection();
		$sql_ipinterface ="SELECT * FROM ipinterface where ipaddr ='$ass_ip' ";
		$result_ipinterface = pg_query($conn,$sql_ipinterface );
		while ($row_ipinterface = pg_fetch_assoc($result_ipinterface) )
		{   
			//echo $row_outages['id'];
			//echo '<br>';
			//echo $row_outages['nodeid'];
			//echo '<br>';
				
				?>
					<table  id="show_date">
				<thead>
				<tr>
					<th>縣市</th>
				<th>地區</th>
				<th>部落</th>
				<th>設備名稱</th>
				<th>失連時間</th>
				<th>復歸時間</th>
				</tr>
			</thead>
			<tbody>
				<?php
			
			$nodeid = $row_ipinterface['nodeid'];
			$sql_events ="SELECT * FROM events where nodeid	 ='$nodeid' ORDER BY eventid DESC ";
			$result_events = pg_query($conn,$sql_events );
			while ($row_events = pg_fetch_assoc($result_events) )
			{ 
				//echo  $row_events['eventid'];
				//echo '<br>';
			      $eventid = $row_events['eventid'];
					$sql_text ="SELECT iflostservice,ifregainedservice,ifserviceid  FROM outages where svclosteventid ='$eventid' ";
					$result_outages = pg_query($conn,$sql_text );
					//echo  $sql_text;
					//$total_records2 = pg_num_rows($result_outages);
				
					while ($row_outages = pg_fetch_assoc($result_outages) )
					{
					 /*
					$city_name_row
	$township_name_row
	$tribe_name_row
				$ass_grouter_city
				$ass_grouter_twon
				$ass_grouter_tribe
				$ass_name
					 */
						echo '<tr>';
						echo '<td>'.$city_name_row.'</td>';
						echo '<td>'.$township_name_row.'</td>';
						echo '<td>'.$tribe_name_row.'</td>';
						//echo '<td>'.$ass_name.'</td>';
						echo '<td><a href="http://'.$ass_ip.'"   title="'.$ass_name.'">'.$ass_name.'</a></td>';
						
							echo '<td>';
						//echo  substr($row_outages['iflostservice'], 0, 19) ;
							$output = explode(":", $row_outages['iflostservice']);
							$output1 =  $output[0];
							$output11 = explode(" ", $output1);
							echo $output11[0];
							echo ' ';
							if($output11[1]<10){ echo $output11[1];}else{ echo $output11[1]=$output11[1];}
							echo ':';
							if($output[1]<10){ echo $output[1];}else{ echo $output[1]=$output[1];}
						echo '</td>';
												
						echo '<td>';
						//echo  substr($row_outages['iflostservice'], 0, 19) ;
							$output = explode(":", $row_outages['ifregainedservice']);
							$output1 =  $output[0];
							$output11 = explode(" ", $output1);
							echo $output11[0];
							echo ' ';
							if($output11[1]<10){ echo $output11[1];}else{ echo $output11[1]=$output11[1];}
							echo ':';
							if($output[1]<10){ echo $output[1];}else{ echo $output[1]=$output[1];}
						echo '</td>';
						echo '</tr>';
						
						
						
					}				 
			
				  
			}
				echo '</tbody>';	
			  echo '</table>';
			
		}		  
			
	
	
?>

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
				{ extend: 'excelHtml5', text: '匯出斷線歷史紀錄' ,title: '<?= date("Y-m-d");?> Router斷線歷史紀錄' },
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>


	</div>
</div>	

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>