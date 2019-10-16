<?php

//Required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Include db and object

include_once '../../config/database.php';
include_once '../../models/sub.categorias.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$sub = new SubCategorias($db);

//Query products
$stmt = $sub->getTipoCategoria();
$num = $stmt->rowCount();

//Check if more than 0 record found
if($num > 0){

    $row = $stmt->fetchall(PDO::FETCH_ASSOC);

    echo json_encode($row);
}else{
    echo json_encode(
        array("messege" => "No hay tipo de categorias ingresadas.")
    );
}
