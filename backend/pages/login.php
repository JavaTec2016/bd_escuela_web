<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="../controller/validar_usuario.php" method="POST">
            <div class="mb-3">
                <label for="caja_usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="caja_usuario" name="caja_usuario" value="Ras">
            </div>
            <div class="mb-3">
                <label for="caja_pass" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="caja_pass" name="caja_pass" value="Acrobacia">
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
            <i>contraseña: Acrobacia</i>
        </form>
    </div>
</body>

</html>