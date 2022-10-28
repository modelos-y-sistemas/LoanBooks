<?php

class professors{
  //Deficición de las propiedades del objeto
  public $code;
  public $name;
  public $surname;
  public $dni;
  public $phone;
  //constructor
  public function __construct($code, $name, $surname, $dni, $phone){
    $this->code = $code;
    $this->name = $name;
    $this->surname = $surname;
    $this->dni = $dni;
    $this->phone = $phone;
  }

  public static function get($key, $value){
  
    require '../datos/datos.php';
  
    $professors = datos::queryExecutor("SELECT * FROM `professors_t` WHERE `$key` = '$value'");
  
    // si queryExecutor no es null devuelve los registro sino retorna null
    return (isset($professors)) ? $professors_record : null;
    }
  
  public function toString(){
    
    $result = "";
    
    foreach ($this as $key => $property) {
      $result .= $key . ": ". $property . "<br>";
    }
  
    return $result;
  }
}

?>
