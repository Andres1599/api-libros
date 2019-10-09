<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/articulos.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$articulos = new Articulos($db);

try {
    //llamo todos los complementos del articulo para poder presentarlo en la lista
    $stmt = $articulos->getMaxArticulo();

    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($row);

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>