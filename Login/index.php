<?php

function escape_string_sql($str){
  
  // hay que escapear codigo SQL de las variables de entrada para
  // evitar una injeccion SQL. la funcion mysqli_real_escape_string() no sirve
  
  return $str;
}

if($_POST){
  
  $roles = ["students", "professores", "librarians"];
  $rol = $_POST['rol'];
  
  if (!in_array($rol, $roles)) die('Rol invalido');
  
  // $rol es igual al nombre del archivo de la clase del rol elegido
  require "../class/" . $rol . ".php"; // por lo tanto, se va a requerir del archivo del rol elegido
  
  if($rol == "librarians") {
    
    $input_email = escape_string_sql($_POST['email']);
    $input_password = escape_string_sql($connection, $_POST['password']);

    // obtengo el registro del bibliotecario por su email 
    $librarian_record = librarians::get("email", $input_email);
    
    // lo valido con su contraseña (Esto deberia ser con password_verify pero falta encriptar la contraseña)
    if($librarian_record && $librarian_record->password == $input_password)
    {
      $librarian = new librarians($librarian_record->id_librarian, $librarian_record->name, $librarian_record->surname, $librarian_record->dni, $librarian_record->email, $librarian_record->password);
      
      //almaceno la variable de session user_id
      session_start();
      $_SESSION['librarian'] = $librarian;
      
      //envio al usuario que acaba de iniciar session a Buscar-y-Recibir
      header("Location: ../Buscar-y-Recibir");
    
    }
    else { echo "Email o password incorrectos"; }
  }
  else
  {
    
    $input_code = $_POST['code'];
    
    if($rol == "students")
    {
      $student_record = students::get("code", $input_code);

      if(isset($student_record)){
        $student = new students($student_record->id_student, $student_record->name, $student_record->surname, $student_record->code, $student_record->dni, $student_record->phone, $student_record->id_course);
        
        session_start();
        $_SESSION['student'] = $student;
      }
      else{

      }
    }
    else
    {
      
    }
    
    header("Location: ../Mis-Pendientes");
    echo "Código incorrecto";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>~LoanBooks~ | Sesión</title>
  
  <link rel="stylesheet" href="./styles/main.css">
  <link rel="shortcut icon" href="../img/LoanBooks_icon.svg" type="image/x-icon">
</head>
<body>

  <?php require '../partials/HTML/header/header.php'; ?>
  <?php include '../partials/HTML/nav/nav.php'; ?>
  
  <div class="mainbox">
    <div class="controles-rol">
      <div class="control-rol">
        <label class="control-rol__label" id="label__rol-librarian" for="input__rol-librarian">Bibliotecario</label>
        <input hidden type="radio" name="rol" id="input__rol-librarian">
      </div>
      <div class="control-rol">
        <label class="control-rol__label" id="label__rol-professor" for="input__rol-professor">Profesor</label>
        <input hidden type="radio" name="rol" id="input__rol-professor">
      </div>
      <div class="control-rol">
        <label class="control-rol__label" id="label__rol-student" for="input__rol-student">Estudiante</label>
        <input hidden type="radio" name="rol" id="input__rol-student">
      </div>
    </div>
    <form class="form" id="form-librarian" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" hidden>
      <div class="control">
        <label class="control__label" for="email">Correo electrónico</label>
        <input class="control__input" id ="email" type="email" name="email" autofocus>
      </div>
      <div class="control">
        <label class="control__label" for="password">Password</label>
        <input class="control__input" id ="password" type="password" name="password">
      </div>
    </form>
    <form class="form" id="form-student" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" hidden>
      <div class="control">
        <label class="control__label" for="student-code">Código</label>
        <input class="control__input" id ="student-code" type="student-code" name="student-code" autofocus>
      </div>
    </form>
    <form class="form" id="form-professor" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" hidden>
      <div class="control">
        <label class="control__label" for="professor-code">Código</label>
        <input class="control__input" id ="professor-code" type="professor-code" name="professor-code" autofocus>
      </div>
    </form>
    <button class="submit" type="submit" value="none" for="none" name="rol"> Ingresar </button>
  </div>

  <?php include "../partials/HTML/footer/footer.php"; ?>

  <script src="./scripts/main.js"></script>
</body>
</html>
