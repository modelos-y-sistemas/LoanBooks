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
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Login | EESTN°5</title>

  <link rel="stylesheet" href="https://localhost/LoanBooks/partials/generic.css">
  <link rel="stylesheet" href="./styles/main.css">

  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/favicon.jpg" type="image/x-icon">
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
      <div class="control">
        <label for="email">email</label>
      <input type="email" name="email" id="email">
    </div>
    <div class="control">
      <label for="password">password</label>
      <input type="text" name="password" id="password">
    </div>
    <button type="submit" name="submit" value="librarian">Bibliotecario Login</button>
  </form>  
</body>
</html>
