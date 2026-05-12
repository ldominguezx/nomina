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
<title>Empresa Cuentas</title>

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
    vertical-align:middle;
}

.badge-moneda{
    font-size:14px;
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
         
            Empresa Cuentas
        </h3>

        <a href="create_empresa_cuenta.php"
           class="btn btn-success">

            Nueva Cuenta

        </a>

    </div>

    <div class="card shadow p-3">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Empresa</th>
                        <th>Número Cuenta</th>
                        <th>Tipo</th>
                        <th>Moneda</th>
                        <th>Fecha</th>
                        <th class="text-center">Acciones</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $sql = "SELECT ec.*, e.nombre
                        FROM empresa_cuentas ec
                        INNER JOIN empresa e
                        ON ec.id_empresa = e.id_empresa
                        WHERE ec.estado = 1
                        ORDER BY ec.id_cuenta DESC";

                $res = $con->query($sql);

                while($row = $res->fetch_assoc()){

                ?>

                    <tr>

                        <td>
                            <?= $row['id_cuenta'] ?>
                        </td>

                        <td>
                            <strong>
                                <?= $row['nombre'] ?>
                            </strong>
                        </td>

                        <td>

                            <span class="badge bg-secondary p-2">

                                <?= $row['numero_cuenta'] ?>

                            </span>

                        </td>

                        <td>

                            <?php if($row['tipo_cuenta'] == 'Corriente'){ ?>

                                <span class="badge bg-primary">

                                    Corriente

                                </span>

                            <?php }else{ ?>

                                <span class="badge bg-success">

                                    Ahorro

                                </span>

                            <?php } ?>

                        </td>

                        <td>

                            <?php if($row['moneda'] == '01'){ ?>

                                <span class="badge bg-info badge-moneda">

                                    CRC

                                </span>

                            <?php }else{ ?>

                                <span class="badge bg-warning text-dark badge-moneda">

                                    USD

                                </span>

                            <?php } ?>

                        </td>

                        <td>

                            <?= $row['fecha_registro'] ?>

                        </td>

                        <td class="text-center">

                          
                            <a href="edit_empresa_cuenta.php?id=<?= $row['id_cuenta'] ?>"
                               class="btn btn-warning btn-sm me-1"
                               title="Editar">

                                <i class="fas fa-edit"></i>

                            </a>

                            <a href="delete/delete_empresa_cuenta.php?id=<?= $row['id_cuenta'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Eliminar cuenta?')"
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
</div>

</body>
</html>