<?php

    require_once('DAO.php');
    require_once('../model/DataRow.php');
    require_once('../model/model_alumno.php');
    require_once('../model/model_donador.php');
    require_once('../model/model_corporacion.php');

    $dao = new DAO();
    

    var_dump(count(Alumno::$rules));
echo "<br>";
    var_dump(count(Donador::$rules));
echo "<br>";
    var_dump(count(Corporacion::$rules));
echo "<br>";
    


    $donador = new Donador(1, "si", "si", "1234567890", "si.si", "toda", 2020, 2, 3, "non", 4);
    $corpo = new Corporacion(-1, "Chambaceuticas", "Las lomas", "494 949 49494", "chambaceuticas@si.si");

    $filtro = $dao->makeWhereCampos($donador->valores, $dao->fakeComodines($donador->valores, false));
    var_dump($filtro);
    echo "<br>";

    $estring = $dao->makeWhereCamposSimple($donador->valores, $dao->fakeComodines($donador->valores, false), Donador::aggregateRule(DataRow::TIPO));
    var_dump($estring);

    echo "<hr>";
    echo "<br>" . $dao->eliminar("donador", $donador->valores);
?>