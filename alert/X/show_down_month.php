<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../include/style.css" rel="stylesheet" type="text/css" />

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


</head>

<body>

<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php include("../include/top.php"); ?>
	</div>

<!-------------------------------------- MAIN -->
  	<div id="main">

		<?php 
		
		
		
		include("alert2.php"); 
		require_once("../SQL/dbtools.inc.php");
		$link = create_connection();
		?>

		
	<?php

		//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
		include("../SQL/dbtools_ps.php");
		$sql_text ="SELECT outageid,svclosteventid,svcregainedeventid,iflostservice,ifserviceid,ipinterfaceid,ipaddr,iflostservice FROM outages  as A
		join ifservices  as B  on  A.ifserviceid = B.id 
		join ipinterface  as C on  B.ipinterfaceid = C.id
		where A.ifregainedservice is NULL  and B.serviceid = 2
		ORDER BY  A.svclosteventid desc
		";
		//$result = pg_query($conn, " SELECT iflostservice,ifserviceid     FROM outages     where  	svcregainedeventid is NULL  ");
		$result = pg_query($conn,$sql_text );
		$total_records = pg_num_rows($result);


	?>
		 
		
		<div id="content0">
			<div id="port_data">
					<table  id="show_date"  class="alert_tb">
					<div class="alert_tt">目前服務中斷數量:<?=$total_records ;?>數 <thead><tr>
							<th>服務中斷事件編號</th>
							<th>事件編號</th>
							<th>部落</th>
							<th>設備</th>
							<th>IP</th>
							<th>服務中斷時間</th>
							
							<th>狀態</th>
						  </tr> </thead>
						  <tbody>
						  <?php
						   $j = 1;
						  while ($row = pg_fetch_row($result)) 
					{
								  ?>
						<tr>
						<td><?=$row[0];?></td>
						<td><?=$row[1];?></td>
						<!---
						<td><a class="tb_link" href="../view_date/view_tribe_msg.php?key=75" target="_blank">達卡努瓦部落【二村】</a></td>
						<td><a class="tb_link" href="../view_date/view_tribe_PDU_date.php?ip=172.21.7.5" target="_blank"> PDU</a></td>
						-->
					<?php 
											$key_ip = $row[6];											
										
											$sql_ap = "SELECT ass_ap_name,ass_ap_ip,tribe_name,township_name,city_name,ass_ap_tribe FROM (SELECT * FROM ass_ap) AS  ass_ap
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_ap.ass_ap_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_ap_ip='$key_ip'  ";											
											$sql_router = "SELECT ass_name,	ass_ip,tribe_name,township_name,city_name,ass_grouter_city FROM (SELECT * FROM  ass_grouter) AS   ass_grouter
											INNER JOIN (SELECT * FROM tribe) AS tribe ON    ass_grouter.ass_grouter_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_ip='$key_ip'  ";											
											$sql_4G_router = "SELECT ass_4Gname,ass_4Gip,tribe_name,township_name,city_name,ass_4Ggrouter_tribe FROM (SELECT * FROM  ass_4Ggrouter) AS   ass_4Ggrouter
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_4Ggrouter.ass_4Ggrouter_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_4Gip='$key_ip' ";											
											$sql_PDU = "SELECT ass_pdu_name,ass_pdu_ip,tribe_name,township_name,city_name,ass_pdu_tribe FROM (SELECT * FROM  ass_pdu) AS   ass_pdu
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_pdu.ass_pdu_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_pdu_ip='$key_ip' ";											
											$sql_poesw = "SELECT ass_poesw_name,ass_poesw_ip,tribe_name,township_name,city_name,ass_poesw_tribe FROM (SELECT * FROM  ass_poesw) AS ass_poesw
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_poesw.ass_poesw_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_poesw_ip='$key_ip'";											//echo $sql_4G_router;
											$result_ap = execute_sql($database_name, $sql_ap, $link);
											$result_router = execute_sql($database_name, $sql_router, $link);
											$result_4G_router = execute_sql($database_name, $sql_4G_router, $link);
											$result_PDU = execute_sql($database_name, $sql_PDU, $link);
											$result_poesw = execute_sql($database_name, $sql_poesw, $link);					                        
											$total_ap = mysql_num_rows($result_ap);											
											$total_router = mysql_num_rows($result_router);	
											$total_4G_router = mysql_num_rows($result_4G_router);	
											$total_PDU = mysql_num_rows($result_PDU);	
											$total_poesw = mysql_num_rows($result_poesw);	
					 if($total_ap>0 or  $total_router >0 or  $total_4G_router >0 or $total_PDU >0 or  $total_poesw >0)
					 {
						 while ($row_ap = mysql_fetch_assoc($result_ap))
																{																	  
																	  //echo $row_ap['ass_ap_name']; ass_ap_tribe
																	  //<a href="../alert/check_alert_ip_type.php?ip=$row231[0]" target="_blank">  </a>
																	  ?>
																	  <td><a class="tb_link" href="../view_date/view_tribe_msg.php?key=<?=$row_ap['ass_ap_tribe'];?>" target="_blank"><?=$row_ap['tribe_name'];?></a></td>
																	  <td><a class="tb_link" href="../view_date/view_tribe_AP_date.php?ip=<?=$key_ip ;?>" target="_blank"> <?=$row_ap['ass_ap_name'];?></a></td>
																	  <?php
																}
																//echo '<br>';//
																while ($row_router = mysql_fetch_assoc($result_router))
																{
																	 // echo $row_router['ass_name']; ass_grouter_city
																	  ?>
																	  <td><a class="tb_link" href="../view_date/view_tribe_msg.php?key=<?=$row_router['ass_grouter_city'];?>" target="_blank"><?=$row_router['tribe_name'];?></a></td>
																		<td><a class="tb_link" href="../view_date/view_tribe_FW_date.php?ip=<?=$key_ip ;?>" target="_blank"> <?=$row_router['ass_name'];?></a></td>
																	  <?php
																}
																//echo '<br>';																
																while ($row_4G_router = mysql_fetch_assoc($result_4G_router))
																{
																	 // echo $row_4G_router['ass_4Gname']; ass_4Ggrouter_tribe
																	  ?>
																	  <td><a class="tb_link" href="../view_date/view_tribe_msg.php?key=<?=$row_4G_router['ass_4Ggrouter_tribe'];?>" target="_blank"><?=$row_4G_router['tribe_name'];?></a></td>
																	  <td><a class="tb_link" href="../view_date/view_tribe_4G_date.php?ip=<?=$key_ip ;?>" target="_blank"> <?=$row_4G_router['ass_4Gname'];?></a></td>
																	  <?php
																}
																//echo '<br>';																
																while ($row_PDU = mysql_fetch_assoc($result_PDU))
																{
																	// echo $row_PDU['ass_pdu_name']; ass_pdu_tribe
																	 
																	?>
																	 <td><a class="tb_link" href="../view_date/view_tribe_msg.php?key=<?=$row_PDU['ass_pdu_tribe'];?>" target="_blank"><?=$row_PDU['tribe_name'];?></a></td>
																	  <td><a class="tb_link" href="../view_date/view_tribe_PDU_date.php?ip=<?=$key_ip ;?>" target="_blank"> <?=$row_PDU['ass_pdu_name'];?></a></td>
																	 <?php
																}
																//echo '<br>';
																while ($row_poesw = mysql_fetch_assoc($result_poesw))
																{
																	 // echo $row_poesw['ass_poesw_name']; ass_poesw_tribe
																	  ?>
																	  <td><a class="tb_link" href="../view_date/view_tribe_msg.php?key=<?=$row_poesw['ass_poesw_tribe'];?>" target="_blank"><?=$row_poesw['tribe_name'];?></a></td>
																	  <td><a class="tb_link" href="../view_date/view_tribe_POE_date.php?ip=<?=$key_ip ;?>" target="_blank"> <?=$row_poesw['ass_poesw_name'];?></a></td>
																	  <?php
																}
																
						 
					 }else{
						 ?>
																	  <td></td>
																	  <td></td>
																	  <?php
						 
					 }
					 ?>
						<td><?=$row[6];?></td>
						<td>
						<?php 
						$AAAA = $row[7] ;
						$str=$AAAA;
						$front = substr($str,0,strpos($str,"."));//先用strpos得到? 問號前面文字長度，再用substr 獲取從第一位（0表示從第一位開始）起，到問號前的位置
						//echo $front ;	

						$date=date_create("$front");
						echo date_format($date,"Y-m-d H:i:s");

						
							?>
						</td>
						<td>服務中斷</td>
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
				lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 筆', '25 筆', '50 筆', '全部' ]
				],
		dom: 'Bfrtip',	 buttons: [
				{ extend: 'excelHtml5', text: '匯出服務中斷數量統計表(當前)' ,title: '2017-01-10服務中斷數量統計表' },
				{ extend: 'print', text: '列印',title: '2017-01-10服務中斷數量統計表' },	
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>		
			</div>
		</div>
		
</form>
</div>



<!-------------------------------------- FOOTER -->
  	<div id="footer">
	<?php  include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>

