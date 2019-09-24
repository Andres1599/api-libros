<?php

//Required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Include db and object

include_once '../../config/database.php';
include_once '../../objects/usuario.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

//Query products
$stmt = $usuario->read();
$num = $stmt->rowCount();

//Check if more than 0 record found
if($num > 0){

    //products array
    $usuarios_arr = array();
    $usuarios_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
        $usuario = array(
            "id_usuario"            =>  $id_usuario,
            "correo_usuario"          =>  $correo_usuario,
            "estado_usuario"   =>  $estado_usuario
        );

        array_push($usuarios_arr,$usuario);
    }

    echo json_encode($usuarios_arr);
}else{
    echo json_encode(
        array("messege" => "No hay usuarios ingresados.")
    );
}
