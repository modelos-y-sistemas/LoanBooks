<?php

//accedo a la clase librarians
require '../class/librarians.php';

session_start();
if(!isset($_SESSION['librarians'])){
    header("location: ../");
}

//Verifico si lo recibido es por metodo post
if($_POST){
    if(isset($_POST['sbmtmod'])&&isset($_POST['email'])){
        $_SESSION['librarians']->Modify("email", $_POST['email']);
        if($_POST['password']!=""){
            //Hasheando la password
            $password_hashed=password_hash($_POST['password'], PASSWORD_BCRYPT);

            $_SESSION['librarians']->Modify("password", $password_hashed);
        }
        $librarian=librarians::get("id_librarian", $_SESSION['librarians']->id);
        $_SESSION['librarians']=new librarians($librarian->id_librarian, $librarian->name, $librarian->surname, $librarian->dni, $librarian->email, $librarian->password);
    }
    if(isset($_POST['del'])){
        echo "hola";
        $_SESSION['librarians']->Delete();
        session_unset();

        session_destroy();

        header('Location: ../');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/LoanBooks_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="./styles/main.css">

    <script src="scripts/index.js"></script>
    
    <link rel="stylesheet" href="https://localhost/LoanBooks/partials/generic.css">

    <title>Configuracion de cuenta</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- bootstrap -->
</head>
<body style="display:grid; justify-items: center;">
    <?php include '../partials/HTML/nav/nav.php' ?>

    <form class="row g-3 p-5 m-5" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
        <h2>Modificacion de datos</h2>
        <div class="col-md-6">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" value="<?php echo $_SESSION['librarians']->name;?>" readonly>
        </div>
        <div class="col-md-6">
        <label for="surname" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="surname" value="<?php echo $_SESSION['librarians']->surname;?>" readonly>
        </div>
        <div class="col-md-6">
        <label for="dni" class="form-label">D.N.I</label>
        <input type="text" class="form-control" id="dni" value="<?php echo $_SESSION['librarians']->dni;?>" readonly>
        </div>
        <div class="col-md-6">
        <label for="email" class="form-label">Email (Modificable)</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo $_SESSION['librarians']->email;?>">
        </div>
        <div class="col-md-12">
        <label for="password" class="form-label">Contraseña (Modificable)</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Nueva Contraseña">
        </div>
        
        <div class="col-12">
        <button type="submit" class="btn btn-primary" name="sbmtmod" value="librarian">Modificar datos</button>
        </div>
    </form>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="mod">
        <h2>Eliminar cuenta</h2>
        <div class="col-12">
        <input type="hidden" name="del" value="Delete">
        <button type="button" onclick="confirmar()" class="btn btn-primary" id="delete" name="sbmtdel" value="Delete">Eliminar cuenta</button>
        </div>
    </form>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script> 
    <!-- bootstrap -->
</body>
</html>