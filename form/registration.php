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
	$password2 = $_POST['password2'];
	$activated = 0;
	echo "$login<br>";
	echo "$email<br>";
	echo "$pssword<br>";
	// $hashedpassword = hash("whirlpool", $password);
	// $storedpassword = hash('md5', $login);
	
	//add the person to to DB

	
if (trim(isset($password)) && trim(isset($password2)) && trim(isset($email)) && 
trim(isset($username)))
{
if (strcmp($pssword, $password2) == 0)
{
	$populate = $conn->prepare("INSERT INTO $tablename (username, email, userPassword, activated)
											VALUES(:username, :email, :pssword, :activated)");
	$populate->bindParam(":username", $login);
	$populate->bindParam(":email", $email);
	$populate->bindParam(":pssword", $pssword);
	$populate->bindParam(":activated", $activated);
	$populate->execute();

	//sending email part
	$subjectline = "Account registration";
	$messagetext = "Hey there!

	Thank you for registering with camagru. Please activate your account by clicking the link below
	http://127.0.0.1:8080/Camagru/form/activate.php?email=$email 

	Your may log in as:
	Username : ".$login."
	Password : ".$pssword."

	Pleasen activate your acount here
	Thank you
	Camagru";

	$head = 'From registartion@camagru.co.za'."\n\r";
	mail($email, $subjectline, $messagetext, $head);

	echo "Please activate your account by following steps on your email after registration";
	header('Location: http://127.0.0.1:8080/Camagru/activated.html');
}
else
{
	header('location: ../signup.php');
}
}
else
{
	header('location: ../signup.php');
}
	}
	catch(PDOException $e)
    {

    echo $sql . "<br>" . $e->getMessage();
    }
echo "done";
$conn = null;
?>