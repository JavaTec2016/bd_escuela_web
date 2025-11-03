<?php

header("Content-Type: application/json");
include_once('DAO.php');
include_once('../model/model_alumno.php');

$dao = new DAO();

//saca los datos actuales
$tabla = $_GET["tabla"]; 
$primaria = Models::get($tabla)::getCampoPrimario();
$num = $_GET["OLD_" . $primaria];

//filtro pal dao
$filtro = array("".$primaria => $num);
$valores = Models::cleanKeys($_GET, "_input");

//modelo actualizao
$modelo = Models::instanciar($tabla, $valores);
$res = $dao->modificar($tabla, $filtro, $modelo);

if($res != false) $res = true;
$json = array("status" =>$res);
echo json_encode($json);
?>