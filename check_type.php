<?php

$sql_query ="	
			SELECT ass_ap_ip FROM ass_ap WHERE ass_ap_address='$addid'  
			UNION
			SELECT ass_pdu_ip FROM ass_pdu WHERE ass_pdu_address='$addid'  
			UNION
			SELECT ass_4Gip FROM ass_4Ggrouter WHERE ass_4Ggrouter_address='$addid' 
			UNION
			SELECT ass_ip FROM ass_grouter WHERE ass_grouter_address='$addid' 
			UNION
			SELECT ass_poesw_ip FROM ass_poesw WHERE ass_poesw_address='$addid'
			";	
$result_query = execute_sql($database_name, $sql_query, $link);
while ($row_query = mysql_fetch_assoc($result_query))
{
   $IPPP = $row_query['ass_ap_ip'];
			/*
			// 錯誤
			if(preg_match("/$IPPP,/","$check_ip_death")) {

			$OK =1;
			echo '1';
			} else {
			//echo "error";
			//echo '<br>';
			$OK =0;
			echo '0';
			}	
			*/		
							/*
							// 錯誤
							$subject=$IPPP;
							$pattern="/,/";
							if (preg_match($pattern, $subject))
							{
							if(preg_match("/$IPPP,/","$check_ip_death")) {

							//$OK =1;
							echo '1';
							} else {
							//echo "error";
							//echo '<br>';
							//$OK =0;
							echo '0';
							}		
							}else {

							if(preg_match("/$IPPP/","$check_ip_death")) {

							//$OK =1;
							echo '1';
							} else {
							//echo "error";
							//echo '<br>';
							//$OK =0;
							echo '0';
							}	
							}

							*/
		if(in_array($IPPP, $array))
		{
			echo '1';
		}else{
			echo '0';
		}
		
		

}

?>