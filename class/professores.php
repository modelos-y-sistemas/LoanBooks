<?php

class professores{
  
  public $id_professor;
  public $name;
  public $surname;
  public $code;
  public $dni;
  public $phone;
  
  public function __construct($id_professor, $name, $surname, $code, $dni, $phone){
    $this->id_professor = $id_professor;
    $this->name = $name;
    $this->surname = $surname;
    $this->code = $code;
    $this->dni = $dni;
    $this->phone = $phone;
  }

  public static function get($key, $value){
  
    require_once '../datos/datos.php';
  
    $professor_record = datos::queryExecutor("SELECT * FROM `professores_t` WHERE `$key` = '$value'");
  
    // si queryExecutor no es null devuelve los registro sino retorna null
    return (isset($professor_record)) ? $professor_record : null;
  }
  
  public function toString(){
    
    $result = "";
    
    foreach ($this as $property => $value) {
      $result .= $property . ": ". $value . "<br>";
    }
  
    return $result;
  }
}

?>
