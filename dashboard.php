<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
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

    
        <div class="col-md-2 sidebar">
            <h4>Nomina</h4>
            <hr>

            <p><strong><?= $_SESSION['nombre'] ?></strong></p>

            <a href="#">Inicio</a>

            <?php if($_SESSION['rol'] == 'admin'): ?>
                <a href="usuarios/list_usuarios.php">Usuarios</a>
            <?php endif; ?>
			<a href="employees/list_employees.php">Empleados</a>
			<a href="employees_cuenta/list_employees.php">Empleados Cuentas</a>
            <a href="#">Planilla</a>
            <a href="#">Pagos</a>
            <a href="logout.php">Cerrar sesion</a>
        </div>

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