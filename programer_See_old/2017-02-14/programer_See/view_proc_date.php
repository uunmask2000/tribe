<?php
include("../SQL/dbtools.inc.php");
include("../function_php/function_class.php");
$link = create_connection();
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
			$calling_bar_id      = $row['calling_bar_id']; //事件處理編號
			$Processing_status   = $row['Processing_status'];
			$Period_AP = $row['Period_AP'];
			
			$alert_written_time  = $row['alert_written_time']; //告警發信時間
			$Processing_time_A   = $row['Processing_time_A'];
			$note_A              = $row['note_A'];  
			$Processing_time_B   = $row['Processing_time_B'];
			$note_B              = $row['note_B'];
			$accendant           = $row['accendant'];
			$Processing_time_C   = $row['Processing_time_C'];
			$processing_engineer           = $row['processing_engineer'];
			$note_C              = $row['note_C'];
			$Processing_time_D   = $row['Processing_time_D'];
			$note_D              = $row['note_D'];
			$Processing_time_E   = $row['Processing_time_E'];
			$note_E              = $row['note_E'];
			
			$Processor_A   = $row['Processor_A'];
			$Processor_B   = $row['Processor_B'];
			$Processor_C   = $row['Processor_C'];
			$Processor_D   = $row['Processor_D'];
			$Processor_E   = $row['Processor_E'];
			///
			$alert_ap_date_city   =  $row['alert_ap_date_city'];
			$alert_ap_date_township   =  $row['alert_ap_date_township'];
			$alert_ap_date_tribe   =  $row['alert_ap_date_tribe'];
			$alert_ap_date_ap_name  =  $row['alert_ap_date_ap_name'];
			
		}


?>
告警信發送時間	 ：<?=$alert_written_time ;?>
<br>
首回覆時間	 ：<?=$Processing_time_A ;?> 回覆內容：<?=$note_A ;?>
<br>


派工資訊:
<table>
		<tr>
		<th>指派工程師</th>
		<th>時間</th>
		<th>備註</th>
		</tr>
		<?php
		$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='00' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		while ($row_0  = mysql_fetch_assoc($result_0))
		{
			echo '<tr>';
			echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
			echo '</tr>';
			
		}	
			?>

</table>

到場資訊:
<table>
	<tr>
	<th>到場工程師</th>
	<th>時間</th>
	<th>備註</th>
	</tr>
		<?php
		$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='02' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		while ($row_0  = mysql_fetch_assoc($result_0))
		{
			echo '<tr>';
			echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
			echo '</tr>';
			
		}	
			?>


</table>


處理資訊:
	<table>
	<tr>
	<th>處理工程師</th>
	<th>時間</th>
	<th>備註</th>
	</tr>
		<?php
		$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='01' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		while ($row_0  = mysql_fetch_assoc($result_0))
		{
			echo '<tr>';
			echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
			echo '</tr>';
			
		}	
			?>


</table>

結案資訊:
<table>
  <tr>
	<th>時間</th>
	<th>備註</th>
  </tr>
  	<?php
		$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='03' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		while ($row_0  = mysql_fetch_assoc($result_0))
		{
			echo '<tr>';
			echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
			echo '</tr>';
			
		}	
			?>

</table>
<?php
}
?>




