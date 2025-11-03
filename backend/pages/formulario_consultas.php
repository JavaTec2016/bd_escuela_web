<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once('menu_principal.php');
    require_once('../controller/DAO.php');
    require_once('../model/model_alumno.php');
    include_once('toast.php');
    /**
     * CREATE TABLE alumno(num_control VARCHAR(10), nombre VARCHAR(30), primer_apellido VARCHAR(30), segundo_apellido VARCHAR(30), fecha_nac DATE, semestre TINYINT, carrera VARCHAR(100));
     */
    ?>
    <hr>
    <div class="container">

        <?php
        echo tostar("toastAlumno", "toastAlumnoBody", "toastBtn1", "toastBtn2");

        $dao = new DAO();

        $alms = $dao->consultar("alumno");

        $campos = array(
            0 => Alumno::NUM_CONTROL,
            1 => Alumno::NOMBRE,
            2 => Alumno::PRIMER_AP,
            3 => Alumno::SEGUNDO_AP,
        );

        ?>

        <div class="row">
            <div class="col-12 col-md-3 col-lg-4">

                <form method="GET" id="consultaAlumnos">
                    <div id="consultaAlumnos-form">
                    </div>
                    <button type="submit" class="btn btn-primary" id="formSubmit">Buscar</button>
                </form>

            </div>

            <div class="col-12 col-md-9 col-lg-8">

                <table class="table table-hover" id="tablaResults">
                    <thead>
                        <tr>
                            <th scope="col">Num. Control</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Primer Ap.</th>
                            <th scope="col">Segundo Ap.</th>
                        </tr>
                    </thead>
                    <tbody id="tablaResults-body">
                        <?php
                        while (($fila = mysqli_fetch_assoc($alms))) { //empieza el row
                            $rowStr = "<tr>";

                            foreach ($campos as $idx => $campo) { //concatena cada campo del row
                                $dato = $fila[$campo];
                                $tede = "<td>" . $dato . "</td>";
                                $rowStr .= $tede;
                            }
                            $rowStr .= "</tr>"; //san se acabo
                            echo $rowStr;
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>


    </div>
    <script type=" text/javascript" src="js/fetchJSON.js">
    </script>
    <script type="text/javascript" src="js/showToast.js"></script>
    <script type="text/javascript" src="js/scripTabla.js"></script>
    <script type="text/javascript" src="js/scripForm.js"></script>
    <script type="text/javascript" src="js/consultar.js"></script>
    <script>
        const form = document.getElementById("consultaAlumnos");
        const formBody = document.getElementById("consultaAlumnos-form");
        const tabla = document.getElementById("tablaResults");
        //armar el form para alumnos
        formBody.innerHTML = "";
        formBody.append(
            buildField("<?php echo Alumno::NUM_CONTROL ?>", undefined, "text", undefined, "Número de control: "),
            buildField("<?php echo Alumno::NOMBRE ?>", undefined, "text", undefined, "Nombre: "),
            buildField("<?php echo Alumno::PRIMER_AP ?>", undefined, "text", undefined, "Primer Apellido: "),
            buildField("<?php echo Alumno::SEGUNDO_AP ?>", undefined, "text", undefined, "Segundo Apellido: "),
            buildField("<?php echo Alumno::FECHA_NAC ?>", undefined, "date", undefined, "Fecha de Nacimiento: "),
            buildField("<?php echo Alumno::SEMESTRE ?>", undefined, "number", undefined, "Semestre: "),
            buildField("<?php echo Alumno::CARRERA ?>", undefined, "text", undefined, "Carrera: "), //select
        );

        //lo chido
        const campos = [
            <?php
            foreach ($campos as $idx => $value) {
                echo "\"" . $value . "\"";
                if ($idx < count($campos) - 1) echo ", ";
            }
            ?>
        ];
        form.onsubmit = (ev) => {
            ev.preventDefault();
            setText("tablaResults-body", "Buscando...");
            consultar("../controller/procesar_consulta.php?tabla=alumno&", form,
                (result) => {
                    crearBody(tabla);
                    agregarRowsCompletas(tabla, result, "<?php echo Alumno::NUM_CONTROL ?>", campos);
                    if (result.length == 0) setText("tablaResults-body", "Sin resultados");
                    return;
                },
                (reason) => {
                    console.log(reason);
                    setText("tablaResults-body", "Error");
                    setText("toastAlumnoBody-text", "Error del servidor, intentelo mas tarde ");
                    hide("toastBtn1");
                    setText("toastBtn2", "cerrar");
                    showToast("toastAlumno");
                }
            )

        }
    </script>
</body>

</html>