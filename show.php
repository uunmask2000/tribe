<script type="text/javascript">
function open_win1()
{
window.open("Daily_alarm/Yesterday_alarm.php","_blank","toolbar=no, location=0, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=520")
}
function open_win2()
{
window.open("Daily_alarm/Daily_alarm.php","_blank","toolbar=no, location=0, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=520")
}
</script>

<input type="button" value="昨日各時段告警數量統計圖" onclick="open_win1()">
<input type="button" value="本日各時段告警數量統計圖" onclick="open_win2()">

<?php
/*
echo '<br>';
include("SQL/dbtools_ps.php");
 
 session_start();
$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and  ifregainedservice is NULL ";
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
	//$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'  and  ipaddr NOT IN('172.21.42.101' ,'172.21.42.102' ,'172.21.42.111','172.21.42.121','172.21.42.122','172.21.42.123') ";  /// 2016.12.12 暫時遮蔽 椰油AP3
	//$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id' and  ipaddr<>'172.21.11.121'   ";   /// 2016.11.21 暫時遮蔽 大社AP4
	$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'";
	$result_ipinterface = pg_query($conn,$sql_ipinterface );
	
	while ($row_ipinterface = pg_fetch_row($result_ipinterface))
	{
		//echo $row_ipinterface[0];
		//echo '<br>';
		//`ass_grouter_address`='$addid'  
	$query_ip = $row_ipinterface[0];
	//echo  $query_ip ;
	//echo '<br>';
	//echo $j;
	$array[$j] = $query_ip;
	echo $query_ip;
	echo'<br>';
	$j++;
	
	
	}
}

}
$check_ip_death = implode(",",$array);

pg_close($conn);

*/

?>