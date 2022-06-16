<?php

require 'vendor/autoload.php';
require 'conexion_db.php';

use PhpOffice\PhpSpreadsheet\{SpreadSheet, IOFactory};

$consulta = "SELECT v.id,v.id_evento, e.fecha, e.franja_horaria, u.nick_name FROM venta v
                        INNER JOIN evento e ON (e.id = v.id_evento) INNER JOIN usuario u ON (u.id = v.id_usuario)
                ;";

$ventas = mysqli_query($conexion, $consulta);

$spreadSheet = new Spreadsheet();
$hojaActiva = $spreadSheet->getActiveSheet();
$hojaActiva->setCellValue('A1', "Reporte de ventas de boletas");
$hojaActiva->setTitle("reporte");
$hojaActiva->setCellValue('A2', "Id venta");
$hojaActiva->setCellValue('B2', "Id evento");
$hojaActiva->setCellValue('C2', "Fecha evento");
$hojaActiva->setCellValue('D2', "Franja horaria");
$hojaActiva->setCellValue('E2', "Nick name cliente");

$fila = 3;
while ($rows = $ventas->fetch_assoc()) {
    $hojaActiva->setCellValue('A' . $fila, $rows['id']);
    $hojaActiva->setCellValue('B' . $fila, $rows['id_evento']);
    $hojaActiva->setCellValue('C' . $fila, $rows['fecha']);
    $hojaActiva->setCellValue('D' . $fila, $rows['franja_horaria']);
    $hojaActiva->setCellValue('E' . $fila, $rows['nick_name']);
    $fila++;
}
// 
/* Here there will be some code where you create $spreadsheet */

// redirect output to client browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadSheet, 'Xlsx');
$writer->save('php://output');
// exit;
// $_SESSION['mensaje'] = "Venta eliminado exitosamente";
// $_SESSION['tipo_mensaje'] = 'success';
header("Location: admin_boletas.php");
