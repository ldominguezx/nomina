<?php

include("../../conexion/conexion.php");

if(!isset($_GET['id_planilla'])){
    exit();
}

$id_planilla = $_GET['id_planilla'];

$sql = "SELECT 
            pd.*,
            e.nombre

        FROM planilla_detalle pd

        INNER JOIN empleados e
            ON pd.id_empleado = e.id_empleado

        WHERE pd.id_planilla = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("i", $id_planilla);

$stmt->execute();

$res = $stmt->get_result();

if($res->num_rows == 0){

    echo '
    <tr>
        <td colspan="6" class="text-center">
            No hay empleados
        </td>
    </tr>
    ';

    exit();
}

$i = 1;

while($row = $res->fetch_assoc()){

?>

<tr>

    <td><?= $i++ ?></td>

    <td>
        <?= $row['nombre'] ?>
    </td>

    <td>
        <?= number_format($row['horas_trabajadas'],2) ?>
    </td>

    <td>
        ₡<?= number_format($row['salario_bruto'],2) ?>
    </td>

    <td>
        ₡<?= number_format($row['deducciones'],2) ?>
    </td>

    <td>
        ₡<?= number_format($row['salario_neto'],2) ?>
    </td>

</tr>

<?php } ?>