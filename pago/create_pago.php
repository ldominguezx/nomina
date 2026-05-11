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

<title>Registrar Pago Planilla</title>

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

.info-box{
    background:white;
    border-radius:12px;
    padding:15px;
    border-left:5px solid #1e3c72;
}

</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <h3 class="mb-4">

        <i class="fas fa-money-bill-transfer"></i>
        Registrar Pago Planilla

    </h3>

    <div class="card shadow p-4">

        <form action="add/add_pago.php" method="POST">
            <div class="mb-4">

                <label class="form-label">
                    Planilla
                </label>

                <select name="id_planilla"
                        id="planilla"
                        class="form-control"
                        required>

                    <option value="">
                        Seleccione una planilla
                    </option>

                    <?php

                    $sql = "
                    SELECT 
                        p.*,
                        e.nombre AS empresa,
                        (
                            SELECT COUNT(*)
                            FROM planilla_detalle pd
                            WHERE pd.id_planilla = p.id_planilla
                        ) AS empleados,

                        (
                            SELECT SUM(pd.salario_neto)
                            FROM planilla_detalle pd
                            WHERE pd.id_planilla = p.id_planilla
                        ) AS total

                    FROM planilla p

                    INNER JOIN empresa e
                    ON p.id_empresa = e.id_empresa
                    ";

                    $res = $con->query($sql);

                    while($r = $res->fetch_assoc()){

                    ?>

                    <option
                        value="<?= $r['id_planilla'] ?>"
                        data-total="<?= $r['total'] ?>"
                        data-empleados="<?= $r['empleados'] ?>">

                        <?= $r['empresa'] ?>
                        -
                        <?= $r['periodo'] ?>

                    </option>

                    <?php } ?>

                </select>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Cuenta Empresa
                </label>

                <select name="id_empresa_cuenta"
                        class="form-control"
                        required>

                    <option value="">
                        Seleccione cuenta
                    </option>

                    <?php

                    $empresa = $con->query("
                    SELECT ec.*, e.nombre
                    FROM empresa_cuentas ec
                    INNER JOIN empresa e
                    ON ec.id_empresa = e.id_empresa
                    ");

                    while($em = $empresa->fetch_assoc()){

                    ?>

                    <option value="<?= $em['id_cuenta'] ?>">

                        <?= $em['nombre'] ?>
                        -
                        <?= $em['numero_cuenta'] ?>

                    </option>

                    <?php } ?>

                </select>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <div class="info-box">

                        <h6>
                            Total Empleados
                        </h6>

                        <h3 id="empleados">
                            0
                        </h3>

                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <div class="info-box">

                        <h6>
                            Monto Total Planilla
                        </h6>

                        <h3 id="total">
                            ₡0.00
                        </h3>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Método Pago
                    </label>

                    <select name="metodo_pago"
                            class="form-control">

                        <option>Transferencia</option>
                        <option>SINPE</option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Referencia
                    </label>

                    <input name="referencia"
                           class="form-control">

                </div>

            </div>
            <div class="mb-3">

                <label class="form-label">
                    Observaciones
                </label>

                <textarea name="observaciones"
                          class="form-control"
                          rows="3"></textarea>

            </div>

            <div class="d-flex justify-content-between mt-4">

                <a href="<?= BASE_URL ?>pago_planilla/list_pago.php"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Volver

                </a>

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Registrar Pago

                </button>

            </div>

        </form>

    </div>

</div>
</div>
</div>

<script>

document
.getElementById("planilla")
.addEventListener("change", function(){

    let option =
    this.options[this.selectedIndex];

    let empleados =
    option.getAttribute("data-empleados");

    let total =
    option.getAttribute("data-total");

    document.getElementById("empleados")
    .innerText = empleados;

    document.getElementById("total")
    .innerText =
    "₡" + parseFloat(total || 0)
    .toLocaleString();

});

</script>

</body>
</html>