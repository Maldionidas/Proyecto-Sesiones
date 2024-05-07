<?php 
if(isset($_POST["agregar"])){
    if(!empty($_POST["habitacion"]) and !empty($_POST["personas"])and !empty($_POST["precio"]) and !empty($_POST["reservada"])){

        
        $tipohab = $_POST["habitacion"];
        $personas = $_POST["personas"];
        $precio = $_POST["precio"];
        $resv = $_POST["reservada"];

        $sql = $conn->query("INSERT INTO `habitaciones` ( `tipo`, `personas`, `precio`, `reservada`) VALUES ( '$tipohab', '$personas','$precio', '$resv'); ");

        if($sql==1){
            echo '<div class="alert alert-success">Habitacion registrada correctamente</div>';
        }else{
            echo '<div class="alert alert-danger">Error al registrar</div>';
        }
        
    }else{
        echo '<div class="alert alert-danger">Algun campo es invalido</div>';
    }

}

?>