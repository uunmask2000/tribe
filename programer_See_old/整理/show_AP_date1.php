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
			<th>相差時間</th>
			</tr>
	</thead>		
	<tbody>	
		<?php
			$sql_alert_ap_date  = "SELECT *,TIMEDIFF(alert_ap_date_time_ok,alert_ap_date_time_dead) FROM alert_ap_date  ";
			$result_alert_ap_date  = execute_sql($database_name, $sql_alert_ap_date, $link);
			while ($row_alert_ap_date  = mysql_fetch_assoc($result_alert_ap_date))
			{  
		      ?>
			  <tr>
				<td><?=$row_alert_ap_date['alert_ap_date_outageid']; ?></td>
				<td><?=$row_alert_ap_date['alert_ap_date_svclosteventid']; ?></td>
				<td><?=$row_alert_ap_date['alert_ap_date_city']; ?></td>
				<td><?=$row_alert_ap_date['alert_ap_date_township']; ?></td>
				<td><?=$row_alert_ap_date['alert_ap_date_tribe']; ?></td>
				<td><?=$row_alert_ap_date['alert_ap_date_ap_name']; ?></td>
				<td><?=$row_alert_ap_date['alert_ap_date_ap_ip']; ?></td>
				<td><?=$row_alert_ap_date['alert_ap_date_time_dead']; ?></td>
				<td><?=$row_alert_ap_date['alert_ap_date_time_ok']; ?></td> 
				<td><?=$row_alert_ap_date['TIMEDIFF(alert_ap_date_time_ok,alert_ap_date_time_dead)']; ?></td> 
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