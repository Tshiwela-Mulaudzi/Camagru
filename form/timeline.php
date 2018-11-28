<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./form/main.css" rel="stylesheet">
    <title>Camagru</title>
</head>
<body>

<?php
include('credentials.php');

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

try
{
    $populate = $conn->prepare("SELECT * FROM $picturetable"); 
    $populate->execute();
    $results = $populate->fetchAll();
    //print_r($results);
    $resultscounter = count($results);

    if ($resultscounter > 0)
    {
        $i = 0;
        while ($i < $resultscounter)
        { 
        echo "<div class = 'TopPics'>";
        echo "<div id = 'topdiv' class = 'card border-dark mb-3 post'>";
        //echo $results[$i]['pic'];
            echo "<img class = 'card-img-top' src =".$results[$i]['pic']." alt = ''>";
            echo "<aside class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<button type='button' class='btn btn-info'>Like</button>";
                echo "<span class='badge badge-primary badge-pill'></span>";
            echo "</aside>";
        echo "</div>";
        echo "<div class = 'content'>";
        echo " <p class = 'caption'></p>";
        echo " </div>";
        echo " <div class = 'comment-block'>";
        echo " <textarea class='txt_comment form-control' placeholder='Comment here..' rows='3'></textarea>";
        echo "<button type='button' class='btn btn-outline-primary'>Send</button>";
        echo "</div>";
        // <!-- </form> -->;
    
        //     echo "Does it display pictures?";
        //     //if i use foreach, will it open multiple timelines?
        //    header('Location: http://127.0.0.1:8080/Camagru/timeline.html'); 
            $i++;
        }
    }
    else
    {
        echo "Please activate your account first<br>";
    }
}
catch(PDOException $e)
{
    echo "Failed to post image".$e->getMessage() . "<br>";
}

$postedimage = file_get_contents($imgurl);
$likes = $arr['likes'];
$comments = $arr['comments'];

//likes and comments part
//for each picture thats will be gotten

//display that picture,
echo $upload['galleryid']; // how, bootstrap in timeline
echo $caption;

//likes, hopefully
for ($counter = 0; $counter < sizeof($likes); $counter++)
{
    if ($likes[$counter]['/* id of the pict*/'] == $_POST['/* id ya something*/'])
        {
            echo $likes[$counter]["likes this post."];
        }
}

//now, lets do comments
for ($counter = 0; $counter < sizeof($comments); $counter++)
{
    if ($likes[$counter]['/* id of the pict*/'] == $_POST['/* id ya something*/'])
        {
            echo $comments[$counter]["body"]. "\n\n";
        }
}

?>
</body>

