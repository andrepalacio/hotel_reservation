<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <style>
        
        img {
            width: 80%;
            height: 500px;
        }
    </style>
    <link rel="stylesheet" href="admin/css/style.css">
</head>
<body>
    <?php 
        include_once 'header.html';
    ?>
    <main>
        <h2>Bienvenido</h2>
        
        <!-- Slideshow container -->
        <div class="slideshow-container">

        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
          <img src="img/hotel-bell.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
          <img src="img/open_hotel.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
          <img src="img/lobby.jpg" style="width:100%">
        </div>

        <!-- Next and previous buttons 
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>-->

        <!-- The dots/circles 
        <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        </div>-->
    </main>
    <?php
        include_once 'footer.html';
    ?>
    <script src="admin/include/index.js"></script>
</body>
</html>