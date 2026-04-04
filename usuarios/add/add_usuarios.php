<?php
include("../../conexion/conexion.php");

$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$rol = $_POST['rol'];

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, usuario, correo, password, rol)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $nombre, $usuario, $correo, $password, $rol);

if ($stmt->execute()) {
header("Location: ../../dashboard.php");
    exit();
} else {
    echo "Error al guardar: " . $con->error;
}
?>