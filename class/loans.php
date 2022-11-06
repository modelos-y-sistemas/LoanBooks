<?php

class loans{
    //Deficición de las propiedades del objeto
    public $id_loan;
    public $book;
    public $category;
    public $total;
    public $start_order;
    public $end_order;
    public $returned;
    public $debtor;
    public $librarian;
    //constructor
    public function __construct($id_loan = 0, $book="n/n", $category="n/n", $total=0, $start_order="1000-01-01 00:00:00", $end_order="1000-01-01 00:00:00", $returned=0, $debtor=NULL, $librarian=NULL){
        $this->id_loan = $id_loan;
        $this->book = $book;
        $this->category = $category;
        $this->total = $total;
        $this->start_order = $start_order;
        $this->end_order = $end_order;
        $this->returned = $returned;
        $this->debtor = $debtor;
        $this->librarian = $librarian;
    }
    //devuelve el registro depende de con lo que lo solicite
    public static function get($key, $value){
  
        require '../datos/datos.php';
      
        $student_record = datos::queryExecutor("SELECT * FROM `orders_t` WHERE `$key` = '$value'");
      
        // si queryExecutor no es null devuelve los registro sino retorna null
        return (isset($loan_record)) ? $loan_record : null;
    }
    //ingresa un nuevo pedido a la base de datos
    public function new_loan($cat){

        require '../datos/datos.php';

        //se inserta el nuevo pedido en la base de datos
        $id_lib=$this->librarian->id;

        if($cat=='Alumno'){
            $cat=$this->debtor->id_student;
            $query = "INSERT INTO orders_t (`book`, `category`, `total`, `start_order`, `end_order`, `returned`, `id_student`, `id_librarian`) VALUES ('$this->book', '$this->category', '$this->total', '$this->start_order', '$this->end_order', '$this->returned', '$cat', '$id_lib')";
        }
        else{
            $cat=$this->debtor->id_professor;
            $query = "INSERT INTO orders_t (`book`, `category`, `total`, `start_order`, `end_order`, `returned`, `id_professor`, `id_librarian`) VALUES ('$this->book', '$this->category', '$this->total', '$this->start_order', '$this->end_order', '$this->returned', '$cat', '$id_lib')";
        }

        
        //$query = "INSERT INTO orders_t (`book`, `category`, `total`, `start_order`, `end_order`, `returned`, `id_student`, `id_librarian`) VALUES ('$this->book', '$this->category', '$this->total', '$this->start_order', '$this->end_order', '$this->returned', '$this->debtor->id_student', '$this->librarian')";
        //$query = "INSERT INTO orders_t (`book`, `category`, `total`, `start_order`, `end_order`, `returned`, `id_professor`, `id_librarian`) VALUES ('$this->book', '$this->category', '$this->total', '$this->start_order', '$this->end_order', '$this->returned', '$this->debtor->id_professor', '$this->librarian')";
        //echo $query;
        datos::queryExecutor($query);

    }
}
?>