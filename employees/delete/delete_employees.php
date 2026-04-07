<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

include("../../conexion/conexion.php");

if (!isset($_GET['id'])) {
    die("ID no válido");
}

$id = $_GET['id'];

$stmt = $con->prepare("UPDATE empleados SET activo=0 WHERE id_empleado=?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
   header("Location: ../../dashboard.php");
    exit();
} else {
    echo "Error al eliminar";
}
?>