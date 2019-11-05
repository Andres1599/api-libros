<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/publicidad.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

try {
    $publicidad = new Publicidad($db);

    // realizo el query
    $stmt = $publicidad->getAll();
    // retorno un json
    echo json_encode($stmt);

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>