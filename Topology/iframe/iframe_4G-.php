<!--------dataTablesw�M��---------->
	<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
	<!---CDN
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
	-->
	<script type="text/javascript" src="../../dataTables/1.10.12/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../../dataTables/1.10.12/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
	
	<div class="defend">
<button id="PageRefresh">��s����</button>
<script type="text/javascript"> 
	$('#PageRefresh').click(function() {
    	      location.reload();
	});
</script>
<?php

//echo $_GET['ip'];
     $ip = $_GET['ip'];
	include_once("../../SQL/dbtools.inc.php");
	$link = create_connection();
	echo '<H1>';
	$sql_router = "SELECT *  FROM  ass_4Ggrouter where ass_4Gip='$ip '  ";
	$result_router = execute_sql($database_name, $sql_router, $link);
	while ($row_router = mysql_fetch_assoc($result_router))
	{
		$ass_4Ggrouter_city =  $row_router['ass_4Ggrouter_city'];
		$ass_4Ggrouter_twon =  $row_router['ass_4Ggrouter_twon'];
		$ass_4Ggrouter_tribe =  $row_router['ass_4Ggrouter_tribe'];
		$ass_4Gip =  $row_router['ass_4Gip'];
		$ass_4Gname =  $row_router['ass_4Gname'];
		$ass_4Ggrouter_id =  $row_router['ass_4Ggrouter_id'];
		echo $ass_4Gname ;
		//	echo '<a href="http://'.$ass_4Gip.'">'.$ass_4Gname.'</a>';
	}
	echo '</H1>';
	echo '<H2>';
	$sql_query = "SELECT *  FROM  city_array where id='$ass_4Ggrouter_city '  ";
	$result_query = execute_sql($database_name, $sql_query, $link);
	while ($row_query = mysql_fetch_assoc($result_query))
	{
		echo $row_query['city_name'];
		$city_name_row = $row_query['city_name'];
	}
	
	$sql_query = "SELECT *  FROM  city_township where township_id='$ass_4Ggrouter_twon '  ";
	$result_query = execute_sql($database_name, $sql_query, $link);
	while ($row_query = mysql_fetch_assoc($result_query))
	{
		echo $row_query['township_name'];
		$township_name_row = $row_query['township_name'];
	}
	
	$sql_query = "SELECT *  FROM  tribe where tribe_id='$ass_4Ggrouter_tribe '  ";
	$result_query = execute_sql($database_name, $sql_query, $link);
	while ($row_query = mysql_fetch_assoc($result_query))
	{
		echo $row_query['tribe_name'];
		$tribe_name_row = $row_query['tribe_name'];
	}
	echo '</H2>';
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
				$sql_change = "SELECT *  FROM  ass_change_4Grouter where ass_change_own_4Grouter='$ass_4Ggrouter_id' ORDER BY `ass_change_4Grouter`.`ass_change_time_4Grouter` ASC ";
				$result_change = execute_sql($database_name, $sql_change, $link);
				while ($row_change = mysql_fetch_assoc($result_change))
				{
						?>
						<tr>
						<td><?=$row_change['ass_change_time_4Grouter'] ;?></td>
						<td><?=$row_change['ass_change_name_4Grouter'] ;?></td>
						<td><?=$row_change['ass_change_sn_4Grouter'] ;?></td>
						<td><?=$row_change['ass_change_mac_4Grouter'] ;?></td>
						<td><?=$row_change['ass_change_pn_4Grouter'] ;?></td>
						<td><?=$row_change['ass_change_note_4Grouter'] ;?></td>
						<td><?=$row_change['ass_change_label_4Grouter'] ;?></td>
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
	//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
						include("../../SQL/dbtools_ps_2.php");
						$conn= create_ps_connection();
						//$sql_ipinterface ="SELECT * FROM ipinterface where ipaddr ='$ass_poesw_ip' ";
						$sql_ipinterface ="	SELECT *FROM ipinterface as A 
						join ifservices as B on A.id = B.ipinterfaceid

						join outages as C on B.id = C.ifserviceid

						where A.ipaddr ='$ass_4Gip'  and B.serviceid = 2";
						$result_ipinterface = pg_query($conn,$sql_ipinterface );
						while ($row_ipinterface = pg_fetch_assoc($result_ipinterface) )
						{   
						
						?>
						<tr>
						<td><?=$city_name_row ; ?></td>
						<td><?=$township_name_row ; ?></td>
						<td><?=$tribe_name_row ; ?></td>
						<td><?=$ass_4Gname ; ?></td>
						<td><?php

						$AAAA1 = $row_ipinterface['iflostservice'];
						$str1=$AAAA1;
						$front1 = substr($str1,0,strpos($str1,"."));//先用strpos得到? 問號前面文字長度，再用substr 獲取從第一位（0表示從第一位開始）起，到問號前的位置
						//echo $front ;	

						$date1=date_create("$front1");
						echo date_format($date1,"Y-m-d H:i:s");	
						?></td>
						<td><?php
						$AAAA1 = $row_ipinterface['ifregainedservice'];
						if(empty($AAAA1))
						{
							//echo 'YES';
						}else{
							//echo 'NO';
							$str1=$AAAA1;
							$front1 = substr($str1,0,strpos($str1,"."));//先用strpos得到? 問號前面文字長度，再用substr 獲取從第一位（0表示從第一位開始）起，到問號前的位置
							//echo $front ;	
							$date1=date_create("$front1");
							echo date_format($date1,"Y-m-d H:i:s");	
						}

						?></td>
						</tr>

						<?php

						?>
						<?php
						
						}		  
						echo '</tbody>';	
						echo '</table>';


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
				{ extend: 'excelHtml5', text: '匯出斷線歷史紀錄' ,title: '<?= date("Y-m-d");?> 4G Router斷線歷史紀錄' },
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>

	</div>