<?php

class librarianes{
  
  private $id;
  private $name;
  private $surname;
  private $dni;
  private $emali;
  private $password;
  
  public function __construct($id = 0, $name = "n/n", $surname = "n/n", $dni = 0, $email = "nn@nn.com", $password = "n/n"){
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
    $this->dni = $dni;
    $this->emali = $emali;
    $this->password = $password;
  }
  
  public static function get($key, $value){
    
    require '../datos/datos.php';

    $librarian_record = datos::queryExecutor("SELECT * FROM `librarianes_t` WHERE `$key` = '$value'");

    // si queryExecutor no es null devuelve los registro sino retorna null
    return (isset($librarian_record)) ? $librarian_record : null;
  }

}
