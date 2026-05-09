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

$sql = "SELECT ec.*, e.nombre
        FROM empresa_cuentas ec
        INNER JOIN empresa e
        ON ec.id_empresa = e.id_empresa
        WHERE ec.id_cuenta = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    die("Cuenta no encontrada");
}

$cuenta = $row['numero_cuenta'];

$producto = substr($cuenta, 0, 3);
$moneda   = substr($cuenta, 3, 2);
$oficina  = substr($cuenta, 5, 3);
$numero   = substr($cuenta, 8, 6);
$dv       = substr($cuenta, 14, 1);

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

<title>Editar Cuenta Empresa</title>

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

        Editar Cuenta Empresa

    </h3>


    <div class="card shadow p-4">

        <form action="edit/update_empresa_cuenta.php"
              method="POST"
              oninput="generarCuenta()">

            <input type="hidden"
                   name="id"
                   value="<?= $row['id_cuenta'] ?>">

            <div class="mb-4">

                <label class="form-label">
                    Empresa
                </label>

                <input class="form-control"
                       value="<?= $row['nombre'] ?>"
                       readonly>

            </div>
            <div class="row">

                <div class="col-md-2 mb-3">

                    <label class="form-label">
                        Producto
                    </label>

                    <select name="producto"
                            class="form-control">

                        <option value="100"
                        <?= $producto=='100'?'selected':'' ?>>

                            100 - Corriente

                        </option>

                        <option value="200"
                        <?= $producto=='200'?'selected':'' ?>>

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

                        <option value="01"
                        <?= $moneda=='01'?'selected':'' ?>>

                            Colones

                        </option>

                        <option value="02"
                        <?= $moneda=='02'?'selected':'' ?>>

                            Dólares

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
                           value="<?= $oficina ?>">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Cuenta
                    </label>

                    <input type="number"
                           name="cuenta"
                           class="form-control"
                           value="<?= $numero ?>">

                </div>

                <div class="col-md-1 mb-3">

                    <label class="form-label">
                        DV
                    </label>

                    <input type="number"
                           name="dv"
                           class="form-control"
                           value="<?= $dv ?>">

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
                       class="form-control"
                       readonly>

            </div>
            <div class="d-flex justify-content-between">

                <a href="<?= BASE_URL ?>empresa_cuentas/list_empresa_cuenta.php"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
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