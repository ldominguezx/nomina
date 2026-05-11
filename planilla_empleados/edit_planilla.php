<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include("../conexion/conexion.php");

define("BASE_URL", "/nomina/");

if (!isset($_GET['id'])) {
    die("ID no válido");
}

$id = $_GET['id'];


$sql = "SELECT p.*, e.nombre
        FROM planilla p
        INNER JOIN empresa e
        ON p.id_empresa = e.id_empresa
        WHERE p.id_planilla = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    die("Planilla no encontrada");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

<title>Editar Planilla</title>

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

.form-control{
    border-radius:10px;
}

.form-label{
    font-weight:500;
}

</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <h3 class="mb-4">

        <i class="fas fa-file-invoice-dollar"></i>
        Editar Planilla

    </h3>

    <!-- CARD -->
    <div class="card shadow p-4">

        <form action="edit/update_planilla.php"
              method="POST">


            <input type="hidden"
                   name="id"
                   value="<?= $row['id_planilla'] ?>">

            <div class="mb-3">

                <label class="form-label">
                    Empresa
                </label>

                <input class="form-control"
                       value="<?= $row['nombre'] ?>"
                       readonly>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Periodo
                </label>

                <input type="text"
                       name="periodo"
                       class="form-control"
                       value="<?= $row['periodo'] ?>"
                       required>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Fecha Inicio
                    </label>

                    <input type="date"
                           name="fecha_inicio"
                           class="form-control"
                           value="<?= $row['fecha_inicio'] ?>"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Fecha Fin
                    </label>

                    <input type="date"
                           name="fecha_fin"
                           class="form-control"
                           value="<?= $row['fecha_fin'] ?>"
                           required>

                </div>

            </div>
            <div class="d-flex justify-content-between mt-4">

                <a href="<?= BASE_URL ?>planilla/list_planilla.php"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Volver

                </a>

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Actualizar Planilla

                </button>

            </div>

        </form>

    </div>

</div>
</div>
</div>

</body>
</html>