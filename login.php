<?php

@include 'conn.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['nombre']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);


   $select = " SELECT * FROM users WHERE email = '$email' && pass = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['type'] == 'admin'){

         $_SESSION['admin_name'] = $row['nombre'];
         header('location:admin.php');

      }elseif($row['type'] == 'user'){

         $_SESSION['user_name'] = $row['nombre'];
         header('location:user.php');

      }
     
   }else{
      $error[] = 'Correo o contraseña incorrectos!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <link rel="stylesheet" href="style/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Ingresa</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="ingresa tu email">
      <input type="password" name="password" required placeholder="ingresa tu contraseña">
      <input type="submit" name="submit" value="Ingresar" class="form-btn">
      <p>¿No tienes una cuenta? <a href="registro.php">Registrate</a></p>
   </form>

</div>

</body>
</html>