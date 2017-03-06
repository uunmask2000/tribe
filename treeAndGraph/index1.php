
<link rel="stylesheet" type="text/css" href="treeAndGraph.css">
<?php
include("../SQL/dbtools_ps.php"); 
include_once("../SQL/dbtools.inc.php");
$link = create_connection();
//session_start();
$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and  ifregainedservice is NULL ";
$result_outages = pg_query($conn,$sql_text );
$total_records2 = pg_num_rows($result_outages);

$j = 0;
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
	$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'";
	$result_ipinterface = pg_query($conn,$sql_ipinterface );
	
	while ($row_ipinterface = pg_fetch_row($result_ipinterface)  )
	{
	$query_ip = $row_ipinterface[0];	
	$array[$j] = $query_ip;
	$j++;
	
	
	}
}

}
$check_ip_death = implode(",",$array);

//$check_ip_death =  array('172.21.19.100','172.21.19.101','172.21.19.102');
///print_r($check_ip_death);
//ok_class  class ="ok_class"
function recursion($IP, $check_ip_death)
{
	if (in_array($IP, $check_ip_death))
		{
		   echo 'class ="alert_class"';
		}else{
			echo 'class ="ok_class"';
		}
	
}
$_GET['key'] = '9';
$key =   $_GET['key'];

if(is_numeric($key))
{
	//echo 'YES';
	?>
	
<div class="tree">

			<ul>		
<?php
//echo  $database_name ;
$sql_FW = "SELECT * FROM ass_grouter WHERE ass_grouter_tribe ='$key'  ";
$result_FW = execute_sql($database_name, $sql_FW, $link);
while ($row_FW = mysql_fetch_assoc($result_FW))
{
   // echo $row_FW['ass_ip'];
   ?>
   <li>			
			<a href="#"  <?php recursion($row_FW['ass_ip'], $check_ip_death );?> >FW <?=$row_FW['ass_ip'];?></a>
				<ul>
			<?php
$sql_poe = "SELECT * FROM ass_poesw WHERE ass_poesw_tribe ='$key'  ";
$result_poe = execute_sql($database_name, $sql_poe, $link);
while ($row_poe = mysql_fetch_assoc($result_poe))
{
		//echo $row_poe['ass_poesw_ip'];	
		$ass_poesw_ip = $row_poe['ass_poesw_ip'];
		$IP_ket = explode(".",$ass_poesw_ip)
		?>
		<li>
		<a href="#" <?php recursion($row_poe['ass_poesw_ip'], $check_ip_death );?> >POE <?=$row_poe['ass_poesw_ip'] ;?></a>
		<ul>
		<?php
		$ip_Group = substr($IP_ket[3],0,2);
		$sql_AP = "SELECT * FROM ass_ap WHERE ass_ap_tribe ='$key'  and ass_ap_ip like '%$ip_Group%' ";
$result_AP = execute_sql($database_name, $sql_AP, $link);
while ($row_AP = mysql_fetch_assoc($result_AP))
{
	?>
	<li>
		<a href="#" <?php recursion($row_AP['ass_ap_ip'], $check_ip_death );?> >AP <?=$row_AP['ass_ap_ip'] ;?> </a>
	</li>
					
	<?php
	
}	
		
		?>
		
					
					
			</ul>
		</li>
		<?php
	
}
	?>
			
				
							
					</ul>
			</li>
   
   
   <?php
   
}

?>		
			
			
			
			<li>
			<?php
$sql_PDU = "SELECT * FROM ass_pdu WHERE ass_pdu_tribe ='$key'  ";
$result_PDU = execute_sql($database_name, $sql_PDU, $link);
while ($row_PDU = mysql_fetch_assoc($result_PDU))
{
	?>
	<a href="#" <?php recursion($row_PDU['ass_pdu_ip'], $check_ip_death );?> >PDU<?=$row_PDU['ass_pdu_ip']; ?></a>
	<?php
}
			
			?>
			
			</li>
			<li>
			<?php
$sql_4G = "SELECT * FROM ass_4Ggrouter WHERE ass_4Ggrouter_tribe ='$key'  ";
$result_4G = execute_sql($database_name, $sql_4G, $link);
while ($row_4G = mysql_fetch_assoc($result_4G))
{
	
	?>
	<a href="#" <?php recursion($row_4G['ass_4Gip'], $check_ip_death );?> >4G<?=$row_4G['ass_4Gip']; ?></a>
	<?php
}
			
			
			?>
			
			
			</li>
			
			
			</ul>
</div>

	
	<?php
	
}else{
	echo 'MO';
}

?>
<!-------------------
<div class="tree">
	<ul>
		<li>
			<a href="#">Parent</a>
			<ul>
				<li>
					<a href="#">Child</a>
					<ul>
						<li>
							<a href="#">Grand Child</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">Child</a>
					<ul>
						<li><a href="#">Grand Child</a></li>
						<li>
							<a href="#">Grand Child</a>
							<ul>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
							</ul>
						</li>
						<li><a href="#"   class="alert_class" >Grand Child</a></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</div>
--->