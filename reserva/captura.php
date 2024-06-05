<?php
include '../crud/conn.php';

// Obtener los datos de la solicitud POST
$datos = json_decode(file_get_contents('php://input'), true);
$id_usuario = $datos['id_usuario'];
$id_transaccion = $datos['id_transaccion'];
$tipo_habitacion = $datos['tipo_habitacion'];
$personas = $datos['personas'];
$dias = $datos['dias'];
$fecha_ingreso = $datos['fecha_ingreso'];
$fecha_salida = $datos['fecha_salida'];
$total_pago = $datos['total_pago'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO reservaciones (id_usuario, id_transaccion, tipo_habitacion, personas, dias, fecha_ingreso, fecha_salida, total_pago) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssisss", $id_usuario, $id_transaccion, $tipo_habitacion, $personas, $dias, $fecha_ingreso, $fecha_salida, $total_pago);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Reservación registrada correctamente']);
} else {
    echo json_encode(['message' => 'Error al registrar la reservación', 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>