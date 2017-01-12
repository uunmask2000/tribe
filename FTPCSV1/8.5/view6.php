

<?php 
 require_once("SQL/dbtools.inc.php");

  $link = create_connection();

$csv_file =$_GET['file'];


		chdir('../../../../home/sk/FTP_upload/');
$file = fopen($csv_file,"rb");

for($i=1;$i<=1;$i++)
{
$data = fgetcsv($file);
}

$data = fgetcsv($file);
//print_r($data = fgetcsv($file));

$A = fgetcsv($file) ;
$B = fgetcsv($file) ;
$C = fgetcsv($file) ;
$D= fgetcsv($file) ;
//exit();
 $data = fgetcsv($file);
/*
echo $AAAA[0] ;
echo '<br>';
echo $BBBB[0] ;
echo '<br>';
echo $CCCC[1] ;
echo '<br>';
echo $DDDD[1] ;
echo '<br>';
print_r($EEEE);
echo '<br>';
print_r($arry_bar);
echo '<br>';
*/


 
$i=0;
while(!feof($file))
{


	//print_r($data = fgetcsv($file));
	
       $data = fgetcsv($file);
	$data1 =  $data[0];

	$data2 =  $data[1];
	$data3 =  $data[2];

	$data4 =  $data[3];

	$data5 =  $data[4];

$data6 =  $data[5];
$data7 =  $data[6];
$data8 =  $data[7];
$data9 =  $data[8];

	echo $data1.' [-] '.$data2.' [-] '.$data3.' [-] '.$data4.' [-] '.$data5;
		echo '<br>';
	
       

        if(empty($data1)and empty($data2) and empty($data3) and empty($data4))
	{
 	  // echo 'NU::';
	}else
	{

	$sql = "SELECT * FROM  Client_Number_Vs_Air_Time_ALL_5G WHERE timestamp_5G='$data1'       " ;
	$result = execute_sql($database_name, $sql, $link);
	$total_records = mysql_num_rows($result);
	
	if($total_records>0)
	{
		
	

	    // echo 'A';
		//exit;
		
	}else
	{
		
	
	$sql ="INSERT INTO `Client_Number_Vs_Air_Time_ALL_5G`(`all_data_interval_5G`, `all_time_zone_5G`, `all_domain_5G`, `all_radio_5G`, `timestamp_5G`, `of_clients_5G`, `tx_5G`, `rx_5G`, `busy_5G` , `all_domain_5G_2`, `all_radio_5G_2`, `of_clients_5G_2`, `tx_5G_2`, `rx_5G_2`, `busy_5G_2`) VALUES('$A[0]','$B[0]','$C[1]','$D[1]','$data1','$data2','$data3','$data4','$data5','$C[5]','$D[5]','$data6','$data7','$data8','$data9')";

	$result = execute_sql($database_name, $sql, $link);

echo $sql;

	}
   
	}

	
echo '<br>';
echo $i;
	
   $i++;     
  
}



fclose($file);
rename("FTP_upload/".$csv_file,"FTP_upload/ok_file/".$csv_file);



?>
