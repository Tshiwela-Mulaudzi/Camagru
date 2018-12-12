<?php
include('credentials.php');
$email = $_GET['email'];
//echo "$hsh and $email <br>";
// echo $email;
// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$stmt = $conn ->prepare("SELECT * FROM $tablename WHERE email = :email");                          
$stmt->bindParam(':email', $email);
$stmt->execute();

$Activateresults = $stmt->fetchAll();
//print_r($Activateresults);
echo  $stmt->rowCount(). '<br>';
    
if($stmt->rowCount())
{
    $stmt = $conn ->prepare("UPDATE $tablename SET activated ='1' WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    // echo "<h6>Success! Your account successfully activated!</h6>";
    echo "<script>alert('activated')</script>";
    //header("Refresh: 2; url=index0.php");
	header('Location: http://127.0.0.1:8080/Camagru/index0.php');
    }
else
{
     echo "Got to the else";
}
?>
</body>
