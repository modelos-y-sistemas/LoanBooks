<?php

class students{
  //Deficición de las propiedades del objeto
  public $id_student;
  public $name;
  public $surname;
  public $code;
  public $dni;
  public $phone;
  public $id_course;
  //constructor
  public function __construct($id_student, $name, $surname, $code, $dni, $phone, $id_course){
    $this->id_student = $id_student;
    $this->name = $name;
    $this->surname = $surname;
    $this->code = $code;
    $this->dni = $dni;
    $this->phone = $phone;
    $this->id_course = $id_course;
  }

  public static function get($key, $value){
  
    require '../datos/datos.php';
  
    $student_record = datos::queryExecutor("SELECT * FROM `students_t` WHERE `$key` = '$value'");
  
    // si queryExecutor no es null devuelve los registro sino retorna null
    return (isset($student_record)) ? $student_record : null;
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
