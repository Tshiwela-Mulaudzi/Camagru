<!DOCTYPE html>
<html>
<head>
    <meta name = "viewpoint" content="width = device-width, initial-scale= 1.0 ">
    <meta name = "viewpoint" content = "height = device-height, initial-scale = 1.0">
    <title> Camagru | Resset password </title> 
<head>
<body>
    <div>
        <form class = "form" id = "reset" action = "reset.php" method = "POST">
        <input class= "input" id = "Username" type = " text" name = "Username" placeholder="Username">
        <input class = "allbuts" id = "Reset" type = "submit" value = "Reset" disabled>
        <div class = "notice" id = "resetnoticeDiv">
            <?php
            $login = $_POST['Username'];
            if ($_login)
            {
            //i need to find that username
            $Found_username = $conn -> query ("SELECT USERNAME FROM Users");
            $Found = false;
            foreach ($Found_username as $User_username)
            {
                if ($user_username['USERNAME'] == $login)
                {
                   $found = true;
                   $find_active = $conn -> query ("SELECT ACTIVATED FROM Users WHERE USERNAME LIKE '$login''");
                   foreach ($find_active as $active_user)
                   {
                    if ($active_user['ACTIVATED'] != 'NULL')
                    {
                        $user_email = $conn -> query ("SELECT EMAIL FROM Users WHERE USERNAME LIKE '$login'");
                        foreach ($user_email as $address)
                        {
                            $email = $address['EMAIL'];
                            $subject_line = " Reset camagru password";
                            $message_text = "click here to reset //put a link";
                            $head = 'From:reset@camagru' . "\r\n";
                            maail($email, $subject_line, $message_text, $header);
                        }
                        echo "Password reset link sent to email associated with this account";
                    }
                    echo "No account found";
                   }

                }
            }
            if ($found == false)
            {
                echo "User not found";
            }
            }
            ?>
			</div>
    </div>        
<body>
</html>