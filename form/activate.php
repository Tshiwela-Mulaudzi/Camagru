<?php
include('credentials.php');
$email = $_GET[email];
//echo "$hsh and $email <br>";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$stmt = $conn ->prepare("SELECT * FROM $tablename WHERE email = :email");                          
$stmt->bindParam(':email', $email);
$stmt->execute();

$Activateresults = $stmt->fetchAll();
print_r($Activateresults);
echo  $stmt->rowCount(). '<br>';
    
if($stmt->rowCount() == 1)
{
    $stmt = $conn ->prepare("UPDATE $users_TTB SET actived ='1' WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    echo "<h6>Success! Your account successfully activated!</h6>";
    header("Refresh: 2; url=index.php");
    }
else
{
     echo "Got to the else";
}
?>
</body>
