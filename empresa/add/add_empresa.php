<?php
include("../../conexion/conexion.php");

$nombre = $_POST['nombre'];
$cedula = $_POST['cedula_juridica'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$ibc= $_POST["numero_cliente_ibc"];
$sql = "INSERT INTO empresa (nombre, cedula_juridica, telefono, correo, direccion,ibc)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("ssssss", $nombre, $cedula, $telefono, $correo, $direccion, $ibc);

$stmt->execute();

header("Location: ../list_empresa.php");
?>