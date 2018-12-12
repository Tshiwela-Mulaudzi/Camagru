<?php
$login = $_POST['Username'];
if ($_login)
{
//need to find that username
$Found_username = $conn -> query ("SELECT USERNAME FROM users");
$Found = false;

//get the new password
$userPassword = $_POST['newpass'];

foreach ($Found_username as $User_username)
{
    if ($user_username['USERNAME'] == $login)
    {
       $found = true;
       $find_active = $conn -> query ("SELECT ACTIVATED FROM Users WHERE USERNAME LIKE '$login''");
       foreach ($find_active as $active_user)
       {
        if ($active_user['activated'] != '0')
        {
            $user_email = $conn -> query ("SELECT EMAIL FROM Users WHERE USERNAME LIKE '$login'");
            foreach ($user_email as $address)
            {
                $email = $address['email'];
                $subject_line = " Reset camagru password";
                $message_text = "Hey there!

                Please reset you password below i you requested to reset. Clicking the link below
                http://127.0.0.1:8080/Camagru/reset.html?email=$email 
            
                Thank you
                Camagru";
                $head = 'From:reset@camagru' . "\r\n";
                maail($email, $subject_line, $message_text, $header);


                //then update the database
                $populate = $conn->prepare("UPDATE $tablename  WHERE email == $email (userPassword)
											VALUES(:userPassword)");
	            $populate->bindParam(":userPassword", $userPassword);
	            $populate->execute();
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