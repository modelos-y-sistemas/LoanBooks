<?php

class librarians{
  
  public $id;
  public $name;
  public $surname;
  public $dni;
  public $email;
  public $password;
  
  public function __construct($id = 0, $name = "n/n", $surname = "n/n", $dni = null, $email = "nn@nn.com", $password = "n/n"){
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
    $this->dni = $dni;
    $this->email = $email;
    $this->password = $password;
  }
  
  public static function get($key, $value){
    
    require '../datos/datos.php';

    $librarian_record = datos::queryExecutor("SELECT * FROM `librarianes_t` WHERE `$key` = '$value'");

    // si queryExecutor no es null devuelve los registro sino retorna null
    return (isset($librarian_record)) ? $librarian_record : null;
  }

  public function toString(){
    
    $result = "";
    
    foreach ($this as $key => $property) {
      $result .= $key . ": ". $property . "<br>";
    }

    return $result;
  }

}
