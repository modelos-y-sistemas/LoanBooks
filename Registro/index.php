<?php
//Verifico si lo recibido es por metodo post
if($_POST){
  switch($_POST['submit']){
    case "librarian":
      //accedo a la clase librarians
      require "../class/librarians.php";
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $dni=$_POST['dni'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      //creacion de objeto bibliotecario
      $librarian = new librarians(0, $name, $surname, $dni, $email, $password);

      //ejecuta el metodo que registra al nuevo usuario a la base de datos
      $librarian->signup();

      //almaceno el objeto bibliotecario
      session_start();
      $_SESSION['librarians'] = $librarian;

      //envio al usuario que acaba de iniciar session a Buscar-y-Recibir
      header("Location: ../Prestar");
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Registro | EESTN°5</title>

  <link rel="stylesheet" href="https://localhost/LoanBooks/partials/generic.css">
  <link rel="stylesheet" href="./styles/main.css">

  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/favicon.jpg" type="image/x-icon">
</head>
<body>
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="name">Nombre/s</label>
    <input type="text" name="name" id="name">
    <label for="surname">Apellido/s</label>
    <input type="text" name="surname" id="surname">
    <label for="dni">DNI</label>
    <input type="number" name="dni" id="dni">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password">
    <label for="repassword">Repetir contraseña</label>
    <input type="password" name="repassword" id="repasswrd">
    <input type="submit" name="submit" value="librarian">
  </form>
</body>
</html>
