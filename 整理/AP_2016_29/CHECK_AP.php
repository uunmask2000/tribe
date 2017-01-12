<?php


	include("../SQL/dbtools.inc.php");
			$link = create_connection();

				$sql_PDU="SELECT ass_ap_tribe,ass_ap_name,ass_ap_ip,tribe_name
							FROM ass_ap  as A
							INNER JOIN tribe  as B
							ON A.ass_ap_tribe=B.tribe_id
							 ORDER BY A.ass_ap_tribe ASC
							";
				$result_PDU= execute_sql($database_name, $sql_PDU, $link);
				echo '<ul>';
				while ($row_PDU= mysql_fetch_assoc($result_PDU)  )
				{
                    $ass_pdu_tribe  = $row_PDU['ass_ap_tribe'];
					//echo '這是第一行<br>';
					$ass_pdu_name   = $row_PDU['ass_ap_name'];
					//echo '這是第一行<br>';
					$ass_pdu_ip     = $row_PDU['ass_ap_ip'];
					$tribe_name      = $row_PDU['tribe_name'];
					//echo '這是第一行<br>';
					echo '<li><a href="http://'.$ass_pdu_ip.'" target="_blank">'.$tribe_name .$ass_pdu_name.'</a>'.$ass_pdu_ip.'</li>';
					
				}
				echo '</ul>';




?>