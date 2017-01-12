<?php
require_once("../SQL/dbtools.inc.php");
$link = create_connection();


switch ($_GET['mode'])
	{
		
	
		case "inser_state":
		//echo "你買了 ps3";
		$name= $_POST['name'];
		$sql = "INSERT INTO ass_state_setting(ass_state_name) VALUES ('$name')" ;

		$result = execute_sql($database_name, $sql, $link);

		echo"<script>alert('資料已新增');window.location.href = 'asset_state.php';</script>";

		break;

		case "fix_state":
		$name= $_POST['name'];
		$ass_state_id= $_POST['ass_state_id'];
		$sql = "UPDATE ass_state_setting SET ass_state_name='$name' WHERE ass_state_id ='$ass_state_id' ";
		//echo $sql ;exit();

		execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";

		break;

		default:
		echo "沒有功能";
	}










?>
