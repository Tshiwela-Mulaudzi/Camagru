<?php 
session_start();
include('credentials.php');


if (isset($_POST['like']))
{
    //$pic_id = $_GET['pic_id'];
    $picID = $_GET['pic_id']; // get  id of that pic from html

    $row;
    
try
{
    echo "<br>";
    $query = $conn->prepare("SELECT likes FROM gallery WHERE pictureID=:picID");

    $query->bindParam(":picID", $picID, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetchColumn();
    print_r($row);
}
catch(PDOException $e)
{
	echo "Failed to post image".$e->getMessage() . "<br>";
}
    print($row);
    $likes = $row['likes'];
    $likes++;
    $query = $conn->prepare("UPDATE gallery SET likes=:likes WHERE pictureID=:picID");
    $query->bindParam(":likes", $likes, PDO::PARAM_STR);
    $query->bindParam(":picID", $picID, PDO::PARAM_STR);
    $query->execute();

    header("location: http://127.0.0.1:8080/Camagru/form/timeline.php");

    
}