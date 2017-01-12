<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>total</title>
<style>
#wrap {
    width: 98%;
    overflow-x: hidden;
    margin: 0px auto;
    padding: 10px 0;
    background: #fff;
	text-align:center;
}
.table_name {}
.report {
	display:inline-block;
    margin: 0 10px 20px;
	padding:10px;
    width:250px;
    height: 180px;
	background:#eee;
	border-radius:5px;
	overflow-x:hidden;
	overflow:auto;
}

</style>
</head>

<body>
<div id="wrap">

    <h1 class="table_name" align="center">TX_and_Rx</h1>
	
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
		echo '<div class="report">';
		echo $today_year.'年'; 
		echo $moon[$i].'月<br/>';

				while ($row = mysql_fetch_assoc($result))
				{

					echo $row['ssid_itaiwan'];echo '<br>';
					echo 'RX總和：'.$row['SUM(itaiwan_rx)'];echo '<br>';
					echo 'TX總和：'.$row['SUM(itaiwan_tx)'];echo '<br>';
					
					echo $row['itaiwan_itribe'];echo '<br>';
					echo 'RX總和：'.$row['SUM(itribe_rx)'];echo '<br>';
					echo 'TX總和：'.$row['SUM(itribe_tx)'];echo '<br>';
				}
		echo '</div>';
		}		
		//釋放記憶體空間
		mysql_free_result($result);
		mysql_close($link);
		?>

<h1 align="center">TX_and_Rx_5G</h1>
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
	$sql = "SELECT  ssid_itaiwan_5G, SUM(itaiwan_rx_5G),SUM(itaiwan_tx_5G),itaiwan_itribe_5G,SUM(itribe_rx_5G) ,SUM(itribe_tx_5G)   FROM TX_and_Rx_5G WHERE `timestamp_5G` LIKE '$moon[$i]/%' and `timestamp_5G` LIKE '%$today_year%'  ORDER BY timestamp_5G DESC";	
	$result = execute_sql($database_name, $sql, $link);

		echo '<div class="report">';
		echo $today_year.'年'; 
		echo $moon[$i].'月<br/>';

				while ($row = mysql_fetch_assoc($result))
				{

					echo $row['ssid_itaiwan_5G'];echo '<br>';
					echo $row['SUM(itaiwan_rx_5G)'];echo '<br>';
					echo $row['SUM(itaiwan_tx_5G)'];echo '<br>';

					echo $row['itaiwan_itribe_5G'];echo '<br>';
					echo $row['SUM(itribe_rx_5G)'];echo '<br>';
					echo $row['SUM(itribe_tx_5G)'];echo '<br>';
				}
		echo '</div>';
	  
	  
	/*echo $today_year;echo '<br>';
      echo $moon[$i];echo '<br>';

			while ($row = mysql_fetch_assoc($result))
		      {
echo $row['ssid_itaiwan_5G'];echo '<br>';
echo $row['SUM(itaiwan_rx_5G)'];echo '<br>';
echo $row['SUM(itaiwan_tx_5G)'];echo '<br>';
                                           echo '-------------';echo '<br>';
					 echo $row['itaiwan_itribe_5G'];echo '<br>';
					echo $row['SUM(itribe_rx_5G)'];echo '<br>';
					echo $row['SUM(itribe_tx_5G)'];echo '<br>';
  echo '-------------';echo '<br>';*/
	}		
	//釋放記憶體空間
	mysql_free_result($result);
	mysql_close($link);
    ?> 

<h1 align="center">new_Client_Associations</h1>
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
		$sql = "SELECT  ssid_itaiwan, SUM(itaiwan_fail_ass),ssid_itribe ,SUM(itribe_fail_ass)   from  new_Client_Associations WHERE `timestamp` LIKE '$moon[$i]/%' and `timestamp` LIKE '%$today_year%' ";	
		$result = execute_sql($database_name, $sql, $link);
		
		echo '<div class="report">';
		echo $today_year.'年'; 
		echo $moon[$i].'月<br/>';

				while ($row = mysql_fetch_assoc($result))
				{

					echo $row['ssid_itaiwan'];echo '<br>';
		 			echo 'SUM(itaiwan_fail_ass):'.$row['SUM(itaiwan_fail_ass)'];echo '<br>';
					
					echo $row['ssid_itribe'];echo '<br>';
					echo  'SUM(itribe_fail_ass):'.$row['SUM(itribe_fail_ass)'];echo '<br>';
				}
		echo '</div>';
/*
	echo $today_year;echo '<br>';
      echo $moon[$i];echo '<br>';

			while ($row = mysql_fetch_assoc($result))
		      {
				      echo $row['ssid_itaiwan'];echo '<br>';
		 			 echo 'SUM(itaiwan_fail_ass):'.$row['SUM(itaiwan_fail_ass)'];echo '<br>';
                                           echo '-------------';echo '<br>';
					 echo $row['ssid_itribe'];echo '<br>';
					echo  'SUM(itribe_fail_ass):'.$row['SUM(itribe_fail_ass)'];echo '<br>';
  echo '-------------';echo '<br>';
*/

	}		
	//釋放記憶體空間
	mysql_free_result($result);
	mysql_close($link);
?> 

<h1 align="center">new_Client_Associations_5G</h1>
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
	$sql = "SELECT  ssid_itaiwan_5G,MAX(itaiwan_max),MIN(itaiwan_min),ssid_itribe_5G ,MAX(itribe_max),MIN(itribe_min) FROM  new_Client_Associations_5G WHERE timestamp_5G LIKE '$moon[$i]/%' and timestamp_5G LIKE '%$today_year%' ";	

	$result = execute_sql($database_name, $sql, $link);
		echo '<div class="report">';
		echo $today_year.'年'; 
		echo $moon[$i].'月<br/>';

				while ($row = mysql_fetch_assoc($result))
				{

					echo $row['ssid_itaiwan_5G'];echo '<br>';
					echo 'MAX(itaiwan_max):'.$row['MAX(itaiwan_max)'];echo '<br>';
					echo  'MIN(itaiwan_min):'.$row['MIN(itaiwan_min)'];echo '<br>';
					
					echo $row['ssid_itribe_5G'];echo '<br>';
					echo  'MAX(itribe_max):'.$row['MAX(itribe_max)'];echo '<br>';
					echo  'MIN(itribe_min):'.$row['MIN(itribe_min)'];echo '<br>';
				}
		echo '</div>';		
		}
/*
	echo $today_year;echo '<br>';
      echo $moon[$i];echo '<br>';

			while ($row = mysql_fetch_assoc($result))
		      {
				      echo $row['ssid_itaiwan_5G'];echo '<br>';
		 			 echo 'MAX(itaiwan_max):'.$row['MAX(itaiwan_max)'];echo '<br>';
					echo  'MIN(itaiwan_min):'.$row['MIN(itaiwan_min)'];echo '<br>';
                                           echo '-------------';echo '<br>';
					 echo $row['ssid_itribe_5G'];echo '<br>';
					echo  'MAX(itribe_max):'.$row['MAX(itribe_max)'];echo '<br>';
					echo  'MIN(itribe_min):'.$row['MIN(itribe_min)'];echo '<br>';
  echo '-------------';echo '<br>';
			 }

*/
	//釋放記憶體空間
	mysql_free_result($result);
	mysql_close($link);
    ?>

<h1 align="center">Failed_Client_Associations</h1>
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
		$sql = "SELECT  ssid_itaiwan,SUM(itaiwan_fail_ass),ssid_itribe,SUM(itribe_fail_ass) FROM  Failed_Client_Associations WHERE timestamp LIKE '$moon[$i]/%' and timestamp LIKE '%$today_year%' ";	

		$result = execute_sql($database_name, $sql, $link);
		echo '<div class="report">';
		echo $today_year.'年'; 
		echo $moon[$i].'月<br/>';

				while ($row = mysql_fetch_assoc($result))
				{

					echo $row['ssid_itaiwan'];echo '<br>';
		 			echo 'SUM(itaiwan_fail_ass):'.$row['SUM(itaiwan_fail_ass)'];echo '<br>';
					
					echo $row['ssid_itribe'];echo '<br>';
					echo  'SUM(itribe_fail_ass):'.$row['SUM(itribe_fail_ass)'];echo '<br>';
				}
		echo '</div>';		
		}
/*
	echo $today_year;echo '<br>';
      echo $moon[$i];echo '<br>';

			while ($row = mysql_fetch_assoc($result))
		      {
				      echo $row['ssid_itaiwan'];echo '<br>';
		 			 echo 'SUM(itaiwan_fail_ass):'.$row['SUM(itaiwan_fail_ass)'];echo '<br>';
					
                                           echo '-------------';echo '<br>';
					 echo $row['ssid_itribe'];echo '<br>';
					echo  'SUM(itribe_fail_ass):'.$row['SUM(itribe_fail_ass)'];echo '<br>';
					
  echo '-------------';echo '<br>';
			 }
*/
	//釋放記憶體空間
	mysql_free_result($result);
	mysql_close($link);
    ?> 

<h1 align="center">Failed_Client_Associations_5G</h1>
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
		$sql = "SELECT  ssid_itaiwan_5G,SUM(itaiwan_fail_ass_5G),ssid_itribe_5G,SUM(itribe_fail_ass_5G) FROM  Failed_Client_Associations_5G WHERE timestamp_5G  LIKE '$moon[$i]/%' and timestamp_5G LIKE '%$today_year%' ";	

		$result = execute_sql($database_name, $sql, $link);
			echo '<div class="report">';
			echo $today_year.'年'; 
			echo $moon[$i].'月<br/>';

					while ($row = mysql_fetch_assoc($result))
					{

						echo $row['ssid_itaiwan_5G'];echo '<br>';
						echo 'SUM(itaiwan_fail_ass_5G):'.$row['SUM(itaiwan_fail_ass_5G)'];echo '<br>';
						
						echo $row['ssid_itribe_5G'];echo '<br>';
						echo  'SUM(itribe_fail_ass_5G):'.$row['SUM(itribe_fail_ass_5G)'];echo '<br>';
					}
			echo '</div>';		
			}
/*
	echo $today_year;echo '<br>';
      echo $moon[$i];echo '<br>';

			while ($row = mysql_fetch_assoc($result))
		      {
				      echo $row['ssid_itaiwan_5G'];echo '<br>';
		 			 echo 'SUM(itaiwan_fail_ass_5G):'.$row['SUM(itaiwan_fail_ass_5G)'];echo '<br>';
					
                                           echo '-------------';echo '<br>';
					 echo $row['ssid_itribe_5G'];echo '<br>';
					echo  'SUM(itribe_fail_ass_5G):'.$row['SUM(itribe_fail_ass_5G)'];echo '<br>';
					
  echo '-------------';echo '<br>';
			 }
*/	
      //釋放記憶體空間
      mysql_free_result($result);
      mysql_close($link);
    ?>



</div>
</body>
</html>
