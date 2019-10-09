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

$sub = new Subscripcion($db);

try {
    echo json_encode($sub->getTipoSub());
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>