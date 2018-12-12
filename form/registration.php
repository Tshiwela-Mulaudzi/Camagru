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

<script>
if ($_POST['password'] != $_POST['password2'])
{
	echo "The two passwords do not match<br>";
}

function validateusername()
{
	var usernamebox = document.getElementById("username");
	var usernamevalue = usernamebox.value;
	if (usernamevalue.length > 1)
	{
		usernamebox.style.borderBottom = "2px midnightblue solid";
		usernamebox.style.borderRight = "2px midnightblue solid";
		usernamebox.style.borderTop = "2px midnightblue solid";
		usernamebox.style.borderLeft = "2px midnightblue solid";
		return true;
	}
	else
	{
		usernamebox.style.borderBottom = "2px red solid";
		usernamebox.style.borderRight = "2px red solid";
		usernamebox.style.borderTop = "2px red solid";
		usernamebox.style.borderLeft = "2px red solid";
		return false;
	}
}

function validateemail()
{
	var emailbox = document.getElementById("email");
	var emailvalue = usernamebox.value;
	if (emailvalue.length > 5)
	{
		emailbox.style.borderBottom = "2px midnightblue solid";
		emailbox.style.borderRight = "2px midnightblue solid";
		emailbox.style.borderTop = "2px midnightblue solid";
		emailbox.style.borderLeft = "2px midnightblue solid";
		return true;
	}
	else
	{
		emailbox.style.borderBottom = "2px red solid";
		emailbox.style.borderRight = "2px red solid";
		emailbox.style.borderTop = "2px red solid";
		emailbox.style.borderLeft = "2px red solid";
		return false;
	}
}

function validatepasswords()
{
	var passwordbox1 = document.getElementById("password");
	var passwordbox2 = document.getElementById("password2");
	var passwordbox1value = passwordbox1.value;
	var passwordbox2value = passwordbox2.value;
	var passwordlen = passwordbox1value.length;
	var similar = passwordbox1value.localCompare(passwordbox2value);

	if (passwordbox1value.length > 6)
	{
		passwordbox1.style.borderBottom = "2px midnightblue solid";
		passwordbox1.style.borderRight = "2px midnightblue solid";
		passwordbox1.style.borderTop = "2px midnightblue solid";
		passwordbox1.style.borderLeft = "2px midnightblue solid";
		return true;
	}
	else if (passwordbox1value.length < 6)
	{
		document.getElementById('password').innerHTML = '6 characters and more';
		return false;
	}
	if (passwordbox1value.length > 6 && similar == 0)
	{
		passwordbox1.style.borderBottom = "2px midnightblue solid";
		passwordbox1.style.borderRight = "2px midnightblue solid";
		passwordbox1.style.borderTop = "2px midnightblue solid";
		passwordbox1.style.borderLeft = "2px midnightblue solid";

		passwordbox2.style.borderBottom = "2px midnightblue solid";
		passwordbox2.style.borderRight = "2px midnightblue solid";
		passwordbox2.style.borderTop = "2px midnightblue solid";
		passwordbox2.style.borderLeft = "2px midnightblue solid";
		return true;
	
	}
}

function finalvalidation()
{
	var passwordbox1 = document.getElementById("password");
	var passwordbox2 = document.getElementById("password2");
	var registerbutton = document.getElementById("registration");
	var pass1value = passwordbox1.value;
	var pass2value = passwordbox1.value;
	var checkname = validateusername();
	var checkemail = validateemail();
	var checkpass = validatepasswords();
	if (checkpass && checkemail && checkusername)
	{
		registerbutton.disabled = false;
	}
	else
	{
		registerbutton.disabled = true;
	}
}
</script>