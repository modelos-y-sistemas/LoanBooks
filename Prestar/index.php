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
