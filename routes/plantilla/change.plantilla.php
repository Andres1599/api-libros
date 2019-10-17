<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/admin.vista.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$view = new AdminVista($db);

try {
    
    // obtengo la información
    $data = json_decode(file_get_contents("php://input"));
    $view->plantilla = $data->plantilla;
    $view->fk_id_usuario = $data->id_usuario;

    // realizo el query
    $stmt = $view->changePlantilla();

    if ($stmt) {
        echo json_encode(array("message"=>"Se a cambiado la plantilla de las categorias."));
    } else {
        echo json_encode(array("message"=>"No se a cambiado la plantilla de las categorias."));
    }

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>