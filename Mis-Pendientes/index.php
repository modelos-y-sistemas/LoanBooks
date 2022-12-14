<?php
  
  require '../class/students.php';
  require '../class/professors.php';
  
  session_start();
  if(isset($_SESSION['professors'])){
    $professor = $_SESSION['professors'];
    $books_pending = $professor->get_pending_books();
  }
  elseif(isset($_SESSION['students'])){
    $student = $_SESSION['students'];
    $books_pending = $student->get_pending_books();
  }
  elseif(isset($_SESSION['librarians'])) {
    header('location: ../Buscar-y-Recibir');
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
  <link rel="shortcut icon" href="../img/LoanBooks_icon.svg" type="image/x-icon">
  
  <title>Mis Pendientes | Biblioteca EESTN°5</title>
  
  <link rel="stylesheet" href="./styles/main.css">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- Bootstrap -->
</head>
<body>
  <div class="principal justify-content-center">
    <div class="d-flex justify-content-between p-5">
      <div>
        <h2>
          ¡Hola <?= isset($professor) ? $professor->name : ( isset($student) ? $student->name : ""); ?>!
        </h2>
      </div>
      <div>
        <h3>
          <?= isset($professor) ? "Profesor" : (isset($student) ? "Alumno" : "") ?>
        </h3>
      </div>
      <div>
        <a href="../partials/logout.php">
          <button class="exit"> Salir </button>
        </a>
      </div>
    </div>
    <?php if(count($books_pending) > 0):?>
      <!-- Si tiene libros pendientes muestra la tabla y los botones de paginacion -->
      <div class="container-sm p-4">
        <h1 class="text-center fw-bolder">Mis Pendientes</h1>
        <table class="table mt-5">
          <thead>
            <tr>
              <?php foreach ($books_pending[0] as $key => $data):?>
                <!-- imprime todas las columnas de la query en professors::get_pending_books -->
                <!-- imprime todas las $key (claves o posiciones (string)) de los datos de un libro
                     EJ: un libro (objeto) tiene
                        libro['VariableNombre']. 'VariableNombre' -> key: es la clave para acceder al valor del nombre -> libro['VariableNombre']
                     y es por esa $key que yo accedo a los distintos $data del primero libro -> $books_pending[0].
                 -->
                <th scope='col'> <?= $key ?> </th>
              <?php endforeach;?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($books_pending as $book_pending):?>
              <!-- por cada libro: -->
              <tr>
                <?php foreach ($book_pending as $data):?>
                  <!-- imprime los datos -->
                  <td> <?= $data ?> </td>
                <?php endforeach;?>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
      <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
          <button type="button" class="btn btn-outline-secondary">1</button>
          <button type="button" class="btn btn-outline-secondary">2</button>
          <button type="button" class="btn btn-outline-secondary">3</button>
          <button type="button" class="btn btn-outline-secondary">4</button>
        </div>
      </div>
      <?php else:?>
        <!-- Sino muestra un mensaje de que no tiene libros -->
        <h3>Vaya, parece que no tienes libros pendientes para entregar</h3>
      <?php endif;?>
  </div>

  <!-- Boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <!-- Boostrap -->

</body>
</html>
