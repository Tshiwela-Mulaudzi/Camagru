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
    <div class = "navbar">
        <h2> Take a picture/ video</h2>
    </div>
    <div class = "top">
        <video id = "video">Im not sure what this message is for...</video>
        <button id = "photobutton" class  = "allButs"> Take picture </button>
        <select id = "photofilter">
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
        const clearbutton = document.getElementById('clearbutton');
        const photofilter = document.getElementById('photofilter');

        //get media stream
        navigator.mediaDevices.getUserMedia({video:true, audio:false})
        .then (function(stream)
        {
        //link to the video
        video.srcObject = stream;

        //play video
        video.play();
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
        photofilter.addEventListener('change', function(e)
        {
            //set filter to chosen option
            const filter = e.target.value;
            //set filter to video
            video.style.filter = filter;
            
            e.preventDefault();

        });

        //clearevent
        clearbutton.addEventListener('click', function(e)
        {
            //clear photo
            photos.innerHTML = '';

            //change filter back to nobne
            filter = 'none';

            //set video filter
            video.style.filter = filter;
            
            //resety filter, back to none
            photofilter.selectedIndex = 0;
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


                //append image to photoID
                photos.appendChild(img);

            }
        }

    </script>
</body>
</html>