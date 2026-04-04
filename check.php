<?php
session_start();

$conexion = new mysqli("localhost", "root", "admin$123", "nomina");

if ($conexion->connect_error) {
    die("Error de conexión");
}

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    $user = $resultado->fetch_assoc();
    if (password_verify($clave, $user['password'])) {

        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];
        $_SESSION['nombre'] = $user['nombre'];

        header("Location: dashboard.php");
        exit();

    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location='index.php';</script>";
    }

} else {
    echo "<script>alert('Usuario no existe'); window.location='index.php';</script>";
}
?>