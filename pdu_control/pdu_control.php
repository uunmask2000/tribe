<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<style>
table.alert_tb { width:100%; border-collapse: collapse;}
table.alert_tb tr th {
background:#f3c641;
}
table.alert_tb tr td ,table.alert_tb th {
	padding: 7px;
    text-align: center;
    border: #aaa 1px solid;
}

.alert_tt {padding:7px; margin:0 0 10px;}
</style>
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
	<?php
	include("../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

	<?php include("../alert/alert2.php");?>

	<div id="port_data">

	<table id="show_date"  class="alert_tb">
    <thead>
	<tr>
		<th>部落</th>
		<th>IP</th>
	</tr>
    </thead>
    <tbody>
	  <?php
	   date_default_timezone_set("Asia/Taipei");
	  	//require_once("dbtools.inc.php");
			include("../SQL/dbtools.inc.php");
			$link = create_connection();
          
				$sql_PDU="SELECT * FROM pdu_control_					";
				$result_PDU= execute_sql($database_name, $sql_PDU, $link);
				while ($row_PDU= mysql_fetch_assoc($result_PDU)  )
				{
						$pdu_control_name  = $row_PDU['pdu_control_name'];
						//echo '這是第一行<br>';
						$pdu_control_ip   = $row_PDU['pdu_control_ip'];
						//echo '這是第一行<br>';
						
						
					?>
					<tr>
						<td><?=$pdu_control_name ;?></td>
						<td><?=$pdu_control_ip ;?></td>
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
</html>
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
				{ extend: 'excelHtml5', text: '匯出' ,title: '<?= date("Y-m-d");?>匯出' },
			
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>