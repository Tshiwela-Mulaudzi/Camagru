<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./form/main.css" rel="stylesheet">
    <title>Take picture</title>
</head>
<body>
<div id = "logout"><a href = "http://127.0.0.1:8080/Camagru/index0.php">Log out</a></div>
    <div class = "navbar">
        <h2> Camagru</h2>
    </div>
    <div class = "top">
        <video id = "video">Im not sure what this message is for...</video>
        <button id = "photobutton" class  = "allButs" onclick="video.play()"> Take picture </button>
        <select id = "photofilter">
           <option value = "none" id = "none"> No filter</option>
           <option value = "grayscale(100%" id = "Grayscale"> Grayscale</option>
           <option value = "blur(10px)" id = "blur"> blur</option>
           <option value = "contrast(200%)"> contrast</option>
           <option value = "contrast(200%)"> contrast</option>
           <option value = "./images/dog.png"> Christmas frame</option>
           <option value = "./images/christmas.png"> Cute dog with</option>
           <option value = "./images/flowers.png"> Flowers frame</option>
        </select>
        <button id = "clearButton" class = "allButs"> Clear</button>
        <canvas id = "canvas"></canvas>
    </div>
    <div id = "upload">
        <input id = "upload" type = "file" accept = "image/*"/>
    </div>
    <div class = "bottom">
        <div id = "photos">
            <form action = "" method = "POST">
                <img id = "picture" src ="" style = "width:100%; max-width:300px">

                <!-- The modal he said--> 
                <div id = "themodal" class = "modal">
                    <span class = "close" > &times; </span>
                    <img class = "model-content" id = "img01">
                    <div id = "caption"></div>
                    <div>
                        <a href = "./takepic.php">
                        <button type = "submit">Cancel</button></a>
                        <button type = "submit"> Save</button>
                    <div>
                </div>
            </form>
        </div>
    </div>

    <script>
        //global var
        let width = 500,
        height = 0,
        filter = 'none',
        streaming = false;

        //DOM elements
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photos = document.getElementById('photos');
        const photobutton = document.getElementById('photobutton');
        const clearbutton = document.getElementById('clearButton');
        const photoFilter = document.getElementById('photofilter');

        //get media stream
        navigator.mediaDevices.getUserMedia({video:true, audio:false})
        .then (function(stream)
        {
        //link to the video
        video.srcObject = stream;

        //play video
        //video.play();
        })
        .catch(function(err)
        {
            console.log(`Error: ${err}`);
        });

        //play when ready
        video.addEventListener('canplay', function(e)
        {
            if (!streaming)
            {
                //set video / canvas height
                height = video.videoHeight / (video.videoWidth / width);
                video.setAttribute('width', width);
                video.setAttribute('height', height);
                canvas.setAttribute('width', width);
                canvas.setAttribute('height', height);

                streaming = true;
            }
        }, false);
        
        //photobutton event
        photobutton.addEventListener('click', function(e)
        {
            takepicture();

            e.preventDefault();
        }, false);


        //Filter event
        photoFilter.addEventListener('change', function(e)
        {
            //set filter to chosen option
            filter = e.target.value;
            //set filter to video
            video.style.filter = filter;
            
            e.preventDefault();

        });

        //clearevent
        clearbutton.addEventListener('click', function(e)
        {
            //clear photo
            photos.innerHTML = '';

            //change filter back to normal
            filter = 'none';

            //set video filter
            video.style.filter = filter;
            
            //resety filter, back to none
            photoFilter.selectedIndex = 0;
        });

        //take pic from canvas
        function takepicture()
        {
            //create canvas
            const context = canvas.getContext('2d');

            //search if there is a height and width
            if (width && height)
            {
                canvas.width = width;
                canvas.height = height;

                //Draw image of the video on canvas
                context.drawImage(video, 0, 0, width, height);

                //create an image from canvas
                const imgurl = canvas.toDataURL('image/png');
                //console.log(imageurl);

                //create image element
                const img = document.createElement('img');

                //set image src
                img.setAttribute('src', imgurl);

                //set image filter
                img.style.filter = filter;

                //append image to photo
                //photos.appendChild(img);

                var imageObj1 = new Image();
            }

                var pictur = document.getElementById('picture');
                var modal = document.getElementById('themodal');
                var modalImage = document.getElementById("img01");
                var caption = document.getElementById("caption");
                
                pictur.addEventListener('load', function()
                {
                    video.style.display = "none";
                    modal.style.dispaly = "block";
                    modalimage.src = this.src;
                    caption.innerHTML = this.alt;
                });

                pictur = document.getElementById('picture').src = imageobj1.src;

                //the span elemnt to close, get it
                var span = document.getElementByClassName("close")[0];

                //that cross to close when i click
                span.onclick = function()
                {
                    window.location.replace('./takeapic.php');
                    modal.style.display = "none";
                }

        }

    </script>
</body>
</html>