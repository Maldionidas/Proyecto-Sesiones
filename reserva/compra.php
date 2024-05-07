<?php
@include '../crud/conn.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
$fechaIngreso= new DateTime( $_GET['finicio']);
$fechaSalida= new DateTime( $_GET['fsalida']);
$idhab = $_GET["idhab"];
$iduser = $_SESSION['user_name'];

$sql = $conn->query(" select * from habitaciones where id=$idhab");
$sqlus = $conn->query(" select * from users where nombre='$iduser' ");

$datoshab = $sql->fetch_object();
$preciohab = $datoshab->precio;

$diferencia = $fechaIngreso->diff($fechaSalida);
$dias=$diferencia->days;
$totalpago=$dias*$preciohab;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Confirmar pago</title>
    <script src="https://www.paypal.com/sdk/js?client-id=ActSazolc4oOWfPqYZ03VgyRgbvO6HqMwh4h6uXLoLpo1pfkno4iViD_1i2oFoZ4tl0cRMBF-lHI1jJU&currency=MXN"></script>
</head>

<body>
    <form class="col-4 p-3 m-auto" method="post">
        <h3 class="text-center text-secondary">CONFIRMAR RESERVACION</h3>
        <input type="hidden" class="form-control" name="id"  value="<?= $iduser ?>">
        <?php
        
        while ($datos = $sqlus->fetch_object()) { ?>
            <div class="mb-1">
            <label class="form-label">ID y nombre de usuario</label>
            <input type="text" class="form-control" disabled readonly value="<?= $datos->id." ".$datos->nombre ?>">
        </div>

            
            <?php
        }
        ?>
        <label class="form-label">Tipo habitacion</label>
        <input type="text" class="form-control" name="id"  value="<?=  $datoshab->tipo?>">
        <label class="form-label">Personas</label>
        <input type="text" class="form-control" name="id"  value="<?=  $datoshab->personas?>">
        <label class="form-label">Dias a hospedar</label>
        <input type="text" class="form-control" name="id"  value="<?=  $dias?>">
        

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
                                value: <?php echo $totalpago;?>
                            }
                        }]
                    });
                },
                onApprove:function(data,actions){
                    let URL ='captura.php'
                    actions.order.capture().then(function (detalles){
                        window.location.href="completado.html"
                        console.log(detalles)

                        let url = 'captura.php'

                        return fetch(url, {
                            method: 'post',
                            headers:{
                                'content-type': 'application/json'
                            },
                            body: JSON.stringify({
                                detalles: detalles
                            })
                        })
                    });
                },
                onCancel: function(data){
                    alert("Pago cancelado");
                    console.log(data);
                }
            }).render('#paypal-button-container');
            </script>
    </div>
    </form>


    

</body>

</html>