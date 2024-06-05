<?php 
$message = '';
if(isset($_POST["agregar"])){
    if(!empty($_POST["habitacion"]) and !empty($_POST["personas"])and !empty($_POST["precio"]) and !empty($_POST["reservada"])){

        
        $tipohab = $_POST["habitacion"];
        $personas = $_POST["personas"];
        $precio = $_POST["precio"];
        $resv = $_POST["reservada"];

        $sql = $conn->query("INSERT INTO `habitaciones` ( `tipo`, `personas`, `precio`, `reservada`) VALUES ( '$tipohab', '$personas','$precio', '$resv'); ");

        if ($sql == 1) {
            $message = "Habitacion registrada correctamente";
            $alertClass = 'alert-success';
        } else {
            $message = "Error al registrar";
            $alertClass = 'alert-danger';
        }

    } else {
        $message = "Algun campo es invalido";
        $alertClass = 'alert-danger';
    }

}

?>