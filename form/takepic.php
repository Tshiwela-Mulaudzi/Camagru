<?php
if(isset($_POST['cancel']))
{
    header('Location: http://127.0.0.1:8080/Camagru/takeapic.html');   
}
else if (isset($_POST['postpic']))
{
    //header('Location: '); 
    //go to timeline
    $image = $_POST['that image tmp kha html'];
    if ($image)
    {
        $timeShared = 'CURRENT_TIMESTAMP';
        $usernmame = $_session['username'];
        try
        {
            $populate = $conn->prepare ("INSERT INTO" .$table."(username, image)
            VALUES (:username, :image)");
            $populate->bindParam(":username", $login);
            $populate->bindParam(":pic", $image);
            $populate->execute();
            echo "successfully uploaded<br>";
            //go to timeline page
        }
        catch(PDOException $e)
        {
            echo "Failed to post image".$e->getMessage() . "<br>";
        }
    }
}
?>