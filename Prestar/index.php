<?php

require '../class/librarians.php';

session_start();
if(isset($_SESSION['librarians'])){
  $librarian = $_SESSION['librarians'];
}
else{
  header("location: ../");
}

echo $librarian->toString();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Home | EESTN°5</title>
  
  <link rel="stylesheet" href="https://localhost/LoanBooks/partials/generic.css">
  <link rel="stylesheet" href="./styles/main.css">

  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/favicon.jpg" type="image/x-icon">
</head>
<body>
  <a href="../partials/logout.php">
    <button> salir </button>
  </a>
</body>
</html>
