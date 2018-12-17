<?php
include('setup.php');
$email = $_POST['email'];

if ($email)
{
    $populate = $conn->prepare("SELECT * FROM users WHERE email =:email"); 
    $populate->bindParam(":email", $email);
    $populate->execute();
    $results = $populate->fetchAll(PDO::FETCH_ASSOC);

    $Reset_line = " Reset camagru password";
    $Reset_text = "Hey there!
    Please reset you password below if you requested to reset. Clicking the link below
    http://127.0.0.1:8080/Camagru/newpassword.php?email=$email 
            
    Thank you
    Camagru";
    $head = 'From:reset@camagru' . "\r\n";
    mail($email, $Reset_line, $Reset_text, $head); 
    echo "<br>Check your email for reset link<br>";
}
else
{
    echo "<br>No account found, register your email address first<br>";
}
?>