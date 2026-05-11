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
<title>Planillas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    border:none;
}

</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
           
            Planillas
        </h3>

        <a href="create_planilla.php"
           class="btn btn-success">

            <i class="fas fa-plus"></i>
            Nueva Planilla

        </a>

    </div>

    <div class="card shadow p-4">

        <table class="table table-hover">

            <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Periodo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>

            </thead>

            <tbody>

            <?php

            $sql = "SELECT p.*, e.nombre
                    FROM planilla p
                    INNER JOIN empresa e
                    ON p.id_empresa = e.id_empresa";

            $res = $con->query($sql);

            while($row = $res->fetch_assoc()){

            ?>

                <tr>

                    <td><?= $row['id_planilla'] ?></td>

                    <td><?= $row['nombre'] ?></td>

                    <td><?= $row['periodo'] ?></td>

                    <td><?= $row['fecha_inicio'] ?></td>

                    <td><?= $row['fecha_fin'] ?></td>

                    <td class="text-center">

                        <a href="edit_planilla.php?id=<?= $row['id_planilla'] ?>"
                           class="btn btn-warning btn-sm me-1">

                            <i class="fas fa-edit"></i>

                        </a>

                        <a href="delete/delete_planilla.php?id=<?= $row['id_planilla'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar planilla?')">

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