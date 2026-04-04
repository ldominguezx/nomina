<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Usuario</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}

.sidebar {
    height: 100vh;
    background: #1e3c72;
    color: white;
    padding: 20px;
}

.sidebar a {
    color: white;
    display: block;
    margin: 10px 0;
    text-decoration: none;
}

.sidebar a:hover {
    background: #2a5298;
    padding-left: 10px;
    border-radius: 5px;
}

.card {
    border-radius: 15px;
}
</style>

</head>

<body>

<div class="container-fluid">
<div class="row">


    <div class="col-md-2 sidebar">
        <h4>Nomina</h4>
        <hr>

        <p><strong><?= $_SESSION['nombre'] ?></strong></p>

        <a href="../dashboard.php">Inicio</a>
        <a href="../usuarios/list_usuarios.php">Usuarios</a>
        <a href="#">Planilla</a>
        <a href="#">Pagos</a>
        <a href="../logout.php">Cerrar sesión</a>
    </div>
    <div class="col-md-10 p-4">

        <h3 class="mb-4"> Crear Usuario</h3>

        <div class="card shadow p-4">

            <form action="add/add_usuarios.php" method="POST">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombre</label>
                        <input class="form-control" name="nombre" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Usuario</label>
                        <input class="form-control" name="usuario" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Correo</label>
                    <input class="form-control" name="correo">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Rol</label>
                        <select name="rol" class="form-control">
                            <option value="empleado">Empleado</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary"> Volver</a>
                    <button class="btn btn-primary">Guardar Usuario</button>
                </div>

            </form>

        </div>

    </div>

</div>
</div>

</body>
</html>