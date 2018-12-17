<?php 
session_start();
include('setup.php');

if (isset($_POST['like']))
{
    $picID = $_GET['pic_id']; // get  id of that pic from html
    $row;
    
try
{
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

    header("location: http://127.0.0.1:8080/Camagru/config/timeline.php");

    
}