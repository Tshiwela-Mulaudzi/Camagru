<!DOCTYPE html>
<html>
<head>
    <meta name = "viewpoint" content = "width = device-width, initial-scale = 1.0">
    <meta name = "viewpoint" content = "height = device-height, initial-scale = 1.0">
    <title> Camagru | New Password </title>
</head>
<body>
<div>
		<form class="form" id="newpassword" action="newpassword.php" method="POST">
			<input class="inp" type="password" id="password" name="password" placeholder="Password">
			<input class="inp" type="password" id="password_c" name="password_c" placeholder="Confirm Password">
			<input class="allButs" id="resetBut" type="submit" value="Reset" disabled>
			
			/*<div id="pass_checker">
				<div class="figure" id="length">Length: 6 more</div>    
				<div class="figure" id="sc">Special Character/Number</div>
				<div class="figure" id="conf">Confirm Password</div>
			</div>*/
			<div class="notice" id="resetNoticeDiv">
				<?php
				session_start();
				$get_hash = $_GET['reset'];
				$password = $_POST['password'];
				if (isset($get_hash) && !empty($get_hash))
					$_SESSION['resethash'] = $get_hash;
				else if (isset($password) && !empty($password))
				{
					$resethash = $_SESSION['resethash'];
					$_SESSION['resethash'] = "";
					unset($_SESSION['resethash']);
					$pass = hash("whirlpool", $password);
					
					//Check password conditions
					if ($passPass === false)
						echo 'Invalid Password';
					else
					{
						$update = $conn->prepare("UPDATE users SET PASSWORD=:PASSWORD WHERE ACTIVATED like '$resethash'");
						$update->bindParam(":PASSWORD", $pass);
						$update->execute();
						echo "Password Sucsesfully Updated";
						header("location:http://127.0.0.1:8080/index.php");
					}
				}
				?>
			</div>
		</form>
	</div>
	<script>
		//maybe check password maybe. 
	</script>

</body>
</html>