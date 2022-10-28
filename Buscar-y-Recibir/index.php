<?php

  require '../class/librarians.php';

  session_start();
  $librarian = $_SESSION['librarian'];

  $librarian_record = librarians::get("id_librarian", $librarian->id);
  
  if ($librarian_record != false){
    $librarian = new librarians($librarian_record->id_librarian, $librarian_record->name, $librarian_record->surname, $librarian_record->dni, $librarian_record->email, $librarian_record->password);
    
    echo $librarian->toString();

  }

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
  
</body>
</html>
