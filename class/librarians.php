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

    $librarian_record = datos::queryExecutor("SELECT * FROM `librarians_t` WHERE `$key` = '$value'");

    // si queryExecutor no es null devuelve los registro sino retorna null
    return (isset($librarian_record)) ? $librarian_record : false;
  }

  public function signup(){
    
    require_once '../datos/datos.php';
    //Hasheando la password
    $password_hashed=password_hash($this->password, PASSWORD_BCRYPT);
    //se inserta el nuevo bibliotecario en la base de datos
    $query = "INSERT INTO librarians_t (`name`, `surname`, `dni`, `email`, `password`) VALUES ('$this->name', '$this->surname', '$this->dni', '$this->email', '$password_hashed')";
    //echo $query;
    datos::queryExecutor($query);

  }

  public function toString(){
    
    $result = "";
    
    foreach ($this as $property => $value) {
      $result .= $property . ": ". $value . "<br>";
    }

    return $result;
  }

  public function find_professors($professor_code, $professor_name, $professor_surname, $professor_dni, $professor_phone, $book_name, $book_category, $book_start_order, $book_end_order){
    require_once "../datos/datos.php";
    $query = "
      SELECT
        CONCAT(`professors_t`.`name`, ' ', `professors_t`.`surname`) AS 'Nombre y Apellido',
        `orders_t`.`book` AS 'Libro',
        `orders_t`.`category` AS 'Categoría',
        `orders_t`.`total` AS 'Cantidad',
        `orders_t`.`start_order` AS 'Fecha de Egreso',
        `orders_t`.`end_order` AS 'Fecha de Regreso',
        CASE WHEN (`orders_t`.`returned` = 0) THEN 'NO'
          ELSE 'SI'
        END AS 'Devuelto',
        `librarians_t`.`name` AS 'Bibliotecarie'
      FROM `orders_t`
        INNER JOIN `librarians_t`
          ON `orders_t`.`id_librarian` = `librarians_t`.`id_librarian`
        INNER JOIN `professors_t`
          ON `orders_t`.`id_professor` = `professors_t`.`id_professor`
      WHERE ";

    $filtered = false;
    
    if($professor_code != ""){
      $query .= "`professors_t`.`code` = '" . $professor_code . "' AND ";
      $filtered = true;
    }
    if($professor_name != ""){
      $query .= "`professors_t`.`name` LIKE '%" . $professor_name . "%' AND ";
      $filtered = true;
    }
    if($professor_surname != ""){
      $query .= "`professors_t`.`surname` LIKE '%" . $professor_surname . "%' AND ";
      $filtered = true;
    }
    if($professor_dni != ""){
      $query .= "`professors_t`.`dni` = '" . $professor_dni . "' AND ";
      $filtered = true;
    }
    if($professor_phone != ""){
      $query .= "`professors_t`.`phone` = '" . $professor_phone . "' AND ";
      $filtered = true;
    }
    
    if($book_name != ""){
      $query .= "`orders_t`.`book` LIKE '%" . $book_name . "%' AND ";
      $filtered = true;
    }
    if($book_category != ""){
      $query .= "`orders_t`.`category` LIKE '%" . $book_category . "%' AND ";
      $filtered = true;
    }
    if($book_start_order != ""){
      $query .= "`orders_t`.`start_order` LIKE '" . $book_start_order . "%' AND ";
      $filtered = true;
    }
    if($book_end_order != ""){
      $query .= "`orders_t`.`end_order` LIKE '" . $book_end_order . "%' AND ";
      $filtered = true;
    }
    
    $query = !$filtered ? $query . "1" : substr($query, 0, strlen($query) - 5);
    $records = datos::queryExecutor($query, true);
    
    return $records;
  }
  
  public function find_students($student_code, $student_name, $student_surname, $student_dni, $student_phone, $student_course, $book_name, $book_category, $book_start_order, $book_end_order){
    require_once "../datos/datos.php";
    $query = "
      SELECT
        CONCAT(`students_t`.`name`, ' ', `students_t`.`surname`) AS 'Nombre y Apellido',
        `orders_t`.`book` AS 'Libro',
        `orders_t`.`category` AS 'Categoría',
        `orders_t`.`total` AS 'Cantidad',
        CONCAT(`courses_t`.`year`, '° ', `courses_t`.`division`, '° ',
          CASE
            WHEN (modality = 1) THEN 'INFORMATICA'
            ELSE
              CASE
                WHEN (modality = 2) THEN 'TURISMO'
                ELSE
                  CASE
                    WHEN (modality = 3) THEN 'ALIMENTOS'
                    ELSE
                      CASE
                        WHEN (modality = 0) THEN 'CICLO BASICO'
                        ELSE NULL
                      END
                  END
              END
          END)
        AS 'Curso',
        `orders_t`.`start_order` AS 'Fecha de Egreso',
        `orders_t`.`end_order` AS 'Fecha de Regreso',
        CASE
          WHEN (`orders_t`.`returned` = 0)
            THEN 'NO'
          ELSE 'SI'
        END AS 'Devuelto',
        `librarians_t`.`name` AS 'Bibliotecarie'
      FROM `orders_t`
        INNER JOIN `librarians_t`
          ON `orders_t`.`id_librarian` = `librarians_t`.`id_librarian`
        INNER JOIN `students_t`
          ON `orders_t`.`id_student` = `students_t`.`id_student`
        INNER JOIN `courses_t`
          ON `students_t`.`id_course` = `courses_t`.`id_course`
      WHERE ";

    $filtered = false;
    
    if($student_code != ""){
      $query .= "`students_t`.`code` = '" . $student_code . "' AND ";
      $filtered = true;
    }
    if($student_name != ""){
      $query .= "`students_t`.`name` LIKE '%" . $student_name . "%' AND ";
      $filtered = true;
    }
    if($student_surname != ""){
      $query .= "`students_t`.`surname` LIKE '%" . $student_surname . "%' AND ";
      $filtered = true;
    }
    if($student_dni != ""){
      $query .= "`students_t`.`dni` = '" . $student_dni . "' AND ";
      $filtered = true;
    }
    if($student_phone != ""){
      $query .= "`students_t`.`phone` = '" . $student_phone . "' AND ";
      $filtered = true;
    }
    if($student_course != -1){
      $query .= "`students_t`.`id_course` = '" . $student_course . "' AND ";
      $filtered = true;
    }
    
    if($book_name != ""){
      $query .= "`orders_t`.`book` LIKE '%" . $book_name . "%' AND ";
      $filtered = true;
    }
    if($book_category != ""){
      $query .= "`orders_t`.`category` LIKE '%" . $book_category . "%' AND ";
      $filtered = true;
    }
    if($book_start_order != ""){
      $query .= "`orders_t`.`start_order` LIKE '" . $book_start_order . "%' AND ";
      $filtered = true;
    }
    if($book_end_order != ""){
      $query .= "`orders_t`.`end_order` LIKE '" . $book_end_order . "%' AND ";
      $filtered = true;
    }
    
    $query = !$filtered ? $query . "1" : substr($query, 0, strlen($query) - 5);
    $records = datos::queryExecutor($query, true);
    
    return $records;
  }
}
