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
<title>Empleados</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f4f6f9; }
.sidebar { height:100vh; background:#1e3c72; color:white; padding:20px; }
.sidebar a { color:white; display:block; margin:10px 0; text-decoration:none; }
.sidebar a:hover { background:#2a5298; padding-left:10px; border-radius:5px; }
.card { border-radius:15px; }
</style>
</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Empleados</h3>
        <a href="../employees/create_employees.php" class="btn btn-success">+ Nuevo</a>
    </div>

    <div class="card p-3 shadow">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Puesto</th>
                    <th>Salario</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <?php
            $res = $con->query("SELECT * FROM empleados WHERE activo=1");
            while($row = $res->fetch_assoc()){
            ?>

            <tr>
                <td><?= $row['id_empleado'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['cedula'] ?></td>
                <td><?= $row['puesto'] ?></td>
                <td><?= $row['salario_base'] ?></td>

                <td>
                    <a href="edit_employees.php?id=<?= $row['id_empleado'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete/delete_employees.php?id=<?= $row['id_empleado'] ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Eliminar empleado?')">
                       Eliminar
                    </a>
                </td>
            </tr>

            <?php } ?>
        </table>
    </div>

</div>
</div>
</div>

</body>
</html>