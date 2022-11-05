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

  <script src="js/index.js"></script>

  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
  />
  <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
      crossorigin="anonymous"
  ></script>

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
        <button type="submit" class="btni" value="register-student">Registrar</button>
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
        <button type="submit" class="btni" value="register-professor">Registrar</button>
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
          <button type="submit" class="btni">Prestar</button>
        </form>
      <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <input type="radio" name="debtor" value="Alumno" id="" checked>
        <input type="radio" name="debtor" value="Profesor" id="">
        <label for="code">Codigo</label>
        <input type="text" name="Codigo" id="code">
        <input type="submit" name="sbmt_SearchUser" value="Buscar">
      </form>
      <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuTask" data-bs-toggle="dropdown" aria-expanded="false">
        Agregar pedido
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li>
        <div class="card card-body">
          <form method="POST" id="subTask" action="./" submit="document.getElementById('subTask').reset();">

            
            <label for="">Libro</label>
            <!--<div class="form-group">
              <textarea name="duracion" id="duracion" rows="2" class="form-control" placeholder="duracion"></textarea>
            </div>-->

            <div class="form-group">
              <input type="text" placeholder="Categoria" name="category" class="form-control" autofocus required>
            </div>
            <br>
            <div class="form-group">
              <input type="text" placeholder="Nombre" name="name" class="form-control" autofocus required>
            </div>
            <br>
            <div class="form-group">
              <input type="text" placeholder="Cantidad" name="cantidad" class="form-control" autofocus required>
            </div>
            <br>

            <input type="button" id="" class="btn btn-success btn-block" value="Agregar">
          </form>
        </div>
        </li>
        <!--<li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>-->
      </ul>
    </div>
<?php
if(isset($_POST['sbmt_SearchUser'])&&isset($_POST['debtor'])&&isset($_POST['Codigo'])){
  switch($_POST['debtor']){
    case 'Alumno':
      require_once '../class/students.php';
      $user_record=students::get("code",$_POST['Codigo']);
      break;
    case 'Profesor':
      require_once '../class/professors.php';
      $user_record=professors::get("code",$_POST['Codigo']);
      break;
    default:
      echo "nada capo";
      break;
  }
echo $user_record->name;
echo '<form style="width: 500px;" action="'.$_SERVER['PHP_SELF'].'" method="post" class="container-inputs">
<div class="box-inputs">
  <div class="box-input-1">
    <h2 class="title-option-1">Libro</h2>
    <input type="text" placeholder="Categoria" name="category">
    <input type="text" placeholder="Nombre" name="name">
    <input type="text" placeholder="Cantidad" name="cantidad">
  </div>
</div>
<button type="submit" class="btni">Prestar</button>
</form>';
//require_once '../class/loans.php';

//$loan=new loans(0, );
}
?>
    </article>
  </section>
</body>
</html>
