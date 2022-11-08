<?php

  require '../class/librarians.php';

  session_start();
  if(isset($_SESSION['librarians'])){
    require "C:/xampp/htdocs/LoanBooks/partials/tools/get_courses/get_courses.php"; // para obtener la variable $courses_record

    $librarian = $_SESSION['librarians'];
  }
  else{
    header("Location: ../");
  }

  if($_POST){
    if($_POST['submit'] == "find_books"){

      $book_name = $_POST["book__name"];
      $book_category = $_POST["book__category"];
      $book_start_order = $_POST["book__start_order"];
      $book_end_order = $_POST["book__end_order"];

      /*
      echo "book_name: " . $book_name . "<br>";
      echo "book_category: " . $book_category . "<br>";
      echo "book_start_order: " . $book_start_order . "<br>";
      echo "book_end_order: " . $book_end_order . "<br>";
      */

      if($_POST['searching'] == "student"){
        $student_code = $_POST["student__code"];
        $student_name = $_POST["student__name"];
        $student_surname = $_POST["student__surname"];
        $student_dni = $_POST["student__dni"];
        $student_phone = $_POST["student__phone"];
        $student_course = $_POST["student__course"];
      
        $records = $librarian->find_students($student_code, $student_name, $student_surname, $student_dni, $student_phone, $student_course, $book_name, $book_category, $book_start_order, $book_end_order);
        
        /*
        echo "student_code: " . $student_code . "<br>";
        echo "student_name: " . $student_name . "<br>";
        echo "student_surname: " . $student_surname . "<br>";
        echo "student_dni: " . $student_dni . "<br>";
        echo "student_phone: " . $student_phone . "<br>";
        echo "student_course: " . $student_course . "<br>";
        */
      }
      elseif($_POST['searching'] == "professor"){
        $professor_code = $_POST["professor__code"];
        $professor_name = $_POST["professor__name"];
        $professor_surname = $_POST["professor__surname"];
        $professor_dni = $_POST["professor__dni"];
        $professor_phone = $_POST["professor__phone"];

        $records = $librarian->find_professors($professor_code, $professor_name, $professor_surname, $professor_dni, $professor_phone, $book_name, $book_category, $book_start_order, $book_end_order);

        /*
        echo "professor_code: " . $professor_code . "<br>";
        echo "professor_name: " . $professor_name . "<br>";
        echo "professor_surname: " . $professor_surname . "<br>";
        echo "professor_dni: " . $professor_dni . "<br>";
        echo "professor_phone: " . $professor_phone . "<br>";
        */
      }
      else die('Algo salio mal.');
    }
    elseif($_POST['submit'] == "delivered"){
      // cuando recibe los libros
    }
    else die('Algo salio mal.');
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Buscar y Recibir | EESTN°5</title>
  
  <link rel="stylesheet" href="style/main.css">
  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/LoanBooks_icon.svg" type="image/x-icon">

</head>
<body>
  <section class="container-section">
    <?php include '../partials/HTML/nav/nav.php'; ?>
    
    <div class="user-name" id="user-name">¡Hola, <?= $librarian->name ?>! :)</div>
    <h1 class="title">Buscar y Recibir</h1>
    
    <form class="container-menu" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" id="find_books">
      <div>
        <label for="student">Alumno</label>
        <input type="radio" name="searching" id="student" value="student" checked>
      </div>
      <div>
        <label for="professor">Profesor</label>
        <input type="radio" name="searching" id="professor" value="professor">
      </div>
      <ul class="options">
        <li id="alumne">
          <a href="#alumne">Alumne</a>
          <ul>
            <li>
              <div class="inputs">
                <input type="text" placeholder="Codigo" name="student__code">
                <input type="text" placeholder="Nombre" name="student__name">
              </div>
              <div class="inputs">
                <input type="text" placeholder="Apellido" name="student__surname">
                <input type="text" placeholder="DNI" name="student__dni">
              </div>
              <div class="inputs">
                <input type="text" placeholder="Telefono" name="student__phone">
                <select name="student__course">
                  <?php if(count($courses_record) > 0): ?>
                    <option value="-1">Seleccionar</option>
                    <?php foreach($courses_record as $course):?>  
                      <option value="<?= $course->id_course ?>"> <?= $course->year . "° " . $course->division . "° " . $course->modality ?> </option>
                    <?php endforeach;?>
                  <?php else: ?>
                    <option value="-1">No hay cursos para seleccionar</option>
                  <?php endif; ?>
                </select>
              </div>
            </li>
          </ul>
        </li>
        <li id="libro">
          <a href="#libro">Libro</a>
          <ul>
            <div class="inputs">
              <input type="text" placeholder="Nombre" name="book__name">
              <input type="text" placeholder="Categoria" name="book__category">
              <div class="order-label">
                <label for="#Egreso">Fecha de Egreso</label>
                <input type="date" id="Egreso" name="book__start_order">
              </div>
              <div class="order-label">
                <label for="#Regreso">Fecha de Regreso</label>
                <input type="date" id="Regreso" name="book__end_order">
              </div>
            </div>
          </ul>
        </li>
        <li id="profesore">
          <a href="#profesore">Profesore</a>
          <ul>
            <div class="box-inputs">
              <div class="inputs">
                <input type="text" placeholder="Nombre" name="professor__name">
                <input type="text" placeholder="DNI" name="professor__dni">
              </div>
              <div class="inputs">
                <input type="text" placeholder="Apellido" name="professor__surname">
                <input type="text" placeholder="Telefono" name="professor__phone">
                <input type="text" placeholder="Codigo" name="professor__code">
              </div>
            </ul>
          </li>
      </ul>
    </form>
  </section>
      
  <section class="container-table">
    <article class="table">
      <?php if(isset($records) && count($records) > 0): ?>
        <table>
          <thead>
            <tr>
              <?php foreach ($records[0] as $column => $value):?>
                <th class="div1 title-col"> <?= $column ?> </th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($records as $record):?>
              <tr>
                <?php foreach ($record as $key => $data):?>
                  <td> <?= $data ?> </td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p> No se Encontraron resultados </p>
      <?php endif; ?>
    </article>
  </section>

  <div class="footer">
    <button type="submit" class="btn" name="submit" form="delivered" value="delivered"> Entregó </button>
    <div class="boxes">
      <div class="box-number">1</div>
      <div class="box-number">2</div>
      <div class="box-number">3</div>
      <div class="box-number">4</div>
    </div>
    <button type="submit" class="btn" name="submit" form="find_books" value="find_books"> Buscar </button>
  </div>
</body>
</html>
