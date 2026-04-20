<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
define("BASE_URL", "/nomina/");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Sistema de Nomina</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
}
</style>

</head>

<body>

<div class="container-fluid">
    <div class="row">

    
		<?php include("layouts/sidebar.php"); ?>

        <div class="col-md-10 p-4">

            <h2>Bienvenido, <?= $_SESSION['nombre'] ?></h2>

            <div class="row mt-4">

                <div class="col-md-4">
                    <div class="card p-3 shadow">
                        <h5>Empleados</h5>
                        <p>Gestión de empleados</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-3 shadow">
                        <h5>Planillas</h5>
                        <p>Control de planillas</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-3 shadow">
                        <h5>Pagos</h5>
                        <p>Pagos realizados</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>