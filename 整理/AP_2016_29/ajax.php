<?php
/*
$num = 1000 + rand(0,1000);
echo $num;

*/
include("../SQL/dbtools.inc.php");
$link = create_connection();
	$sql_view="SELECT * FROM `CPU_check` ORDER by `CPU_check_id` desc LIMIT 8";
	$result_view= execute_sql($database_name, $sql_view, $link);
	while ($row_view= mysql_fetch_assoc($result_view)  )
	{
         // echo $row_view['CPU_no'];
		//  echo $row_view['CPU_user'];
		//  echo $row_view['CPU_nice'];
		//  echo $row_view['CPU_sys'];
		//  echo $row_view['CPU_idle'];
		//  echo $row_view['CPU_check_time'];
		    $new_array[$row['CPU_no']] = $row_view;
			$new_array[$row['CPU_user']] = $row_view;
			$new_array[$row['CPU_nice']] = $row_view;
			$new_array[$row['CPU_sys']] = $row_view;
			$new_array[$row['CPU_idle']] = $row_view;
			$new_array[$row['CPU_check_time']] = $row_view;
			print_r($new_array);
	}
?>