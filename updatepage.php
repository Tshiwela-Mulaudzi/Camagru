<?php
session_start();
$usernamefromsession = $_SESSION['sessionUsername'];
echo "This?<br>";
echo $usernamefromsession."<br><br>";
?>  
<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <meta name = "viewport" content = "height = device-height, initial-scale = 1.0">
    <title> Camagru | Update </title>
    <link href="./form/main.css" rel="stylesheet">
    <h1>Please note that after updating your profile, you will be requested to log in again</h1>
</head>
<body>
<div>
	<form class="form" id="signup" action="./form/update.php" method="POST" >
    <div class="notice"></div>
        <h2><input class="inp" type="text" id="username" name="username" placeholder="Username" required></h2>
	    <h2><input class="inp" type="email" id="email" name="email" placeholder="E-Mail address" required></h2>
        <input class = "allButs" id = "update" type = "Submit" value = "update">
    </form>
</div>
</body>
</html>