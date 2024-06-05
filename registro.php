<?php

@include 'crud/conn.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = "user";

   $select = " SELECT * FROM users WHERE email = '$email' && pass = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Usuario ya existente!';

   }else{

      if($pass != $cpass){
         $error[] = 'Las contraseñas no coinciden!';
      }else{
         $insert = "INSERT INTO users(nombre, email, pass, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro</title>

    <link rel="stylesheet" href="style/style.css">

</head>

<body>

    <div class="form-container">

        <form action="" method="post">
            <h3>Registrarse</h3>
            <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
            <input type="text" name="name" required placeholder="Nombre">
            <input type="email" name="email" required placeholder="Email">
            <input type="password" name="password" required placeholder="Contraseña">
            <input type="password" name="cpassword" required placeholder="Confirmar contraseña">

            <input type="submit" name="submit" value="Registrarse" class="form-btn">
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesion</a></p>
        </form>

    </div>
    <script>
    function validateForm() {
        const name = document.forms["registrationForm"]["name"].value;
        const email = document.forms["registrationForm"]["email"].value;
        const password = document.forms["registrationForm"]["password"].value;
        const cpassword = document.forms["registrationForm"]["cpassword"].value;
        const errorMessages = document.getElementById("errorMessages");

        errorMessages.innerHTML = ''; // Limpiar mensajes de error anteriores

        if (name.trim() === '') {
            errorMessages.innerHTML += '<span class="error-msg">Por favor, ingrese su nombre.</span><br>';
            return false;
        }

        if (email.trim() === '') {
            errorMessages.innerHTML += '<span class="error-msg">Por favor, ingrese su correo electrónico.</span><br>';
            return false;
        }

        if (password.trim() === '') {
            errorMessages.innerHTML += '<span class="error-msg">Por favor, ingrese su contraseña.</span><br>';
            return false;
        }

        if (cpassword.trim() === '') {
            errorMessages.innerHTML += '<span class="error-msg">Por favor, confirme su contraseña.</span><br>';
            return false;
        }

        if (password !== cpassword) {
            errorMessages.innerHTML += '<span class="error-msg">Las contraseñas no coinciden.</span><br>';
            return false;
        }

        return true;
    }
    </script>

</body>

</html>