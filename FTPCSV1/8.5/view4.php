

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

	$AAAA = fgetcsv($file) ;
	$BBBB = fgetcsv($file) ;
	$CCCC = fgetcsv($file) ;
	$DDDD = fgetcsv($file) ;
	$EEEE = fgetcsv($file) ;
	//$FFFF = fgetcsv($file) ;

	print_r($AAAA);		echo '1<br><br>';
	print_r($BBBB);			echo '2<br><br>';
	print_r($CCCC);			echo '3<br><br>';
	print_r($DDDD);			echo '4<br><br>';
	print_r($EEEE);	echo '5<br><br>';
	//print_r($FFFF);	echo '6<br><br>';


$arry_count = ( count($CCCC) -1 )/4;
echo  $arry_count;
echo '<br><br>';
 
$i=0;

while(!feof($file)  )
{

	
       $data = fgetcsv($file);
print_r($data); echo 'dtat<br><br>';


//exit();
       for ($z = 0; $z < $arry_count; $z++) 
	{
            
        if(empty($data[0]))
	{

        }else
	{
             if($z==0)
		{
		
		$sql1 = "SELECT * FROM  Client_Number_Vs_Air_Time_5G    WHERE   timestamp_5G='$data[0]' and zone_5G='$CCCC[1]'        " ;
		$result1 = execute_sql($database_name, $sql1, $link);
		$total_records = mysql_num_rows($result1);
	//echo $sql1;
		if($total_records==0)
		{

//echo $z;
            $sql = "INSERT INTO Client_Number_Vs_Air_Time_5G(data_interval_5G,time_zone_5G,zone_5G,radio_5G,timestamp_5G,of_clients_5G,tx_5G,rx_5G,busy_5G) VALUES('$AAAA[0]','$BBBB[0]','$CCCC[1]','$DDDD[1]','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')";
$result = execute_sql($database_name, $sql, $link);
//echo   $sql;
		
		
		}
                
		

		}else
		{
//echo $z;

//echo  $z*4 ;
      $z1 = 1+($z*4);
	$z2 = 2+($z*4);
	$z3 = 3+($z*4);
	$z4 = 4+($z*4);
	
	
echo  $z1.$z2.$z3.$z4 ;
echo '<br>';

$sql1 = "SELECT * FROM  Client_Number_Vs_Air_Time_5G    WHERE   timestamp_5G='$data[0]' and zone_5G='$CCCC[$z1]'        " ;
		$result1 = execute_sql($database_name, $sql1, $link);
		$total_records = mysql_num_rows($result1);
	//echo $sql1;
		if($total_records==0)
		{

      $sql = "INSERT INTO Client_Number_Vs_Air_Time_5G(data_interval_5G,time_zone_5G,zone_5G,radio_5G,timestamp_5G,of_clients_5G,tx_5G,rx_5G,busy_5G) VALUES('$AAAA[0]','$BBBB[0]','$CCCC[$z1]','$DDDD[1]','$data[0]','$data[$z1]','$data[$z2]','$data[$z3]','$data[$z4]')";
$result = execute_sql($database_name, $sql, $link);
echo   $sql;

		
		}



		}
   
       }

		 
		echo '<br>';
	}

 
   $i++;     
  
}
echo $i ;


fclose($file);
chdir('../../../../home/sk/');
rename("FTP_upload/".$csv_file,"FTP_upload/ok_file/".$csv_file);



?>
