<?php
include('credentials.php');
$email = $_POST['email'];
echo "<br>1<br>";
echo $email;
echo "<br>2<br>";

if ($email)
{
    $populate = $conn->prepare("SELECT * FROM users WHERE email =:email"); 
    $populate->bindParam(":email", $email);
    $populate->execute();
    $results = $populate->fetchAll(PDO::FETCH_ASSOC);
    $Found_username = $results[0]['email'];
    
    $firstpass = $_POST['oldpass'];
    $userPassword = $_POST['newpass'];
    if (strcmp($firstpass, $userPassword) == 0)
    {
        if ($Found_username == $email)
        {
            if ($results[0]['activated'] == '1')
            {
                //$email = $results[0]['email'];       
                //then update the database
                $populate = $conn->prepare("UPDATE $tablename  SET userPassword = :userPassword WHERE email =:email");
                $populate->bindParam(":email", $email);                   
	            $populate->bindParam(":userPassword", $userPassword);
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
        echo "<br>Lol, your passwords do not match<br>";
    }
}
else
{
    echo "No account found";

}
?>