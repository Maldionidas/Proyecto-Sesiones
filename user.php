<?php

@include 'crud/conn.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>User</title>
    <link rel='stylesheet' href='style/style.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
    .content {
        position: relative;
        overflow: hidden;
    }

    .carousel {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .carousel-inner {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .carousel-inner img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    .carousel-inner .active {
        display: block;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-body-tertiary ">
        <div class="container-fluid">
            <a class="navbar-brand h1">Maldo INN</a>
            <a class="navbar-brand text-body-secondary">Bienvenido <?php echo $_SESSION['user_name'] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../user.php">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class='container'>
        <div class="carousel">
            <div class="carousel-inner">
                <img src="img/img6.jpg" alt="Image 1" class="active">
                <img src="img/img7.jpg" alt="Image 2">
                <img src="img/img8.jpg" alt="Image 3">
            </div>
        </div>

        <div class='content'>
            <h3>Hola, <span>usuario</span></h3>
            <h1>bienvenido <span><?php echo $_SESSION['user_name'] ?></span></h1>
            <p>Reservar habitaciones</p>
            <a href='reserva/reservaciones.php' class='btn'>Reservar</a>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        setInterval(function() {
            var $active = $('.carousel-inner .active');
            var $next = $active.next().length ? $active.next() : $('.carousel-inner img').first();
            $active.removeClass('active');
            $next.addClass('active');
        }, 2000);
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>