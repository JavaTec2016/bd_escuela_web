<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
</head>

<body>
    <?php
    require_once('menu_principal.php');
    //require_once('../controller/procesar_altas.php');
    require_once('../model/model_alumno.php');
    include_once('toast.php');
    /**
     * CREATE TABLE alumno(num_control VARCHAR(10), nombre VARCHAR(30), primer_apellido VARCHAR(30), segundo_apellido VARCHAR(30), fecha_nac DATE, semestre TINYINT, carrera VARCHAR(100));
     */
    ?>
    <div class="container">
        <?php
        echo tostar("toastAlumno", "toastAlumnoBody", "toastBtn1", "toastBtn2");
        ?>

        <hr>
        <form method="POST" id="formAgregar">
            <div class="mb-3">
                <label for="caja_num_control" class="form-label">Número de control: </label>
                <input type="text" class="form-control" id="caja_num_control" aria-describedby="caja_num_control" name="caja_num_control">
            </div>
            <div class="mb-3">
                <label for="caja_nombre" class="form-label">Nombre: </label>
                <input type="text" class="form-control" id="caja_nombre" name="caja_nombre">
            </div>
            <div class="mb-3">
                <label for="caja_primer_ap" class="form-label">Primer Apellido: </label>
                <input type="text" class="form-control" id="caja_primer_ap" name="caja_primer_ap">
            </div>
            <div class="mb-3">
                <label for="caja_segundo_ap" class="form-label">Segundo Apellido: </label>
                <input type="text" class="form-control" id="caja_segundo_ap" name="caja_segundo_ap">
            </div>
            <div class="mb-3">
                <label for="caja_fecha_nac" class="form-label">Fecha de Nacimiento: </label>
                <input type="text" class="form-control" id="caja_fecha_nac" name="caja_fecha_nac">
            </div>
            <div class="mb-3">
                <label for="caja_semestre" class="form-label">Semestre: </label>
                <input type="text" class="form-control" id="caja_semestre" name="caja_semestre">
            </div>
            <div class="mb-3">
                <label for="caja_carrera" class="form-label">Carrera: </label>
                <input type="text" class="form-control" id="caja_carrera" name="caja_carrera">
            </div>

            <button type="submit" class="btn btn-primary" id="formSubmit">Agregar</button>
        </form>
    </div>

    <script type="text/javascript" src="js/fetchJSON.js"></script>
    <script type="text/javascript" src="js/showToast.js"></script>
    <script>
        /**@type HTMLFormElement */
        let form = document.getElementById("formAgregar");


        form.onsubmit = (e) => {
            e.preventDefault();
            postAltas();
        };

        function postAltas() {
            fetchJSON("../controller/procesar_altas.php", "POST", form,
                (json) => {
                    if (json.status) {
                        setText("toastAlumnoBody-text", "Alumno agregado");
                        setText("toastBtn1", "OK");
                        setText("toastBtn2", "Deshacer");
                    } else {
                        setText("toastAlumnoBody-text", "Error al agregar el alunmo");
                        setText("toastBtn1", "Informacion");
                        setText("toastBtn2", "cerrar");
                    }
                    showToast("toastAlumno");
                },
                (reason) => {
                    setText("toastAlumnoBody-text", "Error del servidor");
                    hide("toastBtn1");
                    setText("toastBtn2", "cerrar");
                    showToast("toastAlumno");
                }
            )
        }
    </script>
</body>

</html>