<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css"
    />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    /> 
    <link rel="stylesheet" href="./css/lightslider.css" />
    <link rel="stylesheet" href="./css/prettify.css" />
    <link rel="stylesheet" href="./css/lightgallery.min.css" />
    <title>A</title>
  </head>
  <body class=" "> 
  <ul id="imageGallery">
  <li data-thumb="./upload/612a30aa55e96aston-ma.jpg" data-src="./upload/612a30aa55e96aston-ma.jpg">
    <img width="100%" src="./upload/612a30aa55e96aston-ma.jpg" />
  </li> 
  <li data-thumb="./upload/612a30aa55e96aston-ma.jpg" data-src="./upload/612a30aa55e96aston-ma.jpg">
    <img width="100%" src="./upload/612a30aa55e96aston-ma.jpg" />
  </li> 
  <li data-thumb="./upload/612a30aa55e96aston-ma.jpg" data-src="./upload/612a30aa55e96aston-ma.jpg">
    <img width="100%" src="./upload/612a30aa55e96aston-ma.jpg" />
  </li> 
  <li data-thumb="./upload/612a30aa55e96aston-ma.jpg" data-src="./upload/612a30aa55e96aston-ma.jpg">
    <img width="100%" src="./upload/612a30aa55e96aston-ma.jpg" />
  </li> 
</ul>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="../node_modules/lightgallery/js/lightgallery.umd.js"></script>
    <!-- Or use the minified version -->
    <script src="../node_modules/lightgallery/js/lightgallery.min.js"></script>

    <!-- lightgallery plugins -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../node_modules/lightgallery/js/plugins/lg-thumbnail.umd.js"></script>
    <script src="../node_modules/lightgallery/js/plugins/lg-zoom.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
    <script src="./js/lightgallery-all.min.js"></script> 
    <script src="./js/prettify.js"></script> 
    <script src="./js/lightslider.js"></script> 
   <script> 
  $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:7,
        slideMargin:10,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <!-- https://cdnjs.com/libraries/popper.js/2.5.4 -->
    <!-- <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.min.js"
    ></script> -->

    <!-- More: https://getbootstrap.com/docs/5.0/getting-started/introduction/ -->
  </body>
</html>
