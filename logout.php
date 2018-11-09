<!DOCTYPE html>
<html>
//shoud i have a logout button?.
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
	$_SESSION['loggedin'] = false;
	$_SESSION['username'] = "";
	unset($_SESSION['loggedin']);
	unset($_SESSION['username']);
	session_unset();
	session_destroy;
	header("location:http://127.0.0.1:8080");
}
?>

</html>
