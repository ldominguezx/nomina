<?php
session_start();

include("../../conexion/conexion.php");

if(!isset($_GET['id'])){

    die("ID inválido");

}

$id = $_GET['id'];

$sql = "DELETE FROM planilla
        WHERE id_planilla = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("i", $id);

if($stmt->execute()){

    header("Location: ../list_planilla.php");
    exit();

}else{

    echo "Error al eliminar";

}
?>