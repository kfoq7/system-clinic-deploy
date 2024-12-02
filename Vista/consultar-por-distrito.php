<?php
require_once '../Controlador/PacienteController.php';
require_once '../Controlador/DistritoController.php';

$controlador = new PacienteController();
$pacientes = $controlador->getPacienteByIdOrNameOrDistrict(null, '', null);

$controladorDistritos = new DistritoController();
$distritos = $controladorDistritos->getAllDistritos();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
  $accion = $_POST['accion'];


  if ($accion === 'consultar') {
    $pacientes = $controlador->getPacienteByIdOrNameOrDistrict(
      $_POST['id'],
      $_POST['nombre'],
      $_POST['selDistrito'],
    );
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
    <h1>Consultar Paciente</h1>

    <div class="form-container">
      <form method="POST" action="consultar-por-distrito.php">
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
            <label for="selDistrito">Seleccione un Distrito:</label>
            <select name="selDistrito" id="selDistrito">
              <option value="">-- Seleccione un Distrito --</option>
              <?php foreach ($distritos as $distrito): ?>
                <option value="<?= $distrito['id_distrito'] ?>"
                  <?= (isset($pacienteToEdit) && $pacienteToEdit['id_distrito'] == $distrito['id_distrito']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($distrito['nombre_distrito']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <button class="submit-btn" type="submit" name="accion" value="consultar">Consultar</button>
      </form>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Fecha de Nacimiento</th>
            <th>Distrito</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pacientes as $paciente): ?>
            <tr>
              <td><?= htmlspecialchars($paciente['id_paciente']) ?></td>
              <td><?= htmlspecialchars($paciente['nombre']) ?></td>
              <td><?= htmlspecialchars($paciente['direccion']) ?></td>
              <td><?= htmlspecialchars($paciente['fecha_nacimiento']) ?></td>
              <td><?= htmlspecialchars($paciente['email']) ?></td>
              <td><?= htmlspecialchars($paciente['nombre_distrito']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</body>

</html>