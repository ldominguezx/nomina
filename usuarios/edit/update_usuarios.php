<?php
include("../../conexion/conexion.php");

$sql = "UPDATE usuarios SET nombre=?, usuario=?, correo=?, rol=? WHERE id_usuario=?";

$stmt = $con->prepare($sql);
$stmt->bind_param("ssssi",
    $_POST['nombre'],
    $_POST['usuario'],
    $_POST['correo'],
    $_POST['rol'],
    $_POST['id']
);

$stmt->execute();

header("Location: ../../dashboard.php");
?>