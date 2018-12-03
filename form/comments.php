<?php 
session_start();
include('credentials.php');

$said = $_SESSION['username_']." said : ".$_POST['send'];
        
if (isset($_POST['send']) && $_POST['send'] == 'send')
{
    $comment = $_POST["comment"];
    $picId   = $_POST["pic-id"];

    $qry = "SELECT * FROM gallery";
    $CommentResults= $conn->query($qry);
    while($data = $CommentResults->fetch())
        {
            if($data['pic-id'] === $picId)
            {
                if (!empty($data['comments']))
                {
                    $comArray = array();
                    $comArray = unserialize($row['COMMENTS']);
                    array_push($comArray,$said);
                    $finalcom = serialize($comArray);
                }
                else
                {
                    $comArray = array($com);
                    $finalcom = serialize($comArray);
                }

                $sql = "UPDATE gallery SET COMMENTS='$finalcom' WHERE pictureID ='$picId'";
                $conn->exec($sql);
                $mai = "User ".$_SESSION['username_']." commented on your photo";
                $email = $row['EMAIL'];
                mail($email,"CAMAGRU COMMENT", $mai);
                header("location: gallery.php");
                break ;
            }
        }

   

}

?>