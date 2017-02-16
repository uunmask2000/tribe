<!DOCTYPE html>
<html>
	<head>
		<title>無線AP網管系統</title>
		<link href="../include/style.css" rel="stylesheet" type="text/css" />
		<link href="../include/reset.css" rel="stylesheet" type="text/css" />
		
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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
	

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	
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
	<div id="wrap">
			<!-------------------------------------- TOP -->
		<div id="header">
			<?php include("../include/top.php"); ?>
		</div>
	 <div class="report">
		<table class="table2excel"  id="table2excel">
			<thead>
			<tr>
		
			<th>縣市</th>
			<th>地區</th>
			<th>部落</th>
			<th>設備名稱</th>
			<th>斷線時間</th>	
			<th>狀態</th>
			</tr>
			</thead>			
			<tbody>


			<?php
			//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
						include("../SQL/dbtools_ps_2.php");
						include("../SQL/dbtools.inc.php");
						$link = create_connection();
						$conn= create_ps_connection();
			$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid,svcregainedeventid  FROM (SELECT * FROM outages ) AS  outages 
			INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
			where serviceid=2 and  ifregainedservice is NULL ";
			$result_outages = pg_query($conn,$sql_text );
			$total_records2 = pg_num_rows($result_outages);

			while ($row_outages = pg_fetch_row($result_outages) )
			{
			$iflostservice =$row_outages[0];//斷線時間	
			$events_id=$row_outages[5];//svclosteventid
			$svcregainedeventid=$row_outages[6];//svcregainedeventid
			
			$sql_events =" SELECT nodeid	FROM events where eventid='$events_id'   ";
			$result_events = pg_query($conn,$sql_events );//echo  $sql_events ;

			while ($row_events = pg_fetch_row($result_events) )
			{
			$node_id = $row_events[0];
			$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'   ";
			$result_ipinterface = pg_query($conn,$sql_ipinterface );	
			while ($row_ipinterface = pg_fetch_row($result_ipinterface) and  $j <= $total_records2 )
			{
			//echo $row_ipinterface[0];
			//echo '<br>';
			//`ass_grouter_address`='$addid'  
			$query_ip = $row_ipinterface[0];
			//echo  $query_ip ;
			//echo '<br>';
			//echo $j;
			//$array[$j] = $query_ip;
			//$j++;
			$sql_AP = "SELECT * FROM ass_ap  where  ass_ap_ip='$query_ip'  ";
			$result_AP = execute_sql($database_name, $sql_AP, $link);
			while ($row_AP = mysql_fetch_assoc($result_AP))
			{ 	
			$ass_ap_city =$row_AP['ass_ap_city'] ;
			$ass_ap_twon =$row_AP['ass_ap_twon'] ;
			$ass_ap_tribe =$row_AP['ass_ap_tribe'] ;
			/*

			echo '<br>';
			echo $row_AP['ass_ap_twon'];
			echo '<br>';
			echo $row_AP['ass_ap_tribe'];
			echo '<br>';
			echo $row_AP['ass_ap_name'];
			echo '<br>';
			echo $iflostservice;
			echo '<br>';
			echo $query_ip;
			echo '<br>';
			*/
			?>
			<tr>
		
			<td><?php

			//echo  $row_AP['ass_ap_city'];
			$sql_city = "SELECT * FROM city_array  where  id='$ass_ap_city' ";
			$result_city = execute_sql($database_name, $sql_city, $link);
			while ($row_city = mysql_fetch_assoc($result_city))
			{ 
			echo  $row_city['city_name'];

			}
			?></td>
			<td><?php

			//echo  $row_AP['ass_ap_city'];
			$sql_township = "SELECT * FROM city_township  where  township_id='$ass_ap_twon' ";
			$result_township = execute_sql($database_name, $sql_township, $link);
			while ($row_township = mysql_fetch_assoc($result_township))
			{ 
			echo  $row_township['township_name'];

			}
			?></td>
			<td><?php

			//echo  $row_AP['ass_ap_city'];
			$sql_tribe = "SELECT * FROM  tribe  where  tribe_id='$ass_ap_tribe' ";
			$result_tribe = execute_sql($database_name, $sql_tribe, $link);
			while ($row_tribe = mysql_fetch_assoc($result_tribe))
			{ 
			echo  $row_tribe['tribe_name'];

			}
			?></td>
			<td><?=$row_AP['ass_ap_name'];?></td>
			<td><?php
			$output = explode(":", $iflostservice);
			$output1 =  $output[0];
			$output11 = explode(" ", $output1);
			echo $output11[0];
			echo ' ';
			if($output11[1]<10){ echo '0'.$output11[1];}else{ echo $output11[1]=$output11[1];}
			echo ':';
			if($output[1]<10){ echo '0'.$output[1];}else{ echo $output[1]=$output[1];}
			//if($output[2]<10){ echo '0'.$output[2];}else{ echo $output[2]=$output[2];}
			?></td>
			<td>斷線中</td>
			</tr>
			<?php
			}
			}
			}
			}
			///$check_ip_death = implode(",",$array);
			?>	
			</tbody>
		</table>
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
									//lengthMenu: [
									//[ 10, 25, 50, -1 ],
									//[ '10 筆', '25 筆', '50 筆', '全部' ]
									//],
									"pageLength":" 50",
									"bFilter": false, //开关，是否启用客户端过滤器
									"bPaginate": false, //开关，是否显示分页器
									"bInfo": true, //开关，是否显示表格的一些信息，允许或者禁止表信息的显示，默认为 true，显示信息。
									/*
									dom: 'Bfrtip',	 buttons: 
									[
									{ extend: 'excelHtml5', text: '匯出愛台灣服務效益月報表' ,title: '<?= date("Y-m-d");?>愛台灣服務效益月報表' },
									//{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>服務效益分析年報表' },	
									//'pageLength',				
									],
									*/
									};
									$("#table2excel").dataTable(opt);
									});
									</script>
			<div class="c"></div>
			<!-------------------------------------- FOOTER -->
			<div id="footer">
			<?php include("../include/bottom.php"); ?>
	</div>
		


</div>
</body>
</html>