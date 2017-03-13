<?php
<?php
		 /// 縣市
		$sql_city = "SELECT city_name,id FROM city_array";
		$result_city = execute_sql($database_name, $sql_city, $link);
		while ($row_city = mysql_fetch_assoc($result_city))
		{
			echo '
					{
					"id": "'.$row_city['city_name'].'",
					"parent": "原名會",
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
						}
			
				}
		}
?>


?>