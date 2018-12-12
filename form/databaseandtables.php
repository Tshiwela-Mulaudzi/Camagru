<?php
//connect to server
include('credentials.php');
//create database	
	try {
		$conn = new PDO("mysql:host=$servername", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE $dbname";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "Database created successfully $dbname<br>";
		}
	catch(PDOException $e)
		{
		echo $sql . "<br>" . $e->getMessage();
		}


// create table
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    // sql to create table
    $sql = "CREATE TABLE $tablename (
    userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
	userPassword VARCHAR(56),  
	activated INT(1)
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo"$tablename created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
	}

	// //table for uploading pictures
	try
	{
		$sql = "CREATE TABLE $picturetable (
			pictureID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			username VARCHAR(30) NOT NULL,
			pic LONGTEXT NOT NULL,
			likes INT(6) NULL,
			useremail VARCHAR(255) NULL,
			dateposted DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
			)";
			$conn->exec($sql);
			echo "Gallery table created successfully<br>";
	}
	catch(PDOException $e)
    {
    echo "<br>Failed to create gallery table<br>" . $e->getMessage();
	}

	$conn = null;
?>