<?php

session_start();
$rols = ['librarians', 'professors', 'students'];

if($_SESSION)
{
  $paths = ['https://localhost/LoanBooks/Prestar', 'https://localhost/LoanBooks/Mis-Pendientes', 'https://localhost/LoanBooks/Mis-Pendientes'];
  
  foreach ($rols as $key => $rol) {
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
  
  $rol = $_POST['rol'];
  
  if (!in_array($rol, $rols)) die('Rol invalido');
  
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
      if($librarian_record && password_verify($input_password, $librarian_record->password)/*$librarian_record->password == $input_password*/)
      {
        $librarian = new librarians($librarian_record->id_librarian, $librarian_record->name, $librarian_record->surname, $librarian_record->dni, $librarian_record->email, $librarian_record->password);
        
        //almaceno la variable de session user_id
        $_SESSION['librarians'] = $librarian;
        
        //envio al usuario que acaba de iniciar session a Buscar-y-Recibir
        header("Location: ../Buscar-y-Recibir");
      }
      else { echo "Email o password incorrectos"; }

      break;
    }
      
    case "students":
    {
      $student_code = $_POST['student-code'];
      $student_record = students::get("code", $student_code);

      if($student_record){
        $student = new students($student_record->id_student, $student_record->name, $student_record->surname, $student_record->code, $student_record->dni, $student_record->phone, $student_record->id_course);
        
        $_SESSION['students'] = $student;      
        
        header("Location: ../Mis-Pendientes");
      }
      else{
        echo "Código incorrecto";
      }

      break;
    }
      
    case 'professors':
    {
      $professor_code = $_POST['professor-code'];
      $professor_record = professors::get("code", $professor_code);
      
      if($professor_record){

        $professor = new professors($professor_record->id_professor, $professor_record->name, $professor_record->surname, $professor_record->code, $professor_record->dni, $professor_record->phone);
        
        $_SESSION['professors'] = $professor;
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
  
  <? //Llamado de componentes de la interfaz de la página en diferentes ubicaciones?>

  <?php include '../partials/HTML/header/header.php'; ?>
  
  <div class="mainbox">
    
  <? //Botones de control de la interfaz del inicio de sesión ?>  
    
    <center>
      <button class="mainselect" id="librarianbtn" onclick="ChangeLibrarian()">Bibliotecario</button>
      <button class="mainselect" id="professorbtn" onclick="ChangeProfessor()">Profesor</button>
      <button class="mainselect" id="studentbtn" onclick="ChangeStudent()">Estudiante</button>
    </center>
    
    <h1 class="Message">IDENTIFÍQUESE</h1>
    
    <div class="lib-form-box">
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="librarian-form">
      <? //Programando el tipo de acción (method) del formulario, en este caso post" ?>

      <? //Formulario de bibliotecario ?>
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
          <button type="submit" class="sbmbtn" name="rol" value="librarians">
            Ingresar
          </button>
        </div>
      </form>
    </div>
    <? //Formulario de profesor ?>
    <div class="pfs-form-box">
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="professor-form">
        <div class="insideform">
          <label for="cod">Clave de ingreso de profesor</label>
          <br>
          <input type="text" class="input" name="professor-code">
          <br>
          <button type="submit" class="sbmbtn" name="rol" value="professors">
            Ingresar
          </button>
        </div>
      </form>
    </div>
    <? //Formulario de estudiante ?>
    <div class="std-form-box">
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="student-form">
      <div class="insideform">
        <label for="cod">Clave de ingreso de estudiante</label>
        <br>
        <input type="text" class="input" name="student-code">
        <br>
        <button type="submit" class="sbmbtn" id="sbm-3" name="rol" value="students">
          Ingresar
        </button>
      </div>
      </form>
    </div>
  </div>
  
  <? //Llamado al footer como archivo independiente en otra ubicación ?>

  <?php include "../partials/HTML/footer/footer.php"; ?>

  <script src="scripts/main.js"></script>
</body>
</html>
