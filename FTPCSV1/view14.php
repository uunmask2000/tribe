

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
	$FFFF = fgetcsv($file) ;

	print_r($AAAA);		echo '1<br><br>';
	print_r($BBBB);			echo '2<br><br>';
	print_r($CCCC);			echo '3<br><br>';
	print_r($DDDD);			echo '4<br><br>';
	print_r($EEEE);	echo '5<br><br>';
	print_r($FFFF);	echo '6<br><br>';


$arry_count = ( count($CCCC)-1)/4;
echo  $arry_count;
echo '<br><br>';
 
$i=0;

while(!feof($file)  )
{

	
       $data = fgetcsv($file);
print_r($data); echo 'dtat<br><br>';

       for ($z = 0; $z < $arry_count; $z++) 
	{
            
        if(empty($data[0]))
	{

        }else
	{
             if($z==0)
		{
		
		$sql1 = "SELECT * FROM TX_and_Rx where timestamp='$data[0]' and zone='$CCCC[1]'        " ;
		$result1 = execute_sql($database_name, $sql1, $link);
		$total_records = mysql_num_rows($result1);
	echo $sql1;
		if($total_records==0)
		{
               if($EEEE[1]=='Ssid:iTaiwan')
{

//echo 'Ssid:iTaiwan';
 $sql ="INSERT INTO TX_and_Rx(data_interval, time_zone, zone, radio, timestamp, ssid_itaiwan, itaiwan_rx, itaiwan_tx, ssid_itribe itribe_rx, itribe_tx) VALUES
('$AAAA[0]','$BBBB[0]','$CCCC[1]','$DDDD[1]','$data[0]','$EEEE[1]','$data[1]','$data[2]','$EEEE[3]','$data[3]','$data[4]')";
$result = execute_sql($database_name, $sql, $link);

}else{

//echo 'Ssid:i-Tribe';

$sql ="INSERT INTO TX_and_Rx(data_interval, time_zone, zone, radio, timestamp, ssid_itribe , itribe_rx, itribe_tx, ssid_itaiwan, itaiwan_rx, itaiwan_tx) VALUES
('$AAAA[0]','$BBBB[0]','$CCCC[1]','$DDDD[1]','$data[0]','$EEEE[1]','$data[1]','$data[2]','$EEEE[3]','$data[3]','$data[4]')";
$result = execute_sql($database_name, $sql, $link);



}
		
		
		}
                
		

		}else
		{
//echo $z;

//echo  $z*4 ;
      $z1 = 1+($z*4);
	$z2 = 2+($z*4);
	$z3 = 3+($z*4);
	$z4 = 4+($z*4);
	$z5 = 5+($z*4);
	
//echo  $z1.$z2.$z3.$z4 ;
//echo '<br>';

//echo $z1.'<br>';
//echo $CCCC[$z1];
		$sql1 = "SELECT * FROM TX_and_Rx  where timestamp='$data[0]' and zone='$CCCC[$z1]'       " ;
		$result1 = execute_sql($database_name, $sql1, $link);
		$total_records = mysql_num_rows($result1);
	//echo $sql1;
		if($total_records==0)
		{


   if($EEEE[$z1]=='Ssid:iTaiwan')
{
 $sql ="INSERT INTO TX_and_Rx(data_interval, time_zone, zone, radio, timestamp, ssid_itaiwan, itaiwan_rx, itaiwan_tx, ssid_itribe, itribe_rx, itribe_tx) VALUES
('$AAAA[0]','$BBBB[0]','$CCCC[$z1]','$DDDD[$z1]','$data[0]','$EEEE[$z1]','$data[$z1]','$data[$z2]','$EEEE[$z3]','$data[$z3]','$data[$z4]')";
$result = execute_sql($database_name, $sql, $link);

}else{
 $sql ="INSERT INTO TX_and_Rx(data_interval, time_zone, zone, radio, timestamp, ssid_itribe, itribe_rx, itribe_tx, ssid_itaiwan, itaiwan_rx, itaiwan_tx) VALUES
('$AAAA[0]','$BBBB[0]','$CCCC[$z1]','$DDDD[$z1]','$data[0]','$EEEE[$z1]','$data[$z1]','$data[$z2]','$EEEE[$z3]','$data[$z3]','$data[$z4]')";
$result = execute_sql($database_name, $sql, $link);
//echo $sql.'<br>';
}
		
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
