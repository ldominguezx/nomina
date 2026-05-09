<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("../../conexion/conexion.php");
if (!isset($_POST['id'])) {
    die("ID inválido");
}
$id         = $_POST['id'];
$nombre     = $_POST['nombre'];
$cedula     = $_POST['cedula_juridica'];
$ibc        = $_POST['numero_cliente_ibc'];
$telefono   = $_POST['telefono'];
$correo     = $_POST['correo'];
$direccion  = $_POST['direccion'];
$sql = "UPDATE empresa 
        SET 
            nombre = ?,
            cedula_juridica = ?,
            ibc = ?,
            telefono = ?,
            correo = ?,
            direccion = ?
        WHERE id_empresa = ?";
$stmt = $con->prepare($sql);
if (!$stmt) {
    die("Error en prepare: " . $con->error);
}
$stmt->bind_param(
    "ssssssi",
    $nombre,
    $cedula,
    $ibc,
    $telefono,
    $correo,
    $direccion,
    $id
);

if ($stmt->execute()) {

    header("Location: ../list_empresa.php");
    exit();

} else {

    die("Error execute: " . $stmt->error);

}
?>