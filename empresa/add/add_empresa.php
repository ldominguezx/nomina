<?php
include("../../conexion/conexion.php");

$nombre = $_POST['nombre'];
$cedula = $_POST['cedula_juridica'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];

$sql = "INSERT INTO empresa (nombre, cedula_juridica, telefono, correo, direccion)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $nombre, $cedula, $telefono, $correo, $direccion);

$stmt->execute();

header("Location: ../list_empresa.php");
?>