<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include("../conexion/conexion.php");
define("BASE_URL", "/nomina/");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Usuarios</title>

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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Gestion de Usuarios</h3>
            <a href="create_usuarios.php" class="btn btn-success">
                 Nuevo Usuario
            </a>
        </div>

        <div class="card shadow p-3">

            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $result = $con->query("SELECT * FROM usuarios");

                while($row = $result->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $row['id_usuario'] ?></td>
                        <td><?= $row['nombre'] ?></td>
                        <td><?= $row['usuario'] ?></td>
                        <td><?= $row['correo'] ?></td>
                        <td>
                            <span class="badge bg-<?= $row['rol']=='admin' ? 'danger' : 'secondary' ?>">
                                <?= $row['rol'] ?>
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="edit_usuarios.php?id=<?= $row['id_usuario'] ?>" class="btn btn-warning btn-sm">
                            Editar
                            </a>
                            <a href="delete/delete_usuarios.php?id=<?= $row['id_usuario'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Eliminar este usuario?')">
                            Eliminar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>

        </div>

    </div>

</div>
</div>

</body>
</html>