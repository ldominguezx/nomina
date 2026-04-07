<?php
include("../../conexion/conexion.php");

$sql = "UPDATE empleados SET nombre=?, cedula=?, puesto=? WHERE id_empleado=?";

$stmt = $con->prepare($sql);
$stmt->bind_param("sssi",
    $_POST['nombre'],
    $_POST['cedula'],
    $_POST['puesto'],
    $_POST['id']
);

$stmt->execute();

header("Location: ../../dashboard.php");
?>