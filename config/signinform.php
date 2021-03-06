<?php
include('setup.php');
try 
{
    $login = $_POST['username'];
    $pssword = $_POST['password'];
    $hsh = hash('whirlpool',(rand()));
	$hashedpass = hash('whirlpool',($pssword));

    $populate = $conn->prepare("SELECT * FROM $tablename WHERE username = :username AND hashedpass = :hashedpass");
    $populate->bindParam(":username", $login);
    $populate->bindParam(":hashedpass", $hashedpass);
    $populate->execute();

    $result = $populate->fetch(PDO::FETCH_ASSOC); 
    print_r($result);

    if ($result['username'] === $login && $result['hashedpass'] === $hashedpass) 
    {
        if ($result['activated'] == '1')
        {
            $_SESSION['sessionUsername'] = $result['username'];
            $_SESSION['sessionEmail'] = $result['email'];
            $_SESSION['sessionID'] = $result['userID'];
            $_SESSION['sessionNot'] = $result['sendmail'];
            header('Location: ../takeapic.html');
        }
        else 
        {
            header('Location: http://127.0.0.1:8080/Camagru/activated.html');
        }
    }
    else
    {
        header('Location: ../index.php');        
    }
}

catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>