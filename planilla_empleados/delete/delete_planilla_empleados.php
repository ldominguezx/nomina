<?php

session_start();

include("../../conexion/conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("ID no válido");
}

$id = $_GET['id'];

$sql = "DELETE FROM planilla_detalle
        WHERE id_detalle = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header("Location: ../list_planilla_empleados.php");
    exit();

} else {

    echo "Error al eliminar";

}

?>