<?php
//maybe include database thingies, not sure
session_start();

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

