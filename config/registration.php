<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "camagru";
$tablename = "users";
$error = [];
$hsh = hash('whirlpool',(rand()));

try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "successfully connected<br>";
    }
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

try
{
	$login = $_POST['username'];
	$email = $_POST['email'];
	$pssword = $_POST['password'];
	$password2 = $_POST['password2'];
	$activated = 0;
	echo "$login<br>";
	echo "$email<br>";
	echo "$pssword<br>";

	function isSecurePassword($password2)
	{
		$uppercase = preg_match('@[A-Z]@', $password2);
		$lowercase = preg_match('@[a-z]@', $password2);
		$number    = preg_match('@[0-9]@', $password2);
		if(!$uppercase || !$lowercase || !$number || strlen($password2) < 6)
			return 0;
		else
			return 1;
	}

	if (strlen(trim($login)) < 3)
	{
		$error[] = "Username too short";
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$error[] = "Invalid email address";
	}
	if (($pssword != $password2))
	{
		$error[] = "Password does not match";
	}
	if (!isSecurePassword($password2))
	{
		$error[] = "Insecure password";
	}

	if (trim(isset($password)) && trim(isset($password2)) && trim(isset($email)) && 
	trim(isset($username)) && (count($error) == 0))
	{
		if (strcmp($pssword, $password2) == 0)
		{
			$hashedpass = hash('whirlpool',($password2));
			$populate = $conn->prepare("INSERT INTO $tablename (username, email, activated, hashedpass)
											VALUES(:username, :email, :activated, :hashedpass)");
			$populate->bindParam(":username", $login);
			$populate->bindParam(":email", $email);
			$populate->bindParam(":activated", $activated);
			$populate->bindParam(":hashedpass", $hashedpass);
			$populate->execute();

			$subjectline = "Account registration";
			$messagetext = "Hey there!

			Thank you for registering with camagru. Please activate your account by clicking the link below
			http://127.0.0.1:8080/Camagru/config/activate.php?email=$email 

			Your may log in as:
			Username : ".$login."
			Password : ".$pssword."

			Pleasen activate your acount here
			Thank you
			Camagru";

			$head = 'From registration@camagru.co.za'."\n\r";
			mail($email, $subjectline, $messagetext, $head);
			header('Location: http://127.0.0.1:8080/Camagru/activated.html');
		}
		else
		{
			header('location: ../signup.php');
		}
	}
	else
	{
		header('Location: http://127.0.0.1:8080/Camagru/signup.php');
	}
}

catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>