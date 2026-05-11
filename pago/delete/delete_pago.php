<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

include("../../conexion/conexion.php");

if (!isset($_GET['id'])) {
    die("ID inválido");
}

$id = $_GET['id'];

$sql_check = "SELECT id_pago
              FROM pago_planilla
              WHERE id_pago = ?";

$stmt_check = $con->prepare($sql_check);

if (!$stmt_check) {
    die("Error SQL: " . $con->error);
}

$stmt_check->bind_param("i", $id);

$stmt_check->execute();

$result = $stmt_check->get_result();

if ($result->num_rows == 0) {
    die("Pago no encontrado");
}


$sql = "DELETE FROM pago_planilla
        WHERE id_pago = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error SQL DELETE: " . $con->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header("Location: ../list_pago.php");
    exit();

} else {

    echo "Error al eliminar: " . $con->error;

}

?>