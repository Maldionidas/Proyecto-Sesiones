<?php
$message = '';
if(isset($_POST["actualizar"]) ){
    if(!empty($_POST["tipo"]) and !empty($_POST["personas"]) and !empty($_POST["precio"]) and !empty($_POST["rsv"])){
        $id=$_POST["id"];
        $tipo=$_POST["tipo"];
        $pers=$_POST["personas"];
        $precio=$_POST["precio"];
        $reservacion=$_POST["rsv"];

        $sql = $conn->query(" update habitaciones SET tipo='$tipo', personas = '$pers', precio= '$precio', reservada= '$reservacion' WHERE id = '$id' ");

        if ($sql == 1) {
            $message = "Habitacion actualizada correctamente";
            $alertClass = 'alert-success';
        } else {
            $message = "Error al actualizar";
            $alertClass = 'alert-danger';
        }
    } else {
        $message = "Algun campo está vacio";
        $alertClass = 'alert-danger';
    }
}


?>