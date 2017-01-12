<?php
 $key = $_GET['key'];

 if(is_numeric($key))
 {
	 // echo 'ok';
	  $url = 'proc_Maintenance_Engineer_menu.php?mode=del&key='.$key ;
		 header("Location:$url" );
	 
 }else{
	echo"<script>alert('錯誤參數');window.location.href = 'veiw_alert_contacts_setting.php';</script>";
 }
 
 

?>