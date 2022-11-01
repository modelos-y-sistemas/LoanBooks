<?php

require '../class/librarians.php';

session_start();
if(isset($_SESSION['librarians'])){
  $librarian = $_SESSION['librarians'];
}
else{
  header("location: ../");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Prestar | EESTN°5</title>
  
  <link rel="stylesheet" href="style/main.css">

  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/LoanBooks_icon.svg" type="image/x-icon">
</head>
<body style="display:grid; justify-items: center;">

  <?php include '../partials/HTML/nav/nav.php' ?>
  
  <section style="display: grid; justify-items: center;" class="container-section">
    
    <div class="user-name" id="user-name">¡Hola, <?= $librarian->name ?>! :)</div>
    <h1 class="title">Prestar Libros</h1>
    
    <article class="container-form-register">
      <form action="<?= $_SERVER['PHP_SELF']?>" method="get" class="container-inputs">
        <h2 class="title-option-1"> Alumne </h2>
        <div class="inputs">
          <input type="text" placeholder="Codigo">
          <input type="text" placeholder="Nombre">
        </div>
        <div class="inputs">
          <input type="text" placeholder="Apellido">
          <input type="text" placeholder="DNI">
        </div>
        <div class="inputs">
          <input type="text" placeholder="Telefono">
          <select name="Curso" id="Curso">
            <option value="1">Opcion 1</option>
          </select>
        </div>
        <button type="submit" class="btn" value="register-student">Registrar</button>
      </form>
      <form action="<?= $_SERVER['PHP_SELF']?>" method="get" class="container-inputs">
        <h2 class="title-option-1"> Profesore </h2>
        <div class="inputs">
          <input type="text" placeholder="Codigo">
          <input type="text" placeholder="Nombre">
        </div>
        <div class="inputs">
          <input type="text" placeholder="Apellido">
          <input type="text" placeholder="DNI">
        </div>
        <div class="inputs">
          <input type="text" placeholder="Telefono">
        </div>
        <button type="submit" class="btn" value="register-professor">Registrar</button>
      </form>
    </article>
    <article>
      <form style="width: 500px;" action="<?= $_SERVER['PHP_SELF']?>" method="get" class="container-inputs">
          <div class="box-inputs">
            <div class="box-input-1">
              <h2 class="title-option-1">Libro</h2>
              <input type="text" placeholder="Categria">
              <input type="text" placeholder="Nombre">
              <input type="text" placeholder="Cantidad">
            </div>
            <div class="box-input-2">
              <h2 class="title-option-1">Alumne</h2>
              <select name="Curso" id="Curso">
                <option value="1">Opcion 1</option>
              </select>
            </div>
            <div class="box-input-2">
              <h2 class="title-option-1">Profesor</h2>
              <select name="Curso" id="Curso">
                <option value="1">Opcion 1</option>
              </select>
            </div>
          </div>
          <button type="submit" class="btn">Prestar</button>
        </form>
    </article>
  </section>
</body>
</html>
