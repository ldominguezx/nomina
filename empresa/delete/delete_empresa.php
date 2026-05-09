<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("../../conexion/conexion.php");

if (!isset($_GET['id'])) {
    die("ID no válido");
}

$id = $_GET['id'];
$sql = "DELETE FROM empresa WHERE id_empresa = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error prepare: " . $con->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header("Location: ../list_empresa.php");
    exit();

} else {

    die("Error execute: " . $stmt->error);

}
?>