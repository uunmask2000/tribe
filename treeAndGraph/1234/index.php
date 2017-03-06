<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet" />
  <meta charset=utf-8 />
  <title>Visual style</title>
  <meta name="viewport" content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="http://cytoscape.github.io/cytoscape.js/api/cytoscape.js-latest/cytoscape.min.js"></script>
  <!---<script src="code.js"></script>--->
<?php

include("../../SQL/dbtools_ps.php"); 
include_once("../../SQL/dbtools.inc.php");
$link = create_connection();
?>

  
  
  
  
  
</head>
  
<body>
  <div id="cy"></div>
<script>
	$(function()
	{ // on dom ready

	$('#cy').cytoscape({
	layout: {
	name: 'cose',
	padding: 10,
	randomize: true
	},

	style: cytoscape.stylesheet()
	.selector('node')
	.css({
	'shape': 'data(faveShape)',
	'width': 'mapData(weight, 40, 80, 20, 60)',
	'content': 'data(name)',
	'text-valign': 'center',
	'text-outline-width': 2,
	'text-outline-color': 'data(faveColor)',
	'background-color': 'data(faveColor)',
	'color': '#fff'
	})
	.selector(':selected')
	.css({
	'border-width': 3,
	'border-color': '#333'
	})
	.selector('edge')
	.css({
	'curve-style': 'bezier',
	'opacity': 0.666,
	'width': 'mapData(strength, 70, 100, 2, 6)',
	'target-arrow-shape': 'triangle',
	'source-arrow-shape': 'circle',
	'line-color': 'data(faveColor)',
	'source-arrow-color': 'data(faveColor)',
	'target-arrow-color': 'data(faveColor)'
	})
	.selector('edge.questionable')
	.css({
	'line-style': 'dotted',
	'target-arrow-shape': 'diamond'
	})
	.selector('.faded')
	.css({
	'opacity': 0.25,
	'text-opacity': 0
	}),

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
<?php
	$sql_township = "SELECT * FROM city_township";
	$result_township = execute_sql($database_name, $sql_township, $link);
	while ($row_township = mysql_fetch_assoc($result_township))
	{
		echo "{ data: { id: '".$row_township['township_name']."', name: '".$row_township['township_name']."', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },";
		//echo "{ data: { source: 'ROOT', target: '".$row_city['city_name']."', faveColor: '#6FB1FC', strength: 90 } },";
	}
?>		
<?php
	$sql_tribe = "SELECT * FROM tribe";
	$result_tribe = execute_sql($database_name, $sql_tribe, $link);
	while ($row_tribe = mysql_fetch_assoc($result_tribe))
	{
		echo "{ data: { id: '".$row_tribe['tribe_name']."', name: '".$row_tribe['tribe_name']."', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },";
		//echo "{ data: { source: 'ROOT', target: '".$row_city['city_name']."', faveColor: '#6FB1FC', strength: 90 } },";
	}
?>		
	
	
	
	
	
	
	
	
	/*
	{ data: { id: '新北市', name: '新北市', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '桃園市', name: '桃園市', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '臺中市', name: '臺中市', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '高雄市', name: '高雄市', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '新竹縣', name: '新竹縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '苗栗縣', name: '苗栗縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '彰化縣', name: '彰化縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '南投縣', name: '南投縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '嘉義縣', name: '嘉義縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '屏東縣', name: '屏東縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '宜蘭縣', name: '宜蘭縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '花蓮縣', name: '花蓮縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	{ data: { id: '臺東縣', name: '臺東縣', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },
	*/
	/*
	{ data: { id: 'j', name: 'Jerry', weight: 65, faveColor: '#6FB1FC', faveShape: 'triangle' } },
	{ data: { id: 'e', name: 'Elaine', weight: 45, faveColor: '#EDA1ED', faveShape: 'ellipse' } },
	{ data: { id: 'k', name: 'Kramer', weight: 75, faveColor: '#86B342', faveShape: 'octagon' } },
	{ data: { id: 'g', name: 'George', weight: 70, faveColor: '#F5A45D', faveShape: 'rectangle' } }
	*/
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
	
	
	/*
	{ data: { source: 'ROOT', target: '新北市', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '桃園市', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '臺中市', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '高雄市', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '新竹縣', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '苗栗縣', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '彰化縣', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '南投縣', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '嘉義縣', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '屏東縣', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '宜蘭縣', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '花蓮縣', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'ROOT', target: '臺東縣', faveColor: '#6FB1FC', strength: 90 } },
	*/
	/*
	{ data: { source: 'j', target: 'e', faveColor: '#6FB1FC', strength: 90 } },
	{ data: { source: 'j', target: 'k', faveColor: '#6FB1FC', strength: 70 } },
	{ data: { source: 'j', target: 'g', faveColor: '#6FB1FC', strength: 80 } },

	{ data: { source: 'e', target: 'j', faveColor: '#EDA1ED', strength: 95 } },
	{ data: { source: 'e', target: 'k', faveColor: '#EDA1ED', strength: 60 }, classes: 'questionable' },

	{ data: { source: 'k', target: 'j', faveColor: '#86B342', strength: 100 } },
	{ data: { source: 'k', target: 'e', faveColor: '#86B342', strength: 100 } },
	{ data: { source: 'k', target: 'g', faveColor: '#86B342', strength: 100 } },

	{ data: { source: 'g', target: 'j', faveColor: '#F5A45D', strength: 90 } }
	*/
	]
	},

	ready: function(){
	window.cy = this;

	// giddy up
	}
	});

	}
	);
	// on dom ready
	</script>
  </body>
</html>
