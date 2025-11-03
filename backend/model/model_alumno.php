<?php
    require_once('DataRow.php');
    require_once('Modelo.php');

    class Alumno extends Modelo {
        public static $rules = array();
        
        public final const NUM_CONTROL = "num_control";
        public final const NOMBRE = "nombre";
        public final const PRIMER_AP = "primer_apellido";
        public final const SEGUNDO_AP = "segundo_apellido";
        public final const FECHA_NAC = "fecha_nac";
        public final const SEMESTRE = "semestre";
        public final const CARRERA = "carrera";

        public function __construct($numControl="", $nombre="", $primerAp="", $segundoAp="", $fechaNac="", $semestre=-1, $carrera=""){
            $this->fillValuesFrom(array_keys(static::$rules), func_get_args());
        }
        public static function setRules() {
            static::addRule(self::NUM_CONTROL, new DataRow("string", "VARCHAR", true, true, false, 10, 10, false, ""));
            static::addRule(self::NOMBRE, new DataRow("string", "VARCHAR", true, false, false, 0, 30, false, ""));
            static::addRule(self::PRIMER_AP, new DataRow("string", "VARCHAR", true, false, false, 0, 30, false, ""));
            static::addRule(self::SEGUNDO_AP, new DataRow("string", "VARCHAR", true, false, false, 0, 30, false, ""));
            static::addRule(self::FECHA_NAC, new DataRow("string", "DATE", true, false, false, -1, -1, false, ""));
            static::addRule(self::SEMESTRE, new DataRow("int", "TINYINT", true, false, false, -1, -1, false, ""));
            static::addRule(self::CARRERA, new DataRow("string", "VARCHAR", true, false, false, 0, 50, false, ""));
        }
    }
    Alumno::setRules();
    Models::set("alumno", new Alumno());
?>