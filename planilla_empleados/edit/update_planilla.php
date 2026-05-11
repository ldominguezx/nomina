<?php
session_start();

include("../../conexion/conexion.php");

$id = $_POST['id'];

$periodo = $_POST['periodo'];

$fecha_inicio = $_POST['fecha_inicio'];

$fecha_fin = $_POST['fecha_fin'];

$sql = "UPDATE planilla
        SET periodo = ?,
            fecha_inicio = ?,
            fecha_fin = ?
        WHERE id_planilla = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param(
    "sssi",
    $periodo,
    $fecha_inicio,
    $fecha_fin,
    $id
);

if($stmt->execute()){

    header("Location: ../list_planilla.php");
    exit();

}else{

    echo "Error al actualizar";

}
?>