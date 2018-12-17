<?php
$email = $_GET['email'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta name = "viewpoint" content = "width = device-width, initial-scale = 1.0">
    <meta name = "viewpoint" content = "height = device-height, initial-scale = 1.0">
	<title> Camagru | New Password </title>
	<link href="./form/main.css" rel="stylesheet">
</head>
<body>
<div>
	<form class="form" id="newpassword" action="form/newpassword.php" method="POST">
	<?php
		echo "<input type = 'hidden' class='inp' type='password' id='email' name='email' value = '$email'> " ?>
		<input class="inp" type="password" id="oldpass" name="oldpass" placeholder="Type Password">
		<input class="inp" type="password" id="newpass" name="newpass" placeholder="Confirm Password">
		<input class="allButs" id="resetBut" type="submit" value="Reset">
	</form>
</div>
</body>
</html>