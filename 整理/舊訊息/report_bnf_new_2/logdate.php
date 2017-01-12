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
<?php
/// 此頁 測試功能
		include_once("../SQL/dbtools_ps.php");
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		?>
		
		<table  id="show_date" >
					<thead>
					
					<tr>
					<th>縣市</th>
					<th>地區</th>
					<th>部落</th>
					<th>設備名稱</th>
					<th>單位</th>
					<th style="word-break:break-all; ">使用者帳戶</th>
					<th>配發IP</th>
					<th>使用開始時間</th>
					<th>使用結束時間</th>
					</tr>
					</thead>
				<tbody>
				<?php
				$time_string = $year.'-'.$month;	
				//$ass_ap_id
				$sql_ap_1="SELECT * FROM ass_ap WHERE ass_ap_tribe='3' ";
				echo  $sql_ap_1 ;
				$result_ap_1= execute_sql($database_name2, $sql_ap_1, $link2);
				while ($row_ap_1= mysql_fetch_assoc($result_ap_1)  )
				{
				    $key_ip = $row_ap_1['ass_ap_ip'];
					$ass_ap_city = $row_ap_1['ass_ap_city'];
					$ass_ap_twon = $row_ap_1['ass_ap_twon'];
					$ass_ap_tribe = $row_ap_1['ass_ap_tribe'];
					$ass_ap_name = $row_ap_1['ass_ap_name'];
					$sql2="SELECT * FROM radacct  where nasipaddress IN ('$key_ip')   and acctstarttime like '%2016-09%' ";
					$result2 = execute_sql($database_name, $sql2, $link);
					
					echo  $sql2 ;
					while ($row2= mysql_fetch_assoc($result2) )
					{				
								echo '<tr>';	
								
								
echo  '<td>';
				$sql_0="SELECT * FROM city_array WHERE id='$ass_ap_city ' ";
				$result_0= execute_sql($database_name2, $sql_0, $link2);
				while ($row_0= mysql_fetch_assoc($result_0)  )
				{
				  echo   $row_0['city_name'];
				}

echo '</td>';
echo  '<td>';
				$sql_0="SELECT * FROM city_township WHERE township_id='$ass_ap_twon ' ";
				$result_0= execute_sql($database_name2, $sql_0, $link2);
				while ($row_0= mysql_fetch_assoc($result_0)  )
				{
						echo   $row_0['township_name'];
				}

echo '</td>';
echo  '<td>';
			$sql_0="SELECT * FROM tribe WHERE tribe_id='$ass_ap_tribe ' ";
			$result_0= execute_sql($database_name2, $sql_0, $link2);
			while ($row_0= mysql_fetch_assoc($result_0)  )
			{
                 echo   $row_0['tribe_name'];
			}

echo '</td>';					
								echo  '<td>'.$ass_ap_name.'</td>';
								echo  '<td>'.$row2['realm'].'</td>';								
								echo  '<td>'.$row2['username'].'</td>';
								echo  '<td>'.$row2['framedipaddress'].'</td>';
								echo  '<td>'.$row2['acctstarttime'].'</td>';
								echo  '<td>'.$row2['acctstoptime'].'</td>';							
								echo '</tr>';	
						
					}
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
				lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 筆', '25 筆', '50 筆', '全部' ]
				],
			 dom: 'Bfrtip',	 buttons: 
			 [
				{ extend: 'excelHtml5', text: '匯出使用者資訊查詢報表' ,title: '<?= date("Y-m-d");?>  <?=$tribe_name;?>:使用者資訊查詢報表' },
				{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>使用者資訊查詢報表' },	
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>