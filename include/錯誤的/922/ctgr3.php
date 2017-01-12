<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

</head>
<body>
	<div class="ctgr">
	<style>
	.intro { 
			background-color: red;
		}
	</style>
<?php
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
	
	
	
	
	<div class="ctgr_city">
		<?php
		//require_once("../SQL/dbtools.inc.php");
		$link = create_connection();
		$sql = "SELECT * FROM city_array ORDER BY city_sort ASC";
		$result = execute_sql($database_name, $sql, $link);
		while ($row = mysql_fetch_assoc($result))
		{
			$id = $row['id'] ;
		
			$sql33 = "SELECT *  FROM  city_township where township_city='$id'  ";
			$result33 = execute_sql($database_name, $sql33, $link);
			if (mysql_num_rows($result33)!=NULL)
			{
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


							if($city_Equipment>0){ echo 'class="intro"' ;}	
							}
				
				?> >
				<?php
				echo  '<a href="index.php?city='.$id.'&address='.$row["city_name"].'&do=do">'.$row["city_name"] .'</a>';
				echo '</div >';
				
				?>
				<div class="ctgr_town"   <?php if($_GET['city']==$id){ ?>style="display:block!important;"<?php };?>             > 

					<?php
					$sql1 = "SELECT *  FROM  city_township where township_city='$id'   ";
					$result1 = execute_sql($database_name, $sql1, $link);
					while ($row1 = mysql_fetch_assoc($result1))
					{   
					$township_id = $row1["township_id"] ;
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
								if($twon_Equipment>0){ echo 'class="intro"' ;}	
								}

						
						?>>
					<?php
					echo  '<a href="index.php?city='.$id.'&township='.$township_id.'&address='.$row["city_name"].'&address2='.$row1["township_name"].'&do=do">'.$row1["township_name"] .'</a>';
						echo  '</div>';
					?>
					<div class="ctgr_tribe" <?php if($_GET['city']==$id and $_GET['township']==$township_id ){ ?>style="display:block!important;"<?php };?>> 

						<?php
						$sql2 = "SELECT *  FROM  tribe where township_id='$township_id'   ";
						$result2 = execute_sql($database_name, $sql2, $link);
						while ($row2 = mysql_fetch_assoc($result2))
						{
							$tribe_id = $row2["tribe_id"] ;

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
								if($tribe_Equipment>0){ echo 'class="intro"' ;}	
								}						?>
						>
						<a href="index.php?city=<?=$id;?>&township=<?=$township_id?>&tribe_id=<?php echo $row2["tribe_id"] ; ?>&address=<?=$_GET["address"];?>&address2=<?=$_GET["address2"];?>&map=<?php echo $row2["tribe_x"] ; ?>,<?php echo $row2["tribe_y"] ; ?>&do=not&size=<?php echo $row2["tribe_o"] ; ?>" target="_self" style="text-decoration:none;color:red;"><?php  echo $row2["tribe_name"] ;   ?></a>
</div>
						<?php

						}
						?>
					</div> 

					<?php

					}
					?>
				</div> 

				<?php
			}
		}

		?>	
	</div>
	</div>



	</body>
</html>
