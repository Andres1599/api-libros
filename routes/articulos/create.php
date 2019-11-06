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

$articulo = new Articulos($db);

//Get post data
$data = json_decode(file_get_contents("php://input"));

//set data in the attributes
$articulo->titulo_articulo = $data->titulo;
$articulo->fk_id_estado = $data->fk_id_estado;
$articulo->plantilla_articulo = $data->plantilla_articulo;
$articulo->fk_id_usuario = $data->id_usuario;

if($articulo->createA()) {
    $stmt = $articulo->getArticuloTitulo();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)[0]);
} else {
    echo json_encode( array( "message" => "error al crear el articulo"));
}
?>