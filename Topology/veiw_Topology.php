<!DOCTYPE html>  
<html>  
  <head> 
		<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
		<!------->
		<link rel="stylesheet" href="Colorbox/colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="Colorbox/jquery.colorbox.js"></script>
		<!------->
     <title>HTML 5 DEMO</title> 
     <style>
		.YES { color:red ; font-weight:bold; }
		.NO { color:blue ; font-weight:bold; }
		.NO_nono{ color:red ; font-weight:bold; } <!--(display:none ; color:red ; font-weight:bold;) -->
       header, nav, section, article, footer {
         display: block;
       }
       header, nav, section, article, footer {
         color: black;
       }
       header, footer {
         text-align: center;
         width: 100%;
       }
       header {
         background-color: red;
         font-size: 36px;
         font-weight: bold;
       }
       nav {
			position: fixed;
			right: 25px;
			top: 55px;
			height: 500px;
			width: 180px;
			line-height: 2em;
			border: 1px solid #ccc;
			padding: 0;
			margin: 0;
			overflow: scroll;
			overflow-x: hidden;
       }
       section {
         width: 80%;
         background-color: gray;
         padding: 5px;
         margin: 5px;
       }
       footer {
         background-color: green;
         font-size: 10px;
       }
		.button_A {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		}
     </style> 
	 <script>
			$(document).ready(function(){
				
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});

				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
	 
  </head>  
  <body> 
  
  <?php
include("../SQL/dbtools_ps.php");
require_once("../SQL/dbtools.inc.php");
$link = create_connection();
 
 session_start();
$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and  ifregainedservice is NULL ";
$result_outages = pg_query($conn,$sql_text );
$total_records2 = pg_num_rows($result_outages);

$j = 0;
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
	//$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'  and  ipaddr NOT IN('172.21.42.101' ,'172.21.42.102' ,'172.21.42.111','172.21.42.121','172.21.42.122','172.21.42.123') ";  /// 2016.12.12 暫時遮蔽 椰油AP3
	//$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id' and  ipaddr<>'172.21.11.121'   ";   /// 2016.11.21 暫時遮蔽 大社AP4
	$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id' and ipaddr<>'192.168.1.100' ";
	$result_ipinterface = pg_query($conn,$sql_ipinterface );
	
	while ($row_ipinterface = pg_fetch_row($result_ipinterface)  )
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

/*
//////$check_ip_death = implode(",",$array);
echo '目前ICMP失連數量:'. count($array);
//print_r($array);
echo '<br>';
for($ii = 0 ; $ii < count($array) ; $ii++ )
{
	
	//echo $array[$ii];
	echo '<a href="#History'.$array[$ii].'">clink</a> ';
	//echo '<br>';
}
*/
?>
  
    <header>  
      <?php
			echo '目前ICMP失連數量:'. count($array);	  
	  ?> 
    </header>  
    <nav> 
<button id="PageRefresh">刷新頁面</button>
<script type="text/javascript"> 
	$('#PageRefresh').click(function() {
    	      location.reload();
	});
</script>	
      <ul>
	  <?php
				for($ii = 0 ; $ii < count($array) ; $ii++ )
				{
					$key_ip = $array[$ii] ;
							//FW
							$sql_sow_FW = "SELECT * FROM tribe as A
join ass_grouter as B
on A.tribe_id  =  B.ass_grouter_tribe 
where  B.ass_ip = '$key_ip'";

							$result_sow_FW = execute_sql($database_name, $sql_sow_FW, $link);
							while ($row_sow_FW = mysql_fetch_assoc($result_sow_FW))
							{
							//$row_sow_FW['ass_ap_name'];
							echo '<li><a href="#History'.$array[$ii].'">'.$row_sow_FW['tribe_name'].$row_sow_FW['ass_name'].'</a></li>';
					
							}
							//4G
							$sql_sow_4G = "SELECT * FROM tribe as A
join ass_4Ggrouter as B
on A.tribe_id  =  B.ass_4Ggrouter_tribe 
where  B.ass_4Gip = '$key_ip'";
							$result_sow_4G = execute_sql($database_name, $sql_sow_4G, $link);
							while ($row_sow_4G = mysql_fetch_assoc($result_sow_4G))
							{
							//$row_sow_AP['ass_ap_name'];
							echo '<li><a href="#History'.$array[$ii].'">'.$row_sow_4G['tribe_name'].$row_sow_4G['ass_4Gname'].'</a></li>';
					
							}
							//POE
							$sql_sow_POE = "SELECT * FROM tribe as A
join ass_poesw as B
on A.tribe_id  =  B.ass_poesw_tribe 
where  B.ass_poesw_ip = '$key_ip'";
							$result_sow_POE = execute_sql($database_name, $sql_sow_POE, $link);
							while ($row_sow_POE = mysql_fetch_assoc($result_sow_POE))
							{
							//$row_sow_AP['ass_ap_name'];
							echo '<li><a href="#History'.$array[$ii].'">'.$row_sow_POE['tribe_name'].$row_sow_POE['ass_poesw_name'].'</a></li>';
					
							}
							//PDU
							$sql_sow_PDU = "SELECT * FROM tribe as A
join ass_pdu as B
on A.tribe_id  =  B.ass_pdu_tribe 
where  B.ass_pdu_ip = '$key_ip'
";
							$result_sow_PDU = execute_sql($database_name, $sql_sow_PDU, $link);
							while ($row_sow_PDU = mysql_fetch_assoc($result_sow_PDU))
							{
							//$row_sow_AP['ass_ap_name'];
							echo '<li><a href="#History'.$array[$ii].'">'.$row_sow_PDU['tribe_name'].$row_sow_PDU['ass_pdu_name'].'</a></li>';
					
							}

							//AP
							$sql_sow_AP = "SELECT * FROM tribe as A
join ass_ap as B
on A.tribe_id  =  B.ass_ap_tribe 
where  B.ass_ap_ip = '$key_ip'";
							$result_sow_AP = execute_sql($database_name, $sql_sow_AP, $link);
							while ($row_sow_AP = mysql_fetch_assoc($result_sow_AP))
							{
							//$row_sow_AP['ass_ap_name'];							
								echo '<li><a href="#History'.$array[$ii].'">'.$row_sow_AP['tribe_name'].$row_sow_AP['ass_ap_name'].'</a></li>';
							}
				//echo $array[$ii];
				//echo '<li><a href="#History'.$array[$ii].'">故障'.($ii+1).'</a></li>';
				//echo '<br>';
				}

	  ?>
      </ul> 
	  
    </nav>
    <section>
      <article>
<?php

			$sql_1 = "SELECT * FROM city_array ORDER BY city_sort ASC ";
			$result_1 = execute_sql($database_name, $sql_1, $link);
			while ($row_1 = mysql_fetch_assoc($result_1))
			{
				$township_city = $row_1['id'];
			echo '<ul>';
				//echo  $row_1['city_name'];
				echo '<li>'.$row_1['city_name'].'</li>';
			
						$sql_2 = "SELECT * FROM `city_township` where township_city='$township_city' ";
						$result_2 = execute_sql($database_name, $sql_2, $link);
						while ($row_2 = mysql_fetch_assoc($result_2))
						{
							$tribe = $row_2['township_id'];
							//
							$Mayor = $row_2['Mayor'];
							$Mayor_phone = $row_2['Mayor_phone'];
							$Contact_person = $row_2['Contact_person'];
							$Contact_person_phone = $row_2['Contact_person_phone'];
							$address = $row_2['address'];
							$area_note = $row_2['area_note'];
							//
							echo '<ul>';	
							echo '<li>'.$row_2['township_name'].'</li>';
							?>
							<div class="panel panel-default">
							<div class="panel-heading">
							<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" 
							href="#collapseThree_township_<?=$tribe;?>">
							地區資料 <↓展開>
							</a>
							</h4>
							</div>
							<div id="collapseThree_township_<?=$tribe;?>" class="panel-collapse collapse">
							<div class="panel-body">
<table class="table table-striped">
    <thead>
      <tr>
        <th>鄉長</th>
        <th>鄉長電話</th>
        <th>連絡人</th>
		<th>連絡人電話</th>
		<th>地址</th>
		<th>備註</th>
      </tr>
    </thead>
    <tbody>
	<?php
	
	?>
		<tr>
		<td><?=$Mayor;?></td>
		<td><?=$Mayor_phone;?></td>
		<td><?=$Contact_person;?></td>
		<td><?=$Contact_person_phone;?></td>
		<td><?=$address;?></td>
		<td><?=$area_note;?></td>
		</tr>
     
    </tbody>
</table>
							</div>
							</div>
							</div>
							<?php
									$sql_3 = "SELECT * FROM `tribe` where township_id='$tribe' ";
									$result_3 = execute_sql($database_name, $sql_3, $link);
									while ($row_3 = mysql_fetch_assoc($result_3))
									{
										$assets_address = $row_3['tribe_id'];
										//
										$tribe_member = $row_3['tribe_member'];
										$tribe_phone = $row_3['tribe_phone'];
										$tribe_note = $row_3['tribe_note'];
										//
										echo '<ul>';	
										echo '<li>'.$row_3['tribe_name'].'</li>';
										?>							
								<div class="panel panel-default">
								<div class="panel-heading">
								<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" 
								href="#collapseThree_tribe_<?=$assets_address;?>">
								部落聯絡資料 <↓展開>
								</a>
								</h4>
								</div>
								<div id="collapseThree_tribe_<?=$assets_address;?>" class="panel-collapse collapse">
								<div class="panel-body">
								<table class="table table-striped">
								<thead>
								<tr>
								<th>部落聯絡人</th>
								<th>部落聯絡電話</th>
								<th>部落聯絡備註</th>
								</tr>
								</thead>
								<tbody>

								<tr>
								<td><?=$tribe_member;?></td>
								<td><?=$tribe_phone;?></td>
								<td><?=$tribe_note;?></td>
								</tr>

								</tbody>
								</table>
								</div>
								</div>
								</div>
								<?php
									$sql_query = "SELECT * FROM ass_grouter where ass_grouter_tribe='$assets_address' ";
									$result_query = execute_sql($database_name, $sql_query, $link);
									while ($row_query = mysql_fetch_assoc($result_query))
									{
								//
								?>
								<div class="panel panel-default">
								<div class="panel-heading">
								<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" 
								href="#collapseThree_isp_<?=$assets_address;?>">
								ISP資料 <↓展開>
								</a>
								</h4>
								</div>
								<div id="collapseThree_isp_<?=$assets_address;?>" class="panel-collapse collapse">
								<div class="panel-body">
								<table class="table table-striped">
								<thead>
								<tr>
								<th>ISP類型</th>
								<th>ISP業者</th>
								<th>ISP聯絡電話</th>
								<th>ISP備註</th>
								</tr>
								</thead>
								<tbody>

								<tr>
								<td><?=$row_query['isp_type'];?> </td>
							<td><?=$row_query['isp_members'];?> </td>
							<td><?=$row_query['isp_pohoe'];?> </td>
								<td><?=$row_query['isp_note'];?> </td>

								</tr>

								</tbody>
								</table>
								</div>
								</div>
								</div>

								<div class="panel panel-default">
								<div class="panel-heading">
								<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" 
								href="#collapseThree_power_<?=$assets_address;?>">
								用電資料 <↓展開>
								</a>
								</h4>
								</div>
								<div id="collapseThree_power_<?=$assets_address;?>" class="panel-collapse collapse">
								<div class="panel-body">
								<table class="table table-striped">
								<thead>
								<tr>
								<th>用電位置</th>
								<th>補助人名</th>
								<th>連絡電話</th>
								</tr>
								</thead>
								<tbody>

								<tr>
								<td><?=$row_query['power_position'];?> </td>
								<td><?=$row_query['name_of_subsidy'];?> </td>
								<td><?=$row_query['contact_telephone_number'];?> </td>

								</tr>

								</tbody>
								</table>
								</div>
								</div>
								</div>
								<?php
								//
									}
								?>
								<?php
								
								$sql_query2 = "SELECT * FROM ass_4Ggrouter where ass_4Ggrouter_tribe='$assets_address' ";
									$result_query2 = execute_sql($database_name, $sql_query2, $link);
									while ($row_query2 = mysql_fetch_assoc($result_query2))
									{
								//
								?>
								<div class="panel panel-default">
								<div class="panel-heading">
								<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" 
								href="#collapseThree_4Ggrouter_<?=$assets_address;?>">
								4G Router資料 <↓展開>
								</a>
								</h4>
								</div>
								<div id="collapseThree_4Ggrouter_<?=$assets_address;?>" class="panel-collapse collapse">
								<div class="panel-body">
								<table class="table table-striped">
								<thead>
								<tr>
								<th>電話號碼</th>
								<th>IMEI碼</th>
								</tr>
								</thead>
								<tbody>

								<tr>
								<td><?=$row_query2['phone_number'];?> </td>
								<td><?=$row_query2['phone_imei'];?> </td>

								</tr>

								</tbody>
								</table>
								</div>
								</div>
								</div>
								<?php
								//
									}
								
								
								?>
							
								
										<?php
												$sql_4 = "SELECT * FROM `assets_address` where tribe_ass_own='$assets_address' ";
												$result_4 = execute_sql($database_name, $sql_4, $link);
												while ($row_4 = mysql_fetch_assoc($result_4))
												{
													$key = $row_4['ass_address_id'];
													echo '<ul>';	
													echo '<li>'.$row_4['tribe_ass_name'].'</li>';													
													
		echo '<ul>';									
	//FW
	$sql_3_1 = "SELECT * FROM `ass_grouter` WHERE `ass_grouter_address`='$key' ";
	$result_3_1 = execute_sql($database_name, $sql_3_1, $link);
	while ($row_3_1 = mysql_fetch_assoc($result_3_1))
	{
		$check = $row_3_1['ass_ip'] ;
			if(in_array($check, $array))
			{
			//echo "YES";
				echo '<li class="YES" >'.$row_3_1['ass_name'].'</li>';
				echo '<span class="NO_nono" id="History'.$check.'">故障</span>';
			}else{
			//echo "NO";
				echo '<li   class="NO">'.$row_3_1['ass_name'].'</li>';
			
			}
	
?>
<p><a class='iframe button_A' href="iframe/iframe_FW.php?ip=<?=$check ;?>">觀看FW紀錄</a></p>
<?php
	
	}
	//ass_4Ggrouter
	$sql_3_2 = "SELECT * FROM `ass_4Ggrouter` WHERE `ass_4Ggrouter_address`='$key' ";
	$result_3_2 = execute_sql($database_name, $sql_3_2, $link);
	while ($row_3_2 = mysql_fetch_assoc($result_3_2))
	{
$check = $row_3_2['ass_4Gip'] ;
		if(in_array($check, $array))
			{
			//echo "YES";
				echo '<li class="YES" >'.$row_3_2['ass_4Gname'].'</li>';
				echo '<span class="NO_nono" id="History'.$check.'">故障</span>';
			}else{
			//echo "NO";
				echo '<li   class="NO">'.$row_3_2['ass_4Gname'].'</li>';
			
			}

	//echo '<li>'.$row_3_2['ass_4Gname'].$row_3_2['ass_4Gip'].'</li>';
?>
<p><a class='iframe button_A' href="iframe/iframe_4G.php?ip=<?=$check ;?>">觀看4G紀錄</a></p>
<?php		
	}
	//ass_poesw
	$sql_3_3 = "SELECT * FROM `ass_poesw` WHERE `ass_poesw_address`='$key' ";
	$result_3_3 = execute_sql($database_name, $sql_3_3, $link);
	while ($row_3_3 = mysql_fetch_assoc($result_3_3))
	{
$check = $row_3_3['ass_poesw_ip'] ;
			if(in_array($check, $array))
			{
			//echo "YES";
				echo '<li class="YES" >'.$row_3_3['ass_poesw_name'].'</li>';
				echo '<span class="NO_nono" id="History'.$check.'">故障</span>';
			}else{
			//echo "NO";
				echo '<li   class="NO">'.$row_3_3['ass_poesw_name'].'</li>';
			
			}
	//echo '<li>'.$row_3_3['ass_poesw_name'].$row_3_3['ass_poesw_ip'].'</li>';
?>
<p><a class='iframe button_A' href="iframe/iframe_poesw.php?ip=<?=$check ;?>">觀看poesw紀錄</a></p>
<?php		
	}
	//ass_pdu
	$sql_3_4 = "SELECT * FROM `ass_pdu` WHERE `ass_pdu_address`='$key' ";
	$result_3_4 = execute_sql($database_name, $sql_3_4, $link);
	while ($row_3_4 = mysql_fetch_assoc($result_3_4))
	{
$check = $row_3_4['ass_pdu_ip'] ;
			if(in_array($check, $array))
			{
			//echo "YES";
				echo '<li class="YES" >'.$row_3_4['ass_pdu_name'].'</li>';
				echo '<span class="NO_nono" id="History'.$check.'">故障</span>';
			}else{
			//echo "NO";
				echo '<li   class="NO">'.$row_3_4['ass_pdu_name'].'</li>';
			
			}

	//echo '<li>'.$row_3_4['ass_pdu_name'].$row_3_4['ass_pdu_ip'].'</li>';
?>
<p><a class='iframe button_A' href="iframe/iframe_pdu.php?ip=<?=$check ;?>">觀看pdu紀錄</a></p>
<?php	
	}
	//ass_ap
	$sql_3_5 = "SELECT * FROM `ass_ap` WHERE `ass_ap_address`='$key' ";
	$result_3_5 = execute_sql($database_name, $sql_3_5, $link);
	while ($row_3_5 = mysql_fetch_assoc($result_3_5))
	{
$check = $row_3_5['ass_ap_ip'] ;
			if(in_array($check, $array))
			{
			//echo "YES";
				echo '<li class="YES" >'.$row_3_5['ass_ap_name'].'</li>';
				echo '<span class="NO_nono" id="History'.$check.'">故障</span>';
			}else{
			//echo "NO";
				echo '<li   class="NO">'.$row_3_5['ass_ap_name'].'</li>';
			
			}

	//echo '<li>'.$row_3_5['ass_ap_name'].$row_3_5['ass_ap_ip'].'</li>';
?>
<p><a class='iframe button_A' href="iframe/iframe_AP.php?ip=<?=$check ;?>">觀看AP紀錄</a></p>
<?php
	
	}
	/*  
	//ass_other  其他
	$sql_3_6 = "SELECT * FROM `ass_other` WHERE `ass_other_address`='$key' ";
	$result_3_6 = execute_sql($database_name, $sql_3_6, $link);
	while ($row_3_6 = mysql_fetch_assoc($result_3_6))
	{

	
	echo '<li>'.$row_3_6['ass_other_name'].'</li>';
	
	}
	*/	
	echo '</ul>';	
																	
													echo '</ul>';
												}
										echo '</ul>';
									}
							
							
							echo '</ul>';
						}
					
			echo '</ul>';	
			}





?>
	  
	  
      </article>
    </section>      
    <footer>  
      <p>
        footer © 2011 
      </p>       
    </footer>  
  </body>  
</html>  