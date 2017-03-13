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

		
	</head>

	<body>
		<h1>cytoscape-dagre demo</h1>
<?php
include("../SQL/dbtools_ps.php"); 
include_once("../SQL/dbtools.inc.php");
$link = create_connection();
?>
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
							{ data: { id: '原名會' } },
							/*
							{ data: { id: '高雄市1' } },
							{ data: { id: '阿蓮區1' } },
							{ data: { id: '高中區1' } },
							{ data: { id: '高中部落1' } },
							{ data: { id: '高中部落2' } },
							{ data: { id: 'FW' } },
							{ data: { id: 'AP' } },
							{ data: { id: 'PDU' } },
							{ data: { id: 'POE' } },
							{ data: { id: '4G' } },
							*/
							<?php
							$sql_ALL = "SELECT city_name FROM city_array
										UNION
										SELECT township_name FROM city_township
										UNION
										SELECT tribe_name FROM tribe";
							$result_ALL = execute_sql($database_name, $sql_ALL, $link);
							while ($row_ALL = mysql_fetch_assoc($result_ALL))
							{
                             echo "{ data: { id: '".$row_ALL['city_name']."' } },";
							}					
							?>
<?php
//FW
$sql_FW = "SELECT * FROM ass_grouter as A
LEFT JOIN city_array as B ON  (A.ass_grouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_grouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_grouter_tribe = D.tribe_id )
";
$result_FW = execute_sql($database_name, $sql_FW, $link);
while ($row_FW = mysql_fetch_assoc($result_FW))
{
echo "{ data: { id: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },";
}

?>
<?php
//AP
$sql_AP = "SELECT * FROM  ass_ap as A
LEFT JOIN city_array as B ON  (A.ass_ap_city = B.id )
LEFT JOIN city_township as C ON (A.ass_ap_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_ap_tribe = D.tribe_id )
";
$result_AP = execute_sql($database_name, $sql_AP, $link);
while ($row_AP = mysql_fetch_assoc($result_AP))
{
echo "{ data: { id: '".$row_AP['tribe_name'].$row_AP['ass_ap_name']."' } },";
}

?>							
<?php
//4G
$sql_4G = "SELECT * FROM ass_4Ggrouter as A
LEFT JOIN city_array as B ON  (A.ass_4Ggrouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_4Ggrouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_4Ggrouter_tribe = D.tribe_id )
";
$result_4G = execute_sql($database_name, $sql_4G, $link);
while ($row_4G = mysql_fetch_assoc($result_4G))
{
echo "{ data: { id: '".$row_4G['tribe_name'].$row_4G['ass_4Gname']."' } },";
}

?>

<?php
//PDU
$sql_PDU = "SELECT * FROM ass_pdu as A
LEFT JOIN city_array as B ON  (A.ass_pdu_city = B.id )
LEFT JOIN city_township as C ON (A.ass_pdu_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_pdu_tribe = D.tribe_id )
";
$result_PDU = execute_sql($database_name, $sql_PDU, $link);
while ($row_PDU = mysql_fetch_assoc($result_PDU))
{
echo "{ data: { id: '".$row_PDU['tribe_name'].$row_PDU['ass_pdu_name']."' } },";
}

?>
						],
						edges: [
						/*
							{ data: { source: '原名會', target: '高雄市1' } },
							{ data: { source: '高雄市1', target: '阿蓮區1' } },
							{ data: { source: '高雄市1', target: '高中區1' } },
							{ data: { source: '高中區1', target: '高中部落1' } },
							{ data: { source: '高中區1', target: '高中部落2' } },
							{ data: { source: '高中部落1', target: 'FW' } },
							{ data: { source: '高中部落1', target: 'AP' } },
							{ data: { source: '高中部落1', target: 'PDU' } },
							{ data: { source: '高中部落1', target: 'POE' } },
							{ data: { source: '高中部落1', target: '4G' } },
						*/	
							<?php
$sql_city = "SELECT city_name,id FROM city_array";
$result_city = execute_sql($database_name, $sql_city, $link);
while ($row_city = mysql_fetch_assoc($result_city))
{
	echo " 
		{ data: { source: '原名會', target: '".$row_city['city_name']."' } },
		";
								 
		/// 地區
		$ID = $row_city['id'];
		$sql_township = "SELECT * FROM city_township where township_city='$ID' ";
		$result_township = execute_sql($database_name, $sql_township, $link);
		while ($row_township = mysql_fetch_assoc($result_township))
		{
				echo " 
				{ data: { source: '".$row_city['city_name']."', target: '".$row_township['township_name']."' } },
				";
			/// 縣市
			$ID2 = $row_township['township_id'];
			$sql_tr = "SELECT * FROM tribe where township_id='$ID2' ";
					$result_tr = execute_sql($database_name, $sql_tr, $link);
					while ($row_tr = mysql_fetch_assoc($result_tr))
					{
						echo " 
						{ data: { source: '".$row_township['township_name']."', target: '".$row_tr['tribe_name']."' } },
						";
						$ID3 = $row_tr['tribe_id'];
//FW
$sql_FW = "SELECT * FROM ass_grouter as A
			LEFT JOIN city_array as B ON  (A.ass_grouter_city = B.id )
			LEFT JOIN city_township as C ON (A.ass_grouter_twon = C.township_id )
			LEFT JOIN tribe as D ON (A.ass_grouter_tribe = D.tribe_id )
			WHERE D.tribe_id = '$ID3'
			";
$result_FW = execute_sql($database_name, $sql_FW, $link);
while ($row_FW = mysql_fetch_assoc($result_FW))
{
//echo "{ data: { id: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },";							
echo " 
{ data: { source: '".$row_tr['tribe_name']."', target: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },
";
}

//PDU
$sql_PDU = "SELECT * FROM ass_pdu as A
LEFT JOIN city_array as B ON  (A.ass_pdu_city = B.id )
LEFT JOIN city_township as C ON (A.ass_pdu_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_pdu_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
			";
$result_PDU = execute_sql($database_name, $sql_PDU, $link);
while ($row_PDU = mysql_fetch_assoc($result_PDU))
{
//echo "{ data: { id: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },";							
echo " 
{ data: { source: '".$row_tr['tribe_name']."', target: '".$row_PDU['tribe_name'].$row_PDU['ass_pdu_name']."' } },
";
}
/*	
//POE
$sql_POE = "SELECT * FROM ass_poesw as A
LEFT JOIN city_array as B ON  (A.ass_poesw_city = B.id )
LEFT JOIN city_township as C ON (A.ass_poesw_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_poesw_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
			";
$result_POE = execute_sql($database_name, $sql_POE, $link);
while ($row_POE = mysql_fetch_assoc($result_POE))
{
//echo "{ data: { id: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },";							
echo " 
{ data: { source: '".$row_tr['tribe_name']."', target: '".$row_POE['tribe_name'].$row_POE['ass_poesw_name']."' } },
";
}
*/
//4G
$sql_4G = "SELECT * FROM ass_4Ggrouter as A
LEFT JOIN city_array as B ON  (A.ass_4Ggrouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_4Ggrouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_4Ggrouter_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
			";
$result_4G = execute_sql($database_name, $sql_4G, $link);
while ($row_4G = mysql_fetch_assoc($result_4G))
{
//echo "{ data: { id: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },";							
echo " 
{ data: { source: '".$row_tr['tribe_name']."', target: '".$row_4G['tribe_name'].$row_4G['ass_4Gname']."' } },
";
}
//AP
$sql_AP = "SELECT * FROM  ass_ap as A
LEFT JOIN city_array as B ON  (A.ass_ap_city = B.id )
LEFT JOIN city_township as C ON (A.ass_ap_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_ap_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
			";
$result_AP = execute_sql($database_name, $sql_AP, $link);
while ($row_AP = mysql_fetch_assoc($result_AP))
{
//echo "{ data: { id: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },";							
echo " 
{ data: { source: '".$row_tr['tribe_name']."', target: '".$row_AP['tribe_name'].$row_AP['ass_ap_name']."' } },
";
}
//							
					}
		}

}	
							
							
							
							?>
						]
					},
				});
			});
		</script>


		<div id="cy"></div>

	</body>

</html>