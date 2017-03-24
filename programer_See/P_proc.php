<?php
	include("../SQL/dbtools.inc.php");
	$link = create_connection();
	
	if($_GET['mode']=='Del')
	{
		$id = $_GET['id'];
		
			if (is_numeric($id)) 
			{
			//echo	$id ;
			
			$sql = "UPDATE alert_ap_date_filter SET display='0' where alert_ap_date_filter_id='$id'";
			execute_sql($database_name, $sql, $link);
			?>
			<script>
			  //window.location.href = 'show_AP_date_form.php?A=END';
			  history.back();document.URL=location.href;
			</script>
			<?php
			
exit();
			} else {
						?>
						<script>
							window.history.back();
						</script>
						<?php
			}
			exit();
	}


?>