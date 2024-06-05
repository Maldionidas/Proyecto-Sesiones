<?php
include "conn.php";
$id = $_GET["id"];

$sql = $conn->query(" select * from habitaciones where id=$id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Modificar habitacion</title>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-body-tertiary ">
        <div class="container-fluid">
            <a class="navbar-brand h1">Maldo INN</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="crud.php">CRUD</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form class="col-4 p-3 m-auto" method="post">
        <h3 class="text-center text-secondary">Modificar habitacion</h3>
        <input type="hidden" class="form-control" name="id" value="<?= $_GET["id"] ?>">
        <?php
        include "modificarhab.php";
        if ($message !== '') {
            echo '<div id="message" class="alert ' . $alertClass . '">' . $message . '</div>';
        }
        
        while ($datos = $sql->fetch_object()) { ?>
        <div class="mb-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" disabled readonly value="<?= $datos->id ?>">
        </div>

        <div class="mb-1">
            <label class="form-label">Tipo de habitacion</label>
            <input type="text" class="form-control" name="tipo" value="<?= $datos->tipo ?>">

        </div>
        <div class="mb-1">
            <label class="form-label">Numero de personas</label>
            <input type="text" class="form-control" name="personas" value="<?= $datos->personas ?>">

        </div>
        <div class="mb-1">
            <label class="form-label">Precio</label>
            <input type="text" class="form-control" name="precio" value="<?= $datos->precio ?>">

        </div>
        <div class="mb-1">
            <label class="form-label">Reservada</label>
            <input type="text" class="form-control" name="rsv" value="<?= $datos->reservada ?>">

        </div>
        <?php
        }
        ?>


        <button type="submit" class="btn btn-primary" name="actualizar">Confirmar modificacion</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function validateForm() {
        const tipo = document.forms["modifyForm"]["tipo"].value;
        const personas = document.forms["modifyForm"]["personas"].value;
        const precio = document.forms["modifyForm"]["precio"].value;
        const reservada = document.forms["modifyForm"]["rsv"].value;

        if (tipo === "") {
            alert("Por favor, ingrese el tipo de habitación.");
            return false;
        }

        if (personas === "" || isNaN(personas) || personas <= 0) {
            alert("Por favor, ingrese un número válido de personas.");
            return false;
        }

        if (precio === "" || isNaN(precio) || precio <= 0) {
            alert("Por favor, ingrese un precio válido.");
            return false;
        }

        if (reservada === "" || (reservada !== "Si" && reservada !== "No")) {
            alert("Por favor, ingrese si la habitación está reservada (Si/No).");
            return false;
        }

        return true;
    }
    $(document).ready(function() {
        setTimeout(function() {
            $('#message').fadeOut('slow');
        }, 3000);
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>