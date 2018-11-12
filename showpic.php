<html>
<head>
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <meta name = "viewport" content = "height=device-height, initial-scale = 1.0">
    <title>Camagru</title>
    <link href="./form/main.css" rel="stylesheet">
    is anything even showing?.
</head>
<body>
    <div id = "logout"><a href = "http://127.0.0.1:8080/Camagru/index0.php">Log out</a></div>
    <div id = "recent pictures">
        <video autoplay = "true" id = "vid"></video>
        <canvas id = "canv"> </canvas>
        <div id = "right">
            <div id = "toprow">
                <img class = "pics" id = "pic0" onclick="selectPic('pic0')" src="./images/image0"/>
                <img class = "pics" id = "pic1" onclick="selectPic('pic1')" src="./images/image1"/>
                <img class = "pics" id = "pic2" onclick="selectPic('pic2')" src="./images/image2"/>
                <img class = "pics" id = "pic3" onclick="selectPic('pic3')" src="./images/image3"/>
            </div>
             <div id = "bottomrow">
                <img class = "pics" id = "pic4" onclick="selectPic('pic4')" src="./images/image4"/>
                <img class = "pics" id = "pic5" onclick="selectPic('pic5')" src="./images/image5"/>
                <img class = "pics" id = "pic6" onclick="selectPic('pic6')" src="./images/image6"/>
                <img class = "pics" id = "pic7" onclick="selectPic('pic7')" src="./images/image7"/>
            </div>
        </div>
    </div>
    <div id = "belowpics">
        <button class = "allButs" id = "capture" onclick = "takepic()"> Take picture </button>
    </div>
    <div id = "belowcapture">
        <input id = "upload" type = "file" accept = "image/*" capture/>
    </div>
    <script>
        var picselected;

        var p0 = new image();
        p0.setAttribute('crossOrigin', 'anonymous');
        p0.src = "./images/image0";

        var p1 = new image();
        p1.setAttribute('crossOrigin', 'anonymous');
        p1.src = "./images/image1";

        var p2 = new image();
        p2.setAttribute('crossOrigin', 'anonymous');
        p2.src = "./images/image2";

        var p3 = new image();
        p3.setAttribute('crossOrigin', 'anonymous');
        p3.src = "./images/image3";

        var p4 = new image();
        p4.setAttribute('crossOrigin', 'anonymous');
        p4.src = "./images/image4";

        var p5 = new image();
        p5.setAttribute('crossOrigin', 'anonymous');
        p5.src = "./images/image5";

        var p6 = new image();
        p6.setAttribute('crossOrigin', 'anonymous');
        p6.src = "./images/image6";

        var p7 = new image();
        p7.setAttribute('crossOrigin', 'anonymous');
        p7.src = "./images/image7";

        function selectpicture(num)
        {
            console.log(num);
            var capture = document.getElementById('capture');
            var selected = document.getElementById(num);
            picselected = num;

            var pic0 = document.getElementById('pic0');
            var pic1 = document.getElementById('pic1');
            var pic2 = document.getElementById('pic2');
            var pic3 = document.getElementById('pic3');
            var pic4 = document.getElementById('pic4');
            var pic5 = document.getElementById('pic5');
            var pic6 = document.getElementById('pic6');
            var pic7 = document.getElementById('pic7');
            capture.disabled = false;

            pic0.style.border = 'none';
            pic1.style.border = 'none';
            pic2.style.border = 'none';
            pic3.style.border = 'none';
            pic4.style.border = 'none';
            pic5.style.border = 'none';
            pic6.style.border = 'none';
            pic6.style.border = 'none';
            selected.style.border = 'none';
        }
        var video = document.querySelector("#vid");
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia 
        || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
        var input = document.querySelector('input[type = file]');
        input.onchange = function ()
        {
            var file = input.files[0];
            upload(file);
            drawOnCanvas(file);
            displayAsImage(file);
        };

        function upload(file)
        {
            var form = new FordData();
            xhr = new XMLHttpRequest();
            form.append('image', file);
            xhr.open('post', 'server.php', true);
            xhr.send(form);
        }
        
        function drawOnCanvas(file)
        {
            var reader = new FileReader();
            reader.onload = function (e)
            {
                var dataURL = e.target.result,
                c = document.querySelector('canvas'),
                ctx = c.getContext('2d'),
                img = new Image();

                img.onload = function()
                {
                    c.width = img.width;
                    c.height = img.heigth;
                    ctx.drawImage(img, 0, 0);
                };

                img.src = dataURL;
            };
            reader.readAsDataURL(file);
        }

        function displayAsImage(file)
        {
            var imgURL = URL.createObjectURL(file)
            img = document.createElement('img');

            img.onload = function()
            {
                URL.revokeObjectURL(imgURL);
            }

            img.src = imgURL;
            document.body.appendChild(img);
        }
        var canvas = document.querySelector('canvas');
        var context = canvas.getContext('2d');
        var w, h, ratio;

        video.addEventListener('lodedmetadata', function()
        {
            ratio = video.videoWidth / video.videoHeight;
            w = video.videoWidth - 100;
            h = parseInt(w / ratio, 10);
            canvas.width = w;
            canvas.height = h;
        }false);

        function takepic()
        {
           context.clearRect(0, 0, 400, 360);
           context.drawImage(video, 0, 0, w, h);
           console.log("sigh");
           console.log(picselected);

            if (picselected == 'pic0')
                drawpic0();
            else if (picselected == 'pic1')
                drawpic1();
            else if (picselected == 'pic2'')
                drawpic2();
            else if (picselected == 'pic3')
                drawpic3();
            else if (picselected == 'pic4')
                drawpic4();
            else if (picselected == 'pic5')
                drawpic5();
            else if (picselected == 'pic6')
                drawpic6();
            else if (picselected == 'pic7')
                drawpic7();
        }

        if (navigator.getUserMedia)
        {
            navigator.getUserMedia({video: true}, handleVideo, videoError);
        }

        function handleVideo(stream)
        {
            video.src = window.URL.createObjectURL(stream);
        }

        function videoError(e)
        {
        }

        function drawpic0()
        {
            var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p0, 0, 0, c.width, c.height);
        }

        function drawpic1()
        {
            var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p1, 0, 0, c.width, c.height);
        }

        function drawpic2()
        {
            var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p2, 0, 0, c.width, c.height);
        }

        function drawpic3()
        {
            var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p3, 0, 0, c.width, c.height);
        }

        function drawpic4()
        {
            var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p4, 0, 0, c.width, c.height);
        }

        function drawpic5()
        {
            var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p5, 0, 0, c.width, c.height);
        }

        function drawpic6()
        {
            var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p6, 0, 0, c.width, c.height);
        }
        
        function drawpic7()
        {
            var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p7, 0, 0, c.width, c.height);
        }
        </sript>
</body>

</html>