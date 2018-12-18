<?php
include('setup.php');
$email = $_POST['email'];
$error = [];
$hsh = hash('whirlpool',(rand()));

if ($email)
{
    $populate = $conn->prepare("SELECT * FROM users WHERE email =:email"); 
    $populate->bindParam(":email", $email);
    $populate->execute();
    $results = $populate->fetchAll(PDO::FETCH_ASSOC);
    if (count($results) <= 0)
    {
        header('Location: http://127.0.0.1:8080/Camagru/index.php');
    }
    $Found_username = $results[0]['email'];
    
    $firstpass = $_POST['oldpass'];
    $userPassword = $_POST['newpass'];
	$hashedpass = hash('whirlpool',($userPassword));


    function isSecurePassword($userPassword)
    {
        $uppercase = preg_match('@[A-Z]@', $userPassword);
        $lowercase = preg_match('@[a-z]@', $userPassword);
        $number    = preg_match('@[0-9]@', $userPassword);
        if(!$uppercase || !$lowercase || !$number || strlen($userPassword) < 6)
            return 0;
        else
            return 1;
    }
    
    
    if (($firstpass != $userPassword))
    {
        $error[] = "Password does not match";
    }
    if (!isSecurePassword($userPassword))
    {
        $error[] = "Insecure password";
    }

    if (count($error) == 0)
    {
        if ($Found_username == $email)
        {
            if ($results[0]['activated'] == '1')
            {
                $populate = $conn->prepare("UPDATE $tablename  SET hashedpass = :hashedpass WHERE email =:email");
                $populate->bindParam(":email", $email);                   
	            $populate->bindParam(":hashedpass", $hashedpass);
                $populate->execute();
	            header('Location: http://127.0.0.1:8080/Camagru/index.php');
            }
            else
            {
                header('Location: http://127.0.0.1:8080/Camagru/activated.html');
            }
        }
        else
        {
            echo "<br>No account found<br>";
        }
    }
    else
    {
        echo "<br>Your password aint tight enough<br>";
    }
}
else
{
    echo "No account found";
}
?>