<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar/Eliminar</title>
</head>

<body>

    <?php
    require_once('menu_principal.php');

    require_once('../model/model_alumno.php');
    require_once('../controller/DAO.php');
    include_once('toast.php');

    ?>
    <div class="container">
        <?php
        include_once('buildTablaModal.php');
        include_once('buildFormModal.php');


        echo buildTablaModal("tablaDetalles", "Detalles del alumno");
        echo buildFormModal("formCambiar", "Datos del alumno", "POST");
        echo tostar("toastAlumno", "toastAlumnoBody-text", "toastBtn1", "toastBtn2");

        $dao = new DAO();

        $alms = $dao->consultar("alumno");

        $campos = array(
            0 => Alumno::NUM_CONTROL,
            1 => Alumno::NOMBRE,
            2 => Alumno::PRIMER_AP,
            3 => Alumno::SEGUNDO_AP,
        );
        $comodines = array(
            0 => "",
            1 => "",
            2 => "",
            3 => "",
        );

        if (mysqli_num_rows($alms) == 0) {
            echo "<br> No se encontraron registros <br>";
        } else {

            echo '<table class="table table-hover">' .
                '<thead>' .
                '<tr>' .
                '<th scope="col">Num. Control</th>' .
                '<th scope="col">Nombre</th>' .
                '<th scope="col">Primer Apellido</th>' .
                '<th scope="col">Segundo Apellido</th>' .
                '<th scope="col">ACCIONES</th>' .
                '</tr>' .
                '</thead>' .
                '<tbody>';

            while (($fila = mysqli_fetch_assoc($alms))) { //empieza el row
                $rowStr = "<tr>";

                foreach ($campos as $idx => $campo) { //concatena cada campo del row
                    $dato = $fila[$campo];
                    $comodin = $comodines[$idx];

                    $tede = "<td>" . $dato . "</td>";

                    $rowStr .= $tede;
                }
                $rowStr .=
                    '<td>
                
                <a class="btn btn-primary" id="%s" href="../controller/procesar_detalles.php?tabla=alumno&' . $campos[0] . '=%s" name="linkDetalles" data-bs-toggle="modal" data-bs-target="#tablaDetalles"> Detalles </a>
                <a class="btn btn-secondary" id="%s" href="../controller/procesar_cambio.php?tabla=alumno&OLD_' . $campos[0] . '=%s&" name="linkCambiar" data-bs-toggle="modal" data-bs-target="#formCambiar"> Editar </a>
                <a class="btn btn-danger" id="%s" href="../controller/procesar_baja.php?tabla=alumno&' . $campos[0] . '=%s" name="linkEliminar"> Eliminar </a> 
                
                </td>';

                $rowStr .= "</tr>"; //san se acabo

                //printf(texto %s, %d, %f, "x", 5, var3);
                printf($rowStr, $fila[$campos[0]], $fila[$campos[0]], $fila[$campos[0]], $fila[$campos[0]], $fila[$campos[0]], $fila[$campos[0]]);
            }

            echo '</tbody>' .
                '</table>';
        }

        ?>
    </div>

    <script type="text/javascript" src="js/fetchJSON.js"></script>
    <script type="text/javascript" src="js/showToast.js"></script>
    <script type="text/javascript" src="js/scripTabla.js"></script>
    <script type="text/javascript" src="js/scripForm.js"></script>
    <script type="text/javascript" src="js/consultarPrimaria.js"></script>
    <script>
        let btnEliminars = document.getElementsByName("linkEliminar");
        let btnCambiars = document.getElementsByName("linkCambiar");
        let btnDetalless = document.getElementsByName("linkDetalles");

        btnEliminars.forEach(btnEliminar => {
            btnEliminar.onclick = (ev) => {
                ev.preventDefault();
                ev.stopPropagation();
                call(0, btnEliminar.href);
            }
        });

        ////ENVIEN AYUDA PLIS   
        btnCambiars.forEach(btnCambiar => {
            btnCambiar.onclick = (ev) => {
                ev.preventDefault();
                ev.stopPropagation();
                let form = document.getElementById("formCambiar-form");

                /**
                 * un call para:
                 *  1> consultar por el OLD_num_control
                 *  2> crear y popular el formulario
                 * luego definir el onsubmit
                 * 
                 */
                consultarPrimaria("alumno", "<?php echo $campos[0] ?>", btnCambiar.id,
                    (result) => {
                        let data = result[0];

                        form.innerHTML = "";
                        form.append(
                            buildField("<?php echo Alumno::NUM_CONTROL ?>", undefined, "text", undefined, "Número de control: ", {
                                "value": data["<?php echo Alumno::NUM_CONTROL ?>"]
                            }),
                            buildField("<?php echo Alumno::NOMBRE ?>", undefined, "text", undefined, "Nombre: ", {
                                "value": data["<?php echo Alumno::NOMBRE ?>"]
                            }),
                            buildField("<?php echo Alumno::PRIMER_AP ?>", undefined, "text", undefined, "Primer Apellido: ", {
                                "value": data["<?php echo Alumno::PRIMER_AP ?>"]
                            }),
                            buildField("<?php echo Alumno::SEGUNDO_AP ?>", undefined, "text", undefined, "Segundo Apellido: ", {
                                "value": data["<?php echo Alumno::SEGUNDO_AP ?>"]
                            }),
                            buildField("<?php echo Alumno::FECHA_NAC ?>", undefined, "date", undefined, "Fecha de Nacimiento: ", {
                                "value": data["<?php echo Alumno::FECHA_NAC ?>"]
                            }),
                            buildField("<?php echo Alumno::SEMESTRE ?>", undefined, "number", undefined, "Semestre: ", {
                                "value": data["<?php echo Alumno::SEMESTRE ?>"]
                            }),
                            buildField("<?php echo Alumno::CARRERA ?>", undefined, "text", undefined, "Carrera: ", {
                                "value": data["<?php echo Alumno::CARRERA ?>"]
                            }), //select
                        );

                        form.onsubmit = ev => {
                            ev.preventDefault();

                            call(1, btnCambiar.href, "GET", form);
                        };

                    },
                    (reason) => {
                        console.log("consulta no jala", reason);
                        setText("toastAlumnoBody-text", "Error del servidor, intentelo mas tarde ");
                        hide("toastBtn1");
                        setText("toastBtn2", "cerrar");
                        showToast("toastAlumno");
                    }
                )
            }
        })
        btnDetalless.forEach(btnDetalles => {
            btnDetalles.onclick = (ev) => {
                ev.preventDefault();
                ev.stopPropagation();

                let tabla = document.getElementById("tablaDetalles-table");
                document.getElementById("tablaDetalles-submit").hidden = true;
                crearBody(tabla);
                setBodyHTML(tabla, "Buscando...");
                call(2, btnDetalles.href, "GET");
            }
        })

        function call(accion = null, link = null, metodo = "GET", form = null) {
            if (accion == null || link == null) return;
            fetchJSON(link, metodo, form,
                (json) => {
                    if (accion == 2) {
                        //mostrar html con datos
                        let tabla = document.getElementById("tablaDetalles-table");
                        crearBody(tabla);
                        agregarRows(tabla, json, null);
                        return;
                    }
                    if (accion == 1) {
                        console.log(json);

                        if (json.status) {
                            setText("toastAlumnoBody-text", "Alumno modificado");
                            setText("toastBtn1", "OK");
                            setText("toastBtn2", "Deshacer");
                        } else {
                            setText("toastAlumnoBody-text", "Error: datos incorrectos");
                            hide("toastBtn1");
                            setText("toastBtn2", "cerrar");
                        }
                        showToast("toastAlumno");
                        return;
                    }
                    if (accion == 0) {
                        //eliminar momento
                        if (json.status) {
                            setText("toastAlumnoBody-text", "Alumno eliminado");
                            setText("toastBtn1", "OK");
                            setText("toastBtn2", "Deshacer");
                        } else {
                            setText("toastAlumnoBody-text", "No se pudo eliminar el alumno");
                            hide("toastBtn1");
                            setText("toastBtn2", "cerrar");
                        }
                        showToast("toastAlumno");
                        return;
                    }
                },
                (reason) => {
                    console.log(reason);
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