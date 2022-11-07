<?php

require '../class/librarians.php';

session_start();
//unset($_SESSION['user_record']);
if(isset($_SESSION['librarians'])){
  $librarian = $_SESSION['librarians'];
}
else{
  header("location: ../");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Prestar | EESTN°5</title>
  
  <link rel="stylesheet" href="style/main.css">

  <link rel="shortcut icon" href="https://localhost/LoanBooks/img/LoanBooks_icon.svg" type="image/x-icon">

  <script src="js/index.js"></script>

  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
  />
  <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
      crossorigin="anonymous"
  ></script>

</head>
<body style="display:grid; justify-items: center;">

  <?php include '../partials/HTML/nav/nav.php' ?>
  
  <section style="display: grid; justify-items: center;" class="container-section">
    
    <div class="user-name" id="user-name">¡Hola, <?= $librarian->name ?>! :)</div>
    <h1 class="title">Prestar Libros</h1>
    
    <article class="container-form-register">
    </article>
    <article>
      
      <form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="container-inputs">
        <div class="box-inputs">
          <div class="box-input-1">
            <h2 class="title-option-1">Alumno</h2>
            <input type="radio" name="debtor" value="Alumno" id="Alumno" checked>
          </div>
          <div class="box-input-1">
            <h2 class="title-option-1">Profesor</h2>
            <input type="radio" name="debtor" value="Profesor" id="Profesor">
          </div>
          <div class="box-input-1">
            <h2 class="title-option-1">Codigo</h2>
            <input type="text" name="Codigo" id="code" placeholder="Codigo" required>
          </div>
        </div>
        <input type="submit" name="sbmt_SearchUser" class="btni" value="Buscar">
      </form>
<?php
//Registra el nuevo estudiante
if(isset($_POST['register'])&&$_POST['register']=='register-student'&&isset($_POST['Curso'])){
  require_once '../class/students.php';

  if(!isset(students::get_course("id_course", $_POST['Curso'])->year)){
    echo "¡Ingrese los datos correctamente!";
    return 0;
  }

  $student=new students(0, $_POST['name'], $_POST['surname'], $_SESSION['code'], $_POST['dni'], $_POST['phone'], $_POST['Curso']);

  $student->signup();

  $_SESSION['user_record']=students::get("code",$_SESSION['code']);
  $_SESSION['debtor']='Alumno';

  echo "<script>location.href='https://localhost/LoanBooks/Prestar/';</script>";
}
//Registra el nuevo profesor
if(isset($_POST['register'])&&$_POST['register']=='register-professor'){
  require_once '../class/professors.php';

  $profesor=new professors(0, $_POST['name'], $_POST['surname'], $_SESSION['code'], $_POST['dni'], $_POST['phone']);

  $profesor->signup();

  $_SESSION['user_record']=professors::get("code",$_SESSION['code']);
  $_SESSION['debtor']='Profesor';

  echo "<script>location.href='https://localhost/LoanBooks/Prestar/';</script>";
}
//Busca al usuario y lo alamacena en $user_record
if(isset($_POST['sbmt_SearchUser'])&&isset($_POST['debtor'])&&isset($_POST['Codigo'])){
  switch($_POST['debtor']){
    case 'Alumno':
      require_once '../class/students.php';
      $_SESSION['user_record']=students::get("code",$_POST['Codigo']);
      $_SESSION['debtor']='Alumno';
      break;
    case 'Profesor':
      require_once '../class/professors.php';
      $_SESSION['user_record']=professors::get("code",$_POST['Codigo']);
      $_SESSION['debtor']='Profesor';
      break;
    default:
      echo "Selecciona una opcion";
      break;
  }
}
//Realiza el pedido
if(isset($_SESSION['user_record']->name)&&isset($_SESSION['debtor'])&&isset($_POST['category'])&&isset($_POST['name'])&&isset($_POST['total'])&&isset($_POST['loan'])){
  require_once '../class/loans.php';

  $loan=new loans(0, $_POST['name'], $_POST['category'], $_POST['total'], date('Y-m-d H:i:s'), '1001-01-01 01:01:01', 0, $_SESSION['user_record'], $librarian);

  $loan->new_loan($_SESSION['debtor']);

  echo "<script>location.href='https://localhost/LoanBooks/Prestar/';</script>";
}
//si $user_record existe entonces coloca el formulario para realizar pedidos
if(isset($_SESSION['user_record']->name)){
  echo '<h6 class="title-option-1">Categoria: '.$_SESSION['debtor'].'</h6><br><h6 class="title-option-1">Nombre y Apellido: '.$_SESSION['user_record']->name.' '.$_SESSION['user_record']->surname.'</h6><br><h6 class="title-option-1">Codigo: '.$_SESSION['user_record']->code.'</h6>';
  echo '<form style="width: 500px;" action="'.$_SERVER['PHP_SELF'].'" method="post" class="container-inputs">
  <div class="box-inputs">
    <div class="box-input-1">
      <h2 class="title-option-1">Libro</h2>
      <input type="text" placeholder="Categoria" name="category">
      <input type="text" placeholder="Nombre" name="name">
      <input type="text" placeholder="Cantidad" name="total">
    </div>
  </div>
  <button type="submit" class="btni" name="loan">Prestar</button>
  </form>';
}
//Si el usuario no existe entonces coloca el formulario para que rellene los datos del estudiante/profesor
if(isset($_POST['sbmt_SearchUser'])&&!isset($_SESSION['user_record']->name)){
  $_SESSION['code']=$_POST['Codigo'];
  if($_SESSION['debtor']=='Alumno'){
    echo '<h6 class="title-option-1">NO EXISTE EL ESTUDIANTE POR FAVOR REGISTRELO</h6>';
    echo '
    <article class="container-form-register">
      <form action="'.$_SERVER['PHP_SELF'].'" method="post" class="container-inputs">
        <h2 class="title-option-1"> Alumne </h2>
        <div class="inputs">
          <input type="text" value="Codigo: '. $_POST['Codigo'].'" readonly">
          <input type="text" placeholder="Nombre" name="name">
        </div>
        <div class="inputs">
          <input type="text" placeholder="Apellido" name="surname">
          <input type="text" placeholder="DNI" name="dni">
        </div>
        <div class="inputs">
          <input type="text" placeholder="Telefono" name="phone">
          <select name="Curso" id="Curso">
            <option value="1">1°1</option>
            <option value="2">1°2</option>
            <option value="3">1°3</option>
            <option value="4">1°4</option>
            <option value="5">2°1</option>
            <option value="6">2°2</option>
            <option value="7">3°1</option>
            <option value="8">3°2</option>
            <option value="9">4°1 Informatica</option>
            <option value="11">4°1 Turismo</option>
            <option value="12">4°1 Alimentos</option>
            <option value="13">4°2 Informatica</option>
            <option value="14">5°1 Informatica</option>
            <option value="16">5°1 Turismo</option>
            <option value="15">5°2 Informatica</option>
            <option value="18">6°1 Informatica</option>
            <option value="20">6°1 Turismo</option>
            <option value="21">6°1 Alimentos</option>
            <option value="19">6°2 Informatica</option>
            <option value="22">7°1 Informatica</option>
            <option value="23">7°1 Turismo</option>
            <option value="24">7°1 Alimentos</option>
            <option value="25">7°2 Informatica</option>
          </select>
        </div>
        <button type="submit" class="btni" value="register-student" name="register">Registrar</button>
      </form>
      </article>
      ';
  }
  else{
    echo '<h6 class="title-option-1">NO EXISTE EL PROFESOR POR FAVOR REGISTRELO</h6>';
    echo '
    <article class="container-form-register">
    <form action="'.$_SERVER['PHP_SELF'].'" method="post" class="container-inputs">
        <h2 class="title-option-1"> Profesore </h2>
        <div class="inputs">
          <input type="text" value="Codigo: '. $_POST['Codigo'].'" readonly>
          <input type="text" placeholder="Nombre" name="name">
        </div>
        <div class="inputs">
          <input type="text" placeholder="Apellido" name="surname">
          <input type="text" placeholder="DNI" name="dni">
        </div>
        <div class="inputs">
          <input type="text" placeholder="Telefono" name="phone">
        </div>
        <button type="submit" class="btni" value="register-professor" name="register">Registrar</button>
      </form>
      </article>
    ';
  }
}
?>
    </article>
  </section>
</body>
</html>
