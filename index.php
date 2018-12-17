<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <meta name = "viewport" content = "height = device-height, initial-scale = 1.0">
    <title> Camagru | Log in </title>
    <link href="./form/main.css" rel="stylesheet">
</head>
<body>
<div>
    <form class="form" id="login" action="./form/signinform.php" method="POST" >
    <div class="notice">		
		</div>
        <input class="inp" type="text" id="username" name="username" placeholder="Username" required><br><br>
	    <input class="inp" type="password" id="password" name="password" placeholder="Password"required><br>
        </div>
        <input class = "allButs" id = "registration" type = "Submit" value = "Log in"><br><br>
        <a href="http://127.0.0.1:8080/Camagru/reset.html">Forgot Password</a><br><br>
    <a href = "http://127.0.0.1:8080/Camagru/signup.php">Dont have an account? Register here</a>

    </form>
</div>
</body>
</html>