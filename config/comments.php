<?php 
session_start();
include('setup.php');

if (!isset($_POST['comment']))
{
    if (isset($_POST['sendcomment']))
    {
        $comment = $_POST["comment"];
        $pic_id = $_GET['pic_id'];
        $query = $conn->prepare("INSERT INTO `comments` (pic_id,comment) VALUES ($pic_id,:comment)");
        $query->bindParam(":comment", $comment, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert ('you have commented')</script>";
        header ("refresh: 0.5; url=./timeline.php"); 
    }
}
else
{
    echo "<script>alert ('Comment box cannot be left empty when you comment.')</script>";
    header ("refresh: 0.5; url=./timeline.php"); 
}

?>