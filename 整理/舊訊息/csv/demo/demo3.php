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
			while ($row = mysql_fetch_assoc($result))
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
					?>
					
					var data<?php echo $x ;?> = new google.visualization.arrayToDataTable([
				  ['<?php echo $x ;?>月', '<?php echo $row['ssid_itribe'] ; ?>', '<?php echo $row['ssid_itaiwan'] ?>'],
				  ['TX', <?php echo $itribe_tx ;?>, <?php echo $itaiwan_tx ;?>],
				  ['RX', <?php echo $itribe_rx ;?>, <?php echo $itaiwan_rx ;?>]
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
					 brightness: {side: 'top', label: 'TX/RX'}
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
		width:400px;
		height: 300px;
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
	
	for($xx=1;$xx<=12;$xx++)
	{
		echo '<div id="div_'.$xx.'" class="report"></div>';
	}

		?>
    

  </body>
</html>
