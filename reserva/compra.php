<?php
@include '../crud/conn.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}

$idhab = $_GET["id"];
$iduser = $_SESSION['user_name'];

$sql = $conn->query(" select * from habitaciones where id=$idhab");
$sqlus = $conn->query(" select * from users where nombre='$iduser' ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Modificar habitacion</title>
    <script src="https://www.paypal.com/sdk/js?client-id=ActSazolc4oOWfPqYZ03VgyRgbvO6HqMwh4h6uXLoLpo1pfkno4iViD_1i2oFoZ4tl0cRMBF-lHI1jJU&currency=MXN"></script>
</head>

<body>
    <form class="col-4 p-3 m-auto" method="post">
        <h3 class="text-center text-secondary">Modificar habitacion</h3>
        <input type="hidden" class="form-control" name="id"  value="<?= $_GET["id"] ?>">
        <?php
       // include "modificarhab.php";
        while ($datos = $sqlus->fetch_object()) { ?>
            <div class="mb-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" disabled readonly value="<?= $datos->id ?>">
        </div>

            
            <?php
        }
        ?>
        <div id="paypal-button-container">
        <script>
            paypal.Buttons({
                style:{
                    color:'blue',
                    shape:'pill',
                    label:'pay'
                },
                createOrder:function(data, actions){
                    return actions.order.create({
                        purchase_units:[{
                            amount:{
                                value: 100
                            }
                        }]
                    });
                },
                onApprove:function(data,actions){
                    actions.order.capture().then(function (detalles){
                        console.log(detalles);
                        window.location.href="reservaciones.php";
                    });
                },
                onCancel: function(data){
                    alert("Pago cancelado");
                    console.log(data);
                }
            }).render('#paypal-button-container');
            </script>
    </div>
        <button type="submit" class="btn btn-primary" name="actualizar">Confirmar compra</button>
    </form>


    

</body>

</html>