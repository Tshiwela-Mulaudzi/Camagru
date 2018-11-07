<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "camagru";
$tablename = "users";

try {
	
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

	// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    echo "successfully connected<br>";
    }
catch(PDOException $e)
    {

    echo $sql . "<br>" . $e->getMessage();
    }

	try{
	$login = $_POST['username'];
	$email = $_POST['email'];
	$pssword = $_POST['password'];
	$activated = 0;
	echo "$login<br>";
	echo "$email<br>";
	echo "$pssword<br>";
	// $hashedpassword = hash("whirlpool", $password);
	// $storedpassword = hash('md5', $login);
	
	//add the person to to DB

	$populate = $conn->prepare("INSERT INTO $tablename (username, email, userPassword, activated)
									    VALUES(:username, :email, :pssword, :activated)");
$populate->bindParam(":username", $login);
$populate->bindParam(":email", $email);
$populate->bindParam(":pssword", $pssword);
$populate->bindParam(":activated", $activated);
$populate->execute();
header('Location: http://127.0.0.1:8080/Camagru/index0.php/');
	}
	catch(PDOException $e)
    {

    echo $sql . "<br>" . $e->getMessage();
    }
echo "done";
$conn = null;
?>