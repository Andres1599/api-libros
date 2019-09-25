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

$usuario = new Usuario($db);

//Get post data
$data = json_decode(file_get_contents("php://input"));

//set usuarios values
$usuario->_nombre = $data->nombre;
$usuario->_apellido = $data->apellido;
$usuario->_genero = $data->genero;
$usuario->correo_usuario = $data->correo;
$usuario->contrasena_usuario = $data->pass;
$usuario->_tipo = $data->tipo;

if($usuario->registro()){
    echo '{';
        echo '"message": "Usuario creado exitosamente."';
    echo '}';
}else{
    echo '{';
        echo '"message": "Incapaz de crear un usuario."';
    echo '}';
}
?>