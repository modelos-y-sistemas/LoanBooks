<?php

class professors{
  
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
  
    $professor_record = datos::queryExecutor("SELECT * FROM `professors_t` WHERE `$key` = '$value'");
  
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
    WHERE `orders_t`.`id_professor` = '$this->id_professor' AND `orders_t`.`returned` = '0'
    ";

    return datos::queryExecutor($query, true);
  }
}
/*
array(2) {
  [0]=> object(stdClass)#4 (10)
  {
   
    ["id_order"]=> int(2)
   
    ["book"]=> string(8) "El Aleph"
    ["category"]=> string(10) "literatura"
    ["total"]=> int(20)
    ["start_order"]=> string(19) "2022-10-26 01:18:15"
    ["end_order"]=> string(19) "2022-10-27 00:00:00"
    ["returned"]=> int(0)
    ["id_student"]=> NULL
    ["id_professor"]=> int(1)
    ["id_librarian"]=> int(2)
  }
  [1]=> object(stdClass)#5 (10)
  {
    ["id_order"]=> int(5)
    ["book"]=> string(20) "Programacion Nivel 2"
    ["category"]=> string(12) "Programacion"
    ["total"]=> int(10)
    ["start_order"]=> string(19) "2022-10-26 16:58:27"
    ["end_order"]=> string(19) "2022-10-26 00:00:00"
    ["returned"]=> int(0)
    ["id_student"]=> NULL
    ["id_professor"]=> int(1)
    ["id_librarian"]=> int(2)
  }
}
*/
