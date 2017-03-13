<html>
    <head>
        <title>Use jsTree</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
        
    </head>
    <body>
<?php

include("../SQL/dbtools_ps.php"); 
include_once("../SQL/dbtools.inc.php");
$link = create_connection();
?>
	<script>
	$(
		function () 
			{
			var data = 
						[
						{
						"id": "原民會",
						"parent": "#",
					    //"icon": "https://upload.wikimedia.org/wikipedia/commons/4/47/PNG_transparency_demonstration_1.png",
						"text": "原民會"
						},
<?php
		 /// 縣市
		$sql_city = "SELECT city_name,id FROM city_array";
		$result_city = execute_sql($database_name, $sql_city, $link);
		while ($row_city = mysql_fetch_assoc($result_city))
		{
			echo '
					{
					"id": "'.$row_city['city_name'].'",
					"parent": "原民會",
					"text": "'.$row_city['city_name'].'"
					}, 			
			    ';
			 /// 地區
			 $ID = $row_city['id'];
				$sql_township = "SELECT * FROM city_township where township_city='$ID' ";
				$result_township = execute_sql($database_name, $sql_township, $link);
				while ($row_township = mysql_fetch_assoc($result_township))
				{ 
			
			
						echo '
						{
						"id": "'.$row_township['township_name'].'",
						"parent": "'.$row_city['city_name'].'",
						"text": "'.$row_township['township_name'].'"
						}, 			
						';
						/// 縣市
						$ID2 = $row_township['township_id'];
						$sql_tr = "SELECT * FROM tribe where township_id='$ID2' ";
						$result_tr = execute_sql($database_name, $sql_tr, $link);
						while ($row_tr = mysql_fetch_assoc($result_tr))
						{
								echo '
								{
								"id": "'.$row_tr['tribe_name'].'",
								"parent": "'.$row_township['township_name'].'",
								"text": "'.$row_tr['tribe_name'].'"
								}, 			
								';
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
		echo '
		{
		"id": "'.$row_FW['tribe_name'].$row_FW['ass_name'].'",
		"parent": "'.$row_tr['tribe_name'].'",
		"text": "'.$row_FW['tribe_name'].$row_FW['ass_name'].'"
		}, 			
		';

}
//pdu
$sql_pdu = "SELECT * FROM ass_pdu as A
LEFT JOIN city_array as B ON  (A.ass_pdu_city = B.id )
LEFT JOIN city_township as C ON (A.ass_pdu_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_pdu_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_pdu = execute_sql($database_name, $sql_pdu, $link);
while ($row_pdu = mysql_fetch_assoc($result_pdu))
{
		echo '
		{
		"id": "'.$row_pdu['tribe_name'].$row_pdu['ass_pdu_name'].'",
		"parent": "'.$row_tr['tribe_name'].'",
		"text": "'.$row_pdu['tribe_name'].$row_pdu['ass_pdu_name'].'"
		}, 			
		';

}
//ass_poesw
$sql_ass_poesw = "SELECT * FROM ass_poesw as A
LEFT JOIN city_array as B ON  (A.ass_poesw_city = B.id )
LEFT JOIN city_township as C ON (A.ass_poesw_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_poesw_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_ass_poesw = execute_sql($database_name, $sql_ass_poesw, $link);
while ($row_ass_poesw = mysql_fetch_assoc($result_ass_poesw))
{
		echo '
		{
		"id": "'.$row_ass_poesw['tribe_name'].$row_ass_poesw['ass_poesw_name'].'",
		"parent": "'.$row_tr['tribe_name'].'",
		"text": "'.$row_ass_poesw['tribe_name'].$row_ass_poesw['ass_poesw_name'].'"
		}, 			
		';

}
//AP
$sql_ass_AP = "SELECT * FROM ass_ap as A
LEFT JOIN city_array as B ON  (A.ass_ap_city = B.id )
LEFT JOIN city_township as C ON (A.ass_ap_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_ap_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_ass_AP = execute_sql($database_name, $sql_ass_AP, $link);
while ($row_ass_AP = mysql_fetch_assoc($result_ass_AP))
{
		echo '
		{
		"id": "'.$row_ass_AP['tribe_name'].$row_ass_AP['ass_ap_name'].'",
		"parent": "'.$row_tr['tribe_name'].'",
		"text": "'.$row_ass_AP['tribe_name'].$row_ass_AP['ass_ap_name'].'"
		}, 			
		';

}
//ass_4Ggrouter
$sql_ass_ass_4Ggrouter = "SELECT * FROM ass_4Ggrouter as A
LEFT JOIN city_array as B ON  (A.ass_4Ggrouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_4Ggrouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_4Ggrouter_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_ass_ass_4Ggrouter = execute_sql($database_name, $sql_ass_ass_4Ggrouter, $link);
while ($row_ass_ass_4Ggrouter = mysql_fetch_assoc($result_ass_ass_4Ggrouter))
{
		echo '
		{
		"id": "'.$row_ass_ass_4Ggrouter['tribe_name'].$row_ass_ass_4Ggrouter['ass_4Gname'].'",
		"parent": "'.$row_tr['tribe_name'].'",
		"text": "'.$row_ass_ass_4Ggrouter['tribe_name'].$row_ass_ass_4Ggrouter['ass_4Gname'].'"
		}, 			
		';

}

//
						}
			
				}
		}
?>
/*						
						{
						"id": "新北",
						"parent": "原名會",
						"text": "新北"
						}, {
						"id": "烏來",
						"parent": "新北",
						"text": "烏來"
						}, {
						"id": "烏來部落",
						"parent": "烏來",
						"text": "烏來部落"
						}, {
						"id": "設備",
						"parent": "烏來部落",
						"text": "設備"
						}
*/						
						
						];
			$("#jstree").jstree({
			"core" : {
			// so that create works
			//"check_callback" : false,

			"data": data
			},
			//"plugins" : [ "contextmenu",  "dnd"],

			"contextmenu":{         
			"items": {
			"create": {
			"label": "Add",
			"action": function (obj) {
				$('#jstree').jstree().create_node('#' ,  { "id" : "ajson5", "text" : "newly added" }, "last", function(){
			alert("done");
			}); 
			},
			}
			}
			}

			}).on('create_node.jstree', function(e, data) {
			console.log('saved');
			});
			/*新增node
			$("#sam").on("click",function() {
			$('#jstree').jstree().create_node('#' ,  { "id" : "ajson5", "text" : "newly added" }, "last", function(){
			alert("done");
			});
			});
			*/
			}
	);
	</script>
<div id="jstree">  </div>
     <!--- 新增node
	 <button id="sam">create node</button>
	 ---->
	</body>
</html>