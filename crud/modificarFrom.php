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

    <title>Modificar habitaciont</title>
</head>

<body>
    <form class="col-4 p-3 m-auto" method="post">
        <h3 class="text-center text-secondary">Modificar habitacion</h3>
        <input type="hidden" class="form-control" name="id"  value="<?= $_GET["id"] ?>">
        <?php
        include "modificarhab.php";
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
                <label class="form-label">Reservada</label>
                <input type="text" class="form-control" name="rsv" value="<?= $datos->reservada ?>">

            </div>
            <?php
        }
        ?>


        <button type="submit" class="btn btn-primary" name="actualizar">Confirmar modificacion</button>
    </form>
</body>

</html>