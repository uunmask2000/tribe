<?php
require_once(__DIR__.'/../SQL/dbtools.inc.php');
//include("../SQL/dbtools.inc.php");
$link = create_connection();
 date_default_timezone_set("Asia/Taipei");
 $NOWm   = date("Y-m-d H:i:s");
$host=$_GET['ip'];
$tribe_name = $_GET['tribe_name'];
$str = exec("ping -c 1 $host",$output[],$retval);
/*
if ($output == 0){
  echo "ping succeeded";
    $A = 0 ;
}else{
  echo "ping failed";
    $A = 1 ;
}
*/
//print_r($output);
//echo $output[4];
 $output_D = $output;
//echo $output_D[0][4];
$subject =$output_D[0][4];
//echo $subject;

	$sql1= "SELECT * FROM PDU_check WHERE PDU_check_IP='$host' ";
	$result1= execute_sql($database_name, $sql1, $link);
	//取得記錄數
	$num= mysql_num_rows($result1);
	//echo $sql1;
	if( $num>0  )
	{ 
//echo $num;  ,PDU_check_written='$NOWm'
					if($subject!='1 packets transmitted, 1 received, 0% packet loss, time 0ms')
					{
					echo $tribe_name;
					echo '<br>';
					echo $host;
					echo '<br>';
					echo '失去連線';
					//$A = 1 ;
					$sql = "UPDATE PDU_check SET PDU_check_state='失去連線',PDU_check_written='$NOWm' where PDU_check_IP='$host' ";
					execute_sql($database_name, $sql, $link);
//echo 	$sql ;				
					}else{
					//$A = 0 ;
					echo $tribe_name;
					echo '<br>';
					echo $host;
					echo '<br>';
					echo '連線正常';
						$sql = "UPDATE PDU_check SET PDU_check_state='連線正常',PDU_check_written='$NOWm' where PDU_check_IP='$host' ";
						execute_sql($database_name, $sql, $link);
//echo 	$sql ;						
					}			
	}else{
				$sql = "INSERT INTO  PDU_check(PDU_check_tribe,PDU_check_IP) VALUES ('$tribe_name','$host')";
				execute_sql($database_name, $sql, $link);	
				//echo $num;
				
			if($subject!='1 packets transmitted, 1 received, 0% packet loss, time 0ms')
					{
					echo $tribe_name;
					echo '<br>';
					echo $host;
					echo '<br>';
					echo '失去連線';
					//$A = 1 ;
					$sql = "UPDATE PDU_check SET PDU_check_state='失去連線',PDU_check_written='$NOWm' where PDU_check_IP='$host' ";
					execute_sql($database_name, $sql, $link);	
					//echo 	$sql ;
					}else{
					//$A = 0 ;
					echo $tribe_name;
					echo '<br>';
					echo $host;
					echo '<br>';
					echo '連線正常';
						$sql = "UPDATE PDU_check SET PDU_check_state='連線正常',PDU_check_written='$NOWm' where PDU_check_IP='$host' ";
						execute_sql($database_name, $sql, $link);	
						//echo 	$sql ;
					}			
	}
  

//

//exit();
?>