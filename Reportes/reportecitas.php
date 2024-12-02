<?php
// Incluir el modelo de citas
require_once '../DAO/CitaModelDAO.php';

// Crear una instancia del modelo
$model = new CitaModelDAO();

// Obtener la fecha si se pasa como parámetro en la URL, o null si no se pasa
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : null;

// Obtener las citas desde el modelo
$citas = $model->obtenerCitas($fecha);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Citas</title>
    <!-- Agregar Bootstrap para estilo de botones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Reporte de Citas</h1>
        
        <!-- Botones para generar reporte PDF y Excel -->
        <div class="d-flex justify-content-center mt-3">
    <a href="pdfcitas.php" class="btn btn-danger mx-2">Generar Reporte PDF</a>
    <a href="excelcitas.php" class="btn btn-success mx-2">Generar Reporte Excel</a>
    <a href="../Vista/index.php" class="btn btn-success mx-2">Salir</a>
</div>

<!-- Formulario para filtrar y generar los reportes según la fecha -->
<div class="d-flex justify-content-center mt-3">
    <form action="../Reportes/pdfcitas.php" method="GET" class="mx-2">
        <label for="fecha_reporte_pdf">Filtrar por fecha para PDF:</label>
        <input type="date" id="fecha_reporte_pdf" name="fecha" class="form-control mx-2">
        <button type="submit" class="btn btn-danger">Generar PDF</button>
    </form>

    <form action="../Reportes/excelcitas.php" method="GET" class="mx-2">
        <label for="fecha_reporte_excel">Filtrar por fecha para Excel:</label>
        <input type="date" id="fecha_reporte_excel" name="fecha" class="form-control mx-2">
        <button type="submit" class="btn btn-success">Generar Excel</button>
    </form>
</div>

<hr>

        <hr>
        
        <!-- Tabla de Citas -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Turno</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Recorrer el array de citas
                foreach ($citas as $row) { ?>
                <tr>
                    <td><?php echo $row['fecha_cita']; ?></td>
                    <td><?php echo $row['hora_cita']; ?></td>
                    <td><?php echo $row['paciente_nombre']; ?></td>
                    <td><?php echo $row['medico_nombre']; ?></td>
                    <td><?php echo $row['turno']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Agregar Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
