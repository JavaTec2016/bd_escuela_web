<?php

header("Content-Type: application/json");
include_once('DAO.php');
include_once('../model/model_alumno.php');
$dao = new DAO();

$tabla = $_GET["tabla"]; //saca el modelo
$num = $_GET[Models::get($tabla)::getCampoPrimario()]; //saca el nombre de la llave primaria del modelo

$res = $dao->consultarPrimaria($tabla, $num);

if($res){
    echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
}else {
    echo json_encode(array());
}


?>