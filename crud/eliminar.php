<?php

if(!empty($_GET["id"])){
    $id = $_GET["id"];
    $sql = $conn->query(" delete from habitaciones where id=$id");

    if($sql==1){
        echo '<div class="alert alert-success">Se ha eliminado correctamente</div>';
    }else{
        echo '<div class="alert alert-danger">No se ha podido eliminar</div>';
    }
}


?>
