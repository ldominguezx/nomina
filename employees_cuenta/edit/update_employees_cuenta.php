<?php
session_start();
include("../../conexion/conexion.php");

if (
    empty($_POST['id']) ||
    empty($_POST['producto']) ||
    empty($_POST['moneda']) ||
    empty($_POST['oficina']) ||
    empty($_POST['cuenta']) ||
    $_POST['dv'] === ""
) {
    die("Datos incompletos");
}

$id = $_POST['id'];
$producto = $_POST['producto'];
$moneda = $_POST['moneda'];
$oficina = str_pad($_POST['oficina'], 3, "0", STR_PAD_LEFT);
$cuenta = str_pad($_POST['cuenta'], 6, "0", STR_PAD_LEFT);
$dv = $_POST['dv'];
$tipo = $_POST['tipo_cuenta'];

$numero_cuenta = $producto . $moneda . $oficina . $cuenta . $dv;

if (strlen($numero_cuenta) != 15) {
    die("La cuenta debe tener 15 dígitos");
}

if (!preg_match('/^[0-9]{15}$/', $numero_cuenta)) {
    die("❌ Formato inválido");
}

$sql_check = "SELECT id_cuenta 
              FROM empleados_cuentas 
              WHERE numero_cuenta = ? AND id_cuenta != ?";

$stmt_check = $con->prepare($sql_check);
$stmt_check->bind_param("si", $numero_cuenta, $id);
$stmt_check->execute();

$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    die("Esta cuenta ya existe");
}

$sql = "UPDATE empleados_cuentas 
        SET numero_cuenta = ?, 
            tipo_cuenta = ?, 
            moneda = ?
        WHERE id_cuenta = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("sssi", $numero_cuenta, $tipo, $moneda, $id);

if ($stmt->execute()) {
    header("Location: ../list_employees_cuenta.php");
    exit();
} else {
    echo "Error al actualizar: " . $con->error;
}
?>