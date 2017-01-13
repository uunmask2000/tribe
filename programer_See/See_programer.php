<!DOCTYPE html>
<html>
<head>
		<title>無線AP網管系統</title>
		<link href="../include/reset.css" rel="stylesheet" type="text/css">
		<link href="../include/style.css" rel="stylesheet" type="text/css">

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

		<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	
}
th { background:#ddd;}
td, th {
    border: 1px solid #aaa;
    text-align: center;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #aaa;
}
</style>
</head>
	
<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php include("../include/top.php"); ?>
	</div>

	<div class="main">	


		<div id="port_data">
		<table class="table2excel" id="table2excel">
			<thead>
			<tr>
			<!---
			<th>縣市</th>
			<th>地區</th>
			--->
			<th>期別</th>
			<th>部落</th>
			
			<th>設備名稱</th>
			<th>IP</th>
			<th>服務中斷時間</th>	
			<th>狀態</th>
			</tr>
			</thead>			
			<tbody>


			<?php
			//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
						//include("../SQL/dbtools_ps_2.php");
						include("../SQL/dbtools.inc.php");
						$link = create_connection();
						//$conn= create_ps_connection();
				$sql2="SELECT * FROM alert_ap_date_filter  where  alert_ap_date_time_ok='0000-00-00 00:00:00'  ORDER BY `alert_ap_date_filter`.`alert_ap_date_filter_id` DESC   ";
				//$sql2="SELECT * FROM alert_ap_date_filter  where  alert_ap_date_time_ok='0000-00-00 00:00:00' and  alert_ap_date_ap_ip<>'172.21.11.121'  ORDER BY `alert_ap_date_filter`.`alert_ap_date_filter_id` DESC   ";  /// 2016.11.21 暫時遮蔽 大社AP4
				
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row = mysql_fetch_assoc($result2) )
				{
					//$alert_ap_date_city   =$row['alert_ap_date_city'];
					//$alert_ap_date_township=$row['alert_ap_date_township'];
					$alert_ap_date_tribe=$row['alert_ap_date_tribe'];
					$alert_ap_date_ap_name=$row['alert_ap_date_ap_name'];
					$alert_ap_date_ap_ip=$row['alert_ap_date_ap_ip'];
					$alert_ap_date_time_dead=$row['alert_ap_date_time_dead'];  //真實
					$alert_written_time=$row['alert_written_time'];  // 不真實
					
					$sql3="SELECT * FROM tribe WHERE tribe_name='$alert_ap_date_tribe'   ";
					$result3 = execute_sql($database_name, $sql3, $link);
					while ($row3 = mysql_fetch_assoc($result3) )
					{
					    $tribe_label = $row3['tribe_label'];
					}
					
					
					?>
					<tr>
					<td><?=$tribe_label; ?></td>
					<td><?=$alert_ap_date_tribe ;?></td>
					<td><?=$alert_ap_date_ap_name ;?></td>
					<td><?=$alert_ap_date_ap_ip ;?></td>
					
					
					<td><?=$alert_ap_date_time_dead ;?></td>
					<td>服務中斷</td>
					</tr>				
					<?php
					
				}		
			?>
			</tbody>
		</table>
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
</html>