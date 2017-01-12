<?php //header('refresh: 300;url="?"') ?>

<?php 
 require_once("SQL/dbtools.inc.php");
  $link = create_connection();







//echo getcwd().'n'.'<br>';

chdir('../../../../home/sk/FTP_upload/');
//chdir('./718_8');

echo getcwd().'n'.'<br>';


//print_r(glob("*.csv"));
$A= glob("*.csv");
 $arr_num= count($A);
//print_r($A);
//echo $arr_num;
for($a=0;$a<=$arr_num;$a++)
	{
	  echo $A[$a].'<br>';
	 if(empty($A[$a]))
		{
	 	  // echo 'NU::';
		}else
		{
$sql = "SELECT * FROM  scv_table  WHERE scv_table_name='$A[$a]'       " ;
	$result = execute_sql($database_name, $sql, $link);
	$total_records = mysql_num_rows($result);
	
	if($total_records>0)
	{}else{

	$sql = "INSERT INTO scv_table(scv_table_name) VALUES ('$A[$a]' )" ;
	$result = execute_sql($database_name, $sql, $link);	
	echo $sql.'<br>';
}
}
            
	}

echo '<br>';
echo $arr_num;


/*
$file = fopen("csv/text.csv","rb");

// reader 7
for($i=1;$i<8;$i++)
{
$data = fgetcsv($file);
}




 
$i=0;
while(!feof($file))
{


	//print_r($data = fgetcsv($file));
	
       $data = fgetcsv($file);
	$data1 =  $data[0];
	$data2 =  $data[1];
	$data3 =  $data[2];
	$data4 =  $data[3];





        if(empty($data1)and empty($data2) and empty($data3) and empty($data4))
	{
 	  // echo 'NU::';
	}else
	{

	$sql = "SELECT * FROM  Persons  WHERE a='$data1'       " ;
	$result = execute_sql($database_name, $sql, $link);
	$total_records = mysql_num_rows($result);
	
	if($total_records>0)
	{
		
	

	    // echo 'A';
		//exit;
		
	}else
	{
		
	   //echo 'B';
		//exit;
	$sql = "INSERT INTO Persons (a,b,c,d) VALUES ('$data1','$data2','$data3','$data4' )" ;
	$result = execute_sql($database_name, $sql, $link);	
		
	}
   
	}

	

   $i++;     
  
}

fclose($file);

*/




?>
