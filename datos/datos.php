<?php
class datos{
    public static function queryExecutor($query){
        require '../DataBase/database.php'; // para obtener la variable conexion

        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $stmtobj=$stmt->fetchAll(PDO::FETCH_OBJ);
        
        //Devuelve el objeto de la query si es que devuelve
        return $stmtobj;
    }
}
?>