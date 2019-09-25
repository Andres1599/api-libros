<?php
//header method for the request register
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../../config/database.php';
include_once '../../objects/usuario.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$usuario = new Usuario($db);

//Get post data
$data = json_decode(file_get_contents("php://input"));
//set values
$usuario->id_usuario = $data->id_usuario;

$usuario->getUsuarioId();

$usuario_arr = array(
    "correo" => $usuario->correo_usuario,
    "estado" => $usuario->estado_usuario,
    "nombre" => $usuario->_nombre,
    "apellido" => $usuario->_apellido,
    "genero" => $usuario->_genero
);

print_r(json_encode($usuario_arr));
?>