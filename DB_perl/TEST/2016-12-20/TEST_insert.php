<?php
$servername = "localhost";
$username = "root";
$password = "0932969495";
$dbname = "2016_12_D";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

for ($x = 0; $x <= 50000; $x++) {
   // echo "The number is: $x <br>";

	try 
	{


    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO OK (OK_tx ,firstname, lastname, email) 
    VALUES (:OK_tx,:firstname, :lastname, :email)");
	$stmt->bindParam(':OK_tx', $OK_tx);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);

	
			// insert a row
			$OK_tx =  uniqid().uniqid();
			$firstname = "John";
			$lastname = "Doe";
			$email = "john@example.com";
			$stmt->execute();

					/*
					// insert another row
					$OK_tx =   uniqid().uniqid();
					$firstname = "Mary";
					$lastname = "Moe";
					$email = "mary@example.com";
					$stmt->execute();

					// insert another row
					$OK_tx =  uniqid().uniqid();
					$firstname = "Julie";
					$lastname = "Dooley";
					$email = "julie@example.com";
					$stmt->execute();
					*/

			echo "New records created successfully";
			echo '<br>';
		}
			catch(PDOException $e)
			{
			echo "Error: " . $e->getMessage();
			}
			
			
			
	} 		
		$conn = null;



















?>