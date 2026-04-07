<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include("../conexion/conexion.php"); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nomina / Crear Cuenta Empleado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f4f6f9; }
.sidebar { height:100vh; background:#1e3c72; color:white; padding:20px; }
.sidebar a { color:white; display:block; margin:10px 0; text-decoration:none; }
.sidebar a:hover { background:#2a5298; padding-left:10px; border-radius:5px; }
.card { border-radius:15px; }
.form-control { border-radius:10px; }
.form-label { font-weight:500; }
</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<div class="col-md-2 sidebar">
    <h4>Nomina</h4>
    <hr>
    <p><strong><?= $_SESSION['nombre'] ?></strong></p>

    <a href="../dashboard.php">Inicio</a>
    <a href="../usuarios/list_usuarios.php">Usuarios</a>
    <a href="#">Planilla</a>
    <a href="#">Pagos</a>
    <a href="../logout.php">Cerrar sesión</a>
</div>

<div class="col-md-10 p-4">

    <h3 class="mb-4">Crear Cuenta de Empleado</h3>

    <div class="card shadow p-4">

        <form action="add/add.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Empleado</label>
                <select name="id_empleado" class="form-control" required>
                    <option value="">Seleccione empleado</option>

                    <?php
                    $emp = $con->query("SELECT * FROM empleados WHERE activo=1");
                    while($e = $emp->fetch_assoc()){
                    ?>
                        <option value="<?= $e['id_empleado'] ?>">
                            <?= $e['nombre'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Banco</label>
                <input name="banco" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Número de Cuenta</label>
                <input name="numero_cuenta" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de Cuenta</label>
                    <select name="tipo_cuenta" class="form-control">
                        <option value="Ahorro">Ahorro</option>
                        <option value="Corriente">Corriente</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Moneda</label>
                    <select name="moneda" class="form-control">
                        <option value="USD">USD</option>
                        <option value="CRC">CRC</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">← Volver</a>
                <button class="btn btn-primary">Guardar Cuenta</button>
            </div>

        </form>

    </div>

</div>

</div>
</div>

</body>
</html>