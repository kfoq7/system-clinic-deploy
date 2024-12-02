<?php
require_once '../Controlador/CitaController.php';

$controller = new CitaController();
$citas = $controller->obtenerCitaPorFecha(null);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action'])) {
    if ($_GET['action'] == 'guardarCita') {
        $controller->guardarCita();
    }

    if ($_GET['action'] === 'buscarFecha') {
        $citas = $controller->obtenerCitaPorFecha($_POST['fecha']);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="style_citas.css">
    <script src="../public/js/script.js"></script>

</head>

<body>
    <h1>Gestión de Citas de la Clínica</h1>
       
   

    <form action="index.php" method="POST" style="display: inline-block;">
         <button type="submit" class="btn-salir">Salir</button>
    </form>

    <form action="citas_view.php?action=guardarCita" method="POST">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required>

        <label for="paciente_id">ID Paciente:</label>
        <input type="text" id="paciente_id" name="paciente_id" required>

        <label for="medico_id">ID Médico:</label>
        <input type="text" id="medico_id" name="medico_id" required>

        <label for="turno">Turno:</label>
        <input id="turno" name="turno" required></input>

        <button type="submit">Agregar Cita</button>
    </form>

    <form action="citas_view.php?action=buscarFecha" method="POST" class="historial-form">
        <!-- <input type="text" name="nombre" placeholder="Nombre del Paciente"> -->
        <input type="date" name="fecha" placeholder="Fecha de Visita">
        <button type="submit" name="accion" value="buscar">Buscar</button>
    </form>
    <form action="../Reportes/pdfcitas.php" method="GET">
        <label for="fecha_reporte">Filtrar por fecha:</label>
        <input type="date" id="fecha_reporte" name="fecha">
        <button type="submit">Generar PDF</button>
    </form>
        <form action="../Reportes/excelcitas.php" method="GET">
        <label for="fecha_reporte">Filtrar por fecha:</label>
        <input type="date" id="fecha_reporte" name="fecha">
        <button type="submit">Descargar Reporte</button>
    </form>


    <h2>Listado de Citas</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>ID Paciente</th>
                <th>ID Médico</th>
                <th>Turno</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($citas as $cita): ?>
                <tr>
                    <td><?= htmlspecialchars($cita['fecha_cita']) ?></td>
                    <td><?= htmlspecialchars($cita['hora_cita']) ?></td>
                    <td><?= htmlspecialchars($cita['paciente_nombre']) ?></td>
                    <td><?= htmlspecialchars($cita['medico_nombre']) ?></td>
                    <td><?= htmlspecialchars($cita['turno']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>