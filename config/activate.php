<?php
include('setup.php');
$email = $_GET['email'];

//getting user's email data 
$stmt = $conn ->prepare("SELECT * FROM $tablename WHERE email = :email");                          
$stmt->bindParam(':email', $email);
$stmt->execute();

$Activateresults = $stmt->fetchAll();
$stmt->rowCount(). '<br>';

//if person account is found, then activate their account
if($stmt->rowCount())
{
    $stmt = $conn ->prepare("UPDATE $tablename SET activated ='1' WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    echo "<script>alert('activated')</script>";
	header('Location: http://127.0.0.1:8080/Camagru/index.php');
    }
else
{
     echo "Got to the else";
}
?>
</body>
