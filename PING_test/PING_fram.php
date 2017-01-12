<?php
	require_once("../SQL/dbtools.inc.php");
	$link = create_connection();


?>
<?php
$host=$_GET['ip'];

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
	//echo 'NO';
	$A = 1 ;
}else{
	$A = 0 ;
}
//

//exit();
?>

<?php
/*
echo $_GET['ip'];
//echo $_GET['id'];
$host=$_GET['ip'];

$port = 80; 
$waitTimeoutInSeconds = 1; 
if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
   // It worked 
    echo 'YES';
   $A = 0 ;
} else {
   // It didn't work 
   echo 'NO';
   $A = 1 ;
} 
fclose($fp);
*/
//exit();
?>
<?php
//F/W
$sql = " UPDATE  ass_grouter SET ass_grouter_type='$A'  WHERE  ass_ip ='$host' ";
execute_sql($database_name, $sql, $link);
//echo $sql ;

?>
<?php
//4G
$sql = " UPDATE  ass_4Ggrouter SET ass_4G_grouter_type='$A'  WHERE  ass_4Gip ='$host' ";
execute_sql($database_name, $sql, $link);
//echo $sql ;

?>
<?php
//PDU
$sql = " UPDATE  ass_pdu SET ass_PDU_type='$A'  WHERE  ass_pdu_ip ='$host' ";
execute_sql($database_name, $sql, $link);
echo $sql ;

?>
<?php
//POE
$sql = " UPDATE  ass_poesw SET ass_poesw_type='$A'  WHERE  ass_poesw_ip ='$host' ";
execute_sql($database_name, $sql, $link);
//echo $sql ;

?>
<?php
//AP
$sql = " UPDATE  ass_ap SET ass_ap_type='$A'  WHERE  ass_ap_ip ='$host' ";
execute_sql($database_name, $sql, $link);
//echo $sql ;

?>
