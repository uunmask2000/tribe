<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();

?>
<link type="text/css" rel="stylesheet" href="alert_contacts_setting.css">
<?php
 $key = $_GET['key'];

 if(is_numeric($key))
 {
	  //echo 'ok';
	  

				$sql2 = "SELECT * FROM `alert_contacts` WHERE alert_contacts_id='$key'  ";
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row2 = mysql_fetch_assoc($result2))
				{

					
					$alert_contacts_id = $row2['alert_contacts_id'];
					$alert_contacts_name = $row2['alert_contacts_name'];
					$alert_contacts_email = $row2['alert_contacts_email'];

				}
	  
	  ?>
	  
		<form action="proc_alert_contacts_setting.php?mode=fix" method="POST">
		通訊人名稱: <input type="text" name="alert_contacts_name" value="<?=$alert_contacts_name ;?>" ><br>
		通訊人mail: <input type="email" name="alert_contacts_email" value="<?=$alert_contacts_email ;?>"><br>
		 <input type="hidden" name="alert_contacts_id" value="<?=$alert_contacts_id ;?>" >
		<input type="submit" value="送出">
		</form>
	  
	  <?php
	 
 }else{
	// echo 'NO';
		echo"<script>alert('錯誤參數');window.location.href = 'veiw_alert_contacts_setting.php';</script>";
 }
 
 

?>


