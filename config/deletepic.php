<?php
session_start();
include('setup.php');

if (isset($_POST['deletepic']))
{
    $pic_id = $_GET['pic_id'];
    $populate = $conn ->prepare("DELETE FROM $picturetable WHERE pictureID = :pic_id");
    $populate->bindParam(':pic_id', $pic_id);
    $populate->execute();
    header('Location: http://127.0.0.1:8080/Camagru/config/timeline.php'); 
}
$conn = null;
?>