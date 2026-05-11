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

<title>Pagos Planilla</title>

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

.table td{
    vertical-align: middle;
}

</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <div class="d-flex justify-content-between mb-4">

        <h3>
            <i class="fas fa-money-bill-wave"></i>
            Pagos Planilla
        </h3>

        <a href="create_pago.php"
           class="btn btn-success">

            <i class="fas fa-plus"></i>
            Nuevo Pago

        </a>

    </div>

    <div class="card shadow p-4">

        <table class="table table-hover align-middle">

            <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Planilla</th>
                    <th>Empresa</th>
                    <th>Método</th>
                    <th>Referencia</th>
                    <th>Fecha</th>
                    <th class="text-center">Acciones</th>
                </tr>

            </thead>

            <tbody>

            <?php

            $sql = "SELECT 
                        pp.*,
                        pl.periodo,
                        e.nombre AS empresa

                    FROM pago_planilla pp

                    INNER JOIN planilla pl
                        ON pp.id_planilla = pl.id_planilla

                    INNER JOIN empresa e
                        ON pl.id_empresa = e.id_empresa

                    ORDER BY pp.id_pago DESC";

            $res = $con->query($sql);

            while($row = $res->fetch_assoc()){

            ?>

                <tr>

                    <td>
                        <?= $row['id_pago'] ?>
                    </td>

                    <td>
                        <?= $row['periodo'] ?>
                    </td>

                    <td>
                        <?= $row['empresa'] ?>
                    </td>

                    <td>
                        <?= $row['metodo_pago'] ?>
                    </td>

                    <td>
                        <?= $row['referencia'] ?>
                    </td>

                    <td>
                        <?= $row['fecha_pago'] ?>
                    </td>

                    <td class="text-center">

                        <a href="../env/generar_env.php?id=<?= $row['id_pago'] ?>"
                           class="btn btn-success btn-sm"
                           title="Generar ENV">

                            <i class="fas fa-file-download"></i>

                        </a>
                        <a href="edit_pago.php?id=<?= $row['id_pago'] ?>"
                           class="btn btn-warning btn-sm"
                           title="Editar">

                            <i class="fas fa-edit"></i>

                        </a>
                        <a href="delete/delete_pago.php?id=<?= $row['id_pago'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar pago?')"
                           title="Eliminar">

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