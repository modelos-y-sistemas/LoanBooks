<?php
//Esto es uan base para adelantar el trabajo, aun requiere muchas mejoras y validaciones

//obtencion de los datos del formulario de login de bibliotecario
$input_Email=$_POST['email'];
$input_Password=$_POST['password'];

//accedo a la clase librarians
require_once "../class/librarians.php";
//obtengo el bibliotecario por su Mail 
$librarian=librarians::get("email", $input_Email);
//lo valido con su contraseña (Esto deberia ser con password_verify pero falta encriptar la contraseña)
if($librarian->password==$input_Password){
  //almaceno la variable de session user_id
  $_SESSION['user_id']=$librarian->id_librarian;
  //envio al usuario que acaba de iniciar session a Home
  header("Location: ../Home");
}
//echo $librarian->name;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Login | EESTN°5</title>

  <link rel="stylesheet" href="https://localhost/LoanBooks/partials/generic.css">
  <link rel="stylesheet" href="./styles/main.css">

  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/favicon.jpg" type="image/x-icon">
</head>
<body>
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="email">email</label>
    <input type="email" name="email" id="email">
    <label for="password">password</label>
    <input type="password" name="password" id="password">
    <button type="submit">Bibliotecario Login</button>
  </form>
</body>
</html>
