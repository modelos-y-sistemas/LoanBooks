<?php

  require '../class/librarians.php';

  session_start();
  if(isset($_SESSION['librarians'])){
    require "../partials/tools/get_courses/get_courses.php"; // para obtener la variable $courses_record

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

      if($_POST['searching'] == "student"){
        $student_code = $_POST["student__code"];
        $student_name = $_POST["student__name"];
        $student_surname = $_POST["student__surname"];
        $student_dni = $_POST["student__dni"];
        $student_phone = $_POST["student__phone"];
        $student_course = $_POST["student__course"];
      
        $records = $librarian->find_students($student_code, $student_name, $student_surname, $student_dni, $student_phone, $student_course, $book_name, $book_category, $book_start_order, $book_end_order);
      }
      elseif($_POST['searching'] == "professor"){
        $professor_code = $_POST["professor__code"];
        $professor_name = $_POST["professor__name"];
        $professor_surname = $_POST["professor__surname"];
        $professor_dni = $_POST["professor__dni"];
        $professor_phone = $_POST["professor__phone"];

        $records = $librarian->find_professors($professor_code, $professor_name, $professor_surname, $professor_dni, $professor_phone, $book_name, $book_category, $book_start_order, $book_end_order);
      }
      else die('Algo salio mal.');
    }
    elseif($_POST['submit'] == "delivered"){
      // al $_POST solo le llegan los checks checkeados
      foreach($_POST as $key => $value){
        if($key != "submit" && $librarian->receive_book($key)) die('Algo salio mal.');
      }
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
  
  <?php include '../partials/HTML/nav/nav.php'; ?>
  
  <div class="librarian">
    <p class="librarian__name">¡Hola, <?= $librarian->name ?>! :)</p>
  </div>
  <h1 class="title">Buscar y Recibir</h1>

  <form class="form_searching" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" id="find_books">
    <div class="switch-field">
      <input class="switch-field__input" type="radio" id="professor" name="searching" value="professor" <?= (!isset($_POST['searching'])) ? "checked" : ($_POST['searching'] == 'professor' ? "checked" : "") ?>/>
      <label class="switch-field__label" for="professor">Profesores</label>
      <input class="switch-field__input" type="radio" id="student" name="searching" value="student" <?= (!isset($_POST['searching'])) ? "checked" : ($_POST['searching'] == 'student' ? "checked" : "") ?> />
      <label class="switch-field__label" for="student">Alumnos</label>
    </div>
    <div class="entities_form">
      <div class="form form-student">
        <h3 class="form__name">Alumno</h3>
        <input type="text" class="control__input control__input-text" placeholder="Código" name="student__code">
        <input type="text" class="control__input control__input-text" placeholder="Nombre" name="student__name">
        <input type="text" class="control__input control__input-text" placeholder="Apellido" name="student__surname">
        <input type="text" class="control__input control__input-text" placeholder="DNI" name="student__dni">
        <input type="text" class="control__input control__input-text" placeholder="Teléfono" name="student__phone">
        <select class="control__input control__input-select" name="student__course">
          <?php if(count($courses_record) > 0): ?>
            <option value="-1">Seleccionar</option>
            <?php foreach($courses_record as $course):?>  
              <option value="<?= $course->id_course ?>"> <?= $course->year . "° " . $course->division . "° " . $course->modality ?> </option>
            <?php endforeach;?>
          <?php else: ?>
            <option value="-1">No hay cursos para selecciónar</option>
          <?php endif; ?>
        </select>
      </div>
      <div class="form form-book">
      <h3 class="form__name">Libro</h3>
        <input type="text" class="control__input control__input-text" placeholder="Nombre" name="book__name">
        <input type="text" class="control__input control__input-text" placeholder="Categoría" name="book__category">
        <label class="control__label" for="input_start_order">Fecha de Egreso</label>
        <input type="date" class="control__input control__input-date" id="input_start_order" name="book__start_order">
        <label class="control__label" for="input_end_order">Fecha de Regreso</label>
        <input type="date" class="control__input control__input-date" id="input_end_order" name="book__end_order">
      </div>
      <div class="form form-professor">
        <h3 class="form__name">Profesor</h3>
        <input type="text" class="control__input control__input-text" placeholder="Nombre" name="professor__name">
        <input type="text" class="control__input control__input-text" placeholder="DNI" name="professor__dni">
        <input type="text" class="control__input control__input-text" placeholder="Apellido" name="professor__surname">
        <input type="text" class="control__input control__input-text" placeholder="Teléfono" name="professor__phone">
        <input type="text" class="control__input control__input-text" placeholder="Código" name="professor__code">
      </div>
    </div>
  </form>

  <?php if(isset($records) && count($records) > 0): ?>
    <table>
      <thead>
        <tr>
          <?php foreach ($records[0] as $column => $value):?>
            <th class="title-col"> <?= $column ?> </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($records as $record):?>
          <tr class="record">
            <?php foreach ($record as $key => $data):?>
              <td class="values_record">
                <?php
                  if($key == "Selec."){
                    if($record->Devuelto == "NO"){
                      echo "<input type='checkbox' form='delivered' name='$data' id='selection'>";
                    } else echo "";
                  } else echo $data;
                ?>
              </td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="message"> No se Encontraron resultados </p>
  <?php endif; ?>
  <div class="buttons">
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="delivered">
        <button type="submit" class="btn" name="submit" value="delivered"> Entregó </button>
      </form>
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
