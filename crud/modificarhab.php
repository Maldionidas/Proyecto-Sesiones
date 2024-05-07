<?php

if(isset($_POST["actualizar"]) ){
    if(!empty($_POST["tipo"]) and !empty($_POST["personas"]) and !empty($_POST["precio"]) and !empty($_POST["rsv"])){
        $id=$_POST["id"];
        $tipo=$_POST["tipo"];
        $pers=$_POST["personas"];
        $precio=$_POST["precio"];
        $reservacion=$_POST["rsv"];

        $sql = $conn->query(" update habitaciones SET tipo='$tipo', personas = '$pers', precio= '$precio', reservada= '$reservacion' WHERE id = '$id' ");

        if($sql == 1){
            header("location:crud.php");
        }else{
            echo "<div class='alert alert-danger'>No se logro la modificacion </div>";
        }
    }else{
        echo "<div class='alert alert-warning'>Campos vacios </div>";
    }
}


?>