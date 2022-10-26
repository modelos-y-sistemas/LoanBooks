<?php
class datos{
  public static function queryExecutor($query){
    require '../dataBase/database.php'; // para obtener la variable connection

    $stmt = $connection->prepare($query);
    $stmt->execute();
    
    // la funcion fetchAll devuelve un arreglo de registros
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);

    // en cambio la funcion fetch, a secas (sin 'All'), devuelve solo un registro por mas
    // que la query devuelva mas de uno, ira por el primero.
    
    // dependiendo de la query, las funciones fetch o fetchAll van a retornar algo o null.
    // para las query de UPDATE y DELETE por ejemplo retornan null.

    mysqli_close($connection);

    //Devuelve el objeto de la query si es que devuelve
    return $records;
  }
}
