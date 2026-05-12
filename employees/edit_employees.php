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

$sql = "SELECT * FROM empleados WHERE id_empleado = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    die("Empleado no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Empleado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    border: none;
}

.form-control {
    border-radius: 10px;
}

.form-label {
    font-weight: 500;
}

.page-title {
    font-weight: 600;
}
</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

    <?php include("../layouts/sidebar.php"); ?>

   
    <div class="col-md-10 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="page-title">
                <i class="fas fa-user-edit"></i> Editar Empleado
            </h3>
        </div>

        <div class="card shadow p-4">

            <form action="edit/update_employees.php" method="POST">

                <input type="hidden" name="id" value="<?= $row['id_empleado'] ?>">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input 
                            value="<?= $row['nombre'] ?>" 
                            name="nombre" 
                            class="form-control"
                            placeholder="Ingrese el nombre"
                            required autocomplete="off">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cedula</label>
                        <input 
                            value="<?= $row['cedula'] ?>" 
                            name="cedula" 
                            class="form-control"
                            placeholder="Ingrese la cedula" autocomplete="off">
                    </div>

                </div>

           
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefono</label>
                        <input 
                            value="<?= $row['telefono'] ?>" 
                            name="telefono" 
                            class="form-control"
                            placeholder="Ingrese el telefono" autocomplete="off">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Correo</label>
                        <input 
                            type="email"
                            value="<?= $row['correo'] ?>" 
                            name="correo" 
                            class="form-control"
                            placeholder="Ingrese el correo" autocomplete="off">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Puesto</label>
                        <input 
                            value="<?= $row['puesto'] ?>" 
                            name="puesto" 
                            class="form-control"
                            placeholder="Ingrese el puesto" autocomplete="off">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Salario Base</label>
                        <input 
                            type="number"
                            step="0.01"
                            value="<?= $row['salario_base'] ?>" 
                            name="salario_base" 
                            class="form-control"
                            placeholder="0.00">
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de Ingreso</label>
                    <input 
                        type="date"
                        value="<?= $row['fecha_ingreso'] ?>" 
                        name="fecha_ingreso" 
                        class="form-control">
                </div>

                <div class="d-flex justify-content-between mt-4">

                    <a href="<?= BASE_URL ?>employees/list_employees.php" 
                       class="btn btn-secondary">
                     Volver
                    </a>

                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
</div>

</body>
</html>