<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="col-md-2 sidebar">
    <h4>Nomina</h4>
    <hr>

    <p><strong><?= $_SESSION['nombre'] ?? '' ?></strong></p>

   		<a href="<?= BASE_URL ?>dashboard.php">Inicio</a>

		<?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
		    <a href="<?= BASE_URL ?>usuarios/list_usuarios.php">Usuarios</a>
		<?php endif; ?>

		<a href="<?= BASE_URL ?>employees/list_employees.php"> Empleados</a>
		<a href="<?= BASE_URL ?>employees_cuenta/list_employees_cuenta.php">Empleados Cuentas</a>
		<a href="<?= BASE_URL ?>empresa/list_empresa.php">Empresa</a>
		<a href="<?= BASE_URL ?>empresa/list_empresa.php">Empresa Cuentas</a>
  		<a href="#">Planilla</a>
        <a href="#">Pagos</a>
		<a href="<?= BASE_URL ?>logout.php">Cerrar sesión</a>
</div>