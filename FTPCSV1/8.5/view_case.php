<?php  header('refresh: 900 ;url="?"') ;?>

<?php 
  require_once("SQL/dbtools.inc.php");
  $link = create_connection();
	$sql = "SELECT * FROM  scv_table  where do<>1 " ;
	$result = execute_sql($database_name, $sql, $link);
    $J=1;

            while ($row = mysql_fetch_assoc($result))
	     {
		$csv_file= $row['scv_table_name'];

                 if($J>1000)
			{
echo $J;
break;
header('refresh: 1;url="?"') ;
			}

		//echo $csv_file.'<br>';
		chdir('../../../../home/sk/');
//echo getcwd().'n'.'<br>';
		//exit();
		$file = fopen('FTP_upload/'.$csv_file,"rb");


		$data1 = fgetcsv($file);
		$case = $data1[0];
		
				echo '<br>';


		fclose($file);



if($case=='Client Number')
{
echo $case;

     ?>
		<iframe src="view1.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php
}else if($case=='Client Number_5G')
{
echo $case;
?>
		<iframe src="view2.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}else if($case=='Client Number Vs Air Time')
{
echo $case;
?>
		<iframe src="view3.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}else if($case=='Client Number Vs Air Time_5G')
{
echo $case;
?>
		<iframe src="view4.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}else if($case=='Client Number Vs Air Time_ALL')
{
?>
		<iframe src="view5.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}else if($case=='Client Number Vs Air Time_ALL_5G')
{
echo $case;
?>
		<iframe src="view6.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}else if($case=='Continuously Disconnected APs')
{
echo $case;
?>
		<iframe src="view7.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php
}else if($case=='Continuously Disconnected APs_D')
{
echo $case;
?>
		<iframe src="view8.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php
}else if($case=='Failed Client Associations')
{

?>
		<iframe src="view9.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php
}else if($case=='Failed Client Associations_5G')
{
echo $case;
?>
		<iframe src="view10.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}else if($case=='New Client Associations')
{
echo $case;
?>
		<iframe src="view11.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php
}else if($case=='New Client Associations_5G')
{
echo $case;
?>
		<iframe src="view12.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}else if($case=='System Resource Utilization')
{
echo $case;
?>
		<iframe src="view13.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php


}else if($case=='TX and Rx')
{
echo $case;
?>
		<iframe src="view14.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}else if($case=='TX and Rx_5G')
{
echo $case;
?>
		<iframe src="view15.php?file=<?php echo $csv_file; ?>" width="0" height="0" frameborder="0" scrolling="yes"></iframe>		
		<?php

}

$sql = "UPDATE scv_table SET do=1 WHERE scv_table_name ='$csv_file' ";

 execute_sql($database_name, $sql, $link);
                         

          //sleep(1); 
    $J++ ;
	     }      






/*
$i = $case;
switch ($i) {
    case 'Client Number':
        echo "1";
        break;
    case 'Client Number_5G':
        echo "2";
        break;

    case 'Client Number Vs Air Time':
        echo '3';
        break;

	case 'Client Number Vs Air Time_5G':
        echo '4';
        break;
	
	case 'Client Number Vs Air Time_ALL':
        echo '5';
        break;

	case 'Client Number Vs Air Time_ALL_5G':
        echo '6';
        break;

	case 'Continuously Disconnected APs':
        echo '7';
        break;

case 'Continuously Disconnected APs_D':
        echo '8';
        break;








}
*/

 echo '<br>'.$J;



?>

