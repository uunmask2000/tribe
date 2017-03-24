<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();
$sql2="SELECT * FROM `Project`";
$emparray = array();
$II = 0 ;
$result2 = execute_sql($database_name, $sql2, $link);
while ($row = mysql_fetch_assoc($result2) )
{
	/*
	$emparray[$II][0] = '"'.$row['Project_id'].'"';
	$emparray[$II][1] = '"'.$row['Project_name'].'"';
	$emparray[$II][2] = '"'.$row['Project_number'].'"';
	$emparray[$II][3] = '"'.$row['Project_time'].'"';
	*/
	$emparray[$II][0] = '"'.$row['Project_name'].'"';
	$emparray[$II][1] = '"'.$row['Project_number'].'"';
	$emparray[$II][3] = '"'.$row['Project_id'].'"';
	$emparray[$II][4] = '"'.$row['Project_id'].'"';
  $II ++ ;
  
}
//print_r($emparray);
$emparray2 = array();
for($i=0 ;$i < count($emparray) ; $i++)
{
	$emparray2[] =  '['.implode(',',$emparray[$i]).']';
}
?>
{
  "data": 
		[
          <?php
		 echo implode(',',$emparray2) ;		  
		  ?>
		]
}