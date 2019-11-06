<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/comentario.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

try {
    $comentario = new Comentario($db);
    //Get post data
    $data = json_decode(file_get_contents("php://input"));
    //set values
    $comentario->id_comentario = $data->id_comentario;

    if ($comentario->reportar()) {
        echo json_encode(
            array( "message" => "Has reportado el comentario")
        );
    } else {
        echo json_encode(
            array( "message" => "No hemos podido reportar el comentario")
        );
    }

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>