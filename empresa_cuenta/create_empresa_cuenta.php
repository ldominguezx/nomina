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
<title>Crear Cuenta Empresa</title>

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

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
         
            Crear Cuenta Empresa
        </h3>

    </div>

    <div class="card shadow p-4">

        <form action="add/add_empresa_cuenta.php"
              method="POST"
              oninput="generarCuenta()">

            <div class="mb-4">

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

                    $res = $con->query("SELECT * FROM empresa");

                    while($e = $res->fetch_assoc()){

                    ?>

                        <option value="<?= $e['id_empresa'] ?>">

                            <?= $e['nombre'] ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="row">

                <div class="col-md-2 mb-3">

                    <label class="form-label">
                        Producto
                    </label>

                    <select name="producto"
                            class="form-control">

                        <option value="100">
                            100 - Corriente
                        </option>

                        <option value="200">
                            200 - Ahorro
                        </option>

                    </select>

                </div>

                <div class="col-md-2 mb-3">

                    <label class="form-label">
                        Moneda
                    </label>

                    <select name="moneda"
                            class="form-control">

                        <option value="01">
                            CRC
                        </option>

                        <option value="02">
                            USD
                        </option>

                    </select>

                </div>
                <div class="col-md-2 mb-3">

                    <label class="form-label">
                        Oficina
                    </label>

                    <input type="number"
                           name="oficina"
                           class="form-control"
                           placeholder="000">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Cuenta
                    </label>

                    <input type="number"
                           name="cuenta"
                           class="form-control"
                           placeholder="000000">

                </div>

                <div class="col-md-1 mb-3">

                    <label class="form-label">
                        DV
                    </label>

                    <input type="number"
                           name="dv"
                           class="form-control"
                           placeholder="0">

                </div>

            </div>

            <input type="hidden"
                   name="tipo_cuenta"
                   id="tipo_cuenta">

            <div class="mb-4">

                <label class="form-label">
                    Cuenta Completa
                </label>

                <input id="preview"
                       name="numero_cuenta"
                       class="form-control"
                       readonly>

            </div>

            <div class="d-flex justify-content-between">

                <a href="<?= BASE_URL ?>empresa_cuenta/list_empresa_cuenta.php"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Volver

                </a>

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Guardar Cuenta

                </button>

            </div>

        </form>

    </div>

</div>
</div>
</div>

<script>

function generarCuenta(){

    let producto =
    document.querySelector('[name="producto"]').value;

    let moneda =
    document.querySelector('[name="moneda"]').value;

    let oficina =
    document.querySelector('[name="oficina"]').value.padStart(3,'0');

    let cuenta =
    document.querySelector('[name="cuenta"]').value.padStart(6,'0');

    let dv =
    document.querySelector('[name="dv"]').value;

    let tipo = producto === "100"
    ? "Corriente"
    : "Ahorro";

    document.getElementById("tipo_cuenta").value = tipo;

    document.getElementById("preview").value =
    producto + moneda + oficina + cuenta + dv;
}

window.onload = generarCuenta;

</script>

</body>
</html>