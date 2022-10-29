<?php

require '../class/librarians.php';

session_start();
if(isset($_SESSION['librarian'])){
  $librarian = $_SESSION['librarian'];
}
else{
  header("location: ../");
}

echo $librarian->toString();
