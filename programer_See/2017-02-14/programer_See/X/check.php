	<?php

		
		include("../SQL/dbtools.inc.php");
		$link = create_connection();
		
			
	?>
	
	<ol>
	<?php
	$sql_alert_ap_date  = "SELECT * FROM `alert_ap_date_filter` WHERE `alert_written_time` = '0000-00-00 00:00:00' ";
		$result_alert_ap_date  = execute_sql($database_name, $sql_alert_ap_date, $link);
		while ($row_alert_ap_date  = mysql_fetch_assoc($result_alert_ap_date))
		{
			$alert_ap_date_filter_id=$row_alert_ap_date['alert_ap_date_filter_id'];
			$alert_ap_date_time_dead=$row_alert_ap_date['alert_ap_date_time_dead'];
			$alert_written_time=$row_alert_ap_date['alert_written_time'];
			
			
		$sql = "UPDATE alert_ap_date_filter SET  alert_written_time='$alert_ap_date_time_dead'    where alert_ap_date_filter_id='$alert_ap_date_filter_id'" ;
		$sql = preg_replace("/[\'\"]+/" , "'" ,$sql);
	
		execute_sql($database_name, $sql, $link);
		
			echo '<li>';
			//echo   $alert_ap_date_time_dead . $alert_written_time ;
				echo $sql;
			echo '</li>';
	    } 
	
	?>
	</ol>