<?php
//connect to server
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "camagru";
$tablename = "users";
$picturetable = "gallery";
$likestable = "likes";



//create database	
	try {
		$conn = new PDO("mysql:host=$servername", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
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
    $sql = "CREATE TABLE IF NOT EXISTS $tablename (
    userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
	activated INT(1),
	sendmail INT(1),
	hashedpass VARCHAR(255) NOT NULL
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
		$sql = "CREATE TABLE IF NOT EXISTS $picturetable (
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

	try
	{
		$sql = "CREATE TABLE IF NOT EXISTS `comments` (
			pic_id INT(6)  NOT NULL, 
			comment VARCHAR(255) NULL
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