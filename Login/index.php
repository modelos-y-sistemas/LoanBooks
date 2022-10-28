<?php
//Esto es uan base para adelantar el trabajo, aun requiere muchas mejoras y validaciones

if($_POST){
  
  switch ($_POST['submit']) {
    case 'librarian':
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
        session_start();
        $_SESSION['librarian'] = $librarian;
        
        //envio al usuario que acaba de iniciar session a Buscar-y-Recibir
        header("Location: ../Buscar-y-Recibir");
        
      }
      else{ echo "Email o password incorrectos"; }
      break;
    
    case 'student':
      
      break;
    case 'professor':
    
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
    <link rel="stylesheet" href="styles/main.css">
	<link rel="icon" type="image/png" href="../img/LoanBooks_icon.svg">
    <title>~LoanBooks~ | Sesión</title>
</head>
<body>
<<<<<<< HEAD

    <?php include '../partials/HTML/header/header.php'; ?>

    <?php include '../partials/HTML/nav/nav.php'; ?>
    
    <div class="mainbox">
            <center>
                <button class="mainselect" id="librarianbtn" onclick="ChangeLibrarian()">Bibliotecario</button>
                <button class="mainselect" id="professorbtn" onclick="ChangeProfessor()">Profesor</button>
                <button class="mainselect" id="studentbtn" onclick="ChangeStudent()">Estudiante</button>
            </center>
        <div class="libform-box">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="librarian-form">
            <div class="insideform">
            <label for="email">Correo electrónico</label>
            <br>
            <input type="email" class="input"  name="email">
            <br>
            <label for="password">Contraseña</label>
            <br>
            <input type="password" class="input" name="password">
            <br>
            <input type="submit" id="sbmbtn" name="submit" value="Ingresar">
            </div>
            </form>
        </div>
        <div class="std-form-box">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="professor-form">

            </form>
        </div>
        <div>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="student-form"></form>
        </div>
    </div>

    <?php include "../partials/HTML/footer/footer.php"; ?>

    <script src="scripts/mainjs"></script>
</body>
</html>