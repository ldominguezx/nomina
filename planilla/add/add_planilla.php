<?php
session_start();

include("../../conexion/conexion.php");

$id_empresa = $_POST['id_empresa'];
$periodo = $_POST['periodo'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$sql = "INSERT INTO planilla
(id_empresa, periodo, fecha_inicio, fecha_fin)
VALUES (?, ?, ?, ?)";

$stmt = $con->prepare($sql);

$stmt->bind_param(
    "isss",
    $id_empresa,
    $periodo,
    $fecha_inicio,
    $fecha_fin
);

if($stmt->execute()){

    header("Location: ../list_planilla.php");
    exit();

}else{

    echo "Error al guardar";

}
?>