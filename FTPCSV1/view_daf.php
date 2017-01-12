

<?php 
/*
  require_once("SQL/dbtools.inc.php");
  $link = create_connection();
	$sql = "SELECT * FROM  scv_table where scv_table_id=2" ;
	$result = execute_sql($database_name, $sql, $link);
       while ($row = mysql_fetch_assoc($result))
	     {
		$csv_file= $row['scv_table_name'];

                }    
*/  
$csv_file = 'Client_Number_5G-2016-06-16_10-00-05-366_58.csv';

echo $csv_file.'<br>';
chdir('../../../../home/sk/FTP_upload/ok_file');
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



$arry_count = ( count($BBBB) -1 )/4;
echo  $arry_count;
echo '<br><br>';
 
$i=0;

while(!feof($file)  )
{


	//print_r($data = fgetcsv($file));
	
       $data = fgetcsv($file);
	print_r($data = fgetcsv($file));
/*
       for ($z = 0; $z < $arry_count; $z++) 
	{
            
        if(empty($data[0]))
	{

        }else
	{
             if($z==0)
		{
		
		$sql1 = "SELECT * FROM  Client_Number_5G WHERE timestamp_5G='$data[0]' and Client_Number_5G_zone='$CCCC[1]'        " ;
		$result1 = execute_sql($database_name, $sql1, $link);
		$total_records = mysql_num_rows($result1);
	//echo $sql1;
		if($total_records==0)
		{
if($DDDD[1]=='Ssid:iTaiwan')
{
 $sql = "INSERT INTO Client_Number_5G(Client_Number_5G_data, Client_Number_5G_time, timestamp_5G, Client_Number_5G_zone, Client_Number_5G_radio, ssid_itaiwan_5G, ssid_itaiwan_5G_max_client, ssid_itaiwan_5G_min_client, ssid_itribe_5G, ssid_itribe_5G_max_client, ssid_itribe_5G_min_client)
VALUES ('$AAAA[0]','$BBBB[0]','$data[0]','$CCCC[1]','$DDDD[1]','$EEEE[1]','$data[1]','$data[2]','$EEEE[3]','$data[3]','$data[4]')";
$result = execute_sql($database_name, $sql, $link);

}else{
 $sql = "INSERT INTO Client_Number_5G(Client_Number_5G_data, Client_Number_5G_time, timestamp_5G, Client_Number_5G_zone, Client_Number_5G_radio, ssid_itribe_5G, ssid_itribe_5G_max_client, ssid_itribe_5G_min_client, ssid_itaiwan_5G, ssid_itaiwan_5G_max_client, ssid_itaiwan_5G_min_client)
VALUES ('$AAAA[0]','$BBBB[0]','$data[0]','$CCCC[1]','$DDDD[1]','$EEEE[1]','$data[1]','$data[2]','$EEEE[3]','$data[3]','$data[4]')";
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
	$z5 = 5+($z*4)-1;
echo  $z1.$z2.$z3.$z4 ;
echo '<br>';
$sql1 = "SELECT * FROM  Client_Number_5G WHERE timestamp_5G='$data[0]' and  Client_Number_5G_zone='$CCCC[$z1]'     " ;
		$result1 = execute_sql($database_name, $sql1, $link);
		$total_records = mysql_num_rows($result1);
	//echo $sql1;
		if($total_records==0)
		{

if($DDDD[$z1]=='Ssid:iTaiwan')
{
 $sql = "INSERT INTO Client_Number_5G(Client_Number_5G_data, Client_Number_5G_time, timestamp_5G, Client_Number_5G_zone, Client_Number_5G_radio, ssid_itaiwan_5G, ssid_itaiwan_5G_max_client, ssid_itaiwan_5G_min_client, ssid_itribe_5G, ssid_itribe_5G_max_client, ssid_itribe_5G_min_client)
VALUES ('$AAAA[0]','$BBBB[0]','$data[0]','$CCCC[$z1]','Ssid:iTaiwan','$EEEE[1]','$data[$z1]','$data[$z2]','Ssid:i-Tribe','$data[$z4]','$data[$z5]')";
$result = execute_sql($database_name, $sql, $link);

}else{
  $sql = "INSERT INTO Client_Number_5G(Client_Number_5G_data, Client_Number_5G_time, timestamp_5G, Client_Number_5G_zone, Client_Number_5G_radio, ssid_itribe_5G, ssid_itribe_5G_max_client, ssid_itribe_5G_min_client, ssid_itaiwan_5G, ssid_itaiwan_5G_max_client, ssid_itaiwan_5G_min_client)
VALUES ('$AAAA[0]','$BBBB[0]','$data[0]','$CCCC[$z1]','Ssid:i-Tribe','$EEEE[1]','$data[$z1]','$data[$z2]','Ssid:iTaiwan','$data[$z4]','$data[$z5]')";
$result = execute_sql($database_name, $sql, $link);

}
		
		
		}



		}
   
       }

		 
		echo '<br>';
	}


*/
   $i++;     
  
}



fclose($file);



?>
