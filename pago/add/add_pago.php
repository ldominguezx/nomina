<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("../../conexion/conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

if (
    empty($_POST['id_planilla']) ||
    empty($_POST['id_empresa_cuenta']) ||
    empty($_POST['metodo_pago'])
) {
    die("Datos incompletos");
}

$id_planilla = $_POST['id_planilla'];

$id_empresa_cuenta = $_POST['id_empresa_cuenta'];

$metodo_pago = $_POST['metodo_pago'];

$referencia = $_POST['referencia'] ?? '';

$observaciones = $_POST['observaciones'] ?? '';



/*
|--------------------------------------------------------------------------
| VALIDAR SI YA EXISTE PAGO PARA ESA PLANILLA
|--------------------------------------------------------------------------
*/

$sql_check = "SELECT id_pago
              FROM pago_planilla
              WHERE id_planilla = ?";

$stmt_check = $con->prepare($sql_check);

if (!$stmt_check) {
    die("Error SQL CHECK: " . $con->error);
}

$stmt_check->bind_param("i", $id_planilla);

$stmt_check->execute();

$result = $stmt_check->get_result();

if ($result->num_rows > 0) {

    die("Esta planilla ya fue pagada");

}



/*
|--------------------------------------------------------------------------
| INSERTAR PAGO
|--------------------------------------------------------------------------
*/

$sql_insert = "INSERT INTO pago_planilla (

                    id_planilla,
                    id_empresa_cuenta,
                    metodo_pago,
                    referencia,
                    observaciones

                )

                VALUES (?, ?, ?, ?, ?)";

$stmt_insert = $con->prepare($sql_insert);

if (!$stmt_insert) {
    die("Error INSERT: " . $con->error);
}

$stmt_insert->bind_param(

    "iisss",

    $id_planilla,
    $id_empresa_cuenta,
    $metodo_pago,
    $referencia,
    $observaciones

);

if ($stmt_insert->execute()) {

    header("Location: ../list_pago.php");
    exit();

} else {

    echo "Error al registrar pago";

}

?>