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
<title>Nomina / Cuenta Empleado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f4f6f9; }
.sidebar { height:100vh; background:#1e3c72; color:white; padding:20px; }
.sidebar a { color:white; display:block; margin:10px 0; text-decoration:none; }
.sidebar a:hover { background:#2a5298; padding-left:10px; border-radius:5px; }
.card { border-radius:15px; }
.form-control { border-radius:10px; }
</style>
</head>

<body>

<div class="container-fluid">
<div class="row">

    <?php include("../layouts/sidebar.php"); ?>


    <div class="col-md-10 p-4">

        <h3 class="mb-4">Crear Cuenta de Empleado</h3>

        <div class="card shadow p-4">

        <form action="add/add_employees_cuenta.php" method="POST" oninput="generarCuenta()">

       
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

            <div class="row">

                <div class="col-md-2 mb-3">
                    <label>Producto</label>
                    <select name="producto" class="form-control" required>
                        <option value="100">100 - Corriente</option>
                        <option value="200">200 - Ahorro</option>
                    </select>
                </div>
					
                <div class="col-md-2 mb-3">
                    <label>Moneda</label>
                    <select name="moneda" class="form-control" required>
                        <option value="01">Colones</option>
                        <option value="02">Dólares</option>
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label>Oficina</label>
                    <input type="number" name="oficina" class="form-control" min="1" max="245" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Número</label>
                    <input type="number" name="cuenta" class="form-control" required>
                </div>

                <div class="col-md-1 mb-3">
                    <label>DV</label>
                    <input type="number" name="dv" class="form-control" min="0" max="9" required>
                </div>

            </div>
            <div class="mb-3">
			    <label>Tipo de Cuenta</label>
			    <input id="tipo_cuenta" class="form-control" readonly>
			</div>
            <div class="mb-3">
            
                <label>Cuenta Generada</label>
                <input id="preview" class="form-control" readonly>
            </div>

     
            <div class="d-flex justify-content-between">
                <a href="<?= BASE_URL ?>employees_cuenta/list_employees.php" class="btn btn-secondary">
                    ← Volver
                </a>
                <button class="btn btn-primary">Guardar Cuenta</button>
            </div>

        </form>

        </div>

    </div>

</div>
</div>

<script>
function generarCuenta() {

    let producto = document.querySelector('[name="producto"]').value;
    let moneda = document.querySelector('[name="moneda"]').value;
    let oficina = document.querySelector('[name="oficina"]').value.padStart(3,'0');
    let cuenta = document.querySelector('[name="cuenta"]').value.padStart(6,'0');
    let dv = document.querySelector('[name="dv"]').value;
    document.getElementById("preview").value =
        producto + moneda + oficina + cuenta + dv;
    let tipo = "";

    if (producto === "100") {
        tipo = "Corriente";
    } else if (producto === "200") {
        tipo = "Ahorro";
    }

    document.getElementById("tipo_cuenta").value = tipo;
}
</script>

</body>
</html>