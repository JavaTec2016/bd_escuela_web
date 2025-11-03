<?php
header("Content-Type: application/json");
include_once('DAO.php');
include_once('../model/model_alumno.php');
$dao = new DAO();

$tabla = $_GET["tabla"]; //saca el modelo
$num = $_GET[Models::get($tabla)::getCampoPrimario()]; //saca el nombre de la llave primaria del modelo

$estado = $dao->eliminarPrimaria($tabla, $num);

if($estado != false) $estado = true;

echo json_encode(array("status" => $estado));

?>