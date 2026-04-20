<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include("../conexion/conexion.php");
define("BASE_URL", "/nomina/");
$id = $_GET['id'];
$res = $con->query("SELECT * FROM empleados WHERE id_empleado=$id");
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Usuario</title>

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

<?php include("../layouts/sidebar.php"); ?>


    <div class="col-md-10 p-4">

        <h3 class="mb-4"> Editar Usuario</h3>

        <div class="card shadow p-4">

		<form action="edit/update_employees.php" method="POST">

		<input type="hidden" name="id" value="<?= $row['id_empleado'] ?>">

		<input value="<?= $row['nombre'] ?>" name="nombre">
		<input value="<?= $row['cedula'] ?>" name="cedula">
		<input value="<?= $row['puesto'] ?>" name="puesto">

		<button>Actualizar</button>

		</form>

        </div>

    </div>

</div>
</div>

</body>
</html>