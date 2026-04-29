<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include("../conexion/conexion.php");
define("BASE_URL", "/nomina/");

$id = $_GET['id'];
$result = $con->query("SELECT * FROM usuarios WHERE id_usuario = $id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Usuario</title>

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

    <?php include("../layouts/sidebar.php"); ?>


    <div class="col-md-10 p-4">

        <h3 class="mb-4"> Editar Usuario</h3>

        <div class="card shadow p-4">

            <form action="edit/update_usuarios.php" method="POST">

                <input type="hidden" name="id" value="<?= $row['id_usuario'] ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombre</label>
                        <input class="form-control" name="nombre" value="<?= $row['nombre'] ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Usuario</label>
                        <input class="form-control" name="usuario" value="<?= $row['usuario'] ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Correo</label>
                    <input class="form-control" name="correo" value="<?= $row['correo'] ?>">
                </div>

                <div class="mb-3">
                    <label>Rol</label>
                    <select name="rol" class="form-control">
                        <option value="admin" <?= $row['rol']=='admin'?'selected':'' ?>>Administrador</option>
                        <option value="empleado" <?= $row['rol']=='empleado'?'selected':'' ?>>Empleado</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary"> Volver</a>
                    <button class="btn btn-primary">Actualizar Usuario</button>
                </div>

            </form>

        </div>

    </div>

</div>
</div>

</body>
</html>