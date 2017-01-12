<?php
   $mode = $_GET['mode'];
   $key = $_GET['key'];
   
   switch ($mode) 
   {
    case 'A1':
        echo "新增";
		$url = 'insert_alert_contacts_setting.php';
		 header("Location:$url" );
		break;
    case 'A2':
         //echo "修改";
		 $url = 'fix_alert_contacts_setting.php?key='.$key ;
		 header("Location:$url" );
		break;
    case 'A3':
         //echo "刪除";
		  $url = 'del_alert_contacts_setting.php?key='.$key ;
		 header("Location:$url" );
		break;
   default:
        echo "沒有功能";
	   break;
	}
   









?>
