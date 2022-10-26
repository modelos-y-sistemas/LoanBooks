<?php
class students{
    //Deficición de las propiedades del objeto
    private $number;
    private $name;
    private $surname;
    private $dni;
    private $phone;
    private $course;
    //constructor
    public function _construct($number, $name, $surname, $dni, $phone, $course){
        $this->number=$number;
        $this->name=$name;
        $this->surname=$surname;
        $this->dni=$dni;
        $this->phone=$phone;
        $this->course=$course;
    }
}
?>