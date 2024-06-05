<?php

@include 'crud/conn.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
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
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-md pd-3 mt-5 ">
        <?php
        include "../crud/conn.php";
        //include "rsvControlador.php";
        $llamar = $conn->query("select * from `habitaciones`");

        $inc = 0;
        while ($datos = $llamar->fetch_object()) {
            $inc = $inc + 1;
            ?>

            <div class="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?= $inc ?>" aria-expanded="true" aria-controls="collapse<?= $inc ?>">
                            Habitacion <?= $datos->id ?>
                            <span class="badge text-bg-success"> Precio $<?= $datos->precio ?></span>
                        </button>

                    </h2>
                    <div id="collapse<?= $inc ?>" class="accordion-collapse collapse ">
                        <form method="post">
                            <div class="accordion-body input-group">
                                <span class="input-group-text">Fecha llega y salida</span>

                                <input type="date" class="form-control" name="ingreso">
                                <input type="date" aria-label="Last name" class="form-control" name="salida">
                                <input type="hidden" class="form-control" name="id"  value="<?= $datos->id ?>">
                                <button class="btn btn-outline-secondary" name="reservar" >RESERVAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php 
        //$idHabitacion = ;
        if (isset($_POST['reservar'])) {
            if (!empty($_POST['ingreso'] and !empty($_POST['salida']))) {
                $finicio = $_POST['ingreso'];
                $fsalida = $_POST['salida'];
                $id = $_POST['id'];
                header('location:compra.php?finicio='. $finicio.'&fsalida='. $fsalida.'&idhab='.$id);
            }else{
                echo "Fecha vacia";
            }
            
        }}
        
        ?>
    </div>
    <script>
    function validateForm() {
        const fechaIngreso = document.getElementById('fechaIngreso').value;
        const fechaSalida = document.getElementById('fechaSalida').value;

        if (!fechaIngreso) {
            alert('Por favor, seleccione la fecha de llegada.');
            return false;
        }

        if (!fechaSalida) {
            alert('Por favor, seleccione la fecha de salida.');
            return false;
        }

        const dateIngreso = new Date(fechaIngreso);
        const dateSalida = new Date(fechaSalida);

        if (dateSalida <= dateIngreso) {
            alert('La fecha de salida debe ser posterior a la fecha de llegada.');
            return false;
        }

        return true;
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>