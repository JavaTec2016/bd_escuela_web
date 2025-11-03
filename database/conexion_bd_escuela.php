<?php

    class ConexionBDEscuela {
        private $conexion;
        private $host = "localhost";
        private $port = 3306;
        private $usuario = "dominik";
        private $password = "santiago";
        private $bd = "BD_Escuela_Web";

        //hazlo private
        public function __construct(){
            $address = $this->host . ":" . $this->port;
            $this->conexion = mysqli_connect($address, $this->usuario, $this->password, $this->bd);

            if(!$this->conexion){
                die("ERROR: conexion fallida ---- \n" . mysqli_connect_error());
            }
        }
        
        public function getConexion(){
            return $this->conexion;
        }
    }
?>