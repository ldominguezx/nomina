<?php
session_start();
include("../../conexion/conexion.php");

if (!isset($_GET['id'])) {
    die("ID no válido");
}

$id = $_GET['id'];

$sql_check = "SELECT id_pago 
              FROM pago_planilla 
              WHERE id_empleado_cuenta = ?";

$stmt = $con->prepare($sql_check);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("No se puede eliminar, esta cuenta ya tiene pagos registrados");
}

$sql = "DELETE FROM empleados_cuentas WHERE id_cuenta = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../list_employees_cuenta.php");
    exit();
} else {
    echo "Error al eliminar";
}
?>