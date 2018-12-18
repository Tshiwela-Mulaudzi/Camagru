<?php session_start(); 
ini_set('display_errors', 1); 

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "camagru";
$tablename = "users";
$picturetable = "gallery";
$likestable = "likes";

try
{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "".$e->getMessage() . "<br>";
}
?>