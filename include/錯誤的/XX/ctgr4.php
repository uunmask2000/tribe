<style>
.navbar { 
color:#FF0000; 
}
</style>
<?php
/// 這是沒用處的php
$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
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
//print_r( $array);
$check_ip_death = implode(",",$array);

	echo '<ol>';
		require_once("../SQL/dbtools.inc.php");
		$link = create_connection();
		$sql_array = "SELECT * FROM city_array ORDER BY city_sort ASC";
		$result_array = execute_sql($database_name, $sql_array, $link);
		
		while ($row_array = mysql_fetch_assoc($result_array))
		{
			$id = $row_array['id'] ;
			
			$sql_township = "SELECT *  FROM  city_township where township_city='$id'  ";
			$result_township = execute_sql($database_name, $sql_township, $link);
			
			if (mysql_num_rows($result_township)!=NULL)
			{
				echo '<li>';
				
				?>
				<div <?php
							$sql_check_city = "
							SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_city='$id'  
							UNION
							SELECT ass_pdu_ip FROM ass_pdu WHERE ass_pdu_city='$id' 
							UNION
							SELECT ass_4Gip FROM ass_4Ggrouter WHERE ass_4Ggrouter_city='$id' 
							UNION
							SELECT ass_ip FROM ass_grouter WHERE ass_grouter_city='$id'  
							UNION
							SELECT ass_poesw_ip FROM ass_poesw WHERE ass_poesw_city='$id'  ";
							$result_check_city = execute_sql($database_name, $sql_check_city, $link);
							while ($row_check_city  = mysql_fetch_assoc($result_check_city))
							{
							$subject_check_city = $row_check_city['ass_ap_ip'];
							//echo $subject_check_city;
							//echo '<br>';
							if(preg_match("/$subject_check_city/","$check_ip_death")) {
							//echo "OK";
							//echo '<br>';
							$city_Equipment =1;

							} else {
							//echo "error";
							//echo '<br>';
							$city_Equipment =0;
							}


							if($city_Equipment>0){ echo 'style="background-color:#FFBB73;"' ;}	
							}
				
				?> >
				<?php
				echo $row_array["city_name"] ;
				//echo '<br>';
				echo '</div >';

				$sql_township1 = "SELECT *  FROM  city_township where township_city='$id'   ";
				$result_township1 = execute_sql($database_name, $sql_township1, $link);
				while ($row_township1 = mysql_fetch_assoc($result_township1))
				{ 
					echo '<ul>';	
					echo '<li>';
					$township_id = $row_township1["township_id"] ;
					
					?>
					<div   <?php  	$SQL2 = "
								SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_twon='township_id'  
								UNION
								SELECT ass_pdu_ip FROM ass_pdu WHERE ass_pdu_twon='$township_id' 
								UNION
								SELECT ass_4Gip FROM ass_4Ggrouter WHERE ass_4Ggrouter_twon='$township_id' 
								UNION
								SELECT ass_ip FROM ass_grouter WHERE ass_grouter_twon='$township_id'  
								UNION
								SELECT ass_poesw_ip FROM ass_poesw WHERE ass_poesw_twon='$township_id'  ";
								$result_SQL2 = execute_sql($database_name, $SQL2, $link);
								//echo $SQL2;
								while ($row_SQL2  = mysql_fetch_assoc($result_SQL2))
								{
								$subject_check_twon = $row_SQL2['ass_ap_ip'];
								//echo $subject_check_city;
								//echo '<br>';
								if(preg_match("/$subject_check_twon/","$check_ip_death")) {
								//echo "OK";
								//echo '<br>';
								$twon_Equipment =1;

								} else {
								//echo "error";
								//echo '<br>';
								$twon_Equipment =0;
								}
								//echo $twon_Equipment;
								//echo '<br>';
								if($twon_Equipment>0){ echo 'style="background-color:#FFBB73;"' ;}	
								}

						
						?>>
					<?php
					echo $row_township1["township_name"] ;
					echo  '</div>';
					//echo '<br>';
					echo '</li>';
					$sql_tribe = "SELECT *  FROM  tribe where township_id='$township_id'   ";
					$result_tribe = execute_sql($database_name, $sql_tribe, $link);
					while ($row_tribe = mysql_fetch_assoc($result_tribe))
					{
						$tribe_id = $row_tribe["tribe_id"] ;
						//echo  $tribe_id ;
						echo '<ul>';
						echo '<li>';
						
					
						
						?>
						<div   <?php
								$SQL = "
								SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_tribe='$tribe_id'  
								UNION
								SELECT ass_pdu_ip FROM ass_pdu WHERE ass_pdu_tribe='$tribe_id' 
								UNION
								SELECT ass_4Gip FROM ass_4Ggrouter WHERE ass_4Ggrouter_tribe='$tribe_id' 
								UNION
								SELECT ass_ip FROM ass_grouter WHERE ass_grouter_tribe='$tribe_id'  
								UNION
								SELECT ass_poesw_ip FROM ass_poesw WHERE ass_poesw_tribe='$tribe_id'  ";
								$result_SQL = execute_sql($database_name, $SQL, $link);
								//echo $SQL;
								while ($row_SQL  = mysql_fetch_assoc($result_SQL))
								{
								$subject_check_tribe = $row_SQL['ass_ap_ip'];
								//echo $subject_check_city;
								//echo '<br>';
								if(preg_match("/$subject_check_tribe/","$check_ip_death")) {
								//echo "OK";
								//echo '<br>';
								$tribe_Equipment =1;

								} else {
								//echo "error";
								//echo '<br>';
								$tribe_Equipment =0;
								}
								//echo $tribe_Equipment;
								//echo '<br>';
								if($tribe_Equipment>0){ echo 'style="background-color:#FFBB73;"' ;}	
								}
						?>
						>
						<?php
						echo $row_tribe["tribe_name"];
						echo  '</div>';
						echo '</li>';
						
						echo '</ul>';
					}
					echo '</ul>';
				}
				echo '</li>';
				
			}
		}	
	echo '</ol>';
?>