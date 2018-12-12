<?php
session_start();
include('credentials.php');
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

if(isset($_POST['cancel']))
{
    header('Location: http://127.0.0.1:8080/Camagru/takeapic.html');   
}
else if (isset($_POST['postpic']))
{
    $image = $_POST['nameoftheinput'];
    if (isset($image))
    {
        $usernamefromsession = $_SESSION['sessionUsername'];
        $emailfromsession = $_SESSION['sessionEmail'];
        //$username = "Tshiwela";
        try
        {
        $populate = $conn->prepare ("INSERT INTO gallery (username, pic, useremail) 
        VALUES (:usernamefromsession, :pic, :emailfromsession )");
        $populate->bindParam(":usernamefromsession", $usernamefromsession);
        $populate->bindParam(":pic", $image);
        $populate->bindParam(":emailfromsession", $emailfromsession);
        echo "5<br>";
	    $populate->execute();
        echo "successfully uploaded<br>";
        header('Location: http://127.0.0.1:8080/Camagru/form/timeline.php'); 
        }
        catch(PDOException $e)
        {
            echo "Failed to post image".$e->getMessage() . "<br>";
        }
    }
}
$conn = null;
?>