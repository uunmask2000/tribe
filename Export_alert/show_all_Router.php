<!--------dataTablesw套件---------->
		<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
		  <!---CDN
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		 -->
		<script type="text/javascript" src="../dataTables/1.10.12/jquery.dataTables.min.js"></script>
		<!---CDN
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
		 -->
		<script type="text/javascript" src="../dataTables/1.10.12/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
		<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
		<?php
		include_once("../SQL/dbtools.inc.php");
		include_once("../SQL/dbtools_ps.php");
		$link = create_connection();
		
		?>
		<?php
		include_once("../SQL/dbtools.inc.php");
		include_once("../SQL/dbtools_ps.php");
		$link = create_connection();
		
		
		date_default_timezone_set('Asia/Taipei');
		
		$d=strtotime("-1 Months");
		$today=date("Y-m-d");
		$lastmonth=date("Y-m-d", $d);
		//echo date("Y-m-d");
		
		
		?>
		<form action="?mode=query" method="POST">
		 
					<input type="date" name="date_start"   value="<?=$lastmonth;?>"> 
					<input type="date" name="date_end" value="<?=$today ;?>">
					<select name="label_row">
					　<option value="2"  <?php  if($_POST['label_row']=='2'){  echo 'selected';}else if($_POST['label_row']==''){  echo 'selected';};   ?>>第二期</option>
					　<option value="3" <?php  if($_POST['label_row']=='3'){  echo 'selected';}   ?> >第三期</option>
					</select>
		 
		  <input type="submit" value="Submit">
		</form>
		
		<?php
		
		if($_GET['mode']=='query')
		{
			
					$date_start = $_POST['date_start'];
					$date_end = $_POST['date_end'];
					$label_row = $_POST['label_row'];

					if($date_start!=NULL and $date_end!=NULL and $label_row!=NULL)
					{
					?>


			<table  id="show_date">
				<thead>
				<tr>
				<th>縣市</th>
				<th>地區</th>
				<th>部落</th>
				<th>設備名稱</th>
				<th>設備IP</th>
				<th>斷電時間</th>
				<th>回電時間</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sql_router = "SELECT *  FROM  ass_grouter  where ass_grouter_label  ='$label_row'  ";
			$result_router = execute_sql($database_name, $sql_router, $link);
			while ($row_router = mysql_fetch_assoc($result_router))
			{
					$ass_ap_city =  $row_router['ass_grouter_city'];
					$ass_ap_twon =  $row_router['ass_grouter_twon'];
					$ass_ap_tribe =  $row_router['ass_grouter_tribe'];
					$ass_ap_ip =  $row_router['ass_ip'];
					$ass_ap_name =  $row_router['ass_name'];
				
				$sql_ipinterface ="SELECT * FROM ipinterface where ipaddr ='$ass_ap_ip' ";
				$result_ipinterface = pg_query($conn,$sql_ipinterface );
				while ($row_ipinterface = pg_fetch_assoc($result_ipinterface) )
				{ 
			
			
						$nodeid = $row_ipinterface['nodeid'];
						$sql_events ="SELECT * FROM events where nodeid	 ='$nodeid'  ORDER BY eventid DESC";
						$result_events = pg_query($conn,$sql_events );
						while ($row_events = pg_fetch_assoc($result_events) )
						{ 

							$eventid = $row_events['eventid'];
							$sql_text ="SELECT iflostservice,ifregainedservice,ifserviceid  FROM outages where svclosteventid ='$eventid' and iflostservice >='$date_start' and iflostservice <='$date_end' ";
							$result_outages = pg_query($conn,$sql_text );

							while ($row_outages = pg_fetch_assoc($result_outages) )
							{
								
								?>
						<tr>
						<td>
						<?php
							$sql_query = "SELECT *  FROM  city_array where id='$ass_ap_city '  ";
							$result_query = execute_sql($database_name, $sql_query, $link);
							while ($row_query = mysql_fetch_assoc($result_query))
							{
							echo $row_query['city_name'];
							$city_name_row = $row_query['city_name'];
							}
						?>						
						</td>
						<td>
						<?php
							$sql_query = "SELECT *  FROM  city_township where township_id='$ass_ap_twon '  ";
							$result_query = execute_sql($database_name, $sql_query, $link);
							while ($row_query = mysql_fetch_assoc($result_query))
							{
							echo $row_query['township_name'];
							$township_name_row = $row_query['township_name'];
							}						
						?>
						</td>
						<td>
						<?php
							$sql_query = "SELECT *  FROM  tribe where tribe_id='$ass_ap_tribe '  ";
							$result_query = execute_sql($database_name, $sql_query, $link);
							while ($row_query = mysql_fetch_assoc($result_query))
							{
							echo $row_query['tribe_name'];
							$tribe_name_row = $row_query['tribe_name'];
							}
						?>
						</td>
						<td><?=$ass_ap_name ;?></td>
						<td><?=$ass_ap_ip ;?></td>
						<td><?=substr($row_outages['iflostservice'], 0, 19) ;?></td>
						<td><?=substr($row_outages['ifregainedservice'], 0, 19) ;?></td>
						</tr>				  
						<?php
								
							}

						}
			
						

				}
					
									

							
			}
			
			?>
				
			
			</tbody>
			<table>
			
	


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
				"bJQueryUI":true,
				"bLengthChange":false,
				"iDisplayLength": 80,
				 dom: 'Bfrtip',	 buttons: 
				 [
					{ extend: 'excelHtml5', text: '匯出斷線歷史紀錄' ,title: '<?= date("Y-m-d");?>Router斷線歷史紀錄' },
					{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>AP斷線數量統計表' },														
				],
	       };
      $("#show_date").dataTable(opt);
      });
  </script>


					<?php  



					}else{


					echo '未選擇功能2';
					}
		
		
		}else{


					echo '未選擇功能1';
					}
		  
				
		
		exit();
		?>
			<table  id="show_date">
				<thead>
				<tr>
				<th>縣市</th>
				<th>地區</th>
				<th>部落</th>
				<th>設備名稱</th>
				<th>設備IP</th>
				<th>斷電時間</th>
				<th>回電時間</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sql_router = "SELECT *  FROM  ass_grouter  where ass_grouter_label =2  ";
			$result_router = execute_sql($database_name, $sql_router, $link);
			while ($row_router = mysql_fetch_assoc($result_router))
			{
					$ass_ap_city =  $row_router['ass_grouter_city'];
					$ass_ap_twon =  $row_router['ass_grouter_twon'];
					$ass_ap_tribe =  $row_router['ass_grouter_tribe'];
					$ass_ap_ip =  $row_router['ass_ip'];
					$ass_ap_name =  $row_router['ass_name'];
				
				$sql_ipinterface ="SELECT * FROM ipinterface where ipaddr ='$ass_ap_ip' ";
				$result_ipinterface = pg_query($conn,$sql_ipinterface );
				while ($row_ipinterface = pg_fetch_assoc($result_ipinterface) )
				{ 
			
			
						$nodeid = $row_ipinterface['nodeid'];
						$sql_events ="SELECT * FROM events where nodeid	 ='$nodeid'  ORDER BY eventid DESC";
						$result_events = pg_query($conn,$sql_events );
						while ($row_events = pg_fetch_assoc($result_events) )
						{ 

							$eventid = $row_events['eventid'];
							$sql_text ="SELECT iflostservice,ifregainedservice,ifserviceid  FROM outages where svclosteventid ='$eventid' and iflostservice >='2016-09-16' and iflostservice <='2016-10-15' ";
							$result_outages = pg_query($conn,$sql_text );

							while ($row_outages = pg_fetch_assoc($result_outages) )
							{
								
								?>
						<tr>
						<td>
						<?php
							$sql_query = "SELECT *  FROM  city_array where id='$ass_ap_city '  ";
							$result_query = execute_sql($database_name, $sql_query, $link);
							while ($row_query = mysql_fetch_assoc($result_query))
							{
							echo $row_query['city_name'];
							$city_name_row = $row_query['city_name'];
							}
						?>						
						</td>
						<td>
						<?php
							$sql_query = "SELECT *  FROM  city_township where township_id='$ass_ap_twon '  ";
							$result_query = execute_sql($database_name, $sql_query, $link);
							while ($row_query = mysql_fetch_assoc($result_query))
							{
							echo $row_query['township_name'];
							$township_name_row = $row_query['township_name'];
							}						
						?>
						</td>
						<td>
						<?php
							$sql_query = "SELECT *  FROM  tribe where tribe_id='$ass_ap_tribe '  ";
							$result_query = execute_sql($database_name, $sql_query, $link);
							while ($row_query = mysql_fetch_assoc($result_query))
							{
							echo $row_query['tribe_name'];
							$tribe_name_row = $row_query['tribe_name'];
							}
						?>
						</td>
						<td><?=$ass_ap_name ;?></td>
						<td><?=$ass_ap_ip ;?></td>
						<td><?=substr($row_outages['iflostservice'], 0, 19) ;?></td>
						<td><?=substr($row_outages['ifregainedservice'], 0, 19) ;?></td>
						</tr>				  
						<?php
								
							}

						}
			
						

				}
					
									

							
			}
			
			?>
				
			
			</tbody>
			<table>
			
	


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
					{ extend: 'excelHtml5', text: '匯出斷線歷史紀錄' ,title: '<?= date("Y-m-d");?>Router斷線歷史紀錄' },
					{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>Router斷線數量統計表' },	
					'pageLength',						
				],
	       };
      $("#show_date").dataTable(opt);
      });
</script>