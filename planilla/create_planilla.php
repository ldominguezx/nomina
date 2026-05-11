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

<title>Crear Planilla</title>

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

        <i class="fas fa-file-circle-plus"></i>
        Crear Planilla

    </h3>

    <div class="card shadow p-4">

        <form action="add/add_planilla.php" method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Empresa
                </label>

                <select name="id_empresa"
                        class="form-control"
                        required>

                    <option value="">
                        Seleccione empresa
                    </option>

                    <?php

                    $empresas = $con->query("SELECT * FROM empresa");

                    while($e = $empresas->fetch_assoc()){

                    ?>

                        <option value="<?= $e['id_empresa'] ?>">

                            <?= $e['nombre'] ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Periodo
                </label>

                <input type="text"
                       name="periodo"
                       class="form-control"
                       placeholder="">

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Fecha Inicio
                    </label>

                    <input type="date"
                           name="fecha_inicio"
                           class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Fecha Fin
                    </label>

                    <input type="date"
                           name="fecha_fin"
                           class="form-control">

                </div>

            </div>

            <div class="d-flex justify-content-between mt-3">

                <a href="<?= BASE_URL ?>planilla/list_planilla.php"
                   class="btn btn-secondary">

                    Volver

                </a>

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Guardar Planilla

                </button>

            </div>

        </form>

    </div>

</div>
</div>
</div>

</body>
</html>