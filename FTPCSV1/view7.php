

<?php 
  require_once("SQL/dbtools.inc.php");
  $link = create_connection();
$csv_file =$_GET['file'];
		chdir('../../../../home/sk/');
		$file = fopen('FTP_upload/'.$csv_file,"rb");
//$file = fopen('718_8/'.$csv_file,"rb");


//$file = fopen("csv/text.csv","rb");

/*
// reader 7
for($i=1;$i<8;$i++)
{
$data = fgetcsv($file);
}
*/

for($i=1;$i<=1;$i++)
{
$data = fgetcsv($file);
}

$data = fgetcsv($file);
//print_r($data = fgetcsv($file));

$A = fgetcsv($file) ;
$B = fgetcsv($file) ;
$C = fgetcsv($file) ;
//$D = fgetcsv($file) ;
//$E = fgetcsv($file) ;
//$F = fgetcsv($file) ;

	print_r($A);
		echo '1<br>';
	print_r($B);
			echo '2<br>';
	print_r($C);
			echo '3<br>';
	//print_r($D);
			//echo '4<br>';
	//print_r($E);
	//		echo '5<br>';
	//print_r($F);
			//echo '6<br>';

 
$i=0;
while(!feof($file))
{


	//print_r($data = fgetcsv($file));
	
       $data = fgetcsv($file);
	$data0 =  $data[0];
	$data1 =  $data[1];
	$data2 =  $data[2];
	$data3 =  $data[3];
	$data4 =  $data[4];
	$data5 =  $data[5];
	$data6 =  $data[6];
	$data7 =  $data[7];
	$data8 =  $data[8];
	$data9 =  $data[9];
	//$data10 =  $data[10];
	//$data11 =  $data[11];
	//$data12 =  $data[12];

	echo $data1.' [-] '.$data2.' [-] '.$data3.' [-] '.$data4.' [-] '.$data5.' [-] '.$data6.' [-] '.$data7.' [-] '.$data8.' [-] '.$data9;
		echo '<br>';
	
       

        if(empty($data1)and empty($data2) and empty($data3) and empty($data4))
	{
 	  // echo 'NU::';
	}else
	{
/*
	$sql = "SELECT * FROM  Continuously_Disconnected_APs  WHERE WHERE ip_address='$data4'         " ;
	$result = execute_sql($database_name, $sql, $link);
	$total_records = mysql_num_rows($result);
*/	
	if($total_records>0)
	{
		
	

	    // echo 'A';
		//exit;
		
	}else
	{
		
	   
 
	$sql = "INSERT INTO `Continuously_Disconnected_APs_D`(`time_period`, `time_zone`, `mac_address`, `ap_name`, `zone`, `domain`, `ip_address`, `ip_v6_address`, `ip_mode`, `mode`, `mesh_role`, `lastseen`) VALUES ('$A[0]','$B[0]','$data0','$data1','$data2','$data3','$data4','$data5','$data6','$data7','$data8','$data9')";
       $result = execute_sql($database_name, $sql, $link);
//echo $sql;

	
	}
   
	}

	

   $i++;     
  
}



fclose($file);
rename("FTP_upload/".$csv_file,"FTP_upload/ok_file/".$csv_file);


?>
