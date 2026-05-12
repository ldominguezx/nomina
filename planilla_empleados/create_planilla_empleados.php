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

<title>Crear Detalle Planilla</title>

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

.total-box{
    background:#f8f9fa;
    border-radius:10px;
    padding:15px;
    border:1px solid #ddd;
}

</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <h3 class="mb-4">

        <i class="fas fa-file-invoice-dollar"></i>
        Crear Detalle Planilla

    </h3>

    <div class="card shadow p-4">

        <form action="add/add_planilla_empleados.php" method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Planilla
                </label>

                <select name="id_planilla"
                        class="form-control"
                        required>

                    <option value="">
                        Seleccione planilla
                    </option>

                    <?php

                    $planillas = $con->query("SELECT * FROM planilla");

                    while($p = $planillas->fetch_assoc()){

                    ?>

                        <option value="<?= $p['id_planilla'] ?>">

                            <?= $p['periodo'] ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Empleado
                </label>

                <select name="id_empleado"
                        id="empleado"
                        class="form-control"
                        required>

                    <option value="">
                        Seleccione empleado
                    </option>

                    <?php

                    $emp = $con->query("SELECT * FROM empleados where activo=1");

                    while($e = $emp->fetch_assoc()){

                    ?>

                        <option 
                            value="<?= $e['id_empleado'] ?>"
                            data-salario="<?= $e['salario_base'] ?>">

                            <?= $e['nombre'] ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Salario Base Mensual
                    </label>

                    <input type="number"
                           step="0.01"
                           name="salario_base"
                           id="salario_base"
                           class="form-control"
                           readonly>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Horas Extra
                    </label>

                    <input type="number"
                           step="0.01"
                           name="horas_trabajadas"
                           id="horas_extra"
                           class="form-control"
                           value="0">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Valor Hora Extra
                    </label>

                    <input type="number"
                           step="0.01"
                           id="valor_hora"
                           class="form-control"
                           readonly>

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

            <div class="row">

                <div class="col-md-3">

                    <div class="total-box">

                        <strong>Salario Quincena</strong>

                        <input type="number"
                               step="0.01"
                               name="salario_bruto"
                               id="salario_quincena"
                               class="form-control mt-2"
                               readonly>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="total-box">

                        <strong>Total Horas Extra</strong>

                        <input type="number"
                               step="0.01"
                               id="total_extra"
                               class="form-control mt-2"
                               readonly>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="total-box">

                        <strong>Deducciones CCSS</strong>

                        <input type="number"
                               step="0.01"
                               name="deducciones"
                               id="deducciones"
                               class="form-control mt-2"
                               readonly>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="total-box">

                        <strong>Total a Pagar</strong>

                        <input type="number"
                               step="0.01"
                               name="salario_neto"
                               id="salario_neto"
                               class="form-control mt-2"
                               readonly>

                    </div>

                </div>

            </div>

            <div class="d-flex justify-content-between mt-4">

                <a href="<?= BASE_URL ?>planilla_empleados/list_planilla_empleados.php"
                   class="btn btn-secondary">

                    Volver

                </a>

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Guardar

                </button>

            </div>

        </form>

    </div>

</div>
</div>
</div>

<script>

const empleado = document.getElementById("empleado");
const salarioBase = document.getElementById("salario_base");
const horasExtra = document.getElementById("horas_extra");

empleado.addEventListener("change", calcularPlanilla);
horasExtra.addEventListener("input", calcularPlanilla);

function calcularPlanilla(){

    let option = empleado.options[empleado.selectedIndex];

    let salario = parseFloat(option.getAttribute("data-salario")) || 0;

    salarioBase.value = salario.toFixed(2);
    let salarioQuincena = salario / 2;


    let valorHora = salario / 240;


    let valorHoraExtra = valorHora * 1.5;

    document.getElementById("valor_hora").value =
    valorHoraExtra.toFixed(2);

    let horas = parseFloat(horasExtra.value) || 0;

    let totalExtras = horas * valorHoraExtra;
    let bruto = salarioQuincena + totalExtras;

    /*
        DEDUCCIONES 
        Aproximado:
        SEM 5.5%
        IVM 4.17%
        Banco Popular 1%
        TOTAL 10.67%
    */

    let deducciones = bruto * 0.1067;



    let neto = bruto - deducciones;

    document.getElementById("salario_quincena").value =
    bruto.toFixed(2);

    document.getElementById("total_extra").value =
    totalExtras.toFixed(2);

    document.getElementById("deducciones").value =
    deducciones.toFixed(2);

    document.getElementById("salario_neto").value =
    neto.toFixed(2);

}

</script>

</body>
</html>