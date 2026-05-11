<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

include("../conexion/conexion.php");

date_default_timezone_set('America/Costa_Rica');

if (!isset($_GET['id'])) {
    die("ID de pago inválido");
}

$id_pago = $_GET['id'];

function zero_fill($valor, $long = 0)
{
    return str_pad($valor, $long, '0', STR_PAD_LEFT);
}

function parseCuenta($cuenta)
{
    return [
        'producto' => substr($cuenta,0,3),
        'moneda'   => substr($cuenta,3,2),
        'oficina'  => substr($cuenta,5,3),
        'numero'   => substr($cuenta,8,6),
        'dv'       => substr($cuenta,14,1)
    ];
}



$sql_pago = "SELECT 
                pp.*,
                pl.id_empresa,
                emp.ibc,
                ec.numero_cuenta AS cuenta_empresa

            FROM pago_planilla pp

            INNER JOIN planilla pl
                ON pp.id_planilla = pl.id_planilla

            INNER JOIN empresa emp
                ON pl.id_empresa = emp.id_empresa

            INNER JOIN empresa_cuentas ec
                ON pp.id_empresa_cuenta = ec.id_cuenta

            WHERE pp.id_pago = ?";

$stmt_pago = $con->prepare($sql_pago);

if (!$stmt_pago) {
    die("Error SQL pago: " . $con->error);
}

$stmt_pago->bind_param("i", $id_pago);

$stmt_pago->execute();

$pago = $stmt_pago->get_result()->fetch_assoc();

if (!$pago) {
    die("Pago no encontrado");
}

$sql_detalle = "SELECT 
                    pd.salario_neto,
                    e.nombre,
                    ec.numero_cuenta

                FROM planilla_detalle pd

                INNER JOIN empleados e
                    ON pd.id_empleado = e.id_empleado

                INNER JOIN empleados_cuentas ec
                    ON e.id_empleado = ec.id_empleado

                WHERE pd.id_planilla = ?";

$stmt_detalle = $con->prepare($sql_detalle);

if (!$stmt_detalle) {
    die("Error SQL detalle: " . $con->error);
}

$stmt_detalle->bind_param("i", $pago['id_planilla']);

$stmt_detalle->execute();

$detalles = $stmt_detalle->get_result();

if ($detalles->num_rows == 0) {
    die("No existen empleados en esta planilla");
}




$cliente     = $pago['ibc'];
$fecha       = date("dmY");
$cuenta      = $pago['cuenta_empresa'];
$comprobante = "1000";
$concepto    = "PLANILLA";

$total = 0;

$rows = [];

while($row = $detalles->fetch_assoc()){

    $rows[] = $row;

    $total += $row['salario_neto'];
}



$encabezado =
    "1" .
    zero_fill($cliente,6) .
    $fecha .
    zero_fill(0,6) .
    zero_fill(0,6) .
    "1" .
    zero_fill(0,4) .
    zero_fill($total * 100,12) .
    zero_fill(0,7) .
    zero_fill(0,7) .
    zero_fill(0,10);

$c = parseCuenta($cuenta);

$t1 =
    "2" .
    $c['oficina'] .
    $c['producto'] .
    $c['moneda'] .
    $c['numero'] .
    $c['dv'] .
    zero_fill($comprobante,8) .
    zero_fill($total * 100,12) .
    str_pad($concepto,30," ",STR_PAD_RIGHT) .
    "00";



$contenido = "";

$contenido .= $encabezado . "\r\n";

$contenido .= $t1 . "\r\n";

$tcs = 0;


foreach($rows as $r){

    $monto = $r['salario_neto'];

    $cuentaEmpleado = parseCuenta($r['numero_cuenta']);

    $descripcion = strtoupper($r['nombre']);

    $t2 =
        "3" .
        $cuentaEmpleado['oficina'] .
        $cuentaEmpleado['producto'] .
        $cuentaEmpleado['moneda'] .
        $cuentaEmpleado['numero'] .
        $cuentaEmpleado['dv'] .
        zero_fill($comprobante,8) .
        zero_fill($monto * 100,12) .
        str_pad($descripcion,30," ",STR_PAD_RIGHT) .
        "00";

    $contenido .= $t2 . "\r\n";

    $tcs += $cuentaEmpleado['numero'];
}


$cs = substr($cuenta,8,6) + $tcs;

$testkey = "IJKACARTAT";

$control =
    "4" .
    zero_fill($total * 100,15) .
    zero_fill($cs,10) .
    str_pad($testkey,10," ",STR_PAD_RIGHT) .
    zero_fill(0,12) .
    zero_fill(0,12) .
    zero_fill(0,8);

$contenido .= $control;

$filename = "planilla_" . date('Ymd_His') . ".env";

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="' . $filename . '"');

echo $contenido;

exit();

?>