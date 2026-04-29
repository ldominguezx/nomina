<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include("../conexion/conexion.php");
define("BASE_URL", "/nomina/");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Empleados</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

<?php include("../layouts/sidebar.php"); ?>

<div class="col-md-10 p-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Empleados</h3>
        <a href="../employees_cuenta/create_employees_cuenta.php" class="btn btn-success">+ Nueva Cuenta</a>
    </div>

    <div class="card p-3 shadow">
	<table class="table table-bordered">
		<tr>
		    <th>Empleado</th>
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
		    <td><?= $row['numero_cuenta'] ?></td>
		    <td><?= $row['tipo_cuenta'] ?></td>
		    <td><?= $row['moneda'] ?></td>

		    <td class="text-center">
			 <a href="edit_employees_cuenta.php?id=<?= $row['id_cuenta'] ?>" 
			       class="btn btn-warning btn-sm me-1" 
			       title="Editar">
			        <i class="fas fa-edit"></i>
			    </a>

			    <a href="delete/delete_employees_cuenta.php?id=<?= $row['id_cuenta'] ?>" 
			       class="btn btn-danger btn-sm"
			       title="Eliminar"
			       onclick="return confirm('¿Eliminar este registro?')">
			        <i class="fas fa-trash"></i>
			    </a>

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