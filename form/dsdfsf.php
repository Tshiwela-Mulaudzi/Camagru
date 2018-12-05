<?php
  session_start();
  require ("../config/database.php");
  if (!isset($_SESSION['id']))
  {
    echo "<script> alert ('Please login')</script>";
    header("refresh:0.01; url=../login.php");
  }
  else if (isset($_GET['id']))
  {
    $database = db_camagru();
    $user_id = $_GET['id'];
    $query = $database->prepare("SELECT likes FROM db_camagru.images WHERE id=:user_id");
    $query->bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetchColumn();
    $likes = $row['likes'];
    $query = $database->prepare("UPDATE db_camagru.images SET likes=$likes+1 WHERE id=:user_id");
    $query->bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $query->execute();
    header("location: ../template.php");
    }
 ?>