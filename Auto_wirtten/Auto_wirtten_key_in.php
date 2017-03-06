	<?php 
	///include("../include/top.php"); 
	include_once("../SQL/dbtools.inc.php");
	$link = create_connection(); 
	?>
<style type="text/css">
table,td,th
  {
  border:1px solid black;
  }

table
  {
  width:100%;
  }

th
  {
  height:50px;
  }
</style>	
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


<form action="./action_page.php" method="POST">		
<table id="show_date">
	<thead>
		<tr>
		<th></th>
			<th>叫修編號</th>
			<th>期別</th>
			<th>部落</th>
			<th>設備</th>
			<th>IP</th>
			<th>中斷時間</th>
			<th>處理編號</th>	

		</tr>
	</thead>
<tbody>	

<?php

$sql = "SELECT *  FROM  alert_ap_date_filter where  Processing_status ='已發信'  ";
$result = execute_sql($database_name, $sql, $link);
while ($row = mysql_fetch_assoc($result))
{
	?>
	<tr>
	<td>
	<input type="checkbox" name="checkbox_ok[]" value="<?=$row['alert_ap_date_filter_id'];?>"> <br>
	</td>
	<td><?=$row['alert_ap_date_filter_id'];?></td>
	<td><?=$row['Period_AP'];?></td>
	<td><?=$row['alert_ap_date_tribe'];?></td>
	<td><?=$row['alert_ap_date_ap_name'];?></td>
	<td><?=$row['alert_ap_date_ap_ip'];?></td>
	<td><?=$row['alert_written_time'];?></td>
	<td><?=$row['alert_ap_date_time_ok'];?></td>
	</tr>
	<?php
}


?>
</tbody>	
 
</table>
 <input type="submit" value="處理">
</form>

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
				//{ extend: 'excelHtml5', text: '匯出服務中斷數量統計表(當前)' ,title: '2017-01-10服務中斷數量統計表' },
				//{ extend: 'print', text: '列印',title: '2017-01-10服務中斷數量統計表' },	
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>	