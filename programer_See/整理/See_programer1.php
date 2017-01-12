<head>
<meta http-equiv="refresh" content="1800" />
</head>
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
<?php

	
	include("../SQL/dbtools.inc.php");
	$link = create_connection();
	include("../SQL/dbtools_ps_2.php");
	$conn= create_ps_connection();

?>
<table class="table2excel"  id="table2excel" >
		<thead>
			<tr>
			<th>中断代號</th>
			<th>事件代號</th>
			<th>縣市</th>
			<th>地區</th>
			<th>部落</th>
			<th>設備名稱</th>
			<th>IP</th>
			<th>斷線時間</th>
			<th>回復時間</th>
			</tr>
	</thead>		
	<tbody>	
   <?php
			
			$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
			INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
			where serviceid=2 and iflostservice >'2016-11' ORDER BY iflostservice desc";
			
			//where serviceid=2 and iflostservice like '%2016%' ORDER BY iflostservice desc";
			$result_outages = pg_query($conn,$sql_text );
			$total_records2 = pg_num_rows($result_outages);

			while ($row_outages = pg_fetch_row($result_outages) )
			{
			$iflostservice =$row_outages[0];//斷線時間	
			$ifregainedservice =$row_outages[2];//斷線時間	
			$events_id=$row_outages[5];//eventid	
			
			$outageid_pg  =   $row_outages[3];              //outageid	代號
			$svclosteventid_pg  =  $row_outages[5];       //svclosteventid 代號	
			
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
			$ass_ap_name = $row_AP['ass_ap_name'];
			$ass_ap_ip = $row_AP['ass_ap_ip'];
		
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
			<td> <?=$outageid_pg;?> </td>
			<td><?=$svclosteventid_pg;?> </td>
			<td><?php

			//echo  $row_AP['ass_ap_city'];
			$sql_city = "SELECT * FROM city_array  where  id='$ass_ap_city' ";
			$result_city = execute_sql($database_name, $sql_city, $link);
			while ($row_city = mysql_fetch_assoc($result_city))
			{ 
			$city_name =$row_city['city_name'];
			echo  $city_name ;		
			}
			?></td>
			<td><?php

			//echo  $row_AP['ass_ap_city'];
			$sql_township = "SELECT * FROM city_township  where  township_id='$ass_ap_twon' ";
			$result_township = execute_sql($database_name, $sql_township, $link);
			while ($row_township = mysql_fetch_assoc($result_township))
			{ 
			$township_name = $row_township['township_name'];
             echo  $township_name ;
			}
			?></td>
			<td><?php

			//echo  $row_AP['ass_ap_city'];
			$sql_tribe = "SELECT * FROM  tribe  where  tribe_id='$ass_ap_tribe' ";
			$result_tribe = execute_sql($database_name, $sql_tribe, $link);
			while ($row_tribe = mysql_fetch_assoc($result_tribe))
			{ 
			$tribe_name = $row_tribe['tribe_name'];
			echo $tribe_name;
			}
			?></td>
			<td><?=$row_AP['ass_ap_name'];?></td>
			<td><?=$row_AP['ass_ap_ip'];?></td>
			<td><?php
			$output = explode(":", $iflostservice);
			$output1 =  $output[0];	
			$output11 = explode(" ", $output1);
			
			
			//echo $output11[0];
			
			$pII = explode("-", $output11[0]);
			if($pII[2]<10){ 
					$pII[2]='0'.$pII[2];
			}else{ 
					 $pII[2]=$pII[2];
			}
			
			if($output11[1]<10){ 
						$output11[1]= '0'.$output11[1];
						}else{ 
						 $output11[1]=$output11[1];
						}
			if($output[1]<10){ $output[1] ='0'.$output[1];}else{  $output[1]=$output[1];}
			
			$YMD_string = $pII[0].'-'.$pII[1].'-'.$pII[2].' '.$output11[1].':'.$output[1];
			
			echo  $YMD_string;
			/*
			echo ' ';
			if($output11[1]<10){ echo '0'.$output11[1];}else{ echo $output11[1]=$output11[1];}
			echo ':';
			if($output[1]<10){ echo '0'.$output[1];}else{ echo $output[1]=$output[1];}
			//if($output[2]<10){ echo '0'.$output[2];}else{ echo $output[2]=$output[2];}
			*/
			
			
			?></td>
			<td><?php
			//echo $ifregainedservice;
			
			$output = explode(":", $ifregainedservice);
			$output1 =  $output[0];
			$output11 = explode(" ", $output1);
			//echo $output11[0];
			//echo ' ';
			if(empty($output[1]))
			{
				$YMD_string_2 = '';
			}else{
			if($output11[1]<10){ $output11[1]= $output11[1];}else{  $output11[1]=$output11[1];}
			if($output[1]<10){ $output[1]=$output[1];}else{  $output[1]=$output[1];}			
			$YMD_string_2 =  $output11[0].' '.$output11[1].':'.$output[1];
			}
		
			echo  $YMD_string_2;
			?></td>
			
			</tr>
			<?php
				$alert_ap_date_setting =$ass_ap_city.'-'.$ass_ap_twon.'-'.$ass_ap_tribe;
		
				//outageid_pg svclosteventid_pg city_name
			$sql = "SELECT * FROM alert_ap_date WHERE alert_ap_date_outageid ='$outageid_pg' AND alert_ap_date_svclosteventid ='$svclosteventid_pg' ";
			$result = execute_sql($database_name, $sql, $link);
			$number = mysql_num_rows($result);	
			if($number==0)
			{
				$sql = "INSERT INTO alert_ap_date(alert_ap_date_outageid, alert_ap_date_svclosteventid, alert_ap_date_city,alert_ap_date_township,alert_ap_date_tribe,alert_ap_date_ap_name,alert_ap_date_ap_ip,alert_ap_date_time_dead,alert_ap_date_time_ok,alert_ap_date_setting)
				VALUES('$outageid_pg','$svclosteventid_pg','$city_name','$township_name','$tribe_name','$ass_ap_name','$ass_ap_ip','$YMD_string','$YMD_string_2','$alert_ap_date_setting')";
				execute_sql($database_name, $sql, $link);
			}else{
				$sql = "UPDATE alert_ap_date SET alert_ap_date_time_dead='$YMD_string',alert_ap_date_time_ok='$YMD_string_2' WHERE alert_ap_date_outageid='$outageid_pg' and alert_ap_date_svclosteventid ='$svclosteventid_pg'";
				execute_sql($database_name, $sql, $link);
			}
				
				
			?>
			
			<?php
			}
			}
			}
			}
			///$check_ip_death = implode(",",$array);
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
				//lengthMenu: [
				//[ 10, 25, 50, -1 ],
				//[ '10 筆', '25 筆', '50 筆', '全部' ]
				//],
					"pageLength":" 50",
					"bFilter": false, //开关，是否启用客户端过滤器
					"bPaginate": false, //开关，是否显示分页器
					"bInfo": true, //开关，是否显示表格的一些信息，允许或者禁止表信息的显示，默认为 true，显示信息。
			 dom: 'Bfrtip',	 buttons: 
			 [
					{ extend: 'excelHtml5', text: '匯出報表' ,title: '<?= date("Y-m-d");?>報表' },
						
			],
	   };
  $("#table2excel").dataTable(opt);
  });
</script>	