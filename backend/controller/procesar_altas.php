<?php
include_once("DAO.php");
header("Content-Type: application/json");
$alumboResult = false;

$dao = new DAO();

$modelo = array();

$modelo["num_control"] = $_POST["caja_num_control"];
$modelo["nombre"] = $_POST["caja_nombre"];
$modelo["primer_ap"] = $_POST["caja_primer_ap"];
$modelo["segundo_ap"] = $_POST["caja_segundo_ap"];
$modelo["fecha_nac"] = $_POST["caja_fecha_nac"];
$modelo["semestre"] = $_POST["caja_semestre"];
$modelo["carrera"] = $_POST["caja_carrera"];


//==============VALIDAR
$datos_correctos = true;

if ($datos_correctos) {
    $res = $dao->agregar("alumno", $modelo);    
}

$json = array(
    "status" => $datos_correctos
);
echo json_encode($json);

//header("Location: " . $_SERVER['HTTP_REFERER']);
?>

