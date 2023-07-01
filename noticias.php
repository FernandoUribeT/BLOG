<?php include("template/cabeza.php") ?>

<style>
    t {
        font-size: 21px;
    }
</style>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles-footer-pags.css">
    <style>
        .btn-notis-left {
            margin-left: 5px !important;
        }

        .btn-video-right {
            margin-left: 5px !important;
        }

        .btn-notis-hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div id="carouselE" class="carousel slide carusel-noticias" data-bs-ride="carousel">
        <div class="carousel-indicators">
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/imagen-prueba-noticias.webp" class="d-block w-100" alt="">
                <div class="carousel-caption">
                    <h5>Noticias</h5>
                </div>
            </div>
        </div>
    </div>
    <section class="noticias section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center text-white pb-5">
                        <h2>Noticias</h2>
                        <p>¡Hola a todos los amantes del cine! Bienvenidos a nuestra sección de noticias de la industria cinematográfica. En esta sección, encontrarán las últimas novedades sobre películas, actores, directores y todo lo relacionado con el mundo del cine.
                            <br>
                            Desde rumores de casting hasta avances exclusivos de películas que pronto llegarán a los cines, nuestro equipo de redactores expertos en cine les traerá la información más relevante y actualizada.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="acerca section-padding">
        <div class="container">
            <div class="row">
                <?php
                include("administrador/config/bd.php");
                $sentenciaSQL = $conexion->prepare("SELECT * FROM noticias ORDER by id desc LIMIT 21;");
                $sentenciaSQL->execute();
                $listapublicaciones = $sentenciaSQL->fetchAll();
                ?>

                <?php foreach ($listapublicaciones as $publicaciones) {  ?>
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="card-text-light text-center bg-dark pb-2 publis-noticias-dk publis-noticias">
                            <div class="card-body text-white">
                                <div class="img-area mb-4">
                                    <img src="./assets/<?php echo $publicaciones['imagen']; ?>" class="img-fluid" width="450" alt="">
                                </div>
                                <h3><?php echo $publicaciones['titulo']; ?></h3>
                                <p style="line-height: 1.7;" class="lead">
                                    <span><?php echo $publicaciones['comentario']; ?></span>
                                </p>
                                <?php if (!empty($row["username"])) { ?>
                                    <a href="<?php echo $publicaciones['noticia']; ?>" class="boton btn btn-primary mt-3 transUp btn-notis<?php if (!empty($publicaciones["video"])) { echo ' btn-notis-hidden'; } ?>" target="_blank">Ver noticia</a>

                                    <?php if (!empty($publicaciones["video"])) { ?>
                                        <a href="<?php echo $publicaciones['video']; ?>" class="boton btn btn-primary mt-3 transUp btn-video" target="_blank">Ver video</a>
                                        <a href="<?php echo $publicaciones['noticia']; ?>" class="boton btn btn-primary mt-3 transUp btn-notis-agregado" target="_blank">Ver noticia</a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <a class="miBoton btn btn-primary mt-3" target="_blank">Ver Noticia</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php include("template/pie.php") ?>

    <script>
        window.addEventListener('load', function() {
            var noticiasBtn = document.querySelectorAll('.btn-notis');
            var videoBtn = document.querySelectorAll('.btn-video');

            function adjustButtons() {
                for (var i = 0; i < videoBtn.length; i++) {
                    if (videoBtn[i].getAttribute('href') && noticiasBtn[i]) {
                        noticiasBtn[i].classList.add('btn-notis-left');
                        videoBtn[i].classList.add('btn-video-right');
                    } else {
                        noticiasBtn[i].classList.remove('btn-notis-left');
                        videoBtn[i].classList.remove('btn-video-right');
                    }
                }
            }

            adjustButtons();

            var btnVideo = document.querySelectorAll('.btn-video');
            for (var i = 0; i < btnVideo.length; i++) {
                btnVideo[i].addEventListener('click', adjustButtons);
            }
        });
    </script>
</body>
</html>
