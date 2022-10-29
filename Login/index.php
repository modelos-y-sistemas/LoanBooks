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
  
  switch ($_POST['submit']) {
    case 'submitlbn':
      //accedo a la clase librarians
      require "../class/librarians.php";
      
      //obtencion de los datos del formulario de login de bibliotecario
      $input_email = $_POST['email'];
      $input_password = $_POST['password'];
      $librarian_record = null;

      //obtengo el bibliotecario por su email 
      $librarian_record = librarians::get("email", $input_email);
      
      //lo valido con su contraseña (Esto deberia ser con password_verify pero falta encriptar la contraseña)
      if($librarian_record && $librarian_record->password == $input_password){
        
        $librarian = new librarians($librarian_record->id_librarian, $librarian_record->name, $librarian_record->surname, $librarian_record->dni, $librarian_record->email, $librarian_record->password);
        
        //almaceno la variable de session user_id
        $_SESSION['librarian'] = $librarian;
        
        //envio al usuario que acaba de iniciar session a Buscar-y-Recibir
        header("Location: ../Buscar-y-Recibir");
        
      }
      else{ echo "Email o contraseña incorrectos"; }

      break;
    case 'student':
      
      break;

    case 'submitstd':
      
      require "../class/students.php";

      $input_code = $_POST['stdcod'];
      
      $student_record = students::get("code",$input_code);

      if($students_record == $input_code){

        $student = new students($student_record->id_student, $student_record->name, $student_record->surname, $student_record->code, $student_record->dni, $student_record->phone, $student_record->id_course);

        session_start();
        $SESSION['student'] = $student;

        header("Location: ../Buscar-y-Recibir");
      }

      else{ echo "Clave incorrecta o estudiante no encontrado"; }
      
      break;
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
            <center>
                <button class="mainselect" id="librarianbtn" onclick="ChangeLibrarian()">Bibliotecario</button>
                <button class="mainselect" id="professorbtn" onclick="ChangeProfessor()">Profesor</button>
                <button class="mainselect" id="studentbtn" onclick="ChangeStudent()">Estudiante</button>
            </center>
                      <h1 class="Message">IDENTIFÍQUESE</h1>
        <div class="lib-form-box">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="librarian-form">
            <div class="insideform">
              <label for="email">Correo electrónico</label>
              <br>
              <input type="email" class="input"  name="email">
              <br>
              <div id="password-box">
              <label for="password">Contraseña</label>
              <br>
              <input type="password" class="input" name="password">
              </div>
              <input type="submit" class="sbmbtn" name="submitlbn" value="Ingresar">
            </div>
            </form>
        </div>
        <div class="pfs-form-box">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="professor-form">
            <div class="insideform">
              <label for="cod">Clave de ingreso de profesor</label>
              <br>
              <input type="text" class="input" name="pfscod">
              <br>
              <input type="submit" class="sbmbtn" id="sbm-2" name="submitpfs" value="Ingresar">
            </div>
            </form>
        </div>
        <div class="std-form-box">
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="student-form">
            <div class="insideform">
              <label for="cod">Clave de ingreso de estudiante</label>
              <br>
              <input type="text" class="input" name="stdcod">
              <br>
              <input type="submit" class="sbmbtn" id="sbm-3" name="submitstd" value="Ingresar">
            </div>
          </form>
        </div>
    </div>

  <?php include "../partials/HTML/footer/footer.php"; ?>

    <script src="scripts/main.js"></script>
</body>
</html>
