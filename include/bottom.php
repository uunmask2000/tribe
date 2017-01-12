
原住民族委員會 council of indigenous peoples<br/>
Copyright ©  2016-<?php    echo date("Y");?> All Rights Reserved.

<?php
//Browsing history
$URL=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
///echo $URL;
$ame = $_SESSION['user_name'] ;

$servername = "localhost";
$username = "root";
$password = "0932969495";
$dbname = "AP_data";

try {
	
		//$db=new PDO("mysql:host=".$hostname.";dbname=".$db_name, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		//PDO::MYSQL_ATTR_INIT_COMMAND 設定編碼
		//echo '連線成功';
		//$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //錯誤訊息提醒	
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if($ame!=NULL)
			{
			$sql = "INSERT INTO `Browsing history`( `name`, `url`) VALUES ('$ame','$URL')";
			// use exec() because no results are returned
			$conn->exec($sql);	  
			//echo "New record created successfully";
			}

    }
catch(PDOException $e)
    {
  // echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>