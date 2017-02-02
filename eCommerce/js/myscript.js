<!DOCTYPE>

<html>
    <head>
        <title></title>
        <script language="javascript" type="text/javascript">
            var images = ['phone2.jpg ','lenovo3.jpg','fridge1.jpg','fridge3.jpg','head.jpg'];
            var curPic = -1;
            //preload the images for smooth animation
            var imgO = new Array();
            for(i=0; i < images.length; i++) {
                imgO[i] = new Image();
                imgO[i].src = images[i];
            }

            function swapImage() {
                curPic = (++curPic > images.length-1)? 0 : curPic;
                imgCont.src = imgO[curPic].src;
                setTimeout(swapImage,2000);
            }

            window.onload=function() {
                imgCont = document.getElementById('imgBanner');
                swapImage();
            }
        </script>

    </head>
    <body>

        <div>
            <img id="imgBanner" src="" alt="" />
        </div>

    </body>
</html>
