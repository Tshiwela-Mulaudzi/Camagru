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
        $username = "Tshiwela";
        try
        {
        echo "here3?<br>";
       // $populate = $conn->prepare("INSERT INTO $picturetable (userID, pic)
      //  VALUES (:userID, :pic)");

      $populate = $conn->prepare ("INSERT INTO gallery (username, pic) 
      VALUES (:userID, :pic)");
        
        echo "here4?<br>";

            $populate->bindParam(":userID", $username);
            $populate->bindParam(":pic", $image);
            echo "5<br>";
	        $populate->execute();
            echo "successfully uploaded<br>";
            //go to timeline page
        }
        catch(PDOException $e)
        {
            echo "6<br>";
            echo "Failed to post image".$e->getMessage() . "<br>";
        }
    }
}
$conn = null;
?>