<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../models/articulo.imagen.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$articulo = new ArticuloImagen($db);

//Get post data
$data = json_decode(file_get_contents("php://input"));

//set data in the attributes
$articulo->fk_id_articulo = $data->id_articulo;
$articulo->path = $data->path;

if ($articulo->createAI()) {
    echo '{';
        echo '"message": "Se ha agregado correctamente la imagen al articulo."';
    echo '}';
} else {
    echo '{';
        echo '"message": "Incapaz de crear una imagen para un articulo."';
    echo '}';
}

?>