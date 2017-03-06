<!DOCTYPE>

<html>

	<head>
		<title>cytoscape-dagre.js demo</title>

		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

		<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
		<script src="http://cytoscape.github.io/cytoscape.js/api/cytoscape.js-latest/cytoscape.min.js"></script>

		<!-- for testing with local version of cytoscape.js -->
		<!--<script src="../cytoscape.js/build/cytoscape.js"></script>-->

		<script src="https://cdn.rawgit.com/cpettitt/dagre/v0.7.4/dist/dagre.min.js"></script>
		<script src="https://cdn.rawgit.com/cytoscape/cytoscape.js-dagre/1.1.2/cytoscape-dagre.js"></script>
<?php

include("../../SQL/dbtools_ps.php"); 
include_once("../../SQL/dbtools.inc.php");
$link = create_connection();
?>
		<style>
			body {
				font-family: helvetica;
				font-size: 14px;
			}

			#cy {
				width: 100%;
				height: 100%;
				position: absolute;
				left: 0;
				top: 0;
				z-index: 999;
			}

			h1 {
				opacity: 0.5;
				font-size: 1em;
			}
		</style>

		<script>
			$(function(){

				var cy = window.cy = cytoscape({
					container: document.getElementById('cy'),

          boxSelectionEnabled: false,
          autounselectify: true,

					layout: {
						name: 'dagre'
					},

					style: [
						{
							selector: 'node',
							style: {
								'content': 'data(id)',
								'text-opacity': 0.5,
								'text-valign': 'center',
								'text-halign': 'right',
								'background-color': '#11479e'
							}
						},

						{
							selector: 'edge',
							style: {
								'width': 4,
								'target-arrow-shape': 'triangle',
								'line-color': '#9dbaea',
								'target-arrow-color': '#9dbaea',
								'curve-style': 'bezier'
							}
						}
					],

					elements: {
						nodes: [
							{ data: { id: 'ROOT', name: 'ROOT', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
<?php
	$sql_city = "SELECT city_name,id FROM city_array";
	$result_city = execute_sql($database_name, $sql_city, $link);
	while ($row_city = mysql_fetch_assoc($result_city))
	{
		echo "{ data: { id: '".$row_city['city_name']."', name: '".$row_city['city_name']."', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },";
		//echo "{ data: { source: 'ROOT', target: '".$row_city['city_name']."', faveColor: '#6FB1FC', strength: 90 } },";
	}
?>	
						],
						edges: [
							<?php
	$sql_city = "SELECT city_name,id FROM city_array";
	$result_city = execute_sql($database_name, $sql_city, $link);
	while ($row_city = mysql_fetch_assoc($result_city))
	{
		$ID = $row_city['id'];
		//echo "{ data: { id: '".$row_city['city_name']."', name: '".$row_city['city_name']."', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },";
		echo "{ data: { source: 'ROOT', target: '".$row_city['city_name']."', faveColor: '#6FB1FC', strength: 90 } },";
		$sql_township = "SELECT * FROM city_township where township_city='$ID' ";
		$result_township = execute_sql($database_name, $sql_township, $link);
		while ($row_township = mysql_fetch_assoc($result_township))
		{
		$ID2 = $row_township['township_id'];	
		echo "{ data: { source: '".$row_city['city_name']."', target: '".$row_township['township_name']."', faveColor: '#6FB1FC', strength: 90 } },";
		//
		$sql_tr = "SELECT * FROM tribe where township_id='$ID2' ";
		//echo $sql_tr ;
		$result_tr = execute_sql($database_name, $sql_tr, $link);
		while ($row_tr = mysql_fetch_assoc($result_tr))
		{
			echo "{ data: { source: '".$row_township['township_name']."', target: '".$row_tr['tribe_name']."', faveColor: '#6FB1FC', strength: 90 } },";	
		}
	
		}
		
	}
?>	
						]
					},
				});

			});
		</script>
	</head>

	<body>
		<h1>cytoscape-dagre demo</h1>

		<div id="cy"></div>

	</body>

</html>
