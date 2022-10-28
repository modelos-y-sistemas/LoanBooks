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
      $librarian=new librarians($name, $surname, $dni, $email, $password);

      //ejecuta el metodo que registra al nuevo usuario a la base de datos
      $librarian->signup();

      //almaceno el objeto bibliotecario
      session_start();
      $_SESSION['librarian']=$librarian;

      //envio al usuario que acaba de iniciar session a Buscar-y-Recibir
      header("Location: ../Buscar-y-Recibir");
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
    
  </form>
</body>
</html>
