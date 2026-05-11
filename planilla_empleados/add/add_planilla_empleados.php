<?php
session_start();
include("../../conexion/conexion.php");

if (
    empty($_POST['id_planilla']) ||
    empty($_POST['id_empleado'])
) {
    die("Datos incompletos");
}

$id_planilla = $_POST['id_planilla'];
$id_empleado = $_POST['id_empleado'];

$horas_extra = $_POST['horas_trabajadas'] ?? 0;
$observaciones = $_POST['observaciones'] ?? '';

$sql_emp = "SELECT salario_base 
            FROM empleados 
            WHERE id_empleado = ?";

$stmt_emp = $con->prepare($sql_emp);

$stmt_emp->bind_param("i", $id_empleado);

$stmt_emp->execute();

$result_emp = $stmt_emp->get_result();

if ($result_emp->num_rows == 0) {
    die("Empleado no encontrado");
}

$empleado = $result_emp->fetch_assoc();

$salario_base = $empleado['salario_base'];

$salario_quincena = $salario_base / 2;


$valor_hora = $salario_base / 240;



$valor_hora_extra = $valor_hora * 1.5;
$total_horas_extra = $horas_extra * $valor_hora_extra;

$salario_bruto = $salario_quincena + $total_horas_extra;


$deducciones = $salario_bruto * 0.1067;



$salario_neto = $salario_bruto - $deducciones;


$sql = "INSERT INTO planilla_detalle
(
    id_planilla,
    id_empleado,
    horas_trabajadas,
    salario_bruto,
    deducciones,
    salario_neto,
    observaciones
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?
)";

$stmt = $con->prepare($sql);

$stmt->bind_param(
    "iidddds",
    $id_planilla,
    $id_empleado,
    $horas_extra,
    $salario_bruto,
    $deducciones,
    $salario_neto,
    $observaciones
);

if ($stmt->execute()) {

    header("Location: ../list_planilla_empleados.php");
    exit();

} else {

    echo "Error al guardar: " . $con->error;

}
?>