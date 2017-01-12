
<meta http-equiv="refresh" content="120;url=''" />
<title>PDU PING 檢查</title>
<?php



			//require_once("dbtools.inc.php");
			//include("../SQL/dbtools.inc.php");
			require_once(__DIR__.'/../SQL/dbtools.inc.php');
			$link = create_connection();

				$sql_PDU="SELECT ass_pdu_tribe,ass_pdu_name,ass_pdu_ip,tribe_name
							FROM ass_pdu  as A
							INNER JOIN tribe  as B
							ON A.ass_pdu_tribe=B.tribe_id
							 ORDER BY A.ass_pdu_tribe ASC
							";
				$result_PDU= execute_sql($database_name, $sql_PDU, $link);
				while ($row_PDU= mysql_fetch_assoc($result_PDU)  )
				{
                    $ass_pdu_tribe  = $row_PDU['ass_pdu_tribe'];
					//echo '這是第一行<br>';
					$ass_pdu_name   = $row_PDU['ass_pdu_name'];
					//echo '這是第一行<br>';
					$ass_pdu_ip     = $row_PDU['ass_pdu_ip'];
					$tribe_name      = $row_PDU['tribe_name'];
					//echo '這是第一行<br>';
					 echo '<iframe src="pdu_date_new_form.php?tribe_name='.$tribe_name.'&ip='.$ass_pdu_ip.'"  width="180" height="80" marginwidth="0" marginheight="0" scrolling="no" frameborder="3" align="center"  ></iframe>';
					
				}

?>

