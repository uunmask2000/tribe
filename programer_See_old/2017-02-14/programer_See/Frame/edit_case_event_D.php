<!DOCTYPE html>  
<html>  
<head>  
<title>編輯結案資訊:</title> 
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
				$time  =$_POST['time'];
				$accendant = $_POST['accendant'];
				$Equipment_Repair_remark  =$_POST['Equipment_Repair_remark'];
			
			
			$sql = "UPDATE  Equipment_Repair SET Equipment_Repair_time='$time',Equipment_Repair_remark='$Equipment_Repair_remark', Equipment_Repair_engineer='$accendant' WHERE Equipment_Repair_id='$key' ";
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

					$sql  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_id='$key' ";
					$result  = execute_sql($database_name, $sql, $link);
					while ($row  = mysql_fetch_assoc($result))
					{
					$Equipment_Repair_id = $row['Equipment_Repair_id']; //PK		
					$Equipment_Repair_time  = $row['Equipment_Repair_time']; //告警發信時間
					$Equipment_Repair_engineer  = $row['Equipment_Repair_engineer'];  
					$Equipment_Repair_remark   = $row['Equipment_Repair_remark'];
					
					}	
				
				
				
							?>
<form action="?mode=do" method="POST">
結案時間  <input  type="text"  name="time"  value="<?=$Equipment_Repair_time ;?>"/> PS 格式為 0000-00-00 00:00:00  <br>
	結案工程師
	<select name="accendant">
	<?php
	$sql_Engineer  = "SELECT * FROM Maintenance_Engineer_menu ";
	$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
	while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
	{
	?>
	<option value="<?=$row_Engineer['Maintenance_Engineer_menu_name'];?>"  <?php if($row_Engineer['Maintenance_Engineer_menu_name']==$Equipment_Repair_engineer  ){echo 'selected';} ?>><?=$row_Engineer['Maintenance_Engineer_menu_name'];?></option>
	<?php
	}
	?>
	</select>
	<br>
	備註 :<textarea style="width:98%;" rows="5" name="Equipment_Repair_remark" placeholder="備註"><?=$Equipment_Repair_remark;?></textarea>
	<input type="hidden" name="key" value="<?=$Equipment_Repair_id ;?>">
	<input type="submit" value="確定">
</form>
							<?php

				}
		
		
		?>
		
		
		
		
		
		
		
		
		
		
</body>  
</html>  