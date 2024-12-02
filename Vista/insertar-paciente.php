<?php
require_once '../Controlador/PacienteController.php';
require_once '../Controlador/DistritoController.php';

$controlador = new PacienteController();
$pacientes = $controlador->getAllPacientes();

$controladorDistritos = new DistritoController();
$distritos = $controladorDistritos->getAllDistritos();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
  $accion = $_POST['accion'];

  if ($accion === 'agregar') {
    $controlador->agregar(
      $nombre = $_POST['nombre'],
      $direccion = $_POST['direccion'],
      $fecha_nacimiento = $_POST['fecha_nacimiento'],
      $distrito = $_POST['selDistrito'],
      $email = $_POST['email'],
    );
    header('Location: inserta-paciente.php?status=success');
    exit();
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Lista de Paciente</title>
  <link rel="stylesheet" type="text/css" href="lista-pacientes.css">
</head>

<body>
  <header>
    <?php include 'header.php'; ?>
  </header>
  <section>
    <h1>Nuevo Paciente</h1>

    <?php if (isset($_GET['status'])): ?>
      <p class="status-message">
        <?php if ($_GET['status'] === 'success') echo "Medicamento agregado exitosamente"; ?>
      </p>
    <?php endif; ?>

    <div class="form-container">
      <form method="POST" action="lista-pacientes.php">
        <div class="form-row">
          <div>
            <label for="codigo">Código:</label>
            <input name="id" type="text" value="">
          </div>
          <div>
            <label for="nombre">Nombre:</label>
            <input name="nombre" type="text" value="">
          </div>
          <div>
            <label for="direccion">Dirección:</label>
            <input name="direccion" type="text" value="">
          </div>
          <div>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input name="fecha_nacimiento" type="date" class="styled-date" value="">
          </div>
          <div>
            <label for="selDistrito">Seleccione un Distrito:</label>
            <select name="selDistrito" id="selDistrito">
              <?php foreach ($distritos as $distrito): ?>
                <option value="<?= $distrito['id_distrito'] ?>"
                  <?= (isset($pacienteToEdit) && $pacienteToEdit['id_distrito'] == $distrito['id_distrito']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($distrito['nombre_distrito']) ?>
                </option>
              <?php endforeach; ?>
            </select>

          </div>
          <div>
            <label for="email">Email:</label>
            <input name="email" type="text" value="">
          </div>
        </div>

        <button class="submit-btn" type="submit" name="accion" value="agregar">Agregar</button>
      </form>
    </div>
  </section>
</body>

</html>