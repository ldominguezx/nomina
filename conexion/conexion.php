<?php
$con = new mysqli("localhost", "root", "admin$123", "nomina");

if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

$con->set_charset("utf8");
?>