<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <meta name = "viewport" content = "height = device-height, initial-scale = 1.0">
    <title> Camagru | Registartion </title>
    <link href="./config/main.css" rel="stylesheet">
</head>
<body>
<div>
	<form class="form" id="signup" action="./config/registration.php" method="POST" >
    <div class="notice"></div>
        <p>Your username has to be longer than 3 characters <br><br>
        Your password should have at least 1 small character, <br>1 uppercase letter and 1 number. <br> Minimun password length should be 6 </p>
        <label for="username">Username</label> <input class="inp" type="text" id="username" name="username" placeholder="Username" required><br><br>
	    <label for="email">Email</label> <input class="inp" type="email" id="email" name="email" placeholder="E-Mail address" required><br><br>
        <label for="password">password</label> <input class="inp" type="password" id="password" name="password" placeholder="Password"required><br><br>
	    <label for="password2">re-type password</label> <input class="inp" type="password" id="password2" name="password2" placeholder="Confirm Password" required><br><br><br>
        <input class = "allButs" id = "registration" type = "Submit" value = "Register">
    </form>
</div>
</body>
</html>