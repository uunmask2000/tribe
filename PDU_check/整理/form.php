<?php
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
if($subject!='1 packets transmitted, 1 received, 0% packet loss, time 0ms')
{
	echo $tribe_name;
	echo '<br>';
	echo $host;
	echo '<br>';
	echo 'NO';
	//$A = 1 ;
}else{
	//$A = 0 ;
	echo $tribe_name;
	echo '<br>';
	echo $host;
	echo '<br>';
	echo 'YES';
}
//

//exit();
?>