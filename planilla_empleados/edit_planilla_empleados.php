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

$sql = "SELECT 
            pd.*,
            p.periodo,
            e.nombre

        FROM planilla_detalle pd

        INNER JOIN planilla p
            ON pd.id_planilla = p.id_planilla

        INNER JOIN empleados e
            ON pd.id_empleado = e.id_empleado

        WHERE pd.id_detalle = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error SQL: " . $con->error);
}

$stmt->bind_param("i", $id);

$stmt->execute();

$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    die("Registro no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">

<title>Editar Detalle Planilla</title>

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

</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <h3 class="mb-4">

        Editar Detalle Planilla

    </h3>

    <div class="card shadow p-4">

        <form action="edit/update_planilla_empleados.php"
              method="POST">

            <input type="hidden"
                   name="id_detalle"
                   value="<?= $row['id_detalle'] ?>">

            <div class="mb-3">

                <label class="form-label">
                    Planilla
                </label>

                <input type="text"
                       class="form-control"
                       value="<?= $row['periodo'] ?>"
                       readonly>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Empleado
                </label>

                <input type="text"
                       class="form-control"
                       value="<?= $row['nombre'] ?>"
                       readonly>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Horas Trabajadas
                </label>

                <input type="number"
                       step="0.01"
                       name="horas_trabajadas"
                       class="form-control"
                       value="<?= $row['horas_trabajadas'] ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Observaciones
                </label>

                <textarea name="observaciones"
                          class="form-control"
                          rows="3"><?= $row['observaciones'] ?></textarea>

            </div>

            <div class="d-flex justify-content-between mt-4">

                <a href="<?= BASE_URL ?>planilla_empleados/list_planilla_empleados.php"
                   class="btn btn-secondary">

                    Volver

                </a>

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Actualizar

                </button>

            </div>

        </form>

    </div>

</div>
</div>
</div>

</body>
</html>