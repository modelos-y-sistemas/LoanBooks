<?php

$server = 'localhost';
$database = 'loan_books';
$username = 'root';
$password = '123456789';

try{
  $connection = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
  die('Conexión a Base de Datos Fallida. <br> Mensaje: ' . $e->getMessage());
}
