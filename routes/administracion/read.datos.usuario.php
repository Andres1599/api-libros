<?php

//Required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Include db and object

include_once '../../config/database.php';
include_once '../../objects/datos.usuario.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$tipoUsuario = new DatosUsuario($db);

//Query products
$stmt = $tipoUsuario->read();
$num = $stmt->rowCount();

//Check if more than 0 record found
if($num > 0){

    //products array
    $tipoUsuario_arr = array();
    $tipoUsuario = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
        $tipoUsuario_arr = array(
            "fk_id_usuario"            =>  $fk_id_usuario,
            "nombre_usuario"          =>  $nombre_usuario,
            "apellido_usuario"          =>  $apellido_usuario,
            "fk_id_genero"          =>  $fk_id_genero
        );

        array_push($tipoUsuario,$tipoUsuario_arr);
    }

    echo json_encode($tipoUsuario);
}else{
    echo json_encode(
        array("messege" => "No hay datos de los usuarios ingresados.")
    );
}
