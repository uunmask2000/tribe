<?php
//include_once('SQL/config.php');
//include_once('SQL/insert_and_fix_function.php');

?>
<?php
for($j=0; $j<9999; $j++)
{
	$array[$j]="('B".($j+1)."')";
	
}
$sting = implode(",",$array);
	//echo $sting;
//$sting = 	substr($sting,0,-1);

?>
<?php

$servername = "localhost";
$username = "root";
$password = "0932969495";
$dbname = "TEST_DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO array_row_time (row_txt) VALUES $sting ";
echo  $sql;
if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

<?php


//print_r($array);
/*
	$z1=array("id");
	$z2=array($id);
	$str1=insert_data("auth_user",$z1,$z2);
	mysqli_query($link,$str1);
*/
/*
$str1=insert_data("auth_user",$z1,$z2);
mysqli_query($link,$str1);
*/
?>