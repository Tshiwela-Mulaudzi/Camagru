<?php
include('credentials.php');
session_start();

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

try
{
    $populate = $conn->prepare("SELECT * pic FROM $picturetable ORDER BY timeposted ASC"); 
    $populate->execute();

    $results = $populate->fetchAll();
    $resultscounter = count($results);
    if ($resultscounter > 0)
    {
        $i = $resultscounter - 1;
        while ($i >= 0)
        {
            //if i use foreach, will it open multiple timelines?
            header('Location: http://127.0.0.1:8080/Camagru/timeline.html'); 
            $i--;
        }
    }
    else
    {
        echo "Please activate your account first<br>";
    }
}
catch(PDOException $e)
{
    echo "6<br>";
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

