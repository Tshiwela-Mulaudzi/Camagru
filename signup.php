<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <meta name = "viewport" content = "height = device-height, initial-scale = 1.0">
    <title> Camagru | Registartion </title>
</head>
<body>
<div>
	<form class="form" id="signup" action="./form/registration.php" method="POST" >
    <div class="notice">
				
			</div>
        <input class="inp" type="text" id="username" name="username" placeholder="Username" required>
	    <input class="inp" type="email" id="email" name="email" placeholder="E-Mail address" required>
	    <input class="inp" type="password" id="password" name="password" placeholder="Password"required>
	    <input class="inp" type="password" id="password_c" name="password_c" placeholder="Confirm Password" required>
        <div id = "Password_checker">
            <!--<div class = "figure" id = "length">At least 8 characters</div>
            //<div class = "figure" id = "confirm"> Confirm your password</div>-->
        </div>
        <input class = "allButs" id = "registration" type = "Submit" value = "Register">
    </form>
</div>
<script>
//check stuff
</script>
</body>
</html>