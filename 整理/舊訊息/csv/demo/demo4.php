<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);
		
		
      function drawStuff()
		{
				
			<?php 
				$moon = array('00','01','02','03','04','05','06','07','08','09','10','11','12',); 
				for ($i = 1; $i < 13; $i++) {
				
				?>
				
				var data<?=$i;?> = new google.visualization.arrayToDataTable([
				  ['一月', '艾部落', '艾台灣'],
				  ['TX', 10, 0.33],
				  ['RX', 20, 13.1]
				]);

				var options<?=$i;?> = {
				
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

			  var chart<?=$i;?>= new google.charts.Bar(document.getElementById('div_'<?=$i;?>));
			  chart<?=$i;?>.draw(data<?=$i;?>, options<?=$i;?>);	
			  
				<?php
				
				}
			
			?>	
			
				
				
				
			
			
				
				
		};
    </script>
  </head>
  <body>
    <div id="div_1" style="width: 900px; height: 500px;"></div>
	<div id="div_2" style="width: 900px; height: 500px;"></div>
	<div id="div_3" style="width: 900px; height: 500px;"></div>
	<div id="div_4" style="width: 900px; height: 500px;"></div>
	<div id="div_5" style="width: 900px; height: 500px;"></div>
	<div id="div_6" style="width: 900px; height: 500px;"></div>
	<div id="div_7" style="width: 900px; height: 500px;"></div>
	<div id="div_8" style="width: 900px; height: 500px;"></div>
	<div id="div_9" style="width: 900px; height: 500px;"></div>
	<div id="div_10" style="width: 900px; height: 500px;"></div>
	<div id="div_11" style="width: 900px; height: 500px;"></div>
	<div id="div_12" style="width: 900px; height: 500px;"></div>
  </body>
</html>