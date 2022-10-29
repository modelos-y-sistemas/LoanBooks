<?php

session_start();
if($_SESSION){
  $roles = ['librarian', 'professor', 'student'];
  $paths = ['https://localhost/LoanBooks/Buscar-y-Recibir', 'https://localhost/LoanBooks/Mis-Pendientes', 'https://localhost/LoanBooks/Mis-Pendientes'];
  
  foreach ($roles as $key => $rol) {
    if($_SESSION[$rol]){
      header("location: $paths[$key]");
    }

  }
}

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
  
  switch($rol) {
    case "librarians":
    {
      $input_email = escape_string_sql($_POST['email']);
      $input_password = escape_string_sql($_POST['password']);

      // obtengo el registro del bibliotecario por su email 
      $librarian_record = librarians::get("email", $input_email);
      
      // lo valido con su contraseña (Esto deberia ser con password_verify pero falta encriptar la contraseña)
      if($librarian_record && $librarian_record->password == $input_password)
      {
        $librarian = new librarians($librarian_record->id_librarian, $librarian_record->name, $librarian_record->surname, $librarian_record->dni, $librarian_record->email, $librarian_record->password);
        
        //almaceno la variable de session user_id
        $_SESSION['librarian'] = $librarian;
        
        //envio al usuario que acaba de iniciar session a Buscar-y-Recibir
        header("Location: ../Buscar-y-Recibir");
      }
      else { echo "Email o password incorrectos"; }

      break;
    }
    case "students":
    {
      $student_code = $_POST['student-code'];
      echo $student_code;
      $student_record = students::get("code", $student_code);

      var_dump($student_record);

      if($student_record){
        $student = new students($student_record->id_student, $student_record->name, $student_record->surname, $student_record->code, $student_record->dni, $student_record->phone, $student_record->id_course);
        
        var_dump($student);

        $_SESSION['student'] = $student;
        
        var_dump($_SESSION['student']);

        header("Location: ../Mis-Pendientes");
      }
      else{
        echo "Código incorrecto";
      }

      break;
    }
    case 'professores':
    {
      $professor_code = $_POST['professor-code'];
      $professor_record = professores::get("code", $professor_code);
      
      if($professor_record){
        $professor = new professores($professor_record->id_professor, $professor_record->name, $professor_record->surname, $professor_record->code, $professor_record->dni, $professor_record->phone);
      
        $_SESSION['professor'] = $professor;

        var_dump($_SESSION['professor']);

        header("Location: ../Mis-Pendientes");
      }
      else{
        echo "Código incorrecto";
      }

      break;
    }
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

  <?php include '../partials/HTML/header/header.php'; ?>
  <?php include '../partials/HTML/nav/nav.php'; ?>
  
  <div class="mainbox">
    <div class="controles-rol">
      <div class="control-rol">
        <label class="control-rol__label" id="label__rol-librarians" for="input__rol-librarians">Bibliotecario</label>
        <input hidden type="radio" name="rol" id="input__rol-librarians">
      </div>
      <div class="control-rol">
        <label class="control-rol__label" id="label__rol-professores" for="input__rol-professores">Profesor</label>
        <input hidden type="radio" name="rol" id="input__rol-professores">
      </div>
      <div class="control-rol">
        <label class="control-rol__label" id="label__rol-students" for="input__rol-students">Estudiante</label>
        <input hidden type="radio" name="rol" id="input__rol-students">
      </div>
    </div>
    <form class="form" id="form-librarians" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" hidden>
      <div class="control">
        <label class="control__label" for="email">Correo electrónico</label>
        <input class="control__input" id ="email" type="email" name="email" autofocus>
      </div>
      <div class="control">
        <label class="control__label" for="password">Password</label>
        <input class="control__input" id ="password" type="password" name="password">
      </div>
      <button class="submit" type="submit" value="librarians" for="form-librarians" name="rol"> Ingresar </button>
    </form>
    <form class="form" id="form-students" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" hidden>
      <div class="control">
        <label class="control__label" for="student-code">Código</label>
        <input class="control__input" id ="student-code" type="number" name="student-code" autofocus>
      </div>
      <button class="submit" type="submit" value="students" for="form-students" name="rol"> Ingresar </button>
    </form>
    <form class="form" id="form-professores" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" hidden>
      <div class="control">
        <label class="control__label" for="professor-code">Código</label>
        <input class="control__input" id ="professor-code" type="number" name="professor-code" autofocus>
      </div>
      <button class="submit" type="submit" value="professores" for="form-professores" name="rol"> Ingresar </button>
    </form>
  </div>

  <?php include "../partials/HTML/footer/footer.php"; ?>

  <script src="./scripts/main.js"></script>
</body>
</html>
