<?php
class datos{
  
  public static function queryExecutor($query, $result = false){

    require '../dataBase/database.php'; // para obtener la variable connection

    try {
      $stmt = $connection->prepare($query);
      $stmt->execute();
      
      // la funcion fetchAll devuelve un arreglo de registros
      // en cambio la funcion fetch, a secas (sin 'All'), devuelve solo un registro por mas
      // que la query devuelva mas de uno, ira por el primero.
      // si no hay registros de la query, tanto fetchAll como fetch devuelve false.
  
      return ($result) ? $stmt->fetchAll(PDO::FETCH_OBJ) : $stmt->fetch(PDO::FETCH_OBJ);
    }
    catch (PDOException $e) {
      die('<strong>ERROR: Ejecución de la consulta fallida.</strong> <br> Mensaje: ' . $e->getMessage());
    }
    
    /*
      PDO::FETCH_OBJ especifica que el método fetch o fetchAll devolverá cada fila como un objeto
      con nombres de propiedad que correspondan a los nombres de columna devueltos en el conjunto
      de registros.
    */
    
    // dependiendo de la query, la funcion fetchAll van a retornar un arreglo.
    // para las query de UPDATE y DELETE por ejemplo retorna un arreglo vacio.
    // si es un SELECT devuelve un arrgelo de los registro que devuelve la query.
    // si el SELECT devulve solo un registro, sera un arreglo de un registro.

    // devuelve el objeto o un arreglo de objetos de la query (dependiendo de la misma)
    // si es que devuelve, sino sera false.
  }
}
