<?php
include '../crud/conn.php';
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');

}

$fechaIngreso = new DateTime($_GET['finicio']);
$fechaSalida = new DateTime($_GET['fsalida']);
$idhab = $_GET["idhab"];
$iduser = $_SESSION['user_name'];

$sql = $conn->query("SELECT * FROM habitaciones WHERE id=$idhab");
$sqlus = $conn->query("SELECT * FROM users WHERE nombre='$iduser' ");

$datoshab = $sql->fetch_object();
$datos = $sqlus->fetch_object();
$preciohab = $datoshab->precio;

$diferencia = $fechaIngreso->diff($fechaSalida);
$dias = $diferencia->days;
$totalpago = $dias * $preciohab;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Confirmar pago</title>
    <script
        src="https://www.paypal.com/sdk/js?client-id=ActSazolc4oOWfPqYZ03VgyRgbvO6HqMwh4h6uXLoLpo1pfkno4iViD_1i2oFoZ4tl0cRMBF-lHI1jJU&currency=MXN">
    </script>
</head>

<body>
    <form class="col-4 p-3 m-auto" method="post">
        <h3 class="text-center text-secondary">CONFIRMAR RESERVACION</h3>
        <input type="hidden" name="id_usuario"  value="<?= $datos->id ?>">
        <input type="hidden" name="id_transaccion" id="id_transaccion">
        <div class="mb-1">
            <label class="form-label">ID y nombre de usuario</label>
            <input  type="text" class="form-control" disabled readonly
                value="<?= $datos->id." ".$iduser ?>">
        </div>
        <label class="form-label">Tipo habitacion</label>
        <input type="text" class="form-control" name="tipo_habitacion" value="<?= $datoshab->tipo ?>" readonly>
        <label class="form-label">Personas</label>
        <input type="text" class="form-control" name="personas" value="<?= $datoshab->personas ?>" readonly>
        <label class="form-label">Dias a hospedar</label>
        <input type="text" class="form-control" name="dias" value="<?= $dias ?>" readonly>
        <input type="date" class="form-control" name="ingreso" value="<?= $_GET['finicio'] ?>" readonly>
        <input type="date" class="form-control" name="salida" value="<?= $_GET['fsalida'] ?>" readonly>
        <p class="h1">Total a pagar: $<?= $totalpago ?></p>

        <div id="paypal-button-container"></div>
    </form>

    <script>
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?= $totalpago ?>
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            let id_transaccion = data.orderID;
            document.getElementById('id_transaccion').value = id_transaccion;

            return fetch('captura.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_usuario: <?= $datos->id ?>,
                        id_transaccion: id_transaccion,
                        tipo_habitacion: '<?= $datoshab->tipo ?>',
                        personas: <?= $datoshab->personas ?>,
                        dias: <?= $dias ?>,
                        fecha_ingreso: '<?= $_GET['finicio'] ?>',
                        fecha_salida: '<?= $_GET['fsalida'] ?>',
                        total_pago: <?= $totalpago ?>
                    })
                })
                .then(response => response.json())
                .then(result => {
                    window.location.href = "completado.php";
                    console.log(result);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        },
        onCancel: function(data) {
            alert("Pago cancelado");
            console.log(data);
        }
    }).render('#paypal-button-container');
    </script>
</body>

</html>
