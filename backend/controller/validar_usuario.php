<?php
    include_once('../../database/conexion_bd_usuario_escuela.php');
    $con = new ConexionBDUsuarios();
    $usr = $_POST["caja_usuario"];
    $pass = $_POST["caja_pass"];

    //verificar si existe el usuario

    $conexion = $con->getConexion();
    $res = 1;

    if($conexion){
        //cifraderas
        $u_cifrado = sha1($usr);
        $p_cifrado = sha1($pass);
        $sql = "SELECT * FROM usuario WHERE nombre='$u_cifrado' AND pass='$p_cifrado'";
        $res = mysqli_query($conexion, $sql);
        
        $num = mysqli_num_rows($res);

        if($num==1){
            
            session_start();
            $_SESSION["autenticado"] = true;
            $_SESSION["usuario"] = $usr;
            ///nombre, apellido, ROL,  bla bla
            var_dump($_POST);
            header("location: ../pages/menu_principal.php");
            exit(0);
        }else{
            header("location: ../pages/login.php");
            exit(0);
        }

        
    }
?>