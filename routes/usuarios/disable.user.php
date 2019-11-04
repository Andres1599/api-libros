<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/usuario.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

try {

    $usuario = new Usuario($db);

    //Get post data
    $data = json_decode(file_get_contents("php://input"));
    
    //set usuarios values
    $usuario->id_usuario = $data->id_usuario;

    if ($usuario->disableUser()) {
        echo json_encode(
            array(
                "message" => "Se ha deshabilitado el usuario."
            )
        );
    } else {
        echo json_encode(
            array(
                "message" => "No se ha podido deshabilitar el usuario."
            )
        );
    }
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>