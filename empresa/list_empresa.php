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
<title>Empresas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
        <h3>Empresas</h3>
        <a href="<?= BASE_URL ?>empresa/create_empresa.php" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Empresa
        </a>
    </div>

    <div class="card p-3 shadow">

<table class="table table-hover">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Cedula Jurídica</th>
            <th>IBC</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>

    <tbody>

    <?php
    $res = $con->query("SELECT * FROM empresa");

    while($row = $res->fetch_assoc()){
    ?>

        <tr>

            <td><?= $row['id_empresa'] ?></td>

            <td>
                <strong><?= $row['nombre'] ?></strong>
            </td>

            <td><?= $row['cedula_juridica'] ?></td>

            <td>
                <span class="badge bg-primary">
                    <?= $row['ibc'] ?>
                </span>
            </td>

            <td><?= $row['telefono'] ?></td>

            <td><?= $row['correo'] ?></td>

            <td class="text-center">

                <!-- EDITAR -->
                <a href="edit_empresa.php?id=<?= $row['id_empresa'] ?>"
                   class="btn btn-warning btn-sm me-1"
                   title="Editar">

                    <i class="fas fa-edit"></i>

                </a>

                <a href="delete/delete_empresa.php?id=<?= $row['id_empresa'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Eliminar empresa?')"
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