<?php
session_start();
if($_SESSION){
  $roles = ['librarians', 'professors', 'students'];
  $paths = ['https://localhost/LoanBooks/Prestar', 'https://localhost/LoanBooks/Mis-Pendientes', 'https://localhost/LoanBooks/Mis-Pendientes'];
  
  foreach ($roles as $key => $rol) {
    if($_SESSION[$rol]){
      header("location: $paths[$key]");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/LoanBooks_icon.svg" type="image/x-icon">
  <title>LoanBooks | EESTN°5</title>

  <link rel="stylesheet" href="https://localhost/LoanBooks/partials/generic.css">
  <link rel="stylesheet" href="./styles/main.css">

  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/favicon.jpg" type="image/x-icon">
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- Bootstrap -->
</head>
<body>
  <div class="principal justify-content-center">
    <div class="container-sm p-5">
      <p class="text-center fs-4 fw-semibold">ESCUELA DE EDUCACIÓN SECUNDARIA TÉCNICA N°5 <span class="text-break">BIBLIOTECA ESCOLAR<span></p>
    </div>
    <div class="container-sm mt-5 p-4 border-top border-bottom  border-white border-5">
      <h1 class="text-center fs-1 fw-bolder">BIBLIOTECA DIANA LAGOMARSINO</h1>
    </div>
    <div class="container-sm mt-5 p-4">
      <p class="text-center fs-5 lh-base"></p>
    </div>
    <div class="container-sm mt-5 p-4">
      <a href="./Login/">
        <button type="button" class="btn btn-outline-light">Ver mis Pendientes</button>
      </a>
    </div>
  </div>

  <!-- Boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <!-- Boostrap -->
</body>
</html>
