<?php

 function create_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	$link = @mysql_connect("localhost","root","0932969495","AP_data") or die("無法建立連接");
    //$link = @mysql_connect("localhost","mooncat0301","12345678","counter") or die("無法建立連接");  	
    mysql_query("SET NAMES utf8");
			   	
    return $link;
  }
	
  function execute_sql($database, $sql, $link)
  {
    $db_selected = mysql_select_db($database, $link)
      or die("開啟資料庫失敗<br><br>" . mysql_error($link));
						 
    $result = mysql_query($sql, $link);
		
    return $result;
  }
  $database_name = "AP_data";   /// 之後 SQL 語法帶入參數 


function create_ps_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	//$link = @mysql_connect("localhost","root","0932969495","AP_data") or die("無法建立連接");
	$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
	
    //$link = @mysql_connect("localhost","mooncat0301","12345678","counter") or die("無法建立連接");  	
    //mysql_query("SET NAMES utf8");
    return $conn;
  }




	$link = create_connection();
	$conn= create_ps_connection();

?>


<?php
	$month_row =date("Y-m-d", strtotime('-14 day'));
	$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 	INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id 	where serviceid=2 and iflostservice >'$month_row' ORDER BY iflostservice desc";
	//$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id where serviceid=2 and  ifregainedservice is NULL";
	
	//where serviceid=2 and iflostservice like '%2016%' ORDER BY iflostservice desc";
	$result_outages = pg_query($conn,$sql_text );
	// $total_records2 = pg_num_rows($result_outages);
	//echo $sql_text;
	//echo '<br>';
	//exit();
  
	while ($row_outages = pg_fetch_row($result_outages) )
	{

			$iflostservice =$row_outages[0];//斷線時間	
			$ifregainedservice =$row_outages[2];//斷線時間	
			$events_id=$row_outages[5];//eventid	
			$outageid_pg  =   $row_outages[3];              //outageid	代號
			$svclosteventid_pg  =  $row_outages[5];       //svclosteventid 代號	

			$sql_events =" SELECT nodeid	FROM events where eventid='$events_id'   ";
			$result_events = pg_query($conn,$sql_events );//echo  $sql_events ;
			while ($row_events = pg_fetch_row($result_events) )
			{
				 $node_id = $row_events[0];	
						$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'   ";
						$result_ipinterface = pg_query($conn,$sql_ipinterface );	
						while ($row_ipinterface = pg_fetch_row($result_ipinterface) )
						{ 
							$query_ip = $row_ipinterface[0];
								$sql_AP = "SELECT * FROM ass_ap  where  ass_ap_ip='$query_ip'  ";
								$result_AP = execute_sql($database_name, $sql_AP, $link);
								while ($row_AP = mysql_fetch_assoc($result_AP))
								{ 	
									$ass_ap_city =$row_AP['ass_ap_city'] ;
									$ass_ap_twon =$row_AP['ass_ap_twon'] ;
									$ass_ap_tribe =$row_AP['ass_ap_tribe'] ;
									$ass_ap_name = $row_AP['ass_ap_name'];
									$ass_ap_ip = $row_AP['ass_ap_ip'];
		$sql_city = "SELECT * FROM city_array  where  id='$ass_ap_city' ";
		$result_city = execute_sql($database_name, $sql_city, $link);
		while ($row_city = mysql_fetch_assoc($result_city))
		{ 
		$city_name =$row_city['city_name'];
		//echo  $city_name ;		
		}
		$sql_township = "SELECT * FROM city_township  where  township_id='$ass_ap_twon' ";
		$result_township = execute_sql($database_name, $sql_township, $link);
		while ($row_township = mysql_fetch_assoc($result_township))
		{ 
		$township_name = $row_township['township_name'];
		// echo  $township_name ;
		}
		$sql_tribe = "SELECT * FROM  tribe  where  tribe_id='$ass_ap_tribe' ";
		$result_tribe = execute_sql($database_name, $sql_tribe, $link);
		while ($row_tribe = mysql_fetch_assoc($result_tribe))
		{ 
		$tribe_name = $row_tribe['tribe_name'];
		$tribe_label_2 = $row_tribe['tribe_label'];
		//echo $tribe_name;
		}
		$alert_ap_date_setting = $ass_ap_city.'-'.$ass_ap_twon.'-'.$ass_ap_tribe;
		/////
			$output = explode(":", $iflostservice);
			$output1 =  $output[0];	
			$output11 = explode(" ", $output1);


			//echo $output11[0];

			$pII = explode("-", $output11[0]);
			if($pII[2]<10){ 
			$pII[2]='0'.$pII[2];
			}else{ 
			$pII[2]=$pII[2];
			}

			if($output11[1]<10){ 
			$output11[1]= '0'.$output11[1];
			}else{ 
			$output11[1]=$output11[1];
			}
			if($output[1]<10){ $output[1] ='0'.$output[1];}else{  $output[1]=$output[1];}

			$YMD_string = $pII[0].'-'.$pII[1].'-'.$pII[2].' '.$output11[1].':'.$output[1];
		   ///
			$output = explode(":", $ifregainedservice);
			$output1 =  $output[0];
			$output11 = explode(" ", $output1);
			//echo $output11[0];
			//echo ' ';
			if(empty($output[1]))
			{
			$YMD_string_2 = '';
			}else{
			if($output11[1]<10){ $output11[1]= $output11[1];}else{  $output11[1]=$output11[1];}
			if($output[1]<10){ $output[1]=$output[1];}else{  $output[1]=$output[1];}			
			$YMD_string_2 =  $output11[0].' '.$output11[1].':'.$output[1];
			}
			
			$sql = "SELECT * FROM alert_ap_date WHERE alert_ap_date_outageid ='$outageid_pg' AND alert_ap_date_svclosteventid ='$svclosteventid_pg' ";
			$result = execute_sql($database_name, $sql, $link);
			$number = mysql_num_rows($result);	
			if($number==0)
			{
			$sql = "INSERT INTO alert_ap_date(alert_ap_date_outageid, alert_ap_date_svclosteventid, alert_ap_date_city,alert_ap_date_township,alert_ap_date_tribe,alert_ap_date_ap_name,alert_ap_date_ap_ip,alert_ap_date_time_dead,alert_ap_date_time_ok,alert_ap_date_setting,Period_AP)
			VALUES('$outageid_pg','$svclosteventid_pg','$city_name','$township_name','$tribe_name','$ass_ap_name','$ass_ap_ip','$YMD_string','$YMD_string_2','$alert_ap_date_setting','$tribe_label_2')";
			execute_sql($database_name, $sql, $link);
			
				//echo $ass_ap_ip ;
				echo $sql ;
				echo '<br>';
			}else{
			$sql = "UPDATE alert_ap_date SET alert_ap_date_time_dead='$YMD_string',alert_ap_date_time_ok='$YMD_string_2',Period_AP='$tribe_label_2' WHERE alert_ap_date_outageid='$outageid_pg' and alert_ap_date_svclosteventid ='$svclosteventid_pg'";
			execute_sql($database_name, $sql, $link);
			
				//echo $ass_ap_ip ;
				echo $sql ;
				echo '<br>';
			}
				
					
		
							
								}
								
							
							
						}	 
			
			}	
				
	}
	

// mysql_close($link);
	// pg_close($conn);

?>