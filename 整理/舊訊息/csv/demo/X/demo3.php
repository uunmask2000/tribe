<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>total</title>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>

	<div id="chart_div<?php echo '2'; ?>"></div>
	<div id="chart_div<?php echo '1'; ?>"></div>
	
	<script>
	google.charts.load('current', {packages: ['corechart', 'bar']});
	google.charts.setOnLoadCallback(drawRightY);
	google.charts.setOnLoadCallback(drawleftY);

	
	function drawRightY() {
		  var data = new google.visualization.arrayToDataTable([
			['City', 'Tx', 'Rx'],
			['I TAIWAN', 1, 2],
			['I TRIBE', 3, 4],
		  ]);

		  var options = {
			chart: {
			  title: 'Tx and Rx',
			  subtitle: 'test'
			},
			hAxis: {
			  title: '???',
			  minValue: 0,
			},
			vAxis: {
			  title: 'XXX'
			},
			bars: 'horizontal',
			axes: {
			  y: {
				0: {side: 'left'}
			  }
			}
		  };
		  var material = new google.charts.Bar(document.getElementById('chart_div<?php echo '2'; ?>'));
		  material.draw(data, options);
		}

	function drawleftY() {
		  var data = new google.visualization.arrayToDataTable([
			['City', '2010 Population', '2000 Population'],
			['New York City, NY', 8175000, 8008000],
			['Los Angeles, CA', 3792000, 3694000],
			['Chicago, IL', 2695000, 2896000],
			['Houston, TX', 2099000, 1953000],
			['Philadelphia, PA', 1526000, 1517000]
		  ]);

		  var options = {
			chart: {
			  title: 'Population of Largest U.S. Cities',
			  subtitle: 'Based on most recent and previous census data'
			},
			hAxis: {
			  title: 'Total Population',
			  minValue: 0,
			},
			vAxis: {
			  title: 'City'
			},
			bars: 'horizontal',
			axes: {
			  y: {
				0: {side: 'right'}
			  }
			}
		  };
		  var material = new google.charts.Bar(document.getElementById('chart_div<?php echo '1'; ?>'));
		  material.draw(data, options);
		}
	</script>

</body>
</html>