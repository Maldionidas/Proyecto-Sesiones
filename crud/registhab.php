<?php 
if(isset($_POST["agregar"])){
    if(!empty($_POST["habitacion"]) and !empty($_POST["personas"]) and !empty($_POST["reservada"])){
        echo "Exito";

        $tipohab = $_POST["habitacion"];
        $personas = $_POST["personas"];
        $resv = $_POST["reservada"];

        $sql = $conn->query("INSERT INTO `habitaciones` ( `tipo`, `personas`, `reservada`) VALUES ( '$tipohab', '$personas', '$resv'); ");

        if($sql==1){
            echo '<div class="alert alert-success">Habitacion registrada correctamente</div>';
        }else{
            echo '<div class="alert alert-danger">Error al registrar</div>';
        }
        
    }else{
        echo "Algun campo es invalido";
    }

}

?>