<?php
include('credentials.php');

$newlogin = $_POST['username'];
$newmail = $_POST['email'];
$error = [];
$hsh = hash('whirlpool',(rand()));
$IDfromsession = $_SESSION['sessionID'];
echo $IDfromsession."<br><br>";

if (strlen(trim($newlogin)) < 3)
{
	$error[] = "Username too short";
	print_r($error);
}
if (!filter_var($newmail, FILTER_VALIDATE_EMAIL))
{
	$error[] = "Invalid email address";
	print_r($error);

}

if ($IDfromsession)
{	  
        if (trim(isset($newlogin)))
        {
            $populate = $conn ->prepare("UPDATE $tablename SET username = :newlogin WHERE userID = :IDfromsession");
            $populate->bindParam(':IDfromsession', $IDfromsession);
            $populate->bindParam(':newlogin', $newlogin);
            $populate->execute();
        }
        if (trim(isset($newmail)))
        {
            $populate = $conn ->prepare("UPDATE $tablename SET email = :newmail WHERE userID = :IDfromsession");
            $populate->bindParam(':IDfromsession', $IDfromsession);
            $populate->bindParam(':newmail', $newmail);
            $populate->execute();
        }
        if (isset($_POST['emailnot']))
        {
            $populate = $conn ->prepare("UPDATE $tablename SET sendmail ='1' WHERE userID = :IDfromsession");
            $populate->bindParam(':IDfromsession', $IDfromsession);
            $populate->execute();
        }
        if (isset($_POST['delete']))
        {
            $populate = $conn ->prepare("DELETE FROM $tablename WHERE userID = :IDfromsession");
            $populate->bindParam(':IDfromsession', $IDfromsession);
            $populate->execute();
            header('Location: http://127.0.0.1:8080/Camagru/signup.php'); 
        }
        header('Location: http://127.0.0.1:8080/Camagru/'); 

}
else 
{
    echo "Well, if no username maybe they shouldnt update";
}
$conn = null;
?>