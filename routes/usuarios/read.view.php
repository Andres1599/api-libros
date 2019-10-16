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

$user = new Usuario($db);

try {
    
    // obtengo la información
    $data = json_decode(file_get_contents("php://input"));
    $user->id_usuario = $data->id;

    // realizo el query
    $stmt = $user->getView();

    // retorno un json
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>