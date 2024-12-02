<?php
require_once '../Controlador/HistorialMedicoController.php'; // Asegúrate de que esta ruta sea correcta
$controlador = new HistorialMedicoController();
$historiales = $controlador->getHistorialMedicoByNameOrDate('', NULL); // Inicializa un array para los historiales

// echo ("<script>console.log('PHP: " . json_encode($historiales) . "');</script>");

// Verifica si se ha activado una acción de búsqueda
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
  $accion = $_POST['accion'];

  if ($accion === 'buscar') {
    // Obtén los historiales médicos filtrados por nombre de paciente o fecha
    $historiales = $controlador->getHistorialMedicoByNameOrDate(
      $_POST['nombre'],
      $_POST['fecha']
    );
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion de Enfemera</title>
  <link rel="stylesheet" href="Gestioncitas.css">
</head>

<body>
  <div class="container">
    <h1>Gestion de Enfemera</h1> 

    <form action="index.php" method="POST" style="display: inline-block;">
  <button type="submit" class="btn-salir">Salir</button>
</form>

    <!-- Formulario para buscar historiales médicos -->
    <form action="index_historialmedico.php" method="POST" class="historial-form" style="margin-top: 20px;">
        <input type="text" name="nombre" placeholder="Nombre del Paciente">
        <input type="date" name="fecha" placeholder="Fecha de Visita">
        <button type="submit" name="accion" value="buscar">Buscar</button>
    </form>
</div>

    <!-- Tabla para mostrar los historiales médicos -->
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre del Paciente</th>
          <th>Fecha de Visita</th>
          <th>Descripción</th>
          <th>Diagnóstico</th>
          <th>Tratamiento</th>
          <th>Teléfono</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($historiales as $historial): ?>
          <tr>
            <td><?= htmlspecialchars($historial['id_historial']) ?></td>
            <td><?= htmlspecialchars($historial['paciente_nombre']) ?></td>
            <td><?= htmlspecialchars($historial['fecha_visita']) ?></td>
            <td><?= htmlspecialchars($historial['descripcion']) ?></td>
            <td><?= htmlspecialchars($historial['diagnostico']) ?></td>
            <td><?= htmlspecialchars($historial['tratamiento']) ?></td>
            <td><?= htmlspecialchars($historial['telefono']) ?></td>
            <td><?= htmlspecialchars($historial['email']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>