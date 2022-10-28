<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
	<link rel="icon" type="image/png" href="../img/LoanBooks_icon.svg">
    <title>~LoanBooks~ | Sesión</title>
</head>
<body>

    <?php include '../partials/HTML/header/header.php'; ?>

    <?php include '../partials/HTML/nav/nav.php'; ?>
    
    <div class="mainbox">
            <center>
                <button class="mainselect" id="librarianbtn" onclick="ChangeLibrarian()">Bibliotecario</button>
                <button class="mainselect" id="professorbtn" onclick="ChangeProfessor()">Profesor</button>
                <button class="mainselect" id="studentbtn" onclick="ChangeStudent()">Estudiante</button>
            </center>
        <div class="libform-box">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" method="post" name="librarian-form">
            <div class="insideform">
            <label for="" name="mail">Correo electrónico</label>
            <br>
            <input type="text" class="input">
            <br>
            <label for="" name="password">Contraseña</label>
            <br>
            <input type="password" class="input">
            <br>
            <input type="submit" id="sbmbtn" name="submit" value="Ingresar">
            </div>
            </form>
        </div>
        <div class="std-form-box">
            <form action="" method="post" name="student-form">

            </form>
        </div>
    </div>

    <?php include "../partials/HTML/footer/footer.php"; ?>

    <script src="scripts/mainjs"></script>
</body>
</html>