<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/subscripcion.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$sub = new Subscripcion($db);

// Get the data input
$data = json_decode(file_get_contents("php://input"));

// set the data
$sub->id_tipo_sub = $data->id_tipo_sub;
$sub->id_subscripcion = $data->id_subscripcion;

try {
    if($sub->updateSub()){
        echo json_encode( array(
            "message" => "Se ha agregado correctamente la subscripción."
        ));
    } else {
        echo json_encode( array(
            "message" => "Error al ingresar la nueva subscripción."
        ));
    }



} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>