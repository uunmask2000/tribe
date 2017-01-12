

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
$D = fgetcsv($file) ;
//$E = fgetcsv($file) ;
//$F = fgetcsv($file) ;

	print_r($A);
		echo '1<br>';
	print_r($B);
			echo '2<br>';
	print_r($C);
			echo '3<br>';
	print_r($D);
			echo '4<br>';
	//print_r($E);
	//		echo '5<br>';
	//print_r($F);
			//echo '6<br>';

 
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

	echo $data1.' [-] '.$data2.' [-] '.$data3.' [-] '.$data4.' [-] '.$data5;
		echo '<br>';
	
    

        if(empty($data1)and empty($data2) and empty($data3) and empty($data4))
	{
 	  // echo 'NU::';
	}else
	{

	$sql = "SELECT * FROM  System_Resource_Utilization  WHERE timestamp='$data1'       " ;
	$result = execute_sql($database_name, $sql, $link);
	$total_records = mysql_num_rows($result);
	
	if($total_records>0)
	{
		
	

	    // echo 'A';
		//exit;
		
	}else
	{
		
	   
 
	$sql = "INSERT INTO `System_Resource_Utilization`(`data_interval`, `time_zone`, `plane`, `timestamp`, `cpu`, `memory`) VALUES ('$A[0]','$B[0]','$C[1]','$data1','$data2','$data3')" ;
	$result = execute_sql($database_name, $sql, $link);


	
	}
   
	}

	

   $i++;     
  
}



fclose($file);
rename("FTP_upload/".$csv_file,"FTP_upload/ok_file/".$csv_file);



?>
