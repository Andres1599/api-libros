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

    $data = json_decode(file_get_contents("php://input"));

    $publicidad->id_publicidad = $data->id_ad;
    
    if ($publicidad->deletePublicidad()) {
        echo json_encode(
            array(
                "message" => "Se ha eliminado la publicidad."
            )
        );
    } else {
        echo json_encode(
            array(
                "message" => "No se ha eliminado la publicidad."
            )
        );
    }

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>