<?php
 $key = $_GET['key'];

 if(is_numeric($key))
 {
	 // echo 'ok';
	  $url = 'proc_alert_contacts_setting.php?mode=del&key='.$key ;
		 header("Location:$url" );
	 
 }else{
	 echo 'NO1';
 }
 
 

?>