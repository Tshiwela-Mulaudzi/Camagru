<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "camagru";
$tablename = "users";
$error = [];
$hsh = hash('whirlpool',(rand()));

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

function isSecurePassword($password)
{
	$uppercase = preg_match('@[A-Z]@', $password2);
	$lowercase = preg_match('@[a-z]@', $password2);
	$number    = preg_match('@[0-9]@', $password2);
	if(!$uppercase || !$lowercase || !$number || strlen($password) < 6)
		return 0;
	else
		return 1;
}

if (strlen(trim($login)) < 3)
{
	$error[] = "Username too short";
	print_r($error);

}
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	$error[] = "Invalid email address";
	print_r($error);

}
if (($pssword != $password2))
{
	$error[] = "Password does not match";
	print_r($error);

}
if (!isSecurePassword($password2))
{
	$error[] = "Insecure password";
	print_r($error);
}
	
if (trim(isset($password)) && trim(isset($password2)) && trim(isset($email)) && 
trim(isset($username)))
{
	if (strcmp($pssword, $password2) == 0)
	{
	
	$hashedpass = hash('whirlpool',($password2));
	$populate = $conn->prepare("INSERT INTO $tablename (username, email, userPassword, activated, hashedpass)
											VALUES(:username, :email, :pssword, :activated, :hashedpass)");
	$populate->bindParam(":username", $login);
	$populate->bindParam(":email", $email);
	$populate->bindParam(":pssword", $pssword);
	$populate->bindParam(":activated", $activated);
	$populate->bindParam(":hashedpass", $hashedpass);
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