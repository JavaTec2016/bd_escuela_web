<?php

header("Content-Type: application/json");
include_once('DAO.php');
include_once('../model/model_alumno.php');
$dao = new DAO();

$tabla = $_GET["tabla"]; //saca el modelo

$filtrados = array();
foreach($_GET as $key => $value){
    if($key == "tabla") continue;
    if(empty($value) || $key == "") continue;
    $filtrados[$key] = $value;
}
$filtrados = Models::cleanKeys($filtrados, "_input");

//tovia no hay comodines

$res = $dao->consultar($tabla, array(0=>"*"), $filtrados, $dao->fakeComodines($filtrados, true));

if ($res) {
    echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
} else {
    echo json_encode(array());
}
