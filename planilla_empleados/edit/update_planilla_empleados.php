<?php

session_start();

include("../../conexion/conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

if (
    !isset($_POST['id_detalle']) ||
    !isset($_POST['horas_trabajadas'])
) {
    die("Datos incompletos");
}

$id_detalle = $_POST['id_detalle'];

$horas_trabajadas = floatval($_POST['horas_trabajadas']);

$observaciones = $_POST['observaciones'] ?? '';



$sql = "SELECT 
            pd.id_empleado,
            e.salario_base

        FROM planilla_detalle pd

        INNER JOIN empleados e
            ON pd.id_empleado = e.id_empleado

        WHERE pd.id_detalle = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error SQL SELECT: " . $con->error);
}

$stmt->bind_param("i", $id_detalle);

$stmt->execute();

$result = $stmt->get_result();

$data = $result->fetch_assoc();

if (!$data) {
    die("Registro no encontrado");
}



$salario_base = floatval($data['salario_base']);
$horas_mes = 240;

$salario_hora = $salario_base / $horas_mes;

$monto_horas = $horas_trabajadas * $salario_hora;

$salario_bruto = ($salario_base / 2) + $monto_horas;

$deducciones = $salario_bruto * 0.1067;


$salario_neto = $salario_bruto - $deducciones;



$sql_update = "UPDATE planilla_detalle

               SET horas_trabajadas = ?,
                   salario_bruto = ?,
                   deducciones = ?,
                   salario_neto = ?,
                   observaciones = ?

               WHERE id_detalle = ?";

$stmt_update = $con->prepare($sql_update);

if (!$stmt_update) {
    die("Error SQL UPDATE: " . $con->error);
}

$stmt_update->bind_param(
    "ddddsi",
    $horas_trabajadas,
    $salario_bruto,
    $deducciones,
    $salario_neto,
    $observaciones,
    $id_detalle
);

if ($stmt_update->execute()) {

    header("Location: ../list_planilla_empleados.php");
    exit();

} else {

    echo "Error al actualizar";

}

?>