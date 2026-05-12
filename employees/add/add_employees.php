<?php
include("../../conexion/conexion.php");

$sql = "INSERT INTO empleados (nombre, cedula, telefono, correo, puesto, salario_base, fecha_ingreso)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("sssssss",
    $_POST['nombre'],
    $_POST['cedula'],
    $_POST['telefono'],
    $_POST['correo'],
    $_POST['puesto'],
    $_POST['salario_base'],
    $_POST['fecha_ingreso']
);

if ($stmt->execute()) {
header("Location: ../list_employees.php");
    exit();
} else {
    echo "Error al guardar: " . $con->error;
}
?>