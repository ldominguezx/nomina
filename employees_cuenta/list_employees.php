<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include("../conexion/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Empleados</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f4f6f9; }
.sidebar { height:100vh; background:#1e3c72; color:white; padding:20px; }
.sidebar a { color:white; display:block; margin:10px 0; text-decoration:none; }
.sidebar a:hover { background:#2a5298; padding-left:10px; border-radius:5px; }
.card { border-radius:15px; }
</style>
</head>

<body>

<div class="container-fluid">
<div class="row">

        <div class="col-md-2 sidebar">
            <h4>Nomina</h4>
            <hr>

            <p><strong><?= $_SESSION['nombre'] ?></strong></p>

            <a href="#">Inicio</a>

            <?php if($_SESSION['rol'] == 'admin'): ?>
            <a href="usuarios/list_usuarios.php">Usuarios</a>
            <?php endif; ?>
			<a href="../employees/list_employees.php">Empleados</a>
			<a href="../employees_cuenta/list_employees.php">Empleados Cuentas</a>
            <a href="#">Planilla</a>
            <a href="#">Pagos</a>
            <a href="logout.php">Cerrar sesion</a>
        </div>

<div class="col-md-10 p-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Empleados</h3>
        <a href="../employees_cuenta/create_employees_cuenta.php" class="btn btn-success">+ Nueva Cuenta</a>
    </div>

    <div class="card p-3 shadow">
	<table class="table table-bordered">
		<tr>
		    <th>Empleado</th>
		    <th>Banco</th>
		    <th>Cuenta</th>
		    <th>Tipo</th>
		    <th>Moneda</th>
		    <th>Acciones</th>
		</tr>

		<?php
		$sql = "SELECT ec.*, e.nombre 
		        FROM empleados_cuentas ec
		        INNER JOIN empleados e ON ec.id_empleado = e.id_empleado
		        WHERE ec.estado = 1";

		$res = $con->query($sql);

		while($row = $res->fetch_assoc()){
		?>

		<tr>
		    <td><?= $row['nombre'] ?></td>
		    <td><?= $row['banco'] ?></td>
		    <td><?= $row['numero_cuenta'] ?></td>
		    <td><?= $row['tipo_cuenta'] ?></td>
		    <td><?= $row['moneda'] ?></td>

		    <td>
		        <a href="edit.php?id=<?= $row['id_cuenta'] ?>">Editar</a>
		        <a href="delete/delete.php?id=<?= $row['id_cuenta'] ?>">Eliminar</a>
		    </td>
		</tr>

		<?php } ?>
		</table>
			
	
    </div>

</div>
</div>
</div>

</body>
</html>