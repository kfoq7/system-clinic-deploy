<?php
require('fpdf.php');

// Clase para el reporte en PDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(60);
        $this->Cell(70, 10, 'Reporte de Citas', 1, 0, 'C');
        $this->Ln(20);

        // Agregar encabezados de las columnas
        $this->Cell(40, 10, 'Fecha', 1, 0, 'C');
        $this->Cell(30, 10, 'Hora', 1, 0, 'C');
        $this->Cell(50, 10, 'Paciente', 1, 0, 'C');
        $this->Cell(50, 10, 'Medico', 1, 0, 'C');
        $this->Cell(20, 10, 'Turno', 1, 1, 'C');
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

require '../util/conexion.php'; // Conexión a la base de datos
require_once '../DAO/CitaModelDAO.php'; // Ruta de tu DAO

$model = new CitaModelDAO();
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : null;
$citas = $model->obtenerCitas($fecha);

// Crear el PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Imprimir los datos de las citas en el PDF
foreach ($citas as $cita) {
    $pdf->Cell(40, 10, $cita['fecha_cita'], 1, 0, 'C');
    $pdf->Cell(30, 10, $cita['hora_cita'], 1, 0, 'C');
    $pdf->Cell(50, 10, $cita['paciente_nombre'], 1, 0, 'C');
    $pdf->Cell(50, 10, $cita['medico_nombre'], 1, 0, 'C');
    $pdf->Cell(20, 10, $cita['turno'], 1, 1, 'C');
}

// Salida del PDF
$pdf->Output();
?>
