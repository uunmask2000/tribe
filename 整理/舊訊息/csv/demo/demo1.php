<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>TX_and_Rx</title>
  </head>
  <body>
    <h1 align="center">TX_and_Rx</h1>
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
       $sql = "SELECT  ssid_itaiwan, SUM(itaiwan_rx),SUM(itaiwan_tx),itaiwan_itribe ,SUM(itribe_rx) ,SUM(itribe_tx)   FROM TX_and_Rx WHERE `timestamp` LIKE '$moon[$i]/%' and `timestamp` LIKE '%$today_year%'  ORDER BY timestamp DESC";	
      $result = execute_sql($database_name, $sql, $link);
	echo $today_year;echo '<br>';
      echo $moon[$i];echo '<br>';

			while ($row = mysql_fetch_assoc($result))
		      {
				      echo $row['ssid_itaiwan'];echo '<br>';
		 			 echo $row['SUM(itaiwan_rx)'];echo '<br>';
		 			 echo $row['SUM(itaiwan_tx)'];echo '<br>';
                                           echo '-------------';echo '<br>';
					 echo $row['itaiwan_itribe'];echo '<br>';
					echo $row['SUM(itribe_rx)'];echo '<br>';
					echo $row['SUM(itribe_tx)'];echo '<br>';
  echo '-------------';echo '<br>';
			 }


     


	}		
      //釋放記憶體空間
      mysql_free_result($result);
      mysql_close($link);
    ?> 
  </body>
</html>
