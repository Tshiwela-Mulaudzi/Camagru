
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
            var sticker = document.getElementById("photofilter");

            console.log("This is it " + sticker + '\n');
            console.log("This is it " + video + '\n');
            //search if there is a height and width
            if (width && height)
            {
                canvas.width = width;
                canvas.height = height;
                //Draw image of the video on canvas
                context.drawImage(video, 0, 0, width, height);
                context.drawImage(sticker, 150, 0, 200, 200);
                //create an image from canvas
                const imgurl = canvas.toDataURL('image/png');
                //create image element
                const capture = document.createElement('img');
                //set image src
                capture.setAttribute('src', imgurl);

                var imageobj1 = new Image();
                var imageobj2 = new Image();
                imageobj1 = capture;

                imageobj1.onload = function() {
                    context.drawImage(imageobj1, 0, 0, width, height);
                    imageobj2 = (sticker);
                    imageobj2.onload = function() {
                        context.drawImage(imageobj2, 0, 0, width, height);
                        var img = context.toDataURL("image/png");
                    }
                }

               
                //set image filter
                img.style.filter = filter;
                //append image to photo
                photos.appendChild(img);

            }
        }