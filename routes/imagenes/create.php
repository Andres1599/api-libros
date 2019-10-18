<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/imagene.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$img = new Imagenes($db);

try {
    // obtengo la información
    $data = json_decode(file_get_contents("php://input"));
    $img->imagen = $data->img;
    //llamo todos los complementos del articulo para poder presentarlo en la lista
    if ($img->createImagen()) {
        echo json_encode( array( "message"=> "Se a agregado la imagen"));
    } else {
        echo json_encode( array( "message"=> "No se a agregado la imagen"));
    }

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>