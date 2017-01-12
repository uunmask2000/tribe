<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Client_Number</title>
  </head>
  <body>
    <h1 align="center">Client_Number</h1>
    <?php
		date_default_timezone_set('aisa');
      require_once("dbtools.inc.php");
			
       // echo	$today = date("Ymd");  
	$today_year = date("Y"); 
	//$today_moon = date("m"); 
           $moon = array('01','02','03','04','05','06','07','08','09','10','11','12',); 
for ($i = 0; $i < 12; $i++) {
    //echo $i;
      //$moon =  $moon['$i'];
  //echo $moon[$i];;

      //建立資料連接
      $link = create_connection();
       $sql = "SELECT  ssid_itaiwan, MAX(ssid_itaiwan_max_client),MIN(ssid_itaiwan_min_client),ssid_irreibe ,MAX(ssid_irreibe_max_client) ,MIN(ssid_irreibe_min_client)   FROM `Client_Number` WHERE `timestamp` LIKE '$moon[$i]/%' and `timestamp` LIKE '%$today_year%'  ORDER BY timestamp DESC";	
      $result = execute_sql($database_name, $sql, $link);
	echo $today_year;echo '<br>';
      echo $moon[$i];echo '<br>';

			while ($row = mysql_fetch_assoc($result))
		      {
				      echo $row['ssid_itaiwan'];echo '<br>';
		 			 echo $row['MAX(ssid_itaiwan_max_client)'];echo '<br>';
		 			 echo $row['MIN(ssid_itaiwan_min_client)'];echo '<br>';
					 echo $row['ssid_irreibe'];echo '<br>';
					echo $row['MAX(ssid_irreibe_max_client)'];echo '<br>';
					echo $row['MIN(ssid_irreibe_min_client)'];echo '<br>';
			 }


     


	}		
      //釋放記憶體空間
      mysql_free_result($result);
      mysql_close($link);
    ?> 
  </body>
</html>
