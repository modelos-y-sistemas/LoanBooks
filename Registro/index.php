<?php

//accedo a la clase librarians
require '../class/librarians.php';

session_start();
if(!isset($_SESSION['librarians'])){
  header("location: ../");
}

//Verifico si lo recibido es por metodo post
if($_POST){
  switch($_POST['submit']){
    case "librarian":
      //accedo a la clase librarians si es que no fue agregada
      require_once "../class/librarians.php";
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $dni = $_POST['dni'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      //creacion de objeto bibliotecario
      $librarian = new librarians(0, $name, $surname, $dni, $email, $password);
      //echo $librarian->toString();

      //ejecuta el metodo que registra al nuevo usuario a la base de datos
      $librarian->signup();

      //almaceno el objeto bibliotecario
      //$_SESSION['librarians'] = $librarian;

      //envio al usuario que acaba de iniciar session a Buscar-y-Recibir
      //header("Location: ../Prestar");
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
  
  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/favicon.jpg" type="image/x-icon">
  
  <link rel="stylesheet" href="./styles/main.css">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- bootstrap -->
  
  
</head>
<body>


  <?php include '../partials/HTML/nav/nav.php'; ?>
  
  
  <form class="row g-3 p-5 m-5" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
  
    <div class="col-md-6">
      <label for="name" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="name">
    </div>
  
    <div class="col-md-6">
      <label for="dni" class="form-label">Apellido</label>
      <input type="password" class="form-control" id="surname">
    </div>
  
    <div class="col-12">
      <label for="inputAddress" class="form-label">D.N.I</label>
      <input type="text" class="form-control" id="dni">
    </div>
  
    <div class="col-12">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email">
    </div>
  
    <div class="col-md-6">
      <label for="password" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="password">
    </div>
  
    <div class="col-md-6">
      <label for="repassword" class="form-label">Repetir contraseña</label>
      <input type="password" class="form-control" id="repassword">
    </div>
  
  
    <div class="col-12">
      <button type="submit" class="btn btn-primary">librarian</button>
    </div>
  
  </form>


  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script> 
  <!-- bootstrap -->

</body>
</html>
