<?php
session_start();
$usernamefromsession = $_SESSION['sessionUsername'];
?>  
<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <meta name = "viewport" content = "height = device-height, initial-scale = 1.0">
    <title> Camagru | Update </title>
    <link href="./config/main.css" rel="stylesheet">
    <h3>Please note that after updating your profile, you will be requested to log in again.</h3>
</head>
<body>
<div>
	<form class="form" id="signup" action="./config/update.php" method="POST" >
    <div class="notice"></div>
        <h2><input class="inp" type="text" id="username" name="username" placeholder="Username"></h2>
	    <h2><input class="inp" type="email" id="email" name="email" placeholder="E-Mail address"></h2><br>
        <h4>Below you can edit if you would like to change youe email preferences.</h4>
        <p>By ticking the email box, you are saying you would like us to stop sending you comments' emails.</p>
        <input type="checkbox" name="emailnot" value="emailnot"> Emails?<br><br>
        <h4>Below you can edit if you would like to delete your account, permanently.</h4>
        <p>Please be sure, be sure again. There is no getting your account back after this.</p>
        <input type="checkbox" name="delete" value="delete"> Delete account?<br><br><br>
        <input class = "allButs" id = "update" type = "Submit" value = "update">
    </form>
</div>
</body>
</html>