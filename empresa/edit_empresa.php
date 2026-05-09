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


$sql = "SELECT * FROM empresa WHERE id_empresa = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    die("Empresa no encontrada");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Empresa</title>

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
</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

    <?php include("../layouts/sidebar.php"); ?>

    <div class="col-md-10 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3>
                <i class="fas fa-building"></i>
                Editar Empresa
            </h3>

        </div>

        <div class="card shadow p-4">

            <form action="edit/update_empresa.php" method="POST">

                <input type="hidden" name="id" value="<?= $row['id_empresa'] ?>">

             
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Nombre Empresa
                        </label>

                        <input
                            value="<?= $row['nombre'] ?>"
                            name="nombre"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Cédula Jurídica
                        </label>

                        <input
                            value="<?= $row['cedula_juridica'] ?>"
                            name="cedula_juridica"
                            class="form-control">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Número Cliente IBC
                        </label>

                        <input
                            value="<?= $row['numero_cliente_ibc'] ?>"
                            name="numero_cliente_ibc"
                            class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Teléfono
                        </label>

                        <input
                            value="<?= $row['telefono'] ?>"
                            name="telefono"
                            class="form-control">
                    </div>

                </div>

         
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Correo
                        </label>

                        <input
                            type="email"
                            value="<?= $row['correo'] ?>"
                            name="correo"
                            class="form-control">
                    </div>

                </div>

           
                <div class="mb-3">

                    <label class="form-label">
                        Dirección
                    </label>

                    <textarea
                        name="direccion"
                        class="form-control"
                        rows="3"><?= $row['direccion'] ?></textarea>

                </div>


                <div class="d-flex justify-content-between mt-4">

                    <a href="<?= BASE_URL ?>empresa/list_empresa.php"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>
                        Volver

                    </a>

                    <button class="btn btn-primary"> <i class="fas fa-save"></i> Actualizar Empresa </button>

                </div>

            </form>

        </div>

    </div>

</div>
</div>

</body>
</html>