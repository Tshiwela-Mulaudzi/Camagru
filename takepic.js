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

         var nameofthis = document.getElementById('idofinput').value = imgurl;
         console.log("checker text");

         console.log("Hi " + nameofthis);    
      }
 }
