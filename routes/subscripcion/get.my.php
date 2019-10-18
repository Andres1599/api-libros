<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/subscripcion.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$cat = new Subscripcion($db);

try {
    // get data
    $data = json_decode(file_get_contents("php://input"));
    // set data
    $cat->fk_id_usuario = $data->id;
    // realizo el query
    $stmt = $cat->getMySubscripcion();

    // retorno un json
    echo json_encode($stmt[0]);

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>