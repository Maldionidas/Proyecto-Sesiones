<?php

include("../crud/conn.php");

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if(is_array($datos)){
    $id_transaccion = $datos['detalles']['id'];
    $status = $datos['status'];
    $fecha = $datos['update_time'];
    $fechanueva = date('Y-m-d H:i:s', strtotime($fecha));
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $id_cliente = $datos['detalles']['payer']['payer_id'];

    $sql = $conn->prepare("insert into compra (id_transaccion, fecha, status, id_cliente, total)
    values (?,?,?,?,?)");

    $sql->execute([$id_transaccion,$fechanueva,$status,$id_cliente,$monto]);
    $id = $conn->lastInsertId();

    
}

?>