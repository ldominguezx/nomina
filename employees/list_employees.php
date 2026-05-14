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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
    background:#f4f6f9;
}

.sidebar{
    height:100vh;
    background:#1e3c72;
    color:white;
    padding:20px;
}

.sidebar a{
    color:white;
    display:block;
    margin:10px 0;
    text-decoration:none;
}

.sidebar a:hover{
    background:#2a5298;
    padding-left:10px;
    border-radius:5px;
}

.card{
    border-radius:15px;
}

</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <div class="d-flex justify-content-between mb-3">

        <h3>
            Empleados
        </h3>

        <a href="../employees/create_employees.php"
           class="btn btn-success">

            Nuevo

        </a>

    </div>

    <div class="card p-3 shadow">

        <table class="table table-hover table-bordered">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Puesto</th>
                    <th>Correo / Telefono</th>
                    <th>Salario Base</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

            <?php

            $sql = "SELECT *
                    FROM empleados
                    WHERE activo = 1";

            $res = $con->query($sql);

            while($row = $res->fetch_assoc()){

            ?>

            <tr>

                <td>
                    <?= $row['id_empleado'] ?>
                </td>

                <td>
                    <?= $row['nombre'] ?>
                </td>

                <td>
                    <?= $row['cedula'] ?>
                </td>

                <td>
                    <?= $row['puesto'] ?>
                </td>

                <td>
                    <?= $row['correo'] ?> / <?= $row['telefono'] ?>
                </td>

                <td>
                    ₡ <?= number_format($row['salario_base'],2) ?>
                </td>

                <td>
                    <?= $row['fecha_ingreso'] ?>
                </td>

                <td>

                    <?php if($row['activo'] == 1){ ?>

                        <span class="badge bg-success">
                            Activo
                        </span>

                    <?php } else { ?>

                        <span class="badge bg-danger">
                            Inactivo
                        </span>

                    <?php } ?>

                </td>

				<td>

				    <a href="edit_employees.php?id=<?= $row['id_empleado'] ?>"
				       class="btn btn-warning btn-sm"
				       title="Editar">

				        <i class="fas fa-edit"></i>

				    </a>

				    <a href="delete/delete_employees.php?id=<?= $row['id_empleado'] ?>"
				       class="btn btn-danger btn-sm"
				       title="Eliminar"
				       onclick="return confirm('¿Eliminar empleado?')">

				        <i class="fas fa-trash"></i>

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