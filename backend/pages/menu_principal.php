<?php
session_start();

if (!$_SESSION["autenticado"]) {
  header("location: login.php");
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Principal - ABCC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="menu_principal.php">ALUMNOS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="formulario_altas.php">Agregar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bajas_cambios.php">Modificar/Eliminar</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="formulario_consultas.php">Consultar</a>
          </li>
        </ul>
        
        <span>
          Bienvenido <?php echo $_SESSION['usuario']; ?>
        </span>
        <form class="d-flex" action="../controller/cerrar_sesion.php">
          <button class="btn btn-outline-danger" type="submit">Cerrar sesión</button>
        </form>
      </div>
    </div>
  </nav>
</body>

</html>