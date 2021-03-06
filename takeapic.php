
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./config/main.css" rel="stylesheet">
    <title>Take picture</title>
    <a href="http://127.0.0.1:8080/Camagru/updatepage.php">Update profile</a>
    <form action = '../logout.php' method = 'POST'>
		<input class = "allButs" id = "logout" type = "Submit" value = "Logout">
	</form>
</head>
<body>
    <div class = "navbar">
        <h1> Take a picture/ video</h1>
    </div>
    <div class = "top">
        <video id = "video">Im not sure what this message is for...</video>
        <button id = "photobutton" class  = "allButs"> Take picture </button>
        <select id = "photofilter" class = "select">
           <option value = "none"> No filter</option>
           <option value = "grayscale(100%"> Grayscale</option>
           <option value = "blur(10px)"> blur</option>
           <option value = "contrast(200%)"> contrast</option>
        </select>
        <button id = "clearbutton" class = "allButs"> Clear</button>
        <canvas id = "canvas"> </canvas>
    </div>
    <div class = "bottom">
        <div id = "photos">
         <form action = "./config/takepic.php" id = "postpicform" method = "POST">
            <input type="hidden" name="nameoftheinput" id="idofinput">
            <div>
                <button type="submit" name = "cancel" value = "cancel" disabled >Cancel</button>
                <button type="submit" name = "postpic" value = "postpic" disabled >Post</button>
            </div>
        </form>
    </div> 
     <script src = "takepic.js"></script>
</body>
</html> 
