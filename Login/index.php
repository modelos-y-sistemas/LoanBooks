<?php
$input_Email=$_POST['email'];
$input_Password=$_POST['password'];

require_once "../class/librarians.php";
$librarian=librarians::get("email", $input_Email);
if($librarian->password==$input_Password){
  $_SESSION['user_id']=$librarian->id_librarian;
  header("Location: ../Home");
}
//echo $librarian->name;
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
    <label for="email">email</label>
    <input type="email" name="email" id="email">
    <label for="password">password</label>
    <input type="password" name="password" id="password">
    <button type="submit">Bibliotecario Login</button>
  </form>
</body>
</html>
