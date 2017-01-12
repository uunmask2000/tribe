<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<!--------dataTablesw套件---------->
		<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
		  <!---CDN
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		 -->
		<script type="text/javascript" src="../dataTables/1.10.12/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
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
	  <?php include("../include/top.php");?>
</div>
<!-------------------------------------- MAIN -->
	<div id="main">
		

		<?php include("../alert/alert2.php"); ?>
		
		
<?php
//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
include("../SQL/dbtools_ps.php");
$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and  svcregainedeventid is NULL ";
$result_outages = pg_query($conn,$sql_text );
$total_records2 = pg_num_rows($result_outages);

$j = 1;
//$array = array(};

while ($row_outages = pg_fetch_row($result_outages) )
{
$events_id=$row_outages[5];
//eventid	
$sql_events =" SELECT nodeid	FROM events where eventid='$events_id'   ";
$result_events = pg_query($conn,$sql_events );
//echo  $sql_events ;

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
	$array[$j] = $query_ip;
	$j++;
	
	
	}
}

}
$check_ip_death = implode(",",$array);

?>		
		
<?php

	$key  = $_GET['key'];
	if (is_numeric ($key)) 
		{
				//echo "Yes";
				
		include_once("../SQL/dbtools.inc.php");
		include_once("../SQL/dbtools_ps.php");
		$link = create_connection();		
		 $tribe   = $key;	
		 
						?>
						<div class="tab_container">
						<table id="show_date" class="asset">
						<thead>
						<tr>
						<th>縣市</th>
						<th>地區</th>
						<th>部落</th>
						<th>控制箱</th>
						<th>資產名稱</th>
						<th>觀看歷史紀錄</th>
						<th>狀態</th>
						</tr>
						</thead>
						<tbody>
						<?php
				  //AP
				$sql_AP= "SELECT * FROM ass_ap where ass_ap_tribe='$tribe'  ";
				$result_AP= execute_sql($database_name, $sql_AP, $link);
					while ($row_AP = mysql_fetch_assoc($result_AP))
					{
						$ass_ap_id =$row_AP['ass_ap_id'];
						$ass_ap_city =$row_AP['ass_ap_city'];
						$ass_ap_twon =$row_AP['ass_ap_twon'];
						$ass_ap_tribe =$row_AP['ass_ap_tribe'];
						$ass_ap_address =$row_AP['ass_ap_address'];
						$ass_ap_name =$row_AP['ass_ap_name'];
						?>
					<tr>
					<td>
					<?php
						$sql0 = "SELECT *  FROM  city_array	  where  	id=' $ass_ap_city'  ";
						$result0= execute_sql($database_name, $sql0, $link);
						while ($row0 = mysql_fetch_assoc($result0))
						{
							echo  $row0['city_name'];
						}
					?>
					</td>
					<td>
					<?php
						$sql0 = "SELECT *  FROM  city_township  where  	township_id=' $ass_ap_twon'  ";
						$result0= execute_sql($database_name, $sql0, $link);
						while ($row0 = mysql_fetch_assoc($result0))
						{
							echo  $row0['township_name'];
						}
					?>
					</td>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  tribe where  	tribe_id=' $ass_ap_tribe'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['tribe_name'];
					}
					?>
					</td>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  assets_address where  	ass_address_id=' $ass_ap_address'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['tribe_ass_name'];
					}
					?>
					</td>
					<td><?=	$ass_ap_name;?></td>
					<td><a href="show_ap.php?ip=<?=$row_AP['ass_ap_ip'];?>" target=" _blank"><img src="../images/icon_magnifier.png" class="adm_icon" align="absmiddle"></a>
					<td>
					<?php
					  $IP1=  $row_AP['ass_ap_ip'];
					if(preg_match("/$IP1/i","$check_ip_death")) {
							//echo "OK";
							//echo '<br>';
							//$OK =1;
							echo '斷線';
							} else {
							//echo "error";
							echo '正常';
							//echo '<br>';
							//$OK =0;
							}
					?>
					</td>
					</tr>
					<?php
					}
				
				?>
				<?php
				   //FW
					$sql_FW= "SELECT * FROM ass_grouter where ass_grouter_tribe='$tribe'  ";
					$result_FW= execute_sql($database_name, $sql_FW, $link);
					while ($row_FW = mysql_fetch_assoc($result_FW))
					{
						$ass_grouter_id =$row_FW['ass_grouter_id'];
						$ass_grouter_city =$row_FW['ass_grouter_city'];
						$ass_grouter_twon =$row_FW['ass_grouter_twon'];
						$ass_grouter_tribe =$row_FW['ass_grouter_tribe'];
						$ass_grouter_address =$row_FW['ass_grouter_address'];
						$ass_name =$row_FW['ass_name'];
						?>
						<tr>				
						<td>
						<?php
						$sql0 = "SELECT *  FROM  city_array	  where  	id=' $ass_grouter_city'  ";
						$result0= execute_sql($database_name, $sql0, $link);
						while ($row0 = mysql_fetch_assoc($result0))
						{
						echo  $row0['city_name'];
						}
						?>
						</td>
						<td>
						<?php
						$sql0 = "SELECT *  FROM  city_township  where  	township_id=' $ass_grouter_twon'  ";
						$result0= execute_sql($database_name, $sql0, $link);
						while ($row0 = mysql_fetch_assoc($result0))
						{
						echo  $row0['township_name'];
						}
						?>
						</td>
						<td>
						<?php
						$sql0 = "SELECT *  FROM  tribe where  	tribe_id=' $ass_grouter_tribe'  ";
						$result0= execute_sql($database_name, $sql0, $link);
						while ($row0 = mysql_fetch_assoc($result0))
						{
						echo  $row0['tribe_name'];
						}

						?>
						</td>
						<td>
						<?php
						$sql0 = "SELECT *  FROM  assets_address where  	ass_address_id=' $ass_grouter_address'  ";
						$result0= execute_sql($database_name, $sql0, $link);
						while ($row0 = mysql_fetch_assoc($result0))
						{
						echo  $row0['tribe_ass_name'];
						}
						?>
						</td>
						<td><?=	$ass_name;?></td>
						<td><a href="show_fw.php?ip=<?=$row_FW['ass_ip'];?>" target=" _blank"><img src="../images/icon_magnifier.png" class="adm_icon" align="absmiddle"></a>
						<td>					
						<?php
						$IP1= $row_FW['ass_ip'];
					if(preg_match("/$IP1/i","$check_ip_death")) {
							//echo "OK";
							//echo '<br>';
							//$OK =1;
							echo '斷線';
							} else {
							//echo "error";
							echo '正常';
							//echo '<br>';
							//$OK =0;
							}
						?>
						</td>
						</tr>
						<?php
					}
				?>
				<?php
				   //4G_Router
					$sql_4G_Router = "SELECT * FROM `ass_4Ggrouter`   where   ass_4Ggrouter_tribe='$tribe'  ";
					$result_4G_Router= execute_sql($database_name, $sql_4G_Router, $link);
					while ($row_4G_Router = mysql_fetch_assoc($result_4G_Router)  )
					{
					$ass_4Ggrouter_id =$row_4G_Router['ass_4Ggrouter_id'];
					$ass_4Ggrouter_city =$row_4G_Router['ass_4Ggrouter_city'];
					$ass_4Ggrouter_twon =$row_4G_Router['ass_4Ggrouter_twon'];
					$ass_4Ggrouter_tribe =$row_4G_Router['ass_4Ggrouter_tribe'];
					$ass_4Ggrouter_address =$row_4G_Router['ass_4Ggrouter_address'];
					$ass_4Gname =$row_4G_Router['ass_4Gname'];
					?>
					<tr>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  city_array	  where  	id=' $ass_4Ggrouter_city'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['city_name'];
					}
					?>
					</td>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  city_township  where  	township_id=' $ass_4Ggrouter_twon'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['township_name'];
					}
					?>
					</td>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  tribe where  	tribe_id=' $ass_4Ggrouter_tribe'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['tribe_name'];
					}
					?>
					</td>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  assets_address where  	ass_address_id=' $ass_4Ggrouter_address'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['tribe_ass_name'];
					}
					?>
					</td>
					<td><?=	$ass_4Gname;?></td>
					<td><a href="show_4grouter.php?ip=<?=$row_4G_Router['ass_4Gip'];?>" target=" _blank"><img src="../images/icon_magnifier.png" class="adm_icon" align="absmiddle"></a>
					<td>					
					<?php
					  $IP1=  $row_4G_Router['ass_4Gip'];
				if(preg_match("/$IP1/i","$check_ip_death")) {
							//echo "OK";
							//echo '<br>';
							//$OK =1;
							echo '斷線';
							} else {
							//echo "error";
							echo '正常';
							//echo '<br>';
							//$OK =0;
							}
					?>
					</td>
					</tr>
					<?php	
					}
				?>
				<?php
				   //POEWS
				
					$sql_POEWS = "SELECT * FROM ass_poesw   where   ass_poesw_tribe='$tribe'  ";
					$result_POEWS= execute_sql($database_name, $sql_POEWS, $link);
					while ($row_POEWS = mysql_fetch_assoc($result_POEWS)  )
					{
						$ass_poesw_id =$row_POEWS['ass_poesw_id'];
						$ass_poesw_city =$row_POEWS['ass_poesw_city'];
						$ass_poesw_twon =$row_POEWS['ass_poesw_twon'];
						$ass_poesw_tribe =$row_POEWS['ass_poesw_tribe'];
						$ass_poesw_address =$row_POEWS['ass_poesw_address'];
						$ass_poesw_name =$row_POEWS['ass_poesw_name'];
						$ass_poesw_ip =  $row_POEWS['ass_poesw_ip'];										
					?>
					<tr>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  city_array	  where  	id=' $ass_poesw_city'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['city_name'];
					}
					?>
					</td>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  city_township  where  	township_id=' $ass_poesw_twon'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['township_name'];
					}
					?>
					</td>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  tribe where  	tribe_id=' $ass_poesw_tribe'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['tribe_name'];
					}
					?>
					</td>
					<td>
					<?php
					$sql0 = "SELECT *  FROM  assets_address where  	ass_address_id=' $ass_poesw_address'  ";
					$result0= execute_sql($database_name, $sql0, $link);
					while ($row0 = mysql_fetch_assoc($result0))
					{
					echo  $row0['tribe_ass_name'];
					}
					?>
					</td>

					<td><?=	$ass_poesw_name;?></td>
					<td><a href="show_poe_sw.php?ip=<?=$row_POEWS['ass_poesw_ip'];?>" target=" _blank"><img src="../images/icon_magnifier.png" class="adm_icon" align="absmiddle"></a>
					
					<td>					
					<?php
					  $IP1=  $row_POEWS['ass_poesw_ip'];
					if(preg_match("/$IP1/i","$check_ip_death")) {
							//echo "OK";
							//echo '<br>';
							//$OK =1;
							echo '斷線';
							} else {
							//echo "error";
							echo '正常';
							//echo '<br>';
							//$OK =0;
							}
					?>
					</td>
					
					</tr>
					<?php
					}
				?>
				<?php
					//pdu
					$sql_pdu = "SELECT * FROM `ass_pdu`   where   ass_pdu_tribe='$tribe' ";
					$result_pdu= execute_sql($database_name, $sql_pdu, $link);
					while ($row_pdu = mysql_fetch_assoc($result_pdu)  )
					{
						$ass_pdu_id =$row_pdu['ass_pdu_id'];
						$ass_pdu_city =$row_pdu['ass_pdu_city'];
						$ass_pdu_twon =$row_pdu['ass_pdu_twon'];
						$ass_pdu_tribe =$row_pdu['ass_pdu_tribe'];
						$ass_pdu_address =$row_pdu['ass_pdu_address'];
						$ass_pdu_name =$row_pdu['ass_pdu_name'];
						?>
						<tr>
							<td>
							<?php
							$sql0 = "SELECT *  FROM  city_array	  where  	id=' $ass_pdu_city'  ";
							$result0= execute_sql($database_name, $sql0, $link);
							while ($row0 = mysql_fetch_assoc($result0))
							{
							echo  $row0['city_name'];
							}
							?>
							</td>
							<td>
							<?php
							$sql0 = "SELECT *  FROM  city_township  where  	township_id=' $ass_pdu_twon'  ";
							$result0= execute_sql($database_name, $sql0, $link);
							while ($row0 = mysql_fetch_assoc($result0))
							{
							echo  $row0['township_name'];					
							}
							?>
							</td>
							<td>
							<?php
							$sql0 = "SELECT *  FROM  tribe where  	tribe_id=' $ass_pdu_tribe'  ";
							$result0= execute_sql($database_name, $sql0, $link);
							while ($row0 = mysql_fetch_assoc($result0))
							{
							echo  $row0['tribe_name'];
							}
							?>
							</td>
							<td>
							<?php
							$sql0 = "SELECT *  FROM  assets_address where  	ass_address_id=' $ass_pdu_address'  ";
							$result0= execute_sql($database_name, $sql0, $link);
							while ($row0 = mysql_fetch_assoc($result0))
							{
							echo  $row0['tribe_ass_name'];
							}
							?>
							</td>
							<td><?=	$ass_pdu_name;?></td>
							<td><a href="show_pdu.php?ip=<?=$row_pdu['ass_pdu_ip'];?>" target=" _blank"><img src="../images/icon_magnifier.png" class="adm_icon" align="absmiddle"></a>
							<td>					
								<?php
								$IP1=  $row_pdu['ass_pdu_ip'];
								if(preg_match("/$IP1/i","$check_ip_death")) {
							//echo "OK";
							//echo '<br>';
							//$OK =1;
							echo '斷線';
							} else {
							//echo "error";
							echo '正常';
							//echo '<br>';
							//$OK =0;
							}
								?>
							</td>							
						</tr>
						<?php
					}
				?>
				
				
				
				</tbody>
				</table>
				</div>
				
				<?php
				
				
				
		} else {
		//echo "No";
		header("Location:../index.php" );
		}
?>
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
				// dom: 'Bfrtip',	 buttons: [		{ extend: 'excelHtml5', text: '匯出試算表', title: '4G Router 統計表' },{ extend: 'print', text: '列印' , title: '4G Router 統計表'},],
	       };
      $("#show_date").dataTable(opt);
      });
  </script>


<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>

</body>
</html>
