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
</head>

<body>
   <div class='container'>

      <div class='content'>
         <h3>Hola, <span>usuario</span></h3>
         <h1>bienvenido <span><?php echo $_SESSION['user_name'] ?></span></h1>
         <p>Reservar habitaciones</p>
         <a href='reserva/reservaciones.php' class='btn'>Reservar</a>
         <a href='logout.php' class='btn'>Cerrar sesion</a>
      </div>

   </div>

</body>

</html>