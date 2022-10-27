<?php

class students{
    //Deficición de las propiedades del objeto
    public $number;
    public $name;
    public $surname;
    public $dni;
    public $phone;
    public $course;
    //constructor
    public function __construct($number, $name, $surname, $dni, $phone, $course){
        $this->number=$number;
        $this->name=$name;
        $this->surname=$surname;
        $this->dni=$dni;
        $this->phone=$phone;
        $this->course=$course;
    }

    public static function get($key, $value){
    
        require '../datos/datos.php';
    
        $students_record = datos::queryExecutor("SELECT * FROM `librarianes_t` WHERE `$key` = '$value'");
    
        // si queryExecutor no es null devuelve los registro sino retorna null
        return (isset($students_record)) ? $students_record : null;
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