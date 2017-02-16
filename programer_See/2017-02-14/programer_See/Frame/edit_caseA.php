<!DOCTYPE html>  
<html>  
<head>  
<title>編輯首回覆</title> 
</head>  
<body>  
<?php
include("../../SQL/dbtools.inc.php");
include("../../function_php/function_class.php");
$link = create_connection();

?>
<script language="javascript">setTimeout("self.opener = null; self.close();",60000)</script>
		<?php
		session_start();
		date_default_timezone_set('Asia/Taipei');
		$name = $_SESSION['user_name']   ;
		?>
		<?php
		echo '目前登入者 : '.$name ;
		?>
		
		<?php
		if($_GET['mode']=='do')
		{
			
				$key   =$_POST['key'];
				$Processing_time_A  =$_POST['Processing_time_A'];
				$note_A  =$_POST['note_A'];
			
			
			$sql = "UPDATE  alert_ap_date_filter SET Processing_time_A='$Processing_time_A',note_A='$note_A', Processor_A='$name' WHERE alert_ap_date_filter_id='$key' ";
		    execute_sql($database_name, $sql, $link);
			//echo $sql;
			//exit();
			?>
			<script>opener.location.reload();window.close();</script>
			<?php
		
			exit();		
		}
		
		?>
		<?php
		
		$key =$_GET['key'];

				if(get_numeric($key) =='NOT')
				{
				?>
				<script type="text/javascript">
				alert("錯誤參數");history.back();　 
				</script>
				<?php

				}else{

					$sql  =  "SELECT * FROM alert_ap_date_filter WHERE alert_ap_date_filter_id='$key' ";
					$result  = execute_sql($database_name, $sql, $link);
					while ($row  = mysql_fetch_assoc($result))
					{
					$alert_ap_date_filter_id = $row['alert_ap_date_filter_id']; //PK		
					$alert_written_time  = $row['alert_written_time']; //告警發信時間
					$Processing_time_A   = $row['Processing_time_A'];
					$note_A              = $row['note_A'];  
					}	
				
				
				
							?>
							<form action="?mode=do" method="POST">
							回覆時間 <input type="text" name="Processing_time_A"  value="<?=$alert_written_time;?>" ><br>
							回覆內容： <input type="text" name="note_A"  value="<?=$note_A;?>" ><br>
							<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id;?>" ><br>
							
							<input type="submit" value="確定">
							</form>
							<?php

				}
		
		
		?>
		
		
		
		
		
		
		
		
		
		
</body>  
</html>  