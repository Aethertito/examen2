<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weapons Info</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container {
      font-family: Arial, helvetica, arial, sans-serif;
      color: white;
    }
    .carousel-container {
      position: relative;
      max-width: 600px;
      margin: auto;
    }
    .carousel-slide {
      display: none;
    }
    .active {
      display: block;
    }
    .carousel-prev, .carousel-next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      width: auto;
      padding: 16px;
      margin-top: -22px;
      color: white;
      font-weight: bold;
      font-size: 18px;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0;
      user-select: none;
    }
    .carousel-next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }
    .carousel-prev {
      left: 0;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0);
      background-color: rgba(0,0,0,0.9);
    }

    .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
    }

    .modal-content {
      -webkit-animation-name: zoom;
      -webkit-animation-duration: 0.6s;
      animation-name: zoom;
      animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
      from {-webkit-transform:scale(0)} 
      to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
      from {transform:scale(0)} 
      to {transform:scale(1)}
    }
  </style>
</head>
<body>

<div class="navbar">
<a href="../index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons8.php" class="navbar-link">Weapons</a>
    <a href="../basics/maps.php" class="navbar-link">Maps</a>
    <a href="../seasons/season.php" class="navbar-link">Seasons</a>
    <a href="weaponsSkin.php" class="navbar-link">Skins</a>
    <a href="../basics/abilities.php" class="navbar-link">Abilities</a>
  </div>
</div>

<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <video class="modal-content" id="videoHere"></video>
  <button id="closeVideoBtn">Cerrar video</button>
</div>

<div class="container">
<?php
if (isset($_GET['uuid']) && !empty($_GET['uuid'])) {
    $uuid = $_GET['uuid'];
    $url = "https://valorant-api.com/v1/weapons/$uuid";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['data']) && !empty($data['data'])) {
        $weaponUuid = $data['data']['uuid'];
        $weaponName = $data['data']['displayName'];
        $weaponIcon = $data['data']['displayIcon'];
        echo "<h1>$weaponName skins</h1>";

        if (isset($data['data']['skins']) && is_array($data['data']['skins'])) {
            foreach ($data['data']['skins'] as $index => $skin) {
                if ($skin['contentTierUuid'] != null && $skin['displayIcon'] != null) {
                    echo "<h2>{$skin['displayName']}</h2>";
                    echo "<div class='carousel-container' id='carousel-container-{$index}'>";
                    echo "<div class='carousel-slide active'><img src='{$skin['displayIcon']}' alt='{$skin['displayName']}'></div>";
                    
                    if (isset($skin['chromas']) && is_array($skin['chromas'])) {
                        foreach ($skin['chromas'] as $chroma) {
                            if (isset($chroma['fullRender'])) {
                                echo "<div class='carousel-slide'><img src='{$chroma['fullRender']}' alt='{$skin['displayName']} Chroma'></div>";
                            }
                        }
                    }
                    if (isset($skin['levels']) && is_array($skin['levels'])) {
                      foreach ($skin['levels'] as $level) {
                          if (isset($level['streamedVideo'])) {
                              echo "<button onclick='showVideo(\"{$level['streamedVideo']}\", {$index})'>{$level['displayName']}</button>";
                          }
                      }
                  }
                  
                    echo "<a class='carousel-prev' onclick='plusSlides(-1, {$index})'>&#10094;</a>";
                    echo "<a class='carousel-next' onclick='plusSlides(1, {$index})'>&#10095;</a>";
                    echo "</div>";
                    echo "<br>";
                }
            }
        } else {
            echo "No se encontraron skins para este arma.";
        }
    } else {
        echo "Información del arma no disponible.";
    }
} else {
    echo "UUID del arma no proporcionado.";
}
?>
</div>

<script>
let slideIndex = {};

function plusSlides(n, carouselIndex) {
    let carousel = document.getElementById('carousel-container-' + carouselIndex);
    let slides = carousel.getElementsByClassName("carousel-slide");
    slideIndex[carouselIndex] = slideIndex[carouselIndex] + n || 1;

    if (slideIndex[carouselIndex] > slides.length) { slideIndex[carouselIndex] = 1 }
    if (slideIndex[carouselIndex] < 1) { slideIndex[carouselIndex] = slides.length }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slides[slideIndex[carouselIndex] - 1].style.display = "block";  
}

document.addEventListener('DOMContentLoaded', (event) => {
    let carousels = document.getElementsByClassName('carousel-container');
    for (let i = 0; i < carousels.length; i++) {
        slideIndex[i] = 1;
        showSlides(1, i); 
    }
});

function showSlides(n, carouselIndex) {
    let carousel = document.getElementById('carousel-container-' + carouselIndex);
    let slides = carousel.getElementsByClassName("carousel-slide");
    slides[n - 1].style.display = "block";  
}

function showVideo(streamedVideoUrl, carouselIndex) {
    let modal = document.getElementById("myModal");
    let modalVideo = document.getElementById("videoHere");
    modal.style.display = "block";
    modalVideo.src = streamedVideoUrl;
    modalVideo.load();
    modalVideo.play();
}

let span = document.getElementsByClassName("close")[0];

span.onclick = function() {
    modal.style.display = "none";
}

let modal = document.getElementById("myModal");
let modalVideo = document.getElementById("videoHere");
let closeVideoBtn = document.getElementById("closeVideoBtn");

function closeModal() {
    modal.style.display = "none";
    modalVideo.pause(); 
}

closeVideoBtn.addEventListener("click", closeModal);

</script>
</body>
</html>
