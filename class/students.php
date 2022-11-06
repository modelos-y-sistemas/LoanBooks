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

  public function signup(){
    
    require_once '../datos/datos.php';
    //se inserta el nuevo estudiante en la base de datos
    $query = "INSERT INTO students_t (`name`, `surname`, `code`, `dni`, `phone`, `id_course`) VALUES ('$this->name', '$this->surname', '$this->code', '$this->dni', '$this->phone', '$this->id_course')";
    echo $query;
    datos::queryExecutor($query);

  }
  
  public function toString(){
    
    $result = "";
    
    foreach ($this as $property => $value) {
      $result .= $property . ": ". $value . "<br>";
    }
  
    return $result;
  }

  public function get_pending_books(){
    
    require_once "../datos/datos.php";

    $query = "
    SELECT
      `orders_t`.`start_order` AS 'Fecha',
      `orders_t`.`book` AS 'Libro',
      `orders_t`.`total` AS 'Cantidad',
      `librarians_t`.`name` AS 'Bibliotecarie'
    FROM `orders_t` LEFT JOIN `librarians_t`
      ON `orders_t`.`id_librarian` = `librarians_t`.`id_librarian`
    WHERE `orders_t`.`id_student` = '$this->id_student' AND `orders_t`.`returned` = '0'
    ";

    return datos::queryExecutor($query, true);
  }
}

?>
