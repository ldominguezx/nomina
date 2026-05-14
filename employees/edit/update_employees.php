<?php

include("../../conexion/conexion.php");

$sql = "UPDATE empleados 
        SET nombre = ?, 
            cedula = ?, 
            puesto = ?, 
            correo = ?, 
            salario_base = ?,
            fecha_ingreso = ?,
            telefono =?
        WHERE id_empleado = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error SQL: " . $con->error);
}

$nombre = $_POST['nombre'];

$cedula = $_POST['cedula'];

$puesto = $_POST['puesto'];

$correo = $_POST['correo'];

$salario_base = floatval($_POST['salario_base']);

$fecha = $_POST['fecha_ingreso'];
$telefono = $_POST['telefono'];

$id = intval($_POST['id']);

$stmt->bind_param(
    "ssssdssi",
    $nombre,
    $cedula,
    $puesto,
    $correo,
    $salario_base,
    $fecha,
    $telefono,
    $id
);

if ($stmt->execute()) {

    header("Location: ../list_employees.php");
    exit();

} else {

    echo "Error al actualizar: " . $stmt->error;

}

?>