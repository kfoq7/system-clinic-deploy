<?php
// Configurar encabezados para exportar como Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_citas.xls");

// Abrir la etiqueta de la tabla Excel
echo "<table border='1'>";
echo "<tr>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Paciente</th>
        <th>Médico</th>
        <th>Turno</th>
      </tr>";

// Conectar a la base de datos
require_once '../DAO/CitaModelDAO.php'; // Asegúrate de usar la ruta correcta
$model = new CitaModelDAO();

// Obtener las citas (puedes filtrar por fecha si es necesario)
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : null;
$citas = $model->obtenerCitas($fecha);

// Recorrer los resultados y generar las filas de la tabla
foreach ($citas as $cita) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($cita['fecha_cita']) . "</td>";
    echo "<td>" . htmlspecialchars($cita['hora_cita']) . "</td>";
    echo "<td>" . htmlspecialchars($cita['paciente_nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($cita['medico_nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($cita['turno']) . "</td>";
    echo "</tr>";
}

// Cerrar la tabla
echo "</table>";
exit;
?>
