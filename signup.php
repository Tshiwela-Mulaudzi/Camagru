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
        <h2><input class="inp" type="text" id="username" name="username" placeholder="Username" required></h2>
	    <h2><input class="inp" type="email" id="email" name="email" placeholder="E-Mail address" required></h2>
	    <h2><input class="inp" type="password" id="password" name="password" placeholder="Password"required></h2>
	    <h2><input class="inp" type="password" id="password2" name="password2" placeholder="Confirm Password" required></h2>
        <div id = "Password_checker">
            <!--<div class = "figure" id = "length">At least 8 characters</div>
            //<div class = "figure" id = "confirm"> Confirm your password</div>-->
        </div>
        <input class = "allButs" id = "registration" type = "Submit" value = "Register" disabled>
    </form>
</div>
<script>
//check stuff
</script>
</body>
</html>