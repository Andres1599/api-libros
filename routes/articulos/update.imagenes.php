<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/articulos.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

try {
    $articulos = new Articulos($db);

    $data = json_decode(file_get_contents("php://input"));

    $articulos->path = $data->path;
    $articulos->id_articulo_imagen = $data->id_articulo_imagen;
    
    if ($articulos->editArticuloImagen()) {
        echo json_encode(
            array(
                "message" => "Se ha actualizado la imagen del articulo."
            )
        );
    } else {
        echo json_encode(
            array(
                "message" => "No se ha actualizado la imagen del articulo."
            )
        );
    }

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>