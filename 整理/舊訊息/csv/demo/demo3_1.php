<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);
		
		
      function drawStuff()
		{
			<?php
			 require_once("dbtools.inc.php");
			$link = create_connection();
			$moon = array('00','01','02','03','04','05','06','07','08','09','10','11','12',);
			$today_year = date("Y");  
			for($x=1;$x<=12;$x++){
				
			$sql = "SELECT ssid_itaiwan, SUM(itaiwan_rx),SUM(itaiwan_tx),ssid_itribe ,SUM(itribe_rx) ,SUM(itribe_tx) FROM TX_and_Rx WHERE `timestamp` LIKE '$moon[$x]/%'  ";	
			$result = execute_sql($database_name, $sql, $link);
			
			$sql2 = "SELECT SUM(itaiwan_rx_5G),SUM(itaiwan_tx_5G) ,SUM(itribe_rx_5G) ,SUM(itribe_tx_5G) FROM TX_and_Rx_5G WHERE `timestamp_5G` LIKE '$moon[$x]/%'  ";	
			$result2 = execute_sql($database_name, $sql2, $link);
			
			
			$sql3 = "SELECT  SUM(itaiwan_fail_ass),SUM(itribe_fail_ass)   from  new_Client_Associations WHERE `timestamp` LIKE '$moon[$x]/%'  ";	
			$result3 = execute_sql($database_name, $sql3, $link);
			
			$sql4 = "SELECT  SUM(itaiwan_max),SUM(itaiwan_min),SUM(itribe_max),SUM(itribe_min)   from  new_Client_Associations_5G WHERE `timestamp_5G` LIKE '$moon[$x]/%'  ";	
			$result4 = execute_sql($database_name, $sql4, $link);
			
			$sql5 = "SELECT  SUM(itaiwan_fail_ass),SUM(itribe_fail_ass)   from  Failed_Client_Associations WHERE `timestamp` LIKE '$moon[$x]/%'  ";	
			$result5 = execute_sql($database_name, $sql5, $link);
			
			$sql6 = "SELECT  SUM(itaiwan_fail_ass_5G),SUM(itribe_fail_ass_5G)   from  Failed_Client_Associations_5G WHERE `timestamp_5G` LIKE '$moon[$x]/%'  ";	
			$result6 = execute_sql($database_name, $sql5, $link);
		
			?>
		<!--- alert("<?php echo $sql4 ;?>");  --->
			<?php
			
			while ($row = mysql_fetch_assoc($result) and $row2 = mysql_fetch_assoc($result2) and $row3 = mysql_fetch_assoc($result3)  and $row4 = mysql_fetch_assoc($result4) and $row5 = mysql_fetch_assoc($result5) and $row6 = mysql_fetch_assoc($result6) )
				{
					$itaiwan_rx = $row['SUM(itaiwan_rx)'];
					$itaiwan_tx =$row['SUM(itaiwan_tx)'];
					$itribe_rx = $row['SUM(itribe_rx)'];
					$itribe_tx =$row['SUM(itribe_tx)'];
					
					if(empty($itribe_rx)){
						
						$itribe_rx = 0;
						}

					if(empty($itribe_tx)){
						
						$itribe_tx = 0;
						}

				if(empty($itaiwan_tx)){
						
						$itaiwan_tx = 0;
						}

					if(empty($itaiwan_rx)){
						
						$itaiwan_rx = 0;
						}
					///////
					$itaiwan_rx_5G = $row2['SUM(itaiwan_rx_5G)'];
					$itaiwan_tx_5G =$row2['SUM(itaiwan_tx_5G)'];
					$itribe_rx_5G = $row2['SUM(itribe_rx_5G)'];
					$itribe_tx_5G =$row2['SUM(itribe_tx_5G)'];
					
					if(empty($itribe_rx_5G)){
						
						$itribe_rx_5G = 0;
						}
					
					if(empty($itribe_tx_5G)){
						
						$itribe_tx_5G = 0;
						}
					
				if(empty($itaiwan_tx_5G)){
						
						$itaiwan_tx_5G = 0;
						}
					
					
					if(empty($itaiwan_rx_5G)){
						
						$itaiwan_rx_5G = 0;
						}
					/////// new_Client_Associations
					$itaiwan_fail_ass = $row3['SUM(itaiwan_fail_ass)'];
					$itribe_fail_ass =$row3['SUM(itribe_fail_ass)'];
				
					
				if(empty($itaiwan_fail_ass)){
						
						$itaiwan_fail_ass = 0;
						}
					
					
					if(empty($itribe_fail_ass)){
						
						$itribe_fail_ass = 0;
						}
				    /// new_Client_Associations_5G
				    	$itaiwan_max = $row4['SUM(itaiwan_max)'];
						$itaiwan_min = $row4['SUM(itaiwan_min)'];
						$itribe_max = $row4['SUM(itribe_max)'];
						$itribe_min = $row4['SUM(itribe_min)'];
				   
					if(empty($itaiwan_max)){
						
						$itaiwan_max = 0;
						}
					
					
					if(empty($itaiwan_min)){
						
						$itaiwan_min = 0;
						}
						
							if(empty($itribe_max)){
						
						$itribe_max = 0;
						}
					
					
					if(empty($itribe_min)){
						
						$itribe_min = 0;
						}
							/////// Failed_Client_Associations
					$Failed_itaiwan_fail_ass = $row5['SUM(itaiwan_fail_ass)'];
					$Failed_itribe_fail_ass =$row5['SUM(itribe_fail_ass)'];
				
					
				if(empty($Failed_itaiwan_fail_ass)){
						
						$Failed_itaiwan_fail_ass = 0;
						}
					
					
					if(empty($Failed_itribe_fail_ass)){
						
						$Failed_itribe_fail_ass = 0;
						}
					/////// Failed_Client_Associations_5G
						$Failed_itaiwan_fail_ass_5G = $row6['SUM(itaiwan_fail_ass_5G)'];
					$Failed_itribe_fail_ass_5G =$row6['SUM(itribe_fail_ass_5G)'];
				
					
				if(empty($Failed_itaiwan_fail_ass_5G)){
						
						$Failed_itaiwan_fail_ass_5G = 0;
						}
					
					
					if(empty($Failed_itribe_fail_ass_5G)){
						
						$Failed_itribe_fail_ass_5G = 0;
						}
					
					?>
				
					
					var data<?php echo $x ;?> = new google.visualization.arrayToDataTable([
				  ['<?php echo $x ;?>月', 'ssid_itribe', 'ssid_itaiwan'],
				  ['TX', <?php echo $itribe_tx ;?>, <?php echo $itaiwan_tx ;?>],
				  ['RX', <?php echo $itribe_rx ;?>, <?php echo $itaiwan_rx ;?>],
				  ['TX_5G', <?php echo $itribe_tx_5G ;?>, <?php echo $itaiwan_tx_5G ;?>],
				  ['RX_5G', <?php echo $itribe_rx_5G ;?>, <?php echo $itaiwan_rx_5G ;?>],
				  ['New_Client_Associations', <?php echo $itribe_fail_ass ;?>, <?php echo $itaiwan_fail_ass ;?>],
				  ['New_Client_Associations_5G_MAX', <?php echo $itribe_max ;?>, <?php echo $itaiwan_max ;?>],
			      ['New_Client_Associations_5G_MIN', <?php echo $itribe_min ;?>, <?php echo $itaiwan_min ;?>],
		          ['Failed_Client_Associations', <?php echo $Failed_itribe_fail_ass ;?>, <?php echo $Failed_itaiwan_fail_ass ;?>],
		          ['Failed_Client_Associations_5G', <?php echo $Failed_itribe_fail_ass_5G ;?>, <?php echo $Failed_itaiwan_fail_ass_5G ;?>],
				]);

				var options<?php echo $x ;?> = {
				
				 // width: 800,
				//  chart: {
				//   title: 'Nearby galaxies',
				//    subtitle: 'distance on the left, brightness on the right'
				//  },
				  
				  bars: 'horizontal', // Required for Material Bar Charts.
				  series: {
					0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
					1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
				  },
				  axes: {
					x: {
					  distance: {label: '數值'}, // Bottom x-axis.
					 // brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
					 brightness: {side: 'top', label: '統計總表'}
					}
				  }
				};

			  var chart<?php echo $x ;?> = new google.charts.Bar(document.getElementById('div_<?php echo $x ;?>'));
			  chart<?php echo $x ;?>.draw(data<?php echo $x ;?>, options<?php echo $x ;?>);
				
					
					<?php
				}
			 //echo $x."<br />";
                               ?>
				

				<?php




			//下面二行為了防止無限迴圈
			if($x>15)
			  exit;
			  
			}
			?>
   
				
			
				
		};
    </script>
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
		width:600px;
		height: 400px;
		background:#eee;
		border-radius:5px;
		overflow-x:hidden;
		overflow:auto;
	}

	</style>
</head>
<body>
	<div id="wrap">
      <?php
     
      
	for($xx=1;$xx<=12;$xx++)
	{
		echo '<div id="div_'.$xx.'" class="report"></div>';
	}

		?>
    
	</div>
</body>
</html>
