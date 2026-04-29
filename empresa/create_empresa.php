<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

define("BASE_URL", "/nomina/");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nomina / Crear Empresa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f4f6f9; }
.sidebar { height: 100vh; background: #1e3c72; color: white; padding: 20px; }
.sidebar a { color: white; display: block; margin: 10px 0; text-decoration: none; }
.sidebar a:hover { background: #2a5298; padding-left: 10px; border-radius: 5px; }
.card { border-radius: 15px; }
.form-control { border-radius: 10px; }
.form-label { font-weight: 500; }
</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <h3 class="mb-4">Crear Empresa</h3>

    <div class="card shadow p-4">

        <form action="add/add_empresa.php" method="POST">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre de la Empresa</label>
                    <input name="nombre" class="form-control" placeholder="Ej: Empresa S.A" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Cédula Jurídica</label>
                    <input name="cedula_juridica" class="form-control" placeholder="Ej: 3-101-123456">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono</label>
                    <input name="telefono" class="form-control" placeholder="">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" placeholder="correo@empresa.com">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <textarea name="direccion" class="form-control" rows="3" placeholder="Ubicación de la empresa"></textarea>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="<?= BASE_URL ?>empresa/list_empresa.php" class="btn btn-secondary">
                    ← Volver
                </a>
                <button class="btn btn-primary">
                    Guardar Empresa
                </button>
            </div>

        </form>

    </div>

</div>

</div>
</div>

</body>
</html>